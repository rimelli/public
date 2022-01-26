<?php
class Post
{
	private $user_obj;
	private $con;

	public function __construct($con, $user)
	{
		$this->con = $con;
		$this->user_obj = new User($con, $user);
	}

	public function submitPost($body, $user_to, $imageName)
	{

		global $userLoggedIn;

		$body = strip_tags($body); //Removes html tags

		$body = str_replace('\r\n', '\n', $body);
		$body = nl2br($body);

		$check_empty = preg_replace('/\s+/', '', $body); //Deletes all spaces

		if ($check_empty != "") {

			$body_array = preg_split("/\s+/", $body);

			foreach ($body_array as $key => $value) {

				if (strpos($value, "www.youtube.com/watch?v=") !== false) {

					//Youtube videos url from playlists (longer urls)
					$link = preg_split("!&!", $value);

					$value = preg_replace("!watch\?v=!", "embed/", $link[0]);
					$value = "<br><iframe width=\'420\' height=\'315\' src=\'" . $value . "\'></iframe><br>";
					$body_array[$key] = $value;
				}
			}

			$body = implode(" ", $body_array);


			//Current date and time
			$date_added = date("Y-m-d H:i:s");
			//Get user id
			$added_by = $this->user_obj->getUserId();

			//Insert post
			$query = $this->con->prepare("INSERT INTO posts VALUES(NULL, ?, ?, ?, ?, 'no', 'no', '0', ?)");
			$query->execute([$body, $added_by, $user_to, $date_added, $imageName]);
			$returned_id = $this->con->lastInsertId();

			//Insert notification
			if ($user_to != $userLoggedIn) {
				$notification = new Notification($this->con, $added_by);
				$notification->insertNotification($returned_id, $user_to, "profile_post");
			}

			//Update post count for user
			$num_posts = $this->user_obj->getNumPosts();
			$num_posts++;
			$update_query = $this->con->prepare("UPDATE users SET num_posts=? WHERE user_id=?");
			$update_query->execute([$num_posts, $added_by]);
		}
	}

	public function loadPostsFriends($data, $limit)
	{

		$page = $data['page'];
		$userLoggedIn = $this->user_obj->getUserId();

		if ($page == 1)
			$start = 0;
		else
			$start = ($page - 1) * $limit;


		$str = ""; //String to return
		$data_query = $this->con->query("SELECT * FROM posts WHERE deleted='no' ORDER BY id DESC");

		if ($data_query->rowCount() > 0) {


			$num_iterations = 0; //Number of results checked (not necessarily posted)
			$count = 1;

			while ($row = $data_query->fetch()) {
				$id = $row['id'];
				$body = $row['body'];
				$added_by = $row['added_by'];
				$date_time = $row['date_added'];
				$imagePath = $row['image'];
				$user_to = $row['user_to'];

				$profile_to_query = $this->con->prepare("SELECT * FROM users WHERE user_id=?");
				$profile_to_query->execute([$user_to]);
				$profile_to = $profile_to_query->fetch();
				$profile_to_user = $profile_to['username'];

				//Check if user who posted, has their account closed
				$added_by_obj = new User($this->con, $added_by);
				if ($added_by_obj->isClosed()) {
					continue;
				}

				$user_logged_obj = new User($this->con, $userLoggedIn);
				if ($user_logged_obj->isFollowing($added_by) || $user_to = $added_by) {

					if ($num_iterations++ < $start)
						continue;


					//Once 10 posts have been loaded, break
					if ($count > $limit) {
						break;
					} else {
						$count++;
					}

					if ($userLoggedIn == $added_by) {
						$delete_button = "<a href='#delete-dialog$id' id='delp$id' class='button red ripple-effect ico popup-with-zoom-anim' title='Delete Post' data-tippy-placement='left'>
						<i class='icon-feather-trash-2'></i>
					</a>
					<!-- Delete Post popup -->
					<div id='delete-dialog$id' class='zoom-anim-dialog mfp-hide dialog-with-tabs'>
	
						<!--Tabs -->
						<div class='sign-in-form'>
	
							<ul class='popup-tabs-nav'>
								<li><a href='#tab$id'>Delete Post</a></li>
							</ul>
	
							<div class='popup-tabs-container'>
	
								<!-- Tab -->
								<div class='popup-tab-content' id='tab$id'>
	
									<!-- Welcome Text -->
									<div class='welcome-text'>
										<h4>Are you sure you want to delete your This Post?</h4>
									</div>
	
									<a href='#' data-post_id='$id' class='button full-width red ripple-effect ico post-remove' title='Remove'>
										Yes Delete <i data-post_id='$id' class='icon-feather-trash-2'></i>
									</a>
	
									<!-- Button -->
	
	
								</div>
	
							</div>
						</div>
					</div>
					<!-- Close Delete popup / End -->
					";
					} else {
						$delete_button = "";
					}


					$user_details_query = $this->con->prepare("SELECT first_name, last_name, profile_pic FROM users WHERE user_id=?");
					$user_details_query->execute([$added_by]);
					$user_row = $user_details_query->fetch();
					$first_name = $user_row['first_name'];
					$last_name = $user_row['last_name'];
					$profile_pic = $user_row['profile_pic'];


?>
					<script>
						$('#delp<?php echo $id; ?>').magnificPopup({
							type: 'inline',

							fixedContentPos: false,
							fixedBgPos: true,

							overflowY: 'auto',

							closeBtnInside: true,
							preloader: false,

							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
						});

						function toggle<?php echo $id; ?>() {

							var target = $(event.target);
							if (!target.is("a") && !target.is("button")) {
								var element = document.getElementById("toggleComment<?php echo $id; ?>");

								if (element.style.display == "block")
									element.style.display = "none";
								else
									element.style.display = "block";
							}
						}
					</script>
				<?php

					$comments_check = $this->con->prepare("SELECT * FROM comments WHERE post_id=?");
					$comments_check->execute([$id]);
					$comments_check_num = $comments_check->rowCount();


					//Timeframe
					$date_time_now = date("Y-m-d H:i:s");
					$start_date = new DateTime($date_time); //Time of post
					$end_date = new DateTime($date_time_now); //Current time
					$interval = $start_date->diff($end_date); //Difference between dates
					if ($interval->y >= 1) {
						if ($interval == 1)
							$time_message = $interval->y . " year ago"; //1 year ago
						else
							$time_message = $interval->y . " years ago"; //1+ year ago
					} elseif ($interval->m >= 1) {
						if ($interval->d == 0) {
							$days = " ago";
						} else if ($interval->d == 1) {
							$days = $interval->d . " day ago";
						} else {
							$days = $interval->d . " days ago";
						}


						if ($interval->m == 1) {
							$time_message = $interval->m . " month ago";
						} else {
							$time_message = $interval->m . " months ago";
						}
					} else if ($interval->d >= 1) {
						if ($interval->d == 1) {
							$time_message = "Yesterday";
						} else {
							$time_message = $interval->d . " days ago";
						}
					} else if ($interval->h >= 1) {
						if ($interval->h == 1) {
							$time_message = $interval->h . " hour ago";
						} else {
							$time_message = $interval->h . " hours ago";
						}
					} else if ($interval->i >= 1) {
						if ($interval->i == 1) {
							$time_message = $interval->i . " minute ago";
						} else {
							$time_message = $interval->i . " minutes ago";
						}
					} else {
						if ($interval->s < 30) {
							$time_message = "Just now";
						} else {
							$time_message = $interval->s . " seconds ago";
						}
					}

					if ($imagePath != "") {
						if (strpos($imagePath, ';') === false) {
							$imageDiv = "<div class='postedImage'><img src='$imagePath'></div>";
						} else {
							$images = explode(';', $imagePath);
							$imageDiv = '<div class="postedImage"><div class="multi">';

							foreach ($images as $image) {
								$imageDiv .= sprintf('<img src="%s">', $image);
							}

							$imageDiv .= '</div></div>';
						}
					} else {
						$imageDiv = "";
					}



					//Get number of likes for the post:
					$get_likes = $this->con->prepare("SELECT likes FROM posts WHERE id=?");
					$get_likes->execute([$id]);
					$row = $get_likes->fetch();
					$total_likes = $row['likes'];

					//Check if user already liked the post:
					$check_query = $this->con->prepare("SELECT * FROM likes WHERE user_id=? AND post_id=?");
					$check_query->execute([$userLoggedIn, $id]);
					$num_rows = $check_query->rowCount();


					$likes_num = '';

					if ($total_likes === "1") {
						$likes_num .= "<span class='like_value' id='total_like_$id'>$total_likes Like</span>";
					} else {
						$likes_num .= "<span class='like_value' id='total_like_$id'>$total_likes Likes</span>";
					}



					$like_button = '';

					if ($num_rows > 0) {
						$like_button .= "<button id='like_button_$id' name='like_button' onclick='sendLike($id)' value='Like'>
											<a href='#'><i class='icon-line-awesome-thumbs-down'></i> Unlike</a>
										</button>";
					} else {
						$like_button .= "<button>
											<a href='#' id='like_button_$id' name='like_button' onclick='sendLike($id)' value='Like'><i class='icon-line-awesome-thumbs-up'></i> Like</a>
										</button>";
					}



					$str .= "<li id='post_$id'><div class='freelancer-overview manage-candidates'>
								<div class='freelancer-overview-inner'>

									<div class='freelancer-avatar'>
										<a href='$profile_to_user'><img src='$profile_pic'></a>
									</div>

									<div class='freelancer-name'>
										<h4><a href='$profile_to_user'> $first_name $last_name </a></h4><div class='float-right'>$time_message &nbsp $delete_button</div>
										<br>
										<br>
										<div>$body</div>
										<div>$imageDiv</div>


										<button onClick='javascript:toggle$id()'><h5 class='margin-top-45 margin-bottom-0'><i class='icon-line-awesome-comment'></i> Comments <span class='comments-amount'>($comments_check_num)</span></h5></button>
										<br>

										$likes_num

										$like_button											

									</div>

								</div>
							</div>

							</li>

							<div class='post_comment' id='toggleComment$id' style='display:none;'>
							
							   <div class='comments_area'>
							     <textarea id='comment$id' placeholder='Post a comment...'></textarea>
							     <input type='button' onclick='sendComment($id)' value='Send'>
							   </div>

							   	<section class='comments'>
							   		<ul>"
						. $this->getComments($id) .
						"</ul>
							  	</section>

							</div>
							<hr>";
				}

				?>

			<?php

			} //End while loop

			if ($count > $limit)
				$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
							<input type='hidden' class='noMorePosts' value='false'>";
			else
				$str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: center;'> No more posts to show! </p>";
		}

		echo $str;
	}


	public function loadProfilePosts($data, $limit)
	{

		$page = $data['page'];
		$profileUser = $data['profileUsername'];
		$userLoggedIn = $this->user_obj->getUserId();

		if ($page == 1)
			$start = 0;
		else
			$start = ($page - 1) * $limit;


		$str = ""; //String to return
		$data_query = $this->con->prepare("SELECT * FROM posts WHERE deleted='no' AND ((added_by=? AND user_to='none') OR user_to=?) ORDER BY id DESC");
		$data_query->execute([$profileUser, $profileUser]);

		if ($data_query->rowCount() > 0) {


			$num_iterations = 0; //Number of results checked (not necessarily posted)
			$count = 1;

			while ($row = $data_query->fetch()) {
				$id = $row['id'];
				$body = $row['body'];
				$added_by = $row['added_by'];
				$date_time = $row['date_added'];
				$imagePath = $row['image'];



				if ($num_iterations++ < $start)
					continue;


				//Once 10 posts have been loaded, break
				if ($count > $limit) {
					break;
				} else {
					$count++;
				}

				if ($userLoggedIn == $added_by)
					$delete_button = "<button class='delete_button btn-danger' id='post$id'>x</button>";
				else
					$delete_button = "";



				$user_details_query = $this->con->prepare("SELECT first_name, last_name, profile_pic FROM users WHERE user_id=?");
				$user_details_query->execute([$added_by]);
				$user_row = $user_details_query->fetch();
				$first_name = $user_row['first_name'];
				$last_name = $user_row['last_name'];
				$profile_pic = $user_row['profile_pic'];


			?>
				<script>
					function toggle<?php echo $id; ?>() {

						var target = $(event.target);
						if (!target.is("a")) {
							var element = document.getElementById("toggleComment<?php echo $id; ?>");

							if (element.style.display == "block")
								element.style.display = "none";
							else
								element.style.display = "block";
						}
					}
				</script>
				<?php

				$comments_check = $this->con->prepare("SELECT * FROM comments WHERE post_id=?");
				$comments_check->execute([$id]);
				$comments_check_num = $comments_check->rowCount();


				//Timeframe
				$date_time_now = date("Y-m-d H:i:s");
				$start_date = new DateTime($date_time); //Time of post
				$end_date = new DateTime($date_time_now); //Current time
				$interval = $start_date->diff($end_date); //Difference between dates
				if ($interval->y >= 1) {
					if ($interval == 1)
						$time_message = $interval->y . " year ago"; //1 year ago
					else
						$time_message = $interval->y . " years ago"; //1+ year ago
				} elseif ($interval->m >= 1) {
					if ($interval->d == 0) {
						$days = " ago";
					} else if ($interval->d == 1) {
						$days = $interval->d . " day ago";
					} else {
						$days = $interval->d . " days ago";
					}


					if ($interval->m == 1) {
						$time_message = $interval->m . " month" . $days;
					} else {
						$time_message = $interval->m . " months" . $days;
					}
				} else if ($interval->d >= 1) {
					if ($interval->d == 1) {
						$time_message = "Yesterday";
					} else {
						$time_message = $interval->d . " days ago";
					}
				} else if ($interval->h >= 1) {
					if ($interval->h == 1) {
						$time_message = $interval->h . " hour ago";
					} else {
						$time_message = $interval->h . " hours ago";
					}
				} else if ($interval->i >= 1) {
					if ($interval->i == 1) {
						$time_message = $interval->i . " minute ago";
					} else {
						$time_message = $interval->i . " minutes ago";
					}
				} else {
					if ($interval->s < 30) {
						$time_message = "Just now";
					} else {
						$time_message = $interval->s . " seconds ago";
					}
				}

				if ($imagePath != "") {
					$imageDiv = "<div class='postedImage'>
								<img src='$imagePath'>
							     </div>";
				} else {
					$imageDiv = "";
				}



				$str .= "<div class='status_post' onClick='javascript:toggle$id()'>
								<div class='post_profile_pic'>
									<img src='$profile_pic' width='50'>
								</div>

								<div class='posted_by' style='color:#ACACAC;'>
									<a href='$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;$time_message
									$delete_button
								</div>
								<div id='post_body'>
									$body
									<br>
									$imageDiv
									<br>
									<br>
								</div>

								<div class='newsfeedPostOptions'>
									Comments($comments_check_num)&nbsp;&nbsp;&nbsp;
									<iframe src='like.php?post_id=$id' scrolling='no'></iframe>
								</div>

							</div>

							<div class='post_comment' id='toggleComment$id' style='display:none;'>
								<iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
							</div>
							<hr>";

				?>
				<script>
					$(document).ready(function() {

						$('#post<?php echo $id; ?>').on('click', function() {
							bootbox.confirm("Are you sure you want to delete this post?", function(result) {

								$.post("includes/form_handlers/delete_post.php?post_id=<?php echo $id; ?>", {
									result: result
								});

								if (result)
									location.reload();

							})
						})



					});
				</script>
			<?php

			} //End while loop

			if ($count > $limit)
				$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
							<input type='hidden' class='noMorePosts' value='false'>";
			else
				$str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: center;'> No more posts to show! </p>";
		}

		echo $str;
	}

	public function getSinglePost($post_id)
	{

		$userLoggedIn = $this->user_obj->getUserId();

		$opened_query = $this->con->prepare("UPDATE notifications SET opened='yes' WHERE user_to=? AND link LIKE '%=$post_id'");
		$opened_query->execute([$userLoggedIn]);


		$str = ""; //String to return
		$data_query = $this->con->prepare("SELECT * FROM posts WHERE deleted='no' AND id=?");
		$data_query->execute([$post_id]);

		if ($data_query->rowCount() > 0) {



			$row = $data_query->fetch();
			$id = $row['id'];
			$body = $row['body'];
			$added_by = $row['added_by'];
			$date_time = $row['date_added'];

			//Prepare user_to string so it can be included even if not posted to a user
			if ($row['user_to'] == "none") {
				$user_to = "";
			} else {
				$user_to_obj = new User($con, $row['user_to']);
				$user_to_name = $user_to_obj->getFirstAndLastName();
				$user_to = "to <a href='" . $row['user_to'] . "'>" . $user_to_name . "</a>";
			}

			//Check if user who posted, has their account closed
			$added_by_obj = new User($this->con, $added_by);
			if ($added_by_obj->isClosed()) {
				return;
			}

			$user_logged_obj = new User($this->con, $userLoggedIn);
			if ($user_logged_obj->isFollowing($added_by)) {



				if ($userLoggedIn == $added_by)
					$delete_button = "<button class='delete_button btn-danger' id='post$id'>x</button>";
				else
					$delete_button = "";



				$user_details_query = $this->con->prepare("SELECT first_name, last_name, profile_pic FROM users WHERE user_id=?");
				$user_details_query->execute([$added_by]);
				$user_row = $user_details_query->fetch();
				$first_name = $user_row['first_name'];
				$last_name = $user_row['last_name'];
				$profile_pic = $user_row['profile_pic'];


			?>
				<script>
					function toggle<?php echo $id; ?>() {

						var target = $(event.target);
						if (!target.is("a")) {
							var element = document.getElementById("toggleComment<?php echo $id; ?>");

							if (element.style.display == "block")
								element.style.display = "none";
							else
								element.style.display = "block";
						}
					}
				</script>
				<?php

				$comments_check = $this->con->prepare("SELECT * FROM comments WHERE post_id=?");
				$comments_check->execute([$id]);
				$comments_check_num = $comments_check->rowCount();


				//Timeframe
				$date_time_now = date("Y-m-d H:i:s");
				$start_date = new DateTime($date_time); //Time of post
				$end_date = new DateTime($date_time_now); //Current time
				$interval = $start_date->diff($end_date); //Difference between dates
				if ($interval->y >= 1) {
					if ($interval == 1)
						$time_message = $interval->y . " year ago"; //1 year ago
					else
						$time_message = $interval->y . " years ago"; //1+ year ago
				} elseif ($interval->m >= 1) {
					if ($interval->d == 0) {
						$days = " ago";
					} else if ($interval->d == 1) {
						$days = $interval->d . " day ago";
					} else {
						$days = $interval->d . " days ago";
					}


					if ($interval->m == 1) {
						$time_message = $interval->m . " month" . $days;
					} else {
						$time_message = $interval->m . " months" . $days;
					}
				} else if ($interval->d >= 1) {
					if ($interval->d == 1) {
						$time_message = "Yesterday";
					} else {
						$time_message = $interval->d . " days ago";
					}
				} else if ($interval->h >= 1) {
					if ($interval->h == 1) {
						$time_message = $interval->h . " hour ago";
					} else {
						$time_message = $interval->h . " hours ago";
					}
				} else if ($interval->i >= 1) {
					if ($interval->i == 1) {
						$time_message = $interval->i . " minute ago";
					} else {
						$time_message = $interval->i . " minutes ago";
					}
				} else {
					if ($interval->s < 30) {
						$time_message = "Just now";
					} else {
						$time_message = $interval->s . " seconds ago";
					}
				}

				$str .= "<div class='status_post' onClick='javascript:toggle$id()'>
								<div class='post_profile_pic'>
									<img src='$profile_pic' width='50'>
								</div>

								<div class='posted_by' style='color:#ACACAC;'>
									<a href='$added_by'> $first_name $last_name </a> $user_to &nbsp;&nbsp;&nbsp;&nbsp;$time_message
									$delete_button
								</div>
								<div id='post_body'>
									$body
									<br>
									<br>
									<br>
								</div>

								<div class='newsfeedPostOptions'>
									Comments($comments_check_num)&nbsp;&nbsp;&nbsp;
									<iframe src='like.php?post_id=$id' scrolling='no'></iframe>
								</div>

							</div>
							<div class='post_comment' id='toggleComment$id' style='display:none;'>
								<iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
							</div>
							<hr>";


				?>
				<script>
					$(document).ready(function() {

						$('#post<?php echo $id; ?>').on('click', function() {
							bootbox.confirm("Are you sure you want to delete this post?", function(result) {

								$.post("includes/form_handlers/delete_post.php?post_id=<?php echo $id; ?>", {
									result: result
								});

								if (result)
									location.reload();

							})
						})

					});
				</script>
<?php
			} else {
				echo "<p>You cannot see this post because you don't follow this user.</p>";
				return;
			}
		} else {
			echo "<p>No post found.</p>";
			return;
		}

		echo $str;
	}



	public function sendComment($post_author, $commentText, $id, $user_to)
	{

		$userLoggedIn = $this->user_obj->getUserId();

		$body = strip_tags($commentText);
		$body = str_replace('\r\n', "\n", $body);
		$body = nl2br($body);

		if ($body === "") {
			echo "No text";
			return;
		}

		$insert_comment = $this->con->prepare("INSERT INTO comments VALUES(NULL, ?, ?, ?, NOW(), 'no', ?)");
		$insert_comment->execute([$body, $userLoggedIn, $post_author, $id]);

		if ($post_author !== $userLoggedIn) {
			$notification = new Notification($this->con, $userLoggedIn);
			$notification->insertNotification($id, $post_author, "comment");
		}

		if ($user_to !== 'none' && $user_to !== $userLoggedIn) {
			$notification = new Notification($this->con, $userLoggedIn);
			$notification->insertNotification($id, $user_to, "profile_comment");
		}

		$get_commenters = $this->con->prepare("SELECT * FROM comments WHERE post_id=?");
		$get_commenters->execute([$id]);
		$notified_users = array();
		while ($row = $get_commenters->fetch()) {

			if (
				$row['posted_by'] !== $post_author && $row['posted_by'] !== $user_to
				&& $row['posted_by'] !== $userLoggedIn && !in_array($row['posted_by'], $notified_users)
			) {

				$notification = new Notification($this->con, $userLoggedIn);
				$notification->insertNotification($id, $row['posted_by'], "comment_non_owner");

				array_push($notified_users, $row['posted_by']);
			}
		}
	}


	public function getComments($id, $get_only_last_comment = false)
	{

		if ($get_only_last_comment) {

			$get_comments = $this->con->prepare("SELECT * FROM comments WHERE post_id=? ORDER BY id DESC LIMIT 1");
			$get_comments->execute([$id]);
		} else {

			$get_comments = $this->con->prepare("SELECT * FROM comments WHERE post_id=? ORDER BY id ASC");
			$get_comments->execute([$id]);
		}


		$count = $get_comments->rowCount();

		$commment_from_db = "";

		if ($count !== 0) {

			while ($comment = $get_comments->fetch()) {

				$comment_body = $comment['post_body'];
				$posted_to = $comment['posted_to'];
				$posted_by = $comment['posted_by'];
				$date_added = $comment['date_added'];
				$removed = $comment['removed'];

				//Timeframe
				$date_time_now = date("Y-m-d H:i:s");
				$start_date = new DateTime($date_added); //Time of post
				$end_date = new DateTime($date_time_now); //Current time
				$interval = $start_date->diff($end_date); //Difference between dates 
				if ($interval->y >= 1) {
					if ($interval == 1)
						$time_message = $interval->y . " year ago"; //1 year ago
					else
						$time_message = $interval->y . " years ago"; //1+ year ago
				} else if ($interval->m >= 1) {
					if ($interval->d == 0) {
						$days = " ago";
					} else if ($interval->d == 1) {
						$days = $interval->d . " day ago";
					} else {
						$days = $interval->d . " days ago";
					}


					if ($interval->m == 1) {
						$time_message = $interval->m . " month" . $days;
					} else {
						$time_message = $interval->m . " months" . $days;
					}
				} else if ($interval->d >= 1) {
					if ($interval->d == 1) {
						$time_message = "Yesterday";
					} else {
						$time_message = $interval->d . " days ago";
					}
				} else if ($interval->h >= 1) {
					if ($interval->h == 1) {
						$time_message = $interval->h . " hour ago";
					} else {
						$time_message = $interval->h . " hours ago";
					}
				} else if ($interval->i >= 1) {
					if ($interval->i == 1) {
						$time_message = $interval->i . " minute ago";
					} else {
						$time_message = $interval->i . " minutes ago";
					}
				} else {
					if ($interval->s < 30) {
						$time_message = "Just now";
					} else {
						$time_message = $interval->s . " seconds ago";
					}
				}

				$user_obj = new User($this->con, $posted_by);

				$prof_pic = $user_obj->getProfilePic();

				$names = $user_obj->getFirstAndLastName();


				$commment_from_db .= "<li>
										<div class='avatar'><img src='$prof_pic' alt=''></div>
										<div class='comment-content'><div class='arrow-comment'></div>
											<div class='comment-by'>$names<span class='date'>$time_message</span>
												<a href='#' class='reply'><i class='fa fa-reply'></i> Reply</a>
											</div>
											<p>$comment_body</p>
										</div>
										</li>
										<hr>";
			}
		} else {

			$commment_from_db = "<div id='noComment$id'>No comments to show</div>";
		}

		return $commment_from_db;
	}
}

?>
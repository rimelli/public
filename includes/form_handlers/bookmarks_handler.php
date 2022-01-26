<?php


//  Remove bookmark
if (isset($_GET['bookmark_delete_id'])){	
	$query = $con->prepare("DELETE FROM bookmarks WHERE user_id=? AND job_id=? LIMIT 1");
	$query->execute([$userLoggedIn, $_GET['bookmark_delete_id']]);	
	$id = $query->rowCount();

	if ($id){
		echo 'bookmark_deleted';		
	}else{
		echo 'Could not delete the bookmark';
	}

}


?>
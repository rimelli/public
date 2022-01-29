<?php 
require '../../config/config.php';

	if(isset($_GET['post_id']))
		$post_id = $_GET['post_id'];

		$query = $con->prepare("UPDATE posts SET deleted='yes' WHERE id=?");
		$query->execute([$post_id]);

?>
<?php
	include('dbcon.php');	
	$_blog = $_POST['blog'];
	$_conID = $_GET['id'];
	updateBlog($_conID, $_blog);
	header("Location: forum.php");
?>
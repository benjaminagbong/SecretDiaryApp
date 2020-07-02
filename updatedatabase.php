<?php
session_start();

if (array_key_exists("content", $_POST )) {
	# code...
	include ("connection.php");
	
	// $query = "UPDATE users SET diary = '".mysqli_real_escape_string( $link, $_POST['content'])."' WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";

	$content = $link -> real_escape_string($_POST['content']);
	$id = $link -> real_escape_string($_SESSION['id']);

	echo $_SESSION['id'];

	$sql = "UPDATE users SET diary ='{$content}' WHERE id=".$id;

	mysqli_query($link, $sql);
	
}

?>
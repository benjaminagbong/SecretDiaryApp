<?php

// $link = mysqli_connect("localhost", "root", "mysql", "secretdi");

// 	if (mysqli_connect_error()) {
// 		# code...
// 		die("Database Connection Error");
// 	}

$link = new mysqli("localhost", "root", "mysql", "secretdi");

if ($mysqli->connect_errno) {
	echo "Database Connection Error: " . $mysqli->connect_error;
	exit();
}

?>
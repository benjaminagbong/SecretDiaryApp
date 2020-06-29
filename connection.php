<?php

$link = mysqli_connect("localhost", "root", "mysql", "secretdi");

	if (mysqli_connect_error()) {
		# code...
		die("Database Connection Error");
	}

?>
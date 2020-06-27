<?php
session_start();

$error="";

if (array_key_exists("logout", $_GET)) {
	# code...
	unset($_SESSION);

	setcookie("id", "", time() - 60*60);
	$_COOKIE["id"] = "";

}else if((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE)AND $_COOKIE['id'])){

	header("Location: loggedinpage.php");

}

if (array_key_exists("submit", $_POST )) {
	# code...
	include("connection.php");
	

	if (!$_POST['email']) {
		# code...
		$error .= "An Email Address is Required<br>";
	}
	if (!$_POST['password']) {
		# code...
		$error .= "A Password is Required<br>";
	}
	if ($error !="") {
		# code...
		$error = "<p>There were error(s) in your form:</p>".$error;
	}
	else{

		if ($_POST['signup'] == 1) {
			# code...
		

			$query = "SELECT id FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'LIMIT 1";

			 $result = mysqli_query($link, $query);

			 if (mysqli_num_rows($result) > 0) {
			 	# code...
			 	$error = "That email Address is taken";
			 }
			 else{
			 	$query = "INSERT INTO users(email, password) VALUES('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";

			 	if(!mysqli_query($link, $query)){
			 		$error = "<p> Could not sign you up - please try again later.</p>";
			 	}else{

			 		$query = "UPDATE users SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";

			 			mysqli_query($link, $query);

			 			$_SESSION['id'] = mysqli_insert_id($link);

			 			if ($_POST['stayLoggedIn'] == 1) {
			 				# code...
			 				setcookie("id", mysqli_insert_id($link), time() + 60*60*24*365);
			 			}

			 		header("Location: loggedinpage.php");
			 	}
			 }
		}else{
			 	$query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";

			 	$result = mysqli_query($link, $query);
			 	$row = mysqli_fetch_array($result);

			 	if (isset($row)) {
			 		# code...
			 		$hashedpassword = md5(md5($row['id']).$_POST['password']);
			 		if ($hashedpassword == $row['password']) {
			 			# code...
			 			$_SESSION['id'] = $row['id'];
			 			if ($_POST['stayLoggedIn'] == 1) {
			 				# code...
			 				setcookie("id", $row['id'], time() + 60*60*24*365);
			 			}
			 			header("Location: loggedinpage.php");
				 		}else{

				 		$error = "That email/password combination Could not be found.";
				 	}
			 	}else{

			 		$error = "That email/password combination Could not be found.";
			 	}
			 }
	}
}

?>

<?php include("header.php");?>
	<div class="container" id="homepagecontainer">

		<h1>Secret Diary</h1>
		<p><strong>Store your thoughts permanently and Securely.</strong></p>
		<div id="error"><?php echo $error;?></div>

		<form method="post" id="signinform">
			<p>Interested, sign up now!</p>
			<div class="form-group">
				<input type="email" class="form-control" name="email" placeholder="Your Email">
			</div>

			<div class="form-group">
				<input type="password" class="form-control" name="password" placeholder="Password">
			</div>

			<div class="form-group form-check">
			    <input type="checkbox" class="form-check-input" name="stayLoggedIn" value=1>
			    <label class="form-check-label" for="exampleCheck1">Stay Logged In</label>
			 	<input type="hidden" name="signup" value="1">
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-success"name="submit" value="sign Up!" >
			</div>

			<p><a href="#" class="toggleform">Log In</a></p>

		</form>


		<form method="post" id="loginform">
			<p>Login Using your username and Password</p>
			<div class="form-group">
				<input type="email" class="form-control" name="email" placeholder="Your Email">
			</div>

			<div class="form-group">
				<input type="password" class="form-control" name="password" placeholder="Password">
			</div>

			<div class="form-group form-check">
			    <input type="checkbox" class="form-check-input" name="stayLoggedIn" value=1>
			    <label class="form-check-label" for="exampleCheck1">Stay Logged In</label>
			 	<input type="hidden" name="signup" value="0">
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-success" name="submit" value="Log In!" >
			</div>

			<p><a href="#" class="toggleform">Sign Up</a></p>

		</form>

	</div>
    

    
<?php include("footer.php")?>
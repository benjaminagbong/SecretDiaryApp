<?php
session_start();
$diarycontent = "";

	if (array_key_exists("id", $_COOKIE)) {
		# code...
		$_SEESION['id'] = $_COOKIE['id'];
	}
	if (array_key_exists("id", $_SEESION)) {
		# code...
		
		include ("connection.php");

		$query = "SELECT diary FROM users WHERE id = ".mysqli_real_escape_string($link, $_SEESION['id'])." LIMIT 1";

		$row = mysqli_fetch_array(mysqli_query($link, $query));

		$diarycontent = $row['diary'];

	}else{
		header("Location: index.php");

	}
include ("header.php");
?>
	
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top " id="navbar">
  <a class="navbar-brand" href="#">Secret Diary</a>
  
    <div class=" my-2 my-lg-0">
      
      <a href='secretDiary.php?logout=1'><button class="btn btn-success " type="submit">LogOut</button></a>
    </div>
  </div>
</nav>

	<div class="container-fluid" id="containerlogginpage">
		<textarea id="diary" class="form-control"><?php echo $diarycontent; ?></textarea>
	</div>

<?php
include("footer.php");

?>
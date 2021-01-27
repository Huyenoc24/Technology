<!DOCTYPE html>
<html>

<head>
	<title>Login</title>

	<meta charset="utf-8">

	<link rel="stylesheet" href="css/login.css">


</head>

<body>
	<?php
	session_start();
	$connect = mysqli_connect('localhost', 'root', '', 'website_fruit');
	if (isset($_POST['login'])) {
		$UserName = $_POST['userName'];
		$Password = $_POST['password'];
		$sql = "select * from user where userName = '$UserName' AND password ='$Password' ";
		$result = mysqli_query($connect, $sql);
		$checkLogin = mysqli_num_rows($result);
		$rowLogin = mysqli_fetch_array($result);

		if ($checkLogin == 0) {
			echo "<script> alert('Password or UserName is incorrect, please try again!') </script>";
			echo "<script>window.open('index.php','_self')</script>";
			exit();
		}
		if ($checkLogin > 0) {
			$_SESSION['id'] = $rowLogin['id'];
			$_SESSION['username'] = $UserName;
			$_SESSION['role']=$rowLogin['role'];

			echo " <script>alert('You have logged in successfully!') </script>";
			if($_SESSION['role'] == 1){
				header("location:admin/index.php");
			}
			
			else{
				echo " <script>alert('You do not have access to the admin page') </script>";
				echo "<script>window.open('index.php','_self')</script>";
			}
			
			// echo " <script>alert('You have logged in successfully!') </script>";
			// echo "<script>window.open('index.php','_self')</script>";
		}
	}
	?>

	<div id=mes method="post">
		<div class="menubar">
			<ul>
				<li><a href="">Login</a></li>
				<li><a href="register.php">Register</a></li>
			</ul>
		</div> <br> <br>
		<div class="one">
			<h1 style="text-align: left;">Login</h1>
			<p>Log in to track orders, save list of favorite products, receive many attractive offers. </p>
			<img src="https://frontend.tikicdn.com/_desktop-next/static/img/graphic-map.png" alt="" style="float: left;width: 300px; height: 400px;">

		</div>
		<form action="" method="post">
			<div class="two">

				<input type="text" placeholder="    Email or Phone Number" value="" class="first" name="userName"> <br> <br>

				<input type="password" placeholder="   Password" value="" class="second" name="password"> <br> <br>

				<input type="submit" value="Login" class="third" name="login"> <br> <br>

				<input type="checkbox" value="" name="check" id="fourth">

				<label for=" fourth" class=" four">Maintain login account</label> <br> <br>

				<a href="" class="fifth"> Forgot password?</a>

			</div>
		</form>
	</div>


</body>

</html>
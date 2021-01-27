<?php
    session_start();
    $connect = mysqli_connect('localhost', 'root', '', 'mywebsite');
  if (isset($_POST['register'])) { 
    $userName = $_POST['username'];
    $password = $_POST['password'];
    $fullName=$_POST['fullame'];
    $phoneNumber= $_POST['phonenumber'];
    $address=$_POST['address'];
    $sql="insert into user(userName,password,fullName,phoneNumber,address) values ($userName','$password','$fullName','$phoneNumber','$address')";
    $result = mysqli_query($connect,$sql);
    if ($result) {
      echo "<script>alert('Account has been created successfully!')</script>";
      echo "<script>window.open('login.php','_self')</script>";
    }
    else{
      echo"<script>alert('Error')</script>";
    }  
  }
  ?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration Form * Form Tutorial</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Registration Form - Input User's Detail Information</h2>
			</div>
			<div class="panel-body">
				<form method="post">
					
					<div class="form-group">
					  <label for="user">Username:</label>
					  <input required="true" type="text" class="form-control" id="user" name="username">
					</div>
					<div class="form-group">
					  <label for="pwd">Password:</label>
					  <input required="true" type="password" class="form-control" id="pwd" name="password">
                    </div>
                    <div class="form-group">
					  <label for="name">Full Name:</label>
					  <input required="true" type="text" class="form-control" id="name" name="fullname">
					</div>
					<div class="form-group">
					  <label for="phone">Phone number:</label>
					  <input required="true" type="text" class="form-control" id="phone" name="phonenumber">
                    </div>
                    <div>
                        <label for="address">Address:</label>
                        <input require="true" type="text" class="form-control" id="address" name="address">
                    </div>
                    <input type="submit" class="btn btn-success" name="register" value="Register">
                    
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<?php
require_once('../../db/dbhelper.php');
$id = $userName = $password = $fullName = $phoneNumber = $Address = $role = '';
if (!empty($_POST)) {
	if (isset($_POST['userName'])) {
		$userName = $_POST['userName'];
		$userName = str_replace('"', '\\"', $userName);
	}
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	}

	if (isset($_POST['password'])) {
		$password = $_POST['password'];
		$password = str_replace('"', '\\"', $password);
	}
	if (isset($_POST['fullName'])) {
		$fullName = $_POST['fullName'];
		$fullName = str_replace('"', '\\"', $fullName);
	}

	if (isset($_POST['Address'])) {
		$Address = $_POST['Address'];
		$Address = str_replace('"', '\\"', $Address);
	}
	if (isset($_POST['role'])) {
		$role = $_POST['role'];
	}
	if (isset($_POST['phoneNumber'])) {
		$phoneNumber = $_POST['phoneNumber'];
		$phoneNumber = str_replace('"', '\\"', $phoneNumber);
	}



	if (!empty($userName)) {
		//Save as database
		if ($id == '') {
			$sql = 'insert into user(userName,password,fullName,phoneNumber,Address,role) values ("' . $userName . '","' . $password . '","' . $fullName . '","' . $phoneNumber . '","' . $Address . '","' . $role . '")';
		} else {
			$sql = 'update user set userName = "' . $userName . '" , password = "' . $password . '" ,fullName = "' . $fullName . '" ,phoneNumber = "' . $phoneNumber . '" , Address = "' . $Address . '" ,role = "' . $role . '" where id = ' . $id;
		}
		execute($sql);

		header('Location: index.php');
		die();
	}
}

if (isset($_GET['id'])) {
	$id      = $_GET['id'];
	$sql     = 'select * from user where id = ' . $id;
	$user = executeSingleResult($sql);
	if ($user != null) {
		$userName = $user['userName'];
		$password = $user['password'];
		$fullName = $user['fullName'];
		$phoneNumber = $user['phoneNumber'];
		$Address = $user['Address'];
		$role = $user['role'];
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Thêm/Sửa user</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

	<!-- summernote -->
	<!-- include summernote css/js -->
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>

<body>
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link" href="../category/">Category management</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="index.php">Product management</a>
		</li>
	</ul>

	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Add/ Edit product</h2>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<label for="name">Name user:</label>
						<input type="text" name="id" value="<?= $id ?>" hidden="true">
						<input required="true" type="text" class="form-control" id="title" name="userName" value="<?= $userName ?>">
					</div>
					<div class="form-group">
						<label for="price">Password:</label>
						<input required="true" type="password" class="form-control" id="password" name="password" value="<?= $password ?>">
					</div>
					<div class="form-group">
						<label for="price">fullName:</label>
						<input required="true" type="text" class="form-control" id="fullName" name="fullName" value="<?= $fullName ?>">
					</div>
					<div class="form-group">
						<label for="price">Phone Number :</label>
						<input required="true" type="number" class="form-control" id="phoneNumber" name="phoneNumber" value="<?= $phoneNumber ?>">
					</div>
					<div class="form-group">
						<label for="price">Address</label>
						<input required="true" type="text" class="form-control" id="Address" name="Address" value="<?= $Address ?>">
						<input type="hidden" name="role" value="0">
					</div>
					<button class="btn btn-success">Save</button>
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function updateThumbnail() {
			$('#img_thumbnail').attr('src', $('#thumbnail').val())
		}

		$(function() {
			//doi website load noi dung => xu ly phan js
			$('#content').summernote({
				height: 350
			});
		})
	</script>
</body>

</html>
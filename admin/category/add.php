<?php
require_once('../../db/dbhelper.php');

$id = $name = '';
if (!empty($_POST)) {
	if (isset($_POST['name'])) {
		$name = $_POST['name'];
		$name = str_replace('"', '\\"', $name);
	}
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	}

	if (!empty($name)) {
		//Luu vao database
		if ($id == '') {
			$sql = 'insert into category(name) values ("' . $name . '")';
		} else {
			$sql = 'update category set name = "' . $name . '" where id = ' . $id;
		}

		execute($sql);

		header('Location: index.php');
		die();
	}
}

if (isset($_GET['id'])) {
	$id       = $_GET['id'];
	$sql      = 'select * from category where id = ' . $id;
	$category = executeSingleResult($sql);
	if ($category != null) {
		$name = $category['name'];
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Add/ Edit category</title>
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
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link" href="index.php">Category management</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="../product/">Product management</a>
		</li>
	</ul>

	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Add / Edit Category List</h2>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<label for="name">Name category:</label>
						<input type="text" name="id" value="<?= $id ?>" hidden="true">
						<input required="true" type="text" class="form-control" id="name" name="name" value="<?= $name ?>">
					</div>
					<button class="btn btn-success">Save</button>
				</form>
			</div>
		</div>
	</div>
</body>

</html>
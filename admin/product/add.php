<?php
require_once('../../db/dbhelper.php');

$id = $quanity = $status = $create_time = $id_brand = $price = $name = $img = $description = $id_category = '';
if (!empty($_POST)) {
	if (isset($_POST['name'])) {
		$name = $_POST['name'];
		$name = str_replace('"', '\\"', $name);
	}
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	}
	if (isset($_POST['price'])) {
		$price = $_POST['price'];
		$price = str_replace('"', '\\"', $price);
	}
	if (isset($_POST['status'])) {
		$status = $_POST['status'];
		$status = str_replace('"', '\\"', $status);
	}
	if (isset($_POST['quanity'])) {
		$quanity = $_POST['quanity'];
		$quanity = str_replace('"', '\\"', $quanity);
	}
	if (isset($_POST['img'])) {
		$img = $_POST['img'];
		$img = str_replace('"', '\\"', $img);
	}
	if (isset($_POST['description'])) {
		$description = $_POST['description'];
		$description = str_replace('"', '\\"', $description);
	}
	if (isset($_POST['id_category'])) {
		$id_category = $_POST['id_category'];
	}
	if (isset($_POST['id_brand'])) {
		$id_brand = $_POST['id_brand'];
	}

	if (!empty($name)) {
		$created_at = $updated_at = date('Y-m-d H:s:i');
		//Save as database
		if ($id == '') {
			$sql = 'insert into product(name,price,description,img,quanity,status,create_time,id_category,id_brand) values ("' . $name . '", "' . $price . '", "' . $description . '", "' . $img . '", "' . $quanity . '", "' . $status . '","' . $created_at . '","' . $id_category . '","' . $id_brand . '")';
		} else {
			$sql = 'update product set name = "' . $name . '" , price = "' . $price . '" , description = "' . $description . '" , img = "' . $img . '" , quanity = "' . $quanity . '" , status = "' . $status . '" , create_time = "' . $created_at . '" , id_category = "' . $id_category . '" , id_brand = "' . $id_brand . '"  where id = ' . $id;
		}
		execute($sql);

		header('Location: index.php');
		die();
	}
}

if (isset($_GET['id'])) {
	$id      = $_GET['id'];
	$sql     = 'select * from product where id = ' . $id;
	$product = executeSingleResult($sql);
	if ($product != null) {
		$name      = $product['name'];
		$price       = $product['price'];
		$create_time = $product['create_time'];
		$img   = $product['img'];
		$status = $product['status'];
		$id_category = $product['id_category'];
		$id_brand = $product['id_brand'];
		$quanity = $product['quanity'];
		$description     = $product['description'];
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Thêm/Sửa Sản Phẩm</title>
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
						<label for="name">Name product:</label>
						<input type="text" name="id" value="<?= $id ?>" hidden="true">
						<input required="true" type="text" class="form-control" id="title" name="name" value="<?= $name ?>">
					</div>
					<div class="form-group">
						<label for="price">Choose category:</label>
						<select class="form-control" name="id_category" id="id_category">
							<option>-- Select Category --</option>
							<?php
							$sql          = 'select * from category';
							$categoryList = executeResult($sql);

							foreach ($categoryList as $item) {
								if ($item['id'] == $id_category) {
									echo '<option selected value="' . $item['id'] . '">' . $item['name'] . '</option>';
								} else {
									echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
								}
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="price">Choose brand:</label>
						<select class="form-control" name="id_brand" id="id_brand">
							<option>-- Select brand --</option>
							<?php
							$sql          = 'select * from brand';
							$brandList = executeResult($sql);

							foreach ($brandList as $item) {
								if ($item['id'] == $id_brand) {
									echo '<option selected value="' . $item['id'] . '">' . $item['name'] . '</option>';
								} else {
									echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
								}
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="price">Price:</label>
						<input required="true" type="number" class="form-control" id="price" name="price" value="<?= $price ?>">
					</div>
					<div class="form-group">
						<label for="price">Status</label>
						<input required="true" type="number" class="form-control" id="status" name="status" value="<?= $status ?>">
					</div>
					<div class="form-group">
						<label for="quanity">Quanity:</label>
						<input required="true" type="number" class="form-control" id="quanity" name="quanity" value="<?= $quanity ?>">
					</div>
					<div class="form-group">
						<label for="thumbnail">Thumbnail:</label>
						<input required="true" type="text" class="form-control" id="thumbnail" name="img" value="<?= $img ?>" onchange="updateThumbnail()">
						<img src="<?= $img ?>" style="max-width: 200px" id="img_thumbnail">
					</div>
					<div class="form-group">
						<label for="content">Desctiption:</label>
						<textarea class="form-control" rows="5" name="description" id="content"><?= $description ?></textarea>
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
<?php
require_once ('../../db/dbhelper.php');
require_once ('../../common/utility.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Product Management</title>
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
	    <a class="nav-link" href="../category/">Category management</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link active" href="#">Product management</a>
      </li>
      <li class="nav-item">
	    <a class="nav-link active" href="../user/">User management</a>
	  </li>
	</ul>

	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Product management</h2>
			</div>
			<div class="panel-body">
				<div>
				<a href="add.php">
					<button class="btn btn-success" style="margin-bottom: 15px;">Add product</button>
				</a>

				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50px">No</th>
							<th>Thumbnail</th>
							<th>Name</th>
							<th>Price</th>
							<th>Description</th>
							<th>Quantify</th>
							<th> </th>
							<th width="50px"></th>
						</tr>
					</thead>
					<tbody>
				</div>
				<div>
				<div class="col-lg-6">
						<form method="get">
						  <div class="form-group" style="width: 200px; float: right;">
						    <input type="text" class="form-control" placeholder="Searching..." id="s" name="s">
						  </div>
						</form>
					</div>
				</div>
				
			</div>
<?php
//Lay danh sach danh muc tu database
$limit = 5;
$page  = 1;
if (isset($_GET['page'])) {
	$page = $_GET['page'];
}
if ($page <= 0) {
	$page = 1;
}
$firstIndex = ($page-1)*$limit;

// $sql         = 'select product.id, product.name, product.price, product.img, product.create_time, category.name category_name from product left join category on product.id_category = category.id '.' limit '.$firstIndex.', '.$limit;
$sql         = 'select * from product '.' limit '.$firstIndex.','.$limit;
$productList = executeResult($sql);

$sql         = 'select count(id) as total from product where 1 ';
$countResult = executeSingleResult($sql);
$number      = 0;
if ($countResult != null) {
	$count  = $countResult['total'];
	$number = ceil($count/$limit);
}

$index = 1;
foreach ($productList as $item) {
	echo '<tr>
				<td>'.(++$firstIndex).'</td>
				<td><img src="images/'.$item['img'].'" style="max-width: 100px"/></td>
				<td>'.$item['name'].'</td>
				<td>'.$item['price'].'</td>
				<td>'.$item['description'].'</td>
				<td>'.$item['quantify'].'</td>
				<td>
					<a href="add.php?id='.$item['id'].'"><button class="btn btn-warning">Edit</button></a>
				</td>
				<td>
					<button class="btn btn-danger" onclick="deleteProduct('.$item['id'].')">Delete</button>
				</td>
			</tr>';
}
?>
</tbody>
				</table>
				<!-- Bai toan phan trang -->
<?=paginarion($number, $page, '')?>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function deleteProduct(id) {
			var option = confirm('Are you sure you want to delete this product?')
			if(!option) {
				return;
			}

			console.log(id)
			//ajax - lenh post
			$.post('ajax.php', {
				'id': id,
				'action': 'delete'
			}, function(data) {
				location.reload()
			})
		}
	</script>
</body>
</html>
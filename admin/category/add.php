<?php
require_once ('../../db/dbhelper.php');

$id = $name = $thumbnail= '';
if (!empty($_POST)) {
	$name = '';
	if (isset($_POST['name'])) {
		$name = $_POST['name'];
		$name = str_replace('""', '\\"', $name);
	}
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	}
	if (isset($_POST['thumbnail'])) {
		$thumbnail = $_POST['thumbnail'];
		$thumbnail = str_replace('"', '\\"', $thumbnail);
	}
	if (!empty($name)) {
		$created_at = $updated_at = date('Y-m-d H:s:i');
		if ($id == '') {
			$sql = 'insert into category(name, thumbnail, created_at, updated_at) values ("'.$name.'","'.$thumbnail.'", "'.$created_at.'", "'.$updated_at.'")';
		}else{
			$sql = 'update category set name = "'.$name.'", thumbnail="'.$thumbnail.'", updated_at="'.$upddated_at.'" where id = '.$id;
		}
		//Luu vao database
		execute($sql);
		header('Location: index.php');
		die();
	}
}

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = 'select * from category where id ='.$id;
	$category = executeSingleResult($sql);
	if ($category != null) {
		$name = $category['name'];
		$thumbnail = $category['thumbnail'];
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Thêm/Sửa Dan Mục Sản Phẩm</title>
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
			<a href="index.php" class="nav-link">Quản lý Danh Mục</a>
		</li>
		<li class="nav-item">
			<a href="../product/" class="nav-link">Quản lý Sản Phẩm</a>		
		</li>
		<li class="nav-item">
			<a href="../order/" class="nav-link">Quản lý Hoá Đơn</a>
		</li>
	</ul>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Thêm/Sửa Danh Mục Sản Phẩm</h2>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<label for="usr">Tên danh mục:</label>
						<input type="text" name="id" value="<?=$id?>" hidden="true">
						<input required="true" type="text" class="form-control" id="name" name="name" value="<?=$name?>">
					</div>
					<div class="form-group">
						<label for="thumbnail">Thumbnail:</label>
						<input type="text" required="true" class="form-group" id="thumbnail"  name="thumbnail" value="<?=$thumbnail?>" onchange="updateThumbnail()">
						<img src="<?=$thumbnail?>" style="max-width: 200px" id="img_thumbnail">
					</div>
					<button class="btn btn-success">Lưu</button>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function updateThumbnail() {
			$('#img_thumbnail').attr('src', $('#thumbnail').val())
		}
		$( function() {
			//doi website load noi dung ==> xu ly phan js
			$('#content').summernote({
				height: 150, //set editable area's height
				codemirror: { //codemirror options
					theme: 'monokai'
				}
			})
		})
	</script>
</body>
</html>
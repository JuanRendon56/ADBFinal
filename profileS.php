<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Detalles del producto</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
	<style>
		.content {
			margin-top: 80px;
		}
	</style>

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include("nav.php");?>
	</nav>

	<div class="container">
		<div class="content">
			<h2>Información del producto</h2>
			<hr />

			<?php
			$nik = mysqli_real_escape_string($stt,(strip_tags($_GET["nik"],ENT_QUOTES)));

			$sql = mysqli_query($stt, "SELECT * FROM product WHERE id_product='$nik'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: listS.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}

			if(isset($_GET['aksi']) == 'delete'){
				$delete = mysqli_query($stt, "DELETE FROM product WHERE id_product='$nik'");
				if($delete){
					echo '<div class="alert alert-danger alert-dismissable">><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Producto borrado con éxito.</div>';
				}else{
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>No se pudo eliminar el producto.</div>';
				}
			}
			?>

			<table class="table table-striped table-condensed">
				<tr>
					<th>Nombre del producto</th>
					<td><?php echo $row['name']; ?></td>
				</tr>
				<tr>
					<th>Precio</th>
					<td><?php echo $row['price']; ?></td>
				</tr>
				<tr>
					<th>Cantidad</th>
					<td><?php echo $row['quantity']; ?></td>
				</tr>
			</table>

			<a href="listS.php" class="btn btn-sm btn-info">Regresar</a>
			<a href="editS.php?nik=<?php echo $row['nik']; ?>" class="btn btn-sm btn-success">Editar datos</a>
			<a href="profile.php?aksi=delete&nik=<?php echo $row['nik']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Esta seguro de borrar los datos <?php echo $row['nombres']; ?>')">Eliminar</a>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>

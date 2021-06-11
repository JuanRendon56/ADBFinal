<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<title>La Proveedora | Detalles de la editorial</title>

	<style>
		.content {
			margin-top: 80px;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include("nav.php");?>
	</nav>

	<div class="container">
		<div class="content">
			<h2>Información de la editorial</h2>
			<hr />

			<?php
			$nik = mysqli_real_escape_string($bks,(strip_tags($_GET["nik"],ENT_QUOTES)));

			$sql = mysqli_query($bks, "SELECT * FROM publisher WHERE id_publisher='$nik'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: listP.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}

			if(isset($_GET['aksi']) == 'delete'){
				$delete = mysqli_query($bks, "DELETE FROM publisher WHERE id_publisher='$nik'");
				if($delete){
					echo '<div class="alert alert-danger alert-dismissable">><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Autor borrado con éxito.</div>';
				}else{
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>No se pudo eliminar e la editorial.</div>';
				}
			}
			?>

			<table class="table table-striped table-condensed">
				<tr>
					<th>ID de la editorial</th>
					<td><?php echo $row['id_publisher']; ?></td>
				</tr>
				<tr>
					<th>Nombre de la editorial</th>
					<td><?php echo $row['name_publisher']; ?></td>
				</tr>
			</table>

			<a href="listP.php" class="btn btn-sm btn-info">Regresar</a>
			<a href="editP.php?nik=<?php echo $row['nik']; ?>" class="btn btn-sm btn-success">Editar datos</a>
			<a href="profileP.php?aksi=delete&nik=<?php echo $row['nik']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Esta seguro de borrar los datos <?php echo $row['name_publisher']; ?>')">Eliminar</a>
		</div>
	</div>
</body>
</html>

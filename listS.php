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

	<title>La Proveedora | Papelería</title>

	<style>
		.content {
			margin-top: 80px;
		}
	</style>

</head>

<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include('nav.php');?>
	</nav>

	<div class="container">
		<div class="content">

			<div class="row">
				<div class="col">
					<h2>Papelería</h2>
				</div>
				<div class="col col-md-auto">
					<a class="btn btn-outline-dark" href="addS.php">Añadir nuevo producto</a>
				</div>
			</div>


			<hr />

			<?php
			if(isset($_GET['aksi']) == 'delete'){
				$nik = mysqli_real_escape_string($stt,(strip_tags($_GET["nik"],ENT_QUOTES)));
				$cek = mysqli_query($stt, "SELECT * FROM product WHERE id_product='$nik'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				}else{
					$delete = mysqli_query($stt, "DELETE FROM product WHERE id_product='$nik'");
					if($delete){
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
					}
				}
			}
			?>

			<form class="form-inline" method="get">
			</form>
			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
					<th>Nombre</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Acciones</th>
				</tr>
				<?php
					$sql = mysqli_query($stt, "SELECT * FROM product ORDER BY id_product ASC");
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					while($row = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
							<td>'.$row['name'].'</a></td>
							<td>'.$row['price'].'</td>
							<td>'.$row['quantity'].'</td>
							<td>
                				<a href="profileS.php?nik='.$row['id_product'].'" title="Ver detalles" class="btn btn-primary btn-sm">Ver detalles</a>
								<a href="editS.php?nik='.$row['id_product'].'" title="Editar datos" class="btn btn-primary btn-sm">Editar</a>
								<a href="listS.php?aksi=delete&nik='.$row['id_product'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos '.$row['name'].'?\')" class="btn btn-danger btn-sm">Eliminar</a>
							</td>
						</tr>
						';
						$id_product++;
					}
				}
				?>
			</table>
			</div>
		</div>
	</div>
</body>
</html>

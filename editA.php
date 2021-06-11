<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta title="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<title>La Proveedora | Editar autor</title>

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
			<h2>Información del autor &raquo; Editar autor</h2>
			<hr />

			<?php
			$nik = mysqli_real_escape_string($bks,(strip_tags($_GET["nik"],ENT_QUOTES)));
			$sql = mysqli_query($bks, "SELECT * FROM author WHERE id_author='$nik'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: listA.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
				$name_author = mysqli_real_escape_string($bks,(strip_tags($_POST["name_author"],ENT_QUOTES)));
				$lastname_author = mysqli_real_escape_string($bks,(strip_tags($_POST["lastname_author"],ENT_QUOTES)));

				$update = mysqli_query($bks, "UPDATE author SET name_author='$name_author' lastname_author='$lastname_author' WHERE id_author='$nik'") or die(mysqli_error());
				if($update){
					header("Location: editA.php?nik=".$nik."&pesan=sukses");
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
			}

			if(isset($_GET['pesan']) == 'sukses'){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
			}
			?>
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Nombre del autor</label>
					<div class="col-sm-4">
						<input type="text" title="name_author" value="<?php echo $row ['name_author']; ?>" class="form-control" placeholder="Nombre del autor" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Apellidos del autor</label>
					<div class="col-sm-4">
						<input type="text" title="lastname_author" value="<?php echo $row ['lastname_author']; ?>" class="form-control" placeholder="Apellidos del autor" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" title="save" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="listA.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>

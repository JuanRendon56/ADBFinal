<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agregar producto</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
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
			<h2>Agregar nuevo producto</h2>
			<hr />

			<?php
			if(isset($_POST['add'])){
				$name = mysqli_real_escape_string($stt,(strip_tags($_POST["name"],ENT_QUOTES)));
				$price = mysqli_real_escape_string($stt,(strip_tags($_POST["price"],ENT_QUOTES)));
				$quantity = mysqli_real_escape_string($stt,(strip_tags($_POST["quantity"],ENT_QUOTES)));

				$cek = mysqli_query($stt, "SELECT * FROM product WHERE id_product='$id_product'");
				if(mysqli_num_rows($cek) == 0){
						$insert = mysqli_query($stt, "INSERT INTO product(name, price)
															VALUES('$name','$price')") or die(mysqli_error());
            $insert = mysqli_query($stt, "INSERT INTO inventory(id_product, quantity)
                      				VALUES('$id_product','$quantity')") or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudieron guardar los datos.</div>';
						}

				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. código exite!</div>';
				}
			}
			?>

			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Nombre del producto</label>
					<div class="col-sm-2">
						<input type="text" name="name" class="form-control" placeholder="Nombre del producto" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Precio</label>
					<div class="col-sm-4">
						<input type="text" name="price" class="form-control" placeholder="Precio" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Cantidad</label>
					<div class="col-sm-4">
						<input type="text" name="quantity" class="form-control" placeholder="Cantidad" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="listS.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>

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
			<h2>Agregar nuevo libro</h2>
			<hr />

			<?php
			if(isset($_POST['add'])){
				$isbn = mysqli_real_escape_string($bks,(strip_tags($_POST["isbn"],ENT_QUOTES)));
				$title = mysqli_real_escape_string($bks,(strip_tags($_POST["title"],ENT_QUOTES)));
				$id_author = mysqli_real_escape_string($bks,(strip_tags($_POST["id_author"],ENT_QUOTES)));
                $edition = mysqli_real_escape_string($bks,(strip_tags($_POST["edition"],ENT_QUOTES)));
				$id_publisher = mysqli_real_escape_string($bks,(strip_tags($_POST["id_publisher"],ENT_QUOTES)));
				$publication_date = mysqli_real_escape_string($bks,(strip_tags($_POST["publication_date"],ENT_QUOTES)));
                $id_genre = mysqli_real_escape_string($bks,(strip_tags($_POST["id_genre"],ENT_QUOTES)));
				$price = mysqli_real_escape_string($bks,(strip_tags($_POST["price"],ENT_QUOTES)));
                $id_book = mysqli_real_escape_string($bks,(strip_tags($_POST["id_book"],ENT_QUOTES)));

				$cek = mysqli_query($bks, "SELECT * FROM book WHERE id_book='$id_book'");
				if(mysqli_num_rows($cek) == 0){
						$insert = mysqli_query($bks, "INSERT INTO book(isbn, title, id_author, edition, id_publisher, publication_date, id_genre, price, id_book)
															VALUES('$isbn',,'$title','$id_author','$edition','$id_publisher','$publication_date','$id_genre','$price','$id_book')") or die(mysqli_error());
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
					<label class="col-sm-3 control-label">Numero ISBN</label>
					<div class="col-sm-2">
						<input type="number" name="isbn" class="form-control" placeholder="ISBN" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Titulo del libro</label>
					<div class="col-sm-4">
						<input type="text" name="title" class="form-control" placeholder="Titulo" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">ID del autor asociado</label>
					<div class="col-sm-4">
						<input type="number" name="id_author" class="form-control" placeholder="ID" required>
					</div>
				</div>
                <div class="form-group">
					<label class="col-sm-3 control-label">Edicion</label>
					<div class="col-sm-4">
						<input type="number" name="edition" class="form-control" placeholder="Edicion" required>
					</div>
				</div>
                <div class="form-group">
					<label class="col-sm-3 control-label">ID de la casa editorial</label>
					<div class="col-sm-4">
						<input type="number" name="id_publisher" class="form-control" placeholder="ID" required>
					</div>
				</div>
                <div class="form-group">
					<label class="col-sm-3 control-label">Anio de publicacion</label>
					<div class="col-sm-4">
						<input type="number" name="publication_date" class="form-control" placeholder="Anio" required>
					</div>
				</div>
                <div class="form-group">
					<label class="col-sm-3 control-label">ID del genero asociado</label>
					<div class="col-sm-4">
						<input type="number" name="id_genre" class="form-control" placeholder="ID" required>
					</div>
				</div>
                <div class="form-group">
					<label class="col-sm-3 control-label">Precio</label>
					<div class="col-sm-4">
						<input type="number" name="price" class="form-control" placeholder="Cantidad" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="list.php" class="btn btn-sm btn-danger">Cancelar</a>
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

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

	<title>La Proveedora | Agregar libro</title>
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
															VALUES('$isbn','$title','$id_author','$edition','$id_publisher','$publication_date','$id_genre','$price','$id_book')") or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con ??xito.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudieron guardar los datos.</div>';
						}

				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. c??digo exite!</div>';
				}
			}
			?>

			<form class="form-horizontal" action="" method="post">
			<div class="form-group">
					<label class="col-sm-3 control-label">ISBN del libro</label>
					<div class="col-sm-4">
						<input type="text" title="isbn" value="<?php echo $row ['isbn']; ?>" class="form-control" placeholder="ISBN del libro" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Title</label>
					<div class="col-sm-4">
						<input type="text" title="title" value="<?php echo $row ['title']; ?>" class="form-control" placeholder="Title" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">ID del autor</label>
					<div class="col-sm-4">
						<input type="number" title="id_author" value="<?php echo $row ['id_author']; ?>" class="form-control" placeholder="ID del autor" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Edici??n</label>
					<div class="col-sm-4">
						<input type="number" title="edition" value="<?php echo $row ['edition']; ?>" class="form-control" placeholder="Edici??n" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">ID de la editorial</label>
					<div class="col-sm-4">
						<input type="number" title="id_publisher" value="<?php echo $row ['id_publisher']; ?>" class="form-control" placeholder="ID de la Editorial" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Fecha de publicaci??n</label>
					<div class="col-sm-4">
						<input type="date" title="publication_date" value="<?php echo $row ['publication_date']; ?>" class="form-control" placeholder="Fecha de publicaci??n" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">ID de g??nero</label>
					<div class="col-sm-4">
						<input type="number" title="id_genre" value="<?php echo $row ['id_genre']; ?>" class="form-control" placeholder="ID de g??nero" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Precio</label>
					<div class="col-sm-4">
						<input type="number" title="price" value="<?php echo $row ['price']; ?>" class="form-control" placeholder="Precio" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="listB.php" class="btn btn-sm btn-danger">Cancelar</a>
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

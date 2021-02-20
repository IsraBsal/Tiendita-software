<?php  
include "configs/config.php"; //Configuracion de la conexion a mysql
include "configs/funciones.php"; //Conexion a la bd de mysql y funciones 

if(!isset($p)){
	$p = "principal";
}else{
	$p = $p;
}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/estilo.css"/>
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="fontawesome/js/all.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
	<script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	
	<title>Candy shop</title>
</head>
<body>
        
        <div id="contenedor">
			<div id="izq">
				<img src="imagenes/logo_bd11.png" width="80" height="80" >
			</div>
			<div align="center">
			<h1></h1>
			<h2></h2>
			<h3></h3>
			<font SIZE=10>Dulceria Cine</font>
		</div>
		
	</div>
	
	
	
	<div class="menu">
		<?php
		if(isset($_SESSION['IdCliente'])){
		?>
		<a href="?p=productos">Productos</a> 
		<!--<a href="?p=ofertas">Ofertas</a> -->
                <a href="?p=carrito">Mi Carrito</a>
		<a href="?p=miscompras">Mis Compras</a> 
                <?php
		}else{
			?>
				<a href="?p=principal">Principal</a>
                <a href="?p=login">Iniciar Sesion</a>
				<a href="?p=registro">Registrate</a>
			<?php
		}
		?>
		<a href="?p=administrador">Interfaz vendedor</a>
		
		<?php
			if(isset($_SESSION['IdCliente'])){
		?>
        
		<a class="pull-right subir" href="?p=miscompras"><?=nombre_cliente($_SESSION['IdCliente'])?>
		<a class="pull-right subir" href="?p=cerrar">Salir</a>
		</a>

		<?php
			}
		?>
	</div>
	
	<div class="cuerpo">
		<?php 
			if(file_exists("paginas/".$p.".php")){
				include "paginas/".$p.".php";
			}else{
				echo "<i>No se ha encontrado la pagina <b>".$p."</b> <a href='./'>Regresar</a></i>";
			}

		 ?>
	</div>

	<div class="footer">
        <font SIZE=2>Israel Contreras Villanueva 2163047829</font>
        <br><font SIZE=2>Ahtziri Sandy Ramirez Aguilar 2163007469 </font>
		<br><font SIZE=2>Daniel Barrientos Martinez </font>
		<div class="pull-left">
			<img src="imagenes/logo_uam.jpg" width="300" height="150" >
        </div>
                
		
	</div>



</body>
</html>
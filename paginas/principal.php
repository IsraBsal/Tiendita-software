Bienvenido, aqui estan todos los productos mas nuevos de la tienda, Inicia sesion para comprar los productos <br>
<br>



<?php 
	$ssql="SELECT NombreProducto,Imagen,Precio_Caja,Marca FROM productos";
	$resultado= mysqli_query($enlace,$ssql);

	 while($row=mysqli_fetch_array($resultado,MYSQLI_BOTH)){
		?>
			<div class="producto">
				<div class="nombre_producto"><?=$row['NombreProducto']?></div>
                	<div class="nombre_producto"><?=$row['Marca']?></div>
				<div><img class="img_producto" src="imagenes/<?=$row['Imagen']?>"/></div>
				<span class="precio"><br><?=$row['Precio_Caja']?><?=$divisa?></span>
				
			</div>
		<?php
	}

?>
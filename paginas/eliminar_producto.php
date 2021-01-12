<?php 
	check_admin();
	
	$ssql1="SELECT NombreProducto,Imagen,Precio_Caja,Marca,IdProducto FROM productos";
	$resultado= mysqli_query($enlace,$ssql1);

	 while($row=mysqli_fetch_array($resultado,MYSQLI_BOTH)){
		?>
			<div class="producto">
				<div class="Id_producto"><?=$row['IdProducto']?></div>
				<div class="nombre_producto"><?=$row['NombreProducto']?></div>
				<div class="marca_producto"><?=$row['Marca']?></div>
				<div> <img class="img_producto" src="imagenes/<?=$row['Imagen']?>" width="300" height="300"/></div>
				<span class="precio"><br><?=$row['Precio_Caja']?><?=$divisa?></span>
			</div>
		<?php
	}

	if(isset($eliminar)){
		$ssqldelete="DELETE FROM productos WHERE IdProducto = '$id'";
		$query=mysqli_query($enlace,$ssqldelete);
		//redir("?p=eliminar_producto");
	}

?>

	<form method="post" action="" enctype="multipart/form-data">
		<div class="form-group">
		<select name="id" required class="form-control">
			<option value="">Seleccione el producto a eliminar</option>
			<?php
				$ssql="SELECT * FROM productos ORDER BY IdProducto ASC";
				$query = mysqli_query($enlace,$ssql);
				while($r=mysqli_fetch_array($query)){
					?>
						<option value="<?=$r['IdProducto']?>"><?=$r['IdProducto']?></option>
					<?php
				}
			?>
	</select>
	</div>
	

	<div class="form-group">
		<button type="submit" class="btn btn-success" name="eliminar"><i class="fa fa-check"></i> Eliminar Producto</button>
	</div>
	</form>
	


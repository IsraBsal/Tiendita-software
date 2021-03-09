<?php
check_admin();
if(isset($enviar)){
	$idproducto=clear($idproducto);
	$nombre = clear($nombre);
	$marca=clear($marca);
	$cantidad_unidades=clear($cantidad_unidades);
	$price = clear($price);
	$stock=clear($stock);
	$suspendido=clear($suspendido);
	$imagen = "";
	$idcategoria=clear($idcategoria);

	if(is_uploaded_file($_FILES['imagen']['tmp_name'])){
		$imagen = $name.rand(0,1000).".jpg";
		move_uploaded_file($_FILES['imagen']['tmp_name'], "imagenes/".$imagen);
	}
	$ssql1="INSERT INTO productos (IdProducto,NombreProducto,Marca,IdCategoria,CantidadUnidades,Precio_Caja,Stock,UnidadesEnPedido,Suspendido,Imagen) VALUES ('$idproducto','$nombre','$marca','$idcategoria','$cantidad_unidades','$price','$stock','0','No','$imagen')";
	
	$query1=mysqli_query($enlace,$ssql1);
	
	//alert("Producto agregado");
		alert("Producto insertado",1,'agregar_prodcuto');
}

?>
<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<input type="text" class="form-control" name="idproducto" placeholder="Id del producto"/>
	</div>


	<div class="form-group">
		<input type="text" class="form-control" name="nombre" placeholder="Nombre del producto"/>
	</div>

	<div class="form-group">
		<input type="text" class="form-control" name="marca" placeholder="Marca del producto"/>
	</div>	

	<div class="form-group">
		<input type="text" class="form-control" name="cantidad_unidades" placeholder="Unidades de la caja "/>
	</div>

	<div class="form-group">
		<input type="text" class="form-control" name="price" placeholder="Precio del producto"/>
	</div>

	<div class="form-group">
		<input type="text" class="form-control" name="stock" placeholder="Stock"/>
	</div>


	<label>Imagen del producto</label>

	<div class="form-group">
		<input type="file" class="form-control" name="imagen" title="Imagen del producto" placeholder="Imagen del producto"/>
	</div>

	<div class="form-group">

		<select name="idcategoria" required class="form-control">
			<option value="">Seleccione una categoria</option>
			<?php
				$ssql="SELECT * FROM categorias ORDER BY IdCategoria ASC";
				$query = mysqli_query($enlace,$ssql);
				while($r=mysqli_fetch_array($query)){
					?>
						<option value="<?=$r['IdCategoria']?>"><?=$r['IdCategoria']?></option>
					<?php
				}
			?>
		</select>

	</div>


	
	<div class="form-group">
		<button type="submit" class="btn btn-success" name="enviar"><i class="fa fa-check"></i> Agregar Producto</button>
	</div>

</form><br>	
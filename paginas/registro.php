Inicia sesion para poder visualizar y comprar los productos 
<?php

	if(isset($enviarregistro)){
		
		$correo=clear($correo);
		$password=clear($password);
		$nombre=clear($nombre);
		$apellidos=clear($apellidos);
		$direccion=clear($direccion);
		$ciudad=clear($ciudad);
		$estado=clear($estado);
		$codpostal=clear($codpostal);
		$telefono=clear($telefono);
		
		
		if(!empty($correo) && !empty($password) && !empty($nombre) && !empty($apellidos) && !empty($direccion) && !empty($ciudad) && !empty($estado) && !empty($codpostal) && !empty($telefono)){
			$ssql="INSERT INTO usuarios (Correo_Electronico,Password,Nombre,Apellidos,Direccion,Ciudad,Estado,Codpostal,Telefono) VALUES ('$correo','$password','$nombre','$apellidos','$direccion','$ciudad','$estado','$codpostal','$telefono')";
			$query=mysqli_query($enlace,$ssql);
			alert("Registro exitoso",1,'login');
		}
		else{
			alert("Error, campo vacio",0,'registro');
		}
		
	
	}



?>




<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<input type="text" class="form-control" name="correo" placeholder="Correo electronico"/>
	</div>


	<div class="form-group">
		<input type="text" class="form-control" name="password" placeholder="Contraseña"/>
	</div>

	<div class="form-group">
		<input type="text" class="form-control" name="nombre" placeholder="Nombre"/>
	</div>	

	<div class="form-group">
		<input type="text" class="form-control" name="apellidos" placeholder="Apellidos"/>
	</div>

	<div class="form-group">
		<input type="text" class="form-control" name="direccion" placeholder="Direccion"/>
	</div>

	<div class="form-group">
		<input type="text" class="form-control" name="ciudad" placeholder="Ciudad"/>
	</div>
	
	<div class="form-group">
		<input type="text" class="form-control" name="estado" placeholder="Estado"/>
	</div>
	
	<div class="form-group">
		<input type="text" class="form-control" name="codpostal" placeholder="Codigo Postal"/>
	</div>
	
	<div class="form-group">
		<input type="text" class="form-control" name="telefono" placeholder="Telefono"/>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-success" name="enviarregistro"><i class="fa fa-check"></i> Registrar usuario</button>
	</div>

</form><br>	
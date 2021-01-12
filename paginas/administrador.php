<?php
	
	if(isset($entrar)){ //Inicia sesion con datos del formulario
		$usuario = clear($usuario);
		$password = clear($password);
		$ssql="SELECT * FROM admins WHERE usuario = '$usuario' AND password = '$password'";
		$query =mysqli_query($enlace,$ssql);
		if(mysqli_num_rows($query)>0){
			$r = mysqli_fetch_array($query);
			$_SESSION['idadmin'] = $r['idadmin'];
			redir("?p=administrador");
		}else{
				alert("Los datos no son validos",0,'administrador');
			
		}
	}
	if(isset($_SESSION['idadmin'])){ // si hay una sesion iniciada
		?>
		<a href="?p=agregar_producto">
			<button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar Productos</button></a>

			<a href="?p=agregar_categoria">
			<button class="btn btn-info"><i class="fa fa-plus-circle"></i> Agregar Categoria</button></a>

			<a href="?p=manejar_tracking">
			<button class="btn btn-warning"><i class="fa fa-plus-circle"></i> Manejar Tracking</button></a>
			<br><br>

			<a href="?p=eliminar_producto">
			<button class="btn btn-primary"><i class="fa fa-plus-circle"></i>Eliminar Productos</button></a>

			
			<a href="?p=cerrar">
			<button class="btn btn-warning">Cerrar sesion </button></a>
			<br><br>
			
		<?php
	}else{ // si no hay una sesion iniciada
		?>
		<center>
			<form method="post" action="">
				<div class="centrar_login">
					<label><h2><i class="fa fa-key"></i>Administrador Login</h2></label>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Usuario" name="usuario"/>
					</div>

					<div class="form-group">
						<input type="password" class="form-control" placeholder="Contraseña" name="password"/>
					</div>

					<div class="form-group">
						<button class="btn btn-submit" name="entrar" type="submit"><i class="fa fa-sign-in"></i> Ingresar</button>
					</div>
				</div>
			</form>
		</center>
		<?php
	}
?>
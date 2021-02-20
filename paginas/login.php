<?php
if(isset($_SESSION['IdCliente'])){
	redir("?p=productos");
}
	
if(isset($enviar)){
	$username = clear($username);
	$password = clear($password);
	$ssql1="SELECT * FROM usuarios WHERE Correo_Electronico = '$username' AND password = '$password'";
	$query = mysqli_query($enlace,$ssql1);
	if(mysqli_num_rows($query)>0){
		$r = mysqli_fetch_array($query);
		$_SESSION['IdCliente'] = $r['IdCliente'];
		if(isset($return)){
			alert("sesion iniciada",1,'productos');
		}else{
			redir("?p=productos");
		}
	}else{
		alert("Los datos no son validos",0,'login');
		
	}
}
	?>


	<center>
		<form method="post" action="">
			<div class="centrar_login">
				<label><h2><i class="fa fa-key"></i> Iniciar Sesión</h2></label>
				<div class="form-group">
					<input type="text" autocomplete="off" class="form-control" placeholder="Correo" name="username"/>
				</div>

				<div class="form-group">
					<input type="password" class="form-control" placeholder="Contraseña" name="password"/>
				</div>

				<div class="form-group">
					<button class="btn btn-submit" name="enviar" type="submit"><i class="fa fa-sign-in"></i> Ingresar</button>
				</div>
			</div>
		</form>
	</center>
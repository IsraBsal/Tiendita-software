  
<?php
check_admin();
if(isset($enviar)){
	$categoria = clear($categoria);
	$ssqls="SELECT * FROM categorias WHERE IdCategoria = '$categoria'";
    $s = mysqli_query($enlace,$ssqls);
	if(mysqli_num_rows($s)>0){
		alert("Ya esta la categoria esta agregada a la base de datos",0,'agregar_categoria');
		
	}else{
		mysqli_query($enlace,"INSERT INTO categorias (IdCategoria,NombreCategoria,Descripcion) VALUES ('$id','$categoria','$descripcion')");
		alert("Categoria Agregada",1,'agregar_categoria');
		
	}
}
if(isset($eliminar)){
	$eliminar = clear($eliminar);
	mysqli_query($enlace,"DELETE FROM categorias WHERE IdCategoria = '$eliminar'");
	alert("Categoria eliminada",1,'agregar_categoria');
	
}
?>

<h1>Agregar Categoria</h1><br><br>

<form method="post" action="">
	
	<div class="form-group">
	    <input type="text" class="form-control" name="id" placeholder="Id del producto"/>
	</div>
	
	<div class="form-group">
		<input type="text" class="form-control" name="categoria" placeholder="Nombre de la Categoria"/>
	</div>

	<div class="form-group">
	    <input type="text" class="form-control" name="descripcion" placeholder="Descripcion"/>
	</div>
	
	
	
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="enviar" value="Agregar categoria"/>
	</div>
	
	
	
</form><br>

<br>

<table class="table table-striped">
	<tr>
		<th>ID</th>
		<th>Categoria</th>
		<th>Acciones</th>
	</tr>

	<?php
	$q = mysqli_query($enlace,"SELECT * FROM categorias ORDER BY IdCategoria ASC");
	while($r=mysqli_fetch_array($q)){
		?>
			<tr>
				<td><?=$r['IdCategoria']?></td>
				<td><?=$r['NombreCategoria']?>
				<td>
					<a  style="color:#08f" href="?p=agregar_categoria&eliminar=<?=$r['IdCategoria']?>"><i class="fa fa-times"></i></a>
				</td>
			</tr>
		<?php
	}
	?>
</table>
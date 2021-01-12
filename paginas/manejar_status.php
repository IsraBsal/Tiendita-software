<?php
check_admin();
$id = clear($id);
$s = mysqli_query($enlace,"SELECT * FROM compra WHERE id = '$id'");
$r = mysqli_fetch_array($s);
if(isset($modificar)){
	$estado = clear($estado);
	mysqli_query($enlace,"UPDATE compra SET estado = '$estado' WHERE id = '$id'");
	redir("?p=manejar_tracking");
}
?>
<h1>Manejar Status</h1>
<br>
<form method="post" action="">
	<div class="form-group">
		<select class="form-control" name="estado">
			<option <?php if($r['estado'] == 0) { echo "selected"; } ?> value="0">Solicitado</option>
			<option <?php if($r['estado'] == 1) { echo "selected"; } ?> value="1">Pagado</option>
			<option <?php if($r['estado'] == 2) { echo "selected"; } ?> value="2">Enviando</option>
			<option <?php if($r['estado'] == 3) { echo "selected"; } ?> value="3">Entregado</option>
		    
		    <option <?php if($r['estado'] == 4) { echo "Cancelar"; } ?> value="4">Cancelar</option>
		    
		    <option <?php if($r['estado'] == 5) { echo "Devolver"; } ?> value="5">Devolver</option>
		    
		</select>
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" value="Set Status" name="modificar"/>
	</div>
</form>
<?php

$id = clear($id);
$s = mysqli_query($enlace,"SELECT * FROM compra WHERE id = '$id'");
$r = mysqli_fetch_array($s);

if(isset($modificar)){
	$estado = clear($estado);
	mysqli_query($enlace,"UPDATE compra SET calificacion = '$calificacion' WHERE id = '$id'");
	redir("?p=miscompras");
}
?>

<h1>Asignar calificacion</h1>
<br>
<form method="post" action="">
	<div class="form-group">
		<select class="form-control" name="calificacion">
			<option <?php if($r['calificacion'] == 1) { echo "selected"; } ?> value="1"> Pesimo</option>
			<option <?php if($r['calificacion'] == 2) { echo "selected"; } ?> value="2"> Malo</option>
			<option <?php if($r['calificacion'] == 3) { echo "selected"; } ?> value="3"> Regular</option>
			<option <?php if($r['calificacion'] == 4) { echo "selected"; } ?> value="4"> Bueno</option>
                        <option <?php if($r['calificacion'] == 5) { echo "selected"; } ?> value="5"> Perfecto</option>
		    
                            
		    
		</select>
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" value="Cambiar calificacion" name="modificar"/>
	</div>
</form>

   






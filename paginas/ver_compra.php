<?php
check_admin();
$id = clear($id);
$s = mysqli_query($enlace,"SELECT * FROM compra WHERE id = '$id'");
$r = mysqli_fetch_array($s);
$sc = mysqli_query($enlace,"SELECT * FROM usuarios WHERE IdCliente = '".$r['IdCliente']."'");
$rc = mysqli_fetch_array($sc);
$nombre = $rc['Nombre'];
?>
<h1>Viendo compra de <span style="color:#ffffff"><?=$nombre?></span></h1><br>

Fecha: <?=fecha($r['fecha'])?><br>
Monto: <?=number_format($r['monto'])?> <?=$divisa?><br>
Estado: <?=estado($r['estado'])?><br>
<!--Calificacion: <?=calificacion($r['calificacion'])?><br>-->
<br>
<table class="table table-striped">
	<tr>
		<th style="background-color:#FFFFFF">Nombre del producto</th>
		<th style="background-color:#FFFFFF">Cantidad</th>
		<th style="background-color:#FFFFFF">Monto</th>
		<th style="background-color:#FFFFFF">Monto Total</th>
	</tr>
	<?php
		$sp = mysqli_query($enlace,"SELECT * FROM productos_compra WHERE IdCompra = '$id'");
		while($rp=mysqli_fetch_array($sp)){
			$spro = mysqli_query($enlace,"SELECT * FROM productos WHERE IdProducto = '".$rp['IdProducto']."'");
			$rpro = mysqli_fetch_array($spro);
			$nombre_producto = $rpro['NombreProducto'];
			$montototal = $rp['monto'] * $rp['cantidad'];
			?>
				<tr>
					<td style="background-color:#FFFFFF"><?=$nombre_producto?></td>
					<td style="background-color:#FFFFFF"><?=$rp['cantidad']?></td>
					<td style="background-color:#FFFFFF"><?=$rp['monto']?></td>
					<td style="background-color:#FFFFFF"><?=$montototal?></td>
				</tr>
			<?php
		}
	?>
</table>
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
		<th>Nombre del producto</th>
		<th>Cantidad</th>
		<th>Monto</th>
		<th>Monto Total</th>
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
					<td><?=$nombre_producto?></td>
					<td><?=$rp['cantidad']?></td>
					<td><?=$rp['monto']?></td>
					<td><?=$montototal?></td>
				</tr>
			<?php
		}
	?>
</table>
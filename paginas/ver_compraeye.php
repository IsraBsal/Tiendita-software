<?php
check_user('ver_compraeye');
$id = clear($id);
$s = mysqli_query($enlace,"SELECT * FROM compra WHERE id = '$id' AND IdCliente = '".$_SESSION['IdCliente']."'");
if(mysqli_num_rows($s)>0){
$s = mysqli_query($enlace,"SELECT * FROM compra WHERE id = '$id'");
$r = mysqli_fetch_array($s);
$sc = mysqli_query($enlace,"SELECT * FROM usuarios WHERE IdCliente = '".$r['IdCliente']."'");
$rc = mysqli_fetch_array($sc);
$nombre = $rc['Nombre'];
?>
<h1>Viendo compra #<span style="color:#08f"><?=$r['id']?></span></h1><br>

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
					<td>
						
					</td>
				</tr>
			<?php
		}
	?>
</table>
<br>
<br>
<?php

if(estado($r['estado']) == "Solicitado"){
	?>
	<a class="btn btn-primary" href="?p=pagar_compra&id=<?=$r['id']?>">
		Pagar
	</a>
	<?php
}
    
if($r['estado'] != 4){
	?>
	<a class="btn btn-primary" href="?p=cancelar_compra&id=<?=$r['id']?>">
        Cancelar
	</a>
	<?php
}

if($r['estado'] == 3 ){
        ?>
        <a class="btn btn-primary" href="?p=evaluar_compra&id=<?=$r['id']?>">
            Evaluar Compra
        </a>
        <?php
    }
    
?>

<?php
}else{
	alert1("Ha ocurrido un error");
	redir("?p=miscompras");
}
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
<h1>Viendo compra #<span style="color:#FFFFFF"><?=$r['id']?></span></h1><br>

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
<br>
<br>
<?php

if(estado($r['estado']) == "Solicitado"){
	?>
	<a class="btn btn-primary" href="?p=miscompras"> <!-- "?p=pagar_compra&id=<?//=$r['id']?>"-->
		Pagar en caja (Proximamente)
	</a>

	<a class="btn btn-primary" href="?p=cancelar_compra&id=<?=$r['id']?>">
        Cancelar
	</a>

	<?php
}
    
if($r['estado'] != 1){
	?>
	
	<?php
}

if($r['estado'] == "Pagado" ){
        ?>
        <!--<a class="btn btn-primary" href="?p=evaluar_compra&id=<?=$r['id']?>">
            Evaluar Compra
        </a>-->
        <?php
    }
    
?>

<?php
}else{
	alert1("Ha ocurrido un error");
	redir("?p=miscompras");
}
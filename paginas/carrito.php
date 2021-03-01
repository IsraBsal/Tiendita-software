<?php
check_user('carrito');
if(isset($eliminar)){
	$eliminar = clear($eliminar);
	$ssqleliminar="DELETE FROM carro WHERE IdCarro = '$eliminar'";
    mysqli_query($enlace,$ssqleliminar);
	redir("?p=carrito");
}
if(isset($id) && isset($modificar)){
	$id = clear($id);
	$modificar = clear($modificar);
	$ssqlmodificar="UPDATE carro SET cant = '$modificar' WHERE IdCarro = '$id'";
    mysqli_query($enlace,$ssqlmodificar);
	alert("Cantidad modificada",1,'carrito');
	//redir("?p=carrito");
}
if(isset($finalizar)){
	$monto = clear($monto_total);
	$id_cliente = clear($_SESSION['IdCliente']);
	$ssqlq="INSERT INTO compra (IdCliente,fecha,monto,estado) VALUES ('$id_cliente',NOW(),'$monto','0')";
	$q =mysqli_query($enlace,$ssqlq);
	$ssqlsc="SELECT * FROM compra WHERE IdCliente = '$id_cliente' ORDER BY id DESC LIMIT 1";
	$sc =mysqli_query($enlace,$ssqlsc);
	$rc = mysqli_fetch_array($sc);
	$ultima_compra = $rc['id'];
	$ssql2="SELECT * FROM carro WHERE IdCliente = '$id_cliente'";
    $q2 =mysqli_query($enlace,$ssql2);
	while($r2=mysqli_fetch_array($q2)){
		$ssqlsp="SELECT * FROM productos WHERE IdProducto = '".$r2['IdProducto']."'";
        $sp = mysqli_query($enlace,$ssqlsp);
		$rp = mysqli_fetch_array($sp);
		$monto = $rp['Precio_Caja'];
		$q="INSERT INTO productos_compra (IdCompra,IdProducto,cantidad,monto) VALUES ('$ultima_compra','".$r2['IdProducto']."','".$r2['cant']."','$monto')";
        $queryq=mysqli_query($enlace,$q);
	}
	$q="DELETE FROM carro WHERE IdCliente = '$id_cliente'";
    mysqli_query($enlace,$q);
	$ssqlsc="SELECT * FROM compra WHERE IdCliente = '$id_cliente' ORDER BY id DESC LIMIT 1";
    $sc = mysqli_query($enlace,$ssqlsc);
	$rc = mysqli_fetch_array($sc);
	$id_compra = $rc['id'];
	
    alert("Se ha finalizado la compra",1,'ver_compraeye&id='.$id_compra);
    
	
}
?>

<h1><i class="fa fa-shopping-cart"></i> Carro de Compras</h1>
<br><br>

<table class="table table-striped">
	<tr>
		<th><i>Imagen</i></th>
		<th>Nombre del producto</th>
		<th>Cantidad</th>
		<th>Precio por unidad</th>
		<th>Oferta</th>
		<th>Precio Total</th>
		<th>Precio Neto</th>
		<th>Acciones</th>
	    
	    
	</tr>
<?php
$id_cliente = clear($_SESSION['IdCliente']);
$ssql="SELECT * FROM carro WHERE IdCliente = '$id_cliente'";
$q =mysqli_query($enlace,$ssql);
$monto_total = 0;
while($r = mysqli_fetch_array($q)){
	
	$ssql1= " SELECT * FROM productos WHERE IdProducto = '".$r['IdProducto']."' ";
	
	$q2 =mysqli_query($enlace,$ssql1);
	
	$r2 = mysqli_fetch_array($q2);
	
	$preciototal = 0;
			if($r2['oferta']>0){
				if(strlen($r2['oferta'])==1){
					$desc = "0.0".$r2['oferta'];
				}else{
					$desc = "0.".$r2['oferta'];
				}
				$preciototal = $r2['Precio_Caja'] -($r2['Precio_Caja'] * $desc);
			}else{
				$preciototal = $r2['Precio_Caja'];
			}
	$nombre_producto = $r2['NombreProducto'];
	$cantidad = $r['cant'];
	$precio_unidad = $r2['Precio_Caja'];
	$precio_total = $cantidad * $preciototal;
	$imagen_producto = $r2['Imagen'];
	$monto_total = $monto_total + $precio_total;
	
	?>
		<tr>
			<td><img src="imagenes/<?=$imagen_producto?>" class="imagen_carro" width="60" height="60"/></td>
			<td><?=$nombre_producto?></td>
			<td><?=$cantidad?></td>
			<td><?=$precio_unidad?> <?=$divisa?></td>
			<td>
				<?php
					if($r2['oferta']>0){
						echo $r2['oferta']."% de Descuento";
					}else{
						echo "Sin descuento";
					}
				?>
			</td>
			<td><?=$preciototal?> <?=$divisa?></td>
			<td><?=$precio_total?> <?=$divisa?></td>
			<td>
				<a onclick="modificar('<?=$r['IdCarro']?>')" href="#"><i class="fa fa-edit" title="Modificar cantidad en carrito"></i></a>
				<a href="?p=carrito&eliminar=<?=$r['IdCarro']?>"><i class="fa fa-times" title="Eliminar"></i></a>
			</td>
		</tr>
	<?php
}
?>
</table>
<br>
<h2>Monto Total: <b class="text-green"><?=$monto_total?> <?=$divisa?></b></h2>

<br><br>
<form method="post" action="">
	<input type="hidden" name="monto_total" value="<?=$monto_total?>"/>
	<button class="btn btn-primary" type="submit" name="finalizar"><i class="fa fa-check"></i> Finalizar Compra</button>
</form>

<script type="text/javascript">
		
	function modificar(idc){
		var new_cant = new Number(prompt("¿Cual es la nueva cantidad?"));
		if(new_cant>0 && (new_cant instanceof Number)){
			window.location="?p=carrito&id="+idc+"&modificar="+new_cant;
		}
		else{
			alert("Error, introduce un valor valido");
		}
	}
</script>
<?php
check_user("productos");
if(isset($cat)){
	
    $ssql1="SELECT * FROM categorias WHERE IdCategoria = '$cat'";
    $sc = mysqli_query($enlace,$ssql1);
	$rc = mysqli_fetch_array($sc);
	?>
	<h1>Categoria Filtrada por: <?=$rc['IdCategoria']?></h1>
	<?php
}
if(isset($agregar) && isset($cant)){
	$idp = clear($agregar);
	$cant = clear($cant);
	$id_cliente = clear($_SESSION['IdCliente']);
	$ssqlv="SELECT * FROM carro WHERE IdCliente = '$id_cliente' AND IdProducto = '$idp'";
    $v = mysqli_query($enlace,$ssqlv);
	if(mysqli_num_rows($v)>0){
		$ssqlq="UPDATE carro SET cant = cant + $cant WHERE IdCliente = '$id_cliente' AND IdProducto = '$idp'";
        $q = mysqli_query($enlace,$ssqlq);
	
	}else{
		$ssqlq="INSERT INTO carro (IdCliente,IdProducto,cant) VALUES ($id_cliente,$idp,$cant)";
        $q = mysqli_query($enlace,$ssqlq);
	}
	alert("Se ha agregado al carro de compras",1,'productos');
	//redir("?p=productos");
}
if(isset($cat)){
	$ssqlq="SELECT * FROM productos WHERE IdCategoria = '$cat' AND oferta>0 ORDER BY IdProducto DESC";
    $q = mysqli_query($enlace,$ssqlq);
}else{
	$ssqlq="SELECT * FROM productos WHERE oferta>0 ORDER BY IdProducto DESC";
    $q = mysqli_query($enlace,$ssqlq);
}
while($r=mysqli_fetch_array($q)){
	$preciototal = 0;
			if($r['oferta']>0){
				if(strlen($r['oferta'])==1){
					$desc = "0.0".$r['oferta'];
				}else{
					$desc = "0.".$r['oferta'];
				}
				$preciototal = $r['Precio_Caja'] -($r['Precio_Caja'] * $desc);
			}else{
				$preciototal = $r['Precio_Caja'];
			}
	?>
		<div class="producto">
			<div class="name_producto"><?=$r['NombreProducto']?></div>
			<div><img class="img_producto" src="imagenes/<?=$r['Imagen']?>"/></div><br>
			<del><?=$r['Precio_Caja']?> <?=$divisa?></del> <span class="precio"> <?=$preciototal?> <?=$divisa?> </span>
			<button class="btn btn-warning pull-right" onclick="agregar_carro('<?=$r['IdProducto']?>');"><i >Agregar al carrito</i></button>
		</div>
	<?php
}
?>

<script type="text/javascript">
	
	function agregar_carro(idp){
		var cant = prompt("¿Que cantidad desea agregar?",1);
		if(cant.length>0){
			window.location="?p=ofertas&agregar="+idp+"&cant="+cant;
		}
	}
	function redir_cat(){
		window.location="?p=ofertas&cat="+$("#categoria").val();
	}
</script>
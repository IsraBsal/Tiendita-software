<?php
check_user("productos");
if(isset($cat)){
	$sc = mysqli_query($enlace,"SELECT * FROM categorias WHERE IdCategoria = '$cat'");
	$rc = mysqli_fetch_array($sc);
?>
<h1>Categoria Filtrada por: <?=$rc['NombreCategoria']?></h1>
<?php
}
if(isset($agregar) && isset($cant)){
	$idp = clear($agregar);
	$cant = clear($cant);
	$id_cliente = clear($_SESSION['IdCliente']);
	$v = mysqli_query($enlace,"SELECT * FROM carro WHERE IdCliente = '$id_cliente' AND IdProducto = '$idp'");
	if(mysqli_num_rows($v)>0){
		$q = mysqli_query($enlace,"UPDATE carro SET cant = cant + $cant WHERE IdCliente = '$id_cliente' AND IdProducto = '$idp'");
	
	}else{
		$q = mysqli_query($enlace,"INSERT INTO carro (IdCliente,IdProducto,cant) VALUES ($id_cliente,$idp,$cant)");
	}
	alert("Se ha agregado al carro de compras",1,'productos');
	//redir("?p=productos");
}
if(isset($busq) && isset($cat)){
	$q = mysqli_query($enlace,"SELECT * FROM productos WHERE NombreProducto like '%$busq%' AND IdCategoria = '$cat'");
}elseif(isset($cat) && !isset($busq)){
	$q = mysqli_query($enlace,"SELECT * FROM productos WHERE IdCategoria = '$cat' ORDER BY IdProducto DESC");
}elseif(isset($busq) && !isset($cat)){
	$q = mysqli_query($enlace,"SELECT * FROM productos WHERE NombreProducto like '%$busq%'");
}elseif(!isset($busq) && !isset($cat)){
	$q = mysqli_query($enlace,"SELECT * FROM productos ORDER BY IdProducto DESC");
}else{
	$q = mysqli_query($enlace,"SELECT * FROM productos ORDER BY IdProducto DESC");
}
?>
	
	<form method="post" action="">
		<div class="row">
			<div class="col-md-5">
				<div class="form-group">
					<input type="text" class="form-control" name="busq" placeholder="Coloca el nombre del producto"/>
				</div>
			</div>
			<div class="col-md-5">
				<select id="categoria" name="cat" class="form-control">
					<?php
					$cats = mysqli_query($enlace,"SELECT * FROM categorias ORDER BY IdCategoria ASC");
					while($rcat = mysqli_fetch_array($cats)){
						?>
						<option value="<?=$rcat['IdCategoria']?>"><?=$rcat['NombreCategoria']?></option>
						<?php
					}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-prmiary" name="buscar"><i class="fa fa-serch"></i> Buscar</button>
			</div>
		</div>
	</form>
<?php
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
                        <div class="name_producto"><?=$r['Marca']?></div>
			<div><img class="img_producto" src="imagenes/<?=$r['Imagen']?>"/></div>
			<?php
			if($r['oferta']>0){
				?>
				<del><?=$r['Precio_Caja']?> <?=$divisa?></del> <span class="precio"> <?=$preciototal?> <?=$divisa?> </span>
				<?php
			}else{
				?>
				<span class="precio"><br><?=$r['Precio_Caja']?> <?=$divisa?></span>
				<?php
			}
			?>
			
			<button class="btn btn-warning pull-right" onclick="agregar_carro('<?=$r['IdProducto']?>');"><i class="fa fa-shopping-cart"></i></button>
		</div>
	<?php
}
?>

<script type="text/javascript">
	
	function agregar_carro(idp){
		var cant = prompt("¿Que cantidad desea agregar?",1);
		if( cant.length>0 && !(typeof cant === 'string') ){
			window.location="?p=productos&agregar="+idp+"&cant="+cant;
		}
		else{
			alert("Valor invalido, intentalo de nuevo.");
		}
		
	}
</script>
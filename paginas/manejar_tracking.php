<?php
	check_admin();
	// 0 recien comprada
	// 1 compra pagada
	// 2 en camino (enviando)
	// 3 entregada
	$s = mysqli_query($enlace,"SELECT * FROM compra");
	if(isset($eliminar)){
		$eliminar = clear($eliminar);
		mysqli_query($enlace,"DELETE FROM productos_compra WHERE IdCompra = '$eliminar'");
		mysqli_query($enlace,"DELETE FROM pagos WHERE id_compra='$eliminar'");
		mysqli_query($enlace,"DELETE FROM compra WHERE id = '$eliminar'");
		redir("?p=manejar_tracking");
	}
?>

<h1>Trackings</h1><br><br>

<table class="table table-stripe">
	<tr>
		<th style="background-color:#FFFFFF">Cliente</th>
		<th style="background-color:#FFFFFF">Fecha</th>
		<th style="background-color:#FFFFFF">Monto</th>
		<th style="background-color:#FFFFFF">Status</th>
		<th style="background-color:#FFFFFF">Acciones</th>
	</tr>

		
		<form method="post" action="">
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<input type="text" class="form-control" name="busqid" placeholder="Coloca el ID de la compra"/>
					</div>
				</div>
				<div class="col-md-2">
					<button type="submit" class="btn btn-prmiary" name="buscar"><i class="fa fa-serch"></i> Buscar</button>
				</div>
			</div>
		</form>
<?php

	if(isset($busqid)){
		$s = mysqli_query($enlace,"SELECT * FROM compra WHERE id='$busqid'");
		if(mysqli_num_rows($s)==1){
		}
		else{
			alert("No existe la compra con el ID ingresado",0,'manejar_tracking');
		}

	}

	while($r=mysqli_fetch_array($s)){
		$sc = mysqli_query($enlace,"SELECT * FROM usuarios WHERE IdCliente = '".$r['IdCliente']."'");
		$rc = mysqli_fetch_array($sc);
		$cliente = $rc['Nombre'];
		if($r['estado'] == 0){
			$status = "Pedido";
		}elseif($r['estado']==1){
			$status = "Pagado";
		}elseif($r['estado'] == 2){
			$status = "Enviado";
		}elseif($r['estado'] == 3){
			$status = "Entregado";
		}elseif($r['estado'] == 4){
            $status = "Cancelado";
        }else{
			$status = "Indefinido";
		}
		$fecha = fecha($r['fecha']);
		?>
		<tr>
			<td style="background-color:#FFFFFF"><?=$cliente?></td>
			<td style="background-color:#FFFFFF"><?=$fecha?></td>
			<td style="background-color:#FFFFFF"><?=$r['monto']?> <?=$divisa?></td>
			<td style="background-color:#FFFFFF"><?=$status?></td>
			<td style="background-color:#FFFFFF">
				<a tittle="Eliminar registro" style="color:#000000" href="?p=manejar_tracking&eliminar=<?=$r['id']?>">
					<i >Eliminar Registro</i>
				</a>
				&nbsp; &nbsp;
				<a tittle="Editar Status" style="color:#000000" href="?p=manejar_status&id=<?=$r['id']?>">
					Editar status
				</a>
				&nbsp; &nbsp;
				<a  tittle="Ver compra"style="color:#000000" href="?p=ver_compra&id=<?=$r['id']?>">
					<i >Ver compra</i>
				</a>
			</td>
		</tr>
		<?php
	}
?>
</table>
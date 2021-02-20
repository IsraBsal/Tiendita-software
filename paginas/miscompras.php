<?php
check_user('miscompras');
$ssqls="SELECT * FROM compra WHERE IdCliente = '".$_SESSION['IdCliente']."' ORDER BY fecha DESC";
$s = mysqli_query($enlace,$ssqls);
if(mysqli_num_rows($s)>0){
	?>
	<h1>Mis compras</h1>

	<table class="table table-stripe">
		<tr>
			<th>Fecha</th>
			<th>Monto</th>
			<td>Estado</td>
			<td>Acciones</td>
		</tr>
		
		

	<?php
	while($r=mysqli_fetch_array($s)){
		?>
		<tr>
			<td><?=fecha($r['fecha'])?></td>
			<td><?=number_format($r['monto'])?> <?=$divisa?></td>
			<td><?=estado($r['estado'])?></td>
			<td>
				<a title="ver" href="?p=ver_compraeye&id=<?=$r['id']?>">
					Ver compra
				</a>

				<?php
					if(estado($r['estado']) == "Solicitado"){
						?>
							&nbsp; &nbsp; <a title="Pagar" href="?p=pagar_compra&id=<?=$r['id']?>"><b>Pagar</b></a>
                                                        &nbsp; &nbsp; <a title="Cancelar" href="?p=cancelar_compra&id=<?=$r['id']?>"><b>Cancelar</b></a>      
						<?php
					}
                    if(estado($r['estado']) == "Pagado" or estado($r['estado']) == "Enviado"){
                        ?>
                            
                            &nbsp; &nbsp; <a title="Cancelar" href="?p=cancelar_compra&id=<?=$r['id']?>"><b>Cancelar</b></a>
                        <?php
                    }
                    
                    if(estado($r['estado']) == "Entregado"){
						?>
							&nbsp; &nbsp; <a title="Devolver" href="?p=cancelar_compra&id=<?=$r['id']?>"><b>Devolver</b></a>
                                                        &nbsp; &nbsp; <a title="Calificar" href="?p=evaluar_compra&id=<?=$r['id']?>"><b>Calificar compra</b></a>
						<?php
					}
				?>
			</td>
		</tr>
		<?php
	}
	?>
	</table>

	<?php
}else{
	?>
	<i>Usted aun no ha comprado</i>
	<?php
}
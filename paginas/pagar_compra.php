<?php
check_user('pagar_compra');
if(isset($subir)){
	$nombre = clear($nombre);
	$comprobante = "";
	if(is_uploaded_file($_FILES['comprobante']['tmp_name'])){
		$comprobante = date("His").rand(0,1000).".jpg";
		move_uploaded_file($_FILES['comprobante']['tmp_name'], "comprobantes_pagos/".$comprobante);
                $ssql="INSERT INTO pagos (IdCliente,id_compra,comprobante,nombre,fecha,estado) VALUES ('".$_SESSION['IdCliente']."','$id','$comprobante','$nombre',NOW(),'1')";
                
                $ssqlq="UPDATE compra SET estado='1' WHERE id='$id'";
                 
    
            $q=mysqli_query($enlace,$ssql);
            
            mysqli_query($enlace,$ssqlq);
            
    
            alert("Comprobante enviado",1,'miscompras');
                
        }
	
	//redir("?p=miscompras");
}
?>

<h1>Metodos de pago</h1>

<table class="table table-striped">
<tr>
	<th>Tipo de pago</th>
	<th>Cuenta</th>
	<th>Beneficiario</th>
	<th>Acciones</th>
</tr>

<tr>
	<td>Transferencia Bancaria</td>
	<td>1234-40607-000</td>
	<td>Israel And Sandy Candy planet MB </td>
	<th><a target="_blank" href="https://paypal.com"> Ir al pago </a></th>
</tr>
</table>

<h1>Envia el comprobante de pago de la compra</h1>

<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<label><small>Adjuntar comprobante y nombre de la persona que transfiere el dinero</small></label>
		<input type="file" class="form-control" name="comprobante" title="Adjuntar Comprobante" required/>
	</div>
	<div class="form-group">
		<input type="text" class="form-control" name="nombre" title="Nombre de la persona que transfiere"/>
	</div>
	<div class="form-group">
		<input type="submit" name="subir" class="btn btn-primary" value="Enviar"/>
	</div>
</form>
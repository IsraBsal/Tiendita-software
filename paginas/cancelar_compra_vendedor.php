<?php
    $id = clear($id);
    $s = mysqli_query($enlace,"SELECT * FROM compra WHERE id = '$id'");
    $r = mysqli_fetch_array($s);
	mysqli_query($enlace,"UPDATE compra SET estado = '4' WHERE id = '$id'");
    alert("Compra cancelada",0,'administrador');

?>
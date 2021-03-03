<?php
    $id = clear($id);
    $s = mysqli_query($enlace,"SELECT * FROM compra WHERE id = '$id'");
    $r = mysqli_fetch_array($s);
	mysqli_query($enlace,"UPDATE compra SET estado = '1' WHERE id = '$id'");
    alert("Orden pagada",1,'administrador');

?>
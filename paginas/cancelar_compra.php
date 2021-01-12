<?php
    $id = clear($id);
    $s = mysqli_query($enlace,"SELECT * FROM compra WHERE id = '$id'");
    $r = mysqli_fetch_array($s);
    $estado = clear($estado);
	mysqli_query($enlace,"UPDATE compra SET estado = '4' WHERE id = '$id'");
	redir("?p=miscompras");

?>



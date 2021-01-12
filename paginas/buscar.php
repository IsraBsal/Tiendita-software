<?php



if (isset($_POST['buscador'])){
    // Tomamos el valor ingresado
    $buscar = mysqli_real_escape_string($enlace, $_POST['palabra']);

    // Si está vacío, lo informamos, sino realizamos la búsqueda
    if (empty($buscar)){
        echo "No se ha ingresado una cadena a buscar";
    }else{
        $sql = "SELECT * FROM productos WHERE NombreProducto like '%$buscar%'";
        $result = mysqli_query($enlace, $sql);
        if ($result === false){
            echo mysqli_error($enlace);
        }else{
            $total = mysqli_num_rows($result);
            // Imprimimos los resultados
            if ($row = mysqli_fetch_array($result)){
                echo "Resultados para: <b>$buscar</b>";
                do {
                ?>
                <div class="producto">
				Para comprar los productos por favor inicia sesion
                                <div class="nombre_producto"><?=$row['NombreProducto']?></div>
				<div class="marca_producto"><?=$row['Marca']?></div>
				<div> <img class="img_producto" src="imagenes/<?=$row['Imagen']?>" width="300" height="300"/></div>
				<span class="precio"><br><?=$row['Precio_Caja']?><?=$divisa?></span>
				
			     </div>
                <?php
                }while ($row = mysqli_fetch_array($result));
                echo "<p>Resultados: $total</p>";
            }else{
                // En caso de no encontrar resultados
                echo "No se encontraron resultados para: $buscar";
            }
        }
    }
}
?>


<?php 

	
	$enlace=mysqli_connect($host_mysql,$user_mysql,$pass_mysql) or die ("error al conectar al servidor");
	mysqli_select_db($enlace,$db_mysql) or die ("Error conexion a la base de datos");

	function clear($var){
		htmlspecialchars($var);
		return $var;
	}

	function redir($var){ //para redireccionar a una pagina
	 ?>
	 	<script>
		window.location="<?=$var?>";
	 	</script>
	 <?php
	 
	 die();
    }

    function check_admin(){ //Verifica si hay una sesion iniciada de admin
	 	if (!isset($_SESSION['idadmin'])){
		   redir("./");
	    }
    }

    function alert1($var){ //Mostrar mensajes al usuario
		//"error", "success" and "info".
		?>
		<script>
			window.location="<?$var?>";
		</script>	
		<?php
	}

	function alert($txt,$type,$url){
		//"error", "success" and "info".
		if($type==0){
			$t = "error";
		}elseif($type==1){
			$t = "success";
		}elseif($type==2){
			$t = "info";
		}else{
			$t = "info";
		}
		echo '<script>swal({ title: "Alerta", text: "'.$txt.'", icon: "'.$t.'"});';
		echo '$(".swal-button").click(function(){ window.location="?p='.$url.'"; });';
		echo '</script>';
	}

	function check_user($url){
		if(!isset($_SESSION['IdCliente'])){
			redir("?p=login&return=<?=$url?>");
		}
	}

	function connect(){
		$host_mysql = "localhost";
		$user_mysql = "root";
		$pass_mysql = "";
		$db_mysql = "tienda";
	 	$mysqli = mysqli_connect($host_mysql,$user_mysql,$pass_mysql,$db_mysql);
		return $mysqli;
	}

	function nombre_cliente($id_cliente){
		$enlace = connect();
		$ssql1 ="SELECT * FROM usuarios WHERE IdCliente = '$id_cliente'";
		$query=mysqli_query($enlace,$ssql1);
		$r = mysqli_fetch_array($query,MYSQLI_BOTH);
		return $r['Nombre'];
	}
        
        function fecha($fecha){
        $e = explode("-",$fecha);
        $year = $e[0];
        $month = $e[1];
        $e2 = explode(" ",$e[2]);
        $day = $e2[0];
        $time = $e2[1];
        $e3 = explode(":",$time);
        $hour = $e3[0];
        $mins = $e3[1];
        return $day."/".$month."/".$year." ".$hour.":".$mins;
    }

    function estado($id_estado){
		if($id_estado == 0){
			$status = "Solicitado";
		}elseif($id_estado==1){
			$status = "Pagado";
		}elseif($id_estado == 2){
			$status = "Enviando";
		}elseif($id_estado == 3){
			$status = "Entregado";
		}elseif($id_estado == 4){
                    $status = "Cancelado";
                }elseif($id_estado == 5){
                    $status = "Devuelto";
                }else{
                    $status = "Indefinido";
		}
		return $status;
    }
    
    function calificacion($id_calificacion){
		if($id_calificacion == 0){
			$calificacion = "Ninguna";
		}elseif($id_calificacion==1){
			$calificacion = "Pesima";
		}elseif($id_calificacion == 2){
			$calificaion = "Mala";
		}elseif($id_calificacion == 3){
			$calificacion = "Regular";
		}elseif($id_calificacion == 4){
                        $calificacion = "Buena";
                }elseif($id_calificacion==5 ){
                        $calificacion="Perfecta";
                }else{
                        $calificacion = "Ninguna";
		}
		return $calificacion;
    }


	

 ?>
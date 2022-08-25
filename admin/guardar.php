<?php require_once('../Connections/conexiontienda.php'); ?>
<?php

$ruta = "../Imagenes/";
opendir($ruta);
$destino = $ruta.$_FILES['foto']['name'];
copy($_FILES['foto']['tmp_name'],$destino);
$nombre=$_FILES['foto']['name'];
$conexiontienda=mysql_connect($hostname_conexiontienda, $username_conexiontienda, $password_conexiontienda)or die("problemas al conectar al servidor");
	mysql_select_db($database_conexiontienda,$conexiontienda)or die("no existe la base de datos");
	mysql_query("insert into dbproductos(strNombre, strPos, flPrecio, intEst, Imagen)values('$_POST[strNombre]','$_POST[strPos]','$_POST[flPrecio]','$_POST[intEst]','$nombre'))",$conexiontienda);
					  
	header("location:../admin/productos_lista/"); 
?>

      
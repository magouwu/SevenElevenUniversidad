<?php if (isset($_SESSION)) {
  session_start();}
?>
<?php require_once('Connections/conexiontienda.php'); ?>
<?php require_once('Connections/conexiontienda.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO dbproductos (strNombre, flPrecio) VALUES (%s, %s)",
                       GetSQLValueString($_POST['strNombre'], "text"),
                       GetSQLValueString($_POST['flPrecio'], "double"));

  mysql_select_db($database_conexiontienda, $conexiontienda);
  $Result1 = mysql_query($insertSQL, $conexiontienda) or die(mysql_error());

  $insertGoTo = "carrito.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexiontienda, $conexiontienda);
$query_Recordset1 = "SELECT * FROM dbproductos ORDER BY dbproductos.idProductos";
$Recordset1 = mysql_query($query_Recordset1, $conexiontienda) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Documento sin título</title>

<style type="text/css">
body,td,th {
	font-size: 12px;
}
</style>
<link href="Estilo/principal.css" rel="stylesheet" type="text/css" />
</head>

<body text="#FFFFFF">

<div class="container">
  <div class="header"><img src="images/sven.png" width="961" height="122" /></div>
  <div class="sidebar1">
    <ul class="nav">
      <li></li>
    </ul>
<p><a href="productos.php">productos</a></p>
  <?php
if(isset($_SESSION['MM_Username'])&&($_SESSION['MM_Username']!=""))
{
	echo "Hola " . ObtenerNombreUsuario($_SESSION['MM_idUsuario']);
}
else
{?>
<p><a href="alta_usuario.php">Registrarme</a></p>
<p><a href="acceso_usuario.php">Log In</a></p>
<?php } ?>
 <?php require_once('Connections/conexiontienda.php'); ?>

  </div>
  <div class="content">
    <h1>Productos<br />
<table width="700" border="1">
	  <tr class="tablaprincipal">
	    <td width="59">Nombre Producto</td>
	    <td width="59">Estado</td>
	    <td width="59">Proovedor</td>
	    <td width="59">Precio</td>
	    <td width="59">Categoria</td>
	    <td width="59">Imagen</td>
        
      </tr>
	  <?php do { ?>
	  <tr>
	    <td><?php echo $row_Recordset1['strNombre']; ?></td>
	    <td><?php echo $row_Recordset1['intEst']; ?></td>
	    <td><?php echo $row_Recordset1['strPos']; ?></td>
	    <td><?php echo $row_Recordset1['flPrecio']; ?></td>
	    <td><?php echo $row_Recordset1['strCategoria']; ?></td>
      <td><?php echo "<img class=\"imagen\" src=\""."Imagenes/".$row_Recordset1['Imagen']."\"/>";?></td>
      </tr>
	  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </table>


   
    <!-- InstanceEndEditable --></h1>
    <!-- InstanceBeginEditable name="EditRegion4" --> <!-- InstanceEndEditable --><!-- end .content --></div>
  <div class="footer">
    <p>Seven</p>

 

    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($Recordset1);
?>

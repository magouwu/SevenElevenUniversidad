<?php require_once('../Connections/conexiontienda.php'); ?>
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

mysql_select_db($database_conexiontienda, $conexiontienda);
$query_DatosUsuarios = "SELECT * FROM dbadmin ORDER BY dbadmin.strNombre ASC";
$DatosUsuarios = mysql_query($query_DatosUsuarios, $conexiontienda) or die(mysql_error());
$row_DatosUsuarios = mysql_fetch_assoc($DatosUsuarios);
$totalRows_DatosUsuarios = mysql_num_rows($DatosUsuarios);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Administracion principal tienda seven</title>

<link href="../Estilo/twoColFixLtHdr.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="container">
  <div class="header"><img src="../images/sven.png" width="963" height="134" alt="Administracion" />

    </div>
  <div class="sidebar1">

    <?php include("../includes/cabeceraadmin.php")?>
</div>
  <div class="content">
 

	<h1>Lista de Usuarios</h1>
	<p>&nbsp;    
	<table border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr class="tablaprincipal">
	    <td width="147">Id</td>
	    <td width="10">&nbsp;</td>
	    <td width="228">Nombre</td>
	    <td width="158">Acciones</td>
      </tr>
	  <?php do { ?>
	    <tr>
	      <td><a href="usuarios_datos.php?recordID=<?php echo $row_DatosUsuarios['idUsuario']; ?>"> <?php echo $row_DatosUsuarios['idUsuario']; ?>&nbsp; </a></td>
	      <td>&nbsp;</td>
	      <td><?php echo $row_DatosUsuarios['strNombre']; ?></td>
	      <td>Editar - Eliminar</td>
        </tr>
	    <?php } while ($row_DatosUsuarios = mysql_fetch_assoc($DatosUsuarios)); ?>
    </table>
    <br />
    <?php echo $totalRows_DatosUsuarios ?> Registros Total
    </p>
	</div>
  <div class="footer">Administracion Seven</div>
</div>
</body>
</html>
<?php
mysql_free_result($DatosUsuarios);
?>

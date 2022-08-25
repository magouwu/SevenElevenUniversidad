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
$query_Recordset1 = "SELECT * FROM dbproductos ORDER BY dbproductos.idProductos";
$Recordset1 = mysql_query($query_Recordset1, $conexiontienda) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
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
 
	<h1>Lista de Productos</h1>
	<p><a href="producto_add.php">A&ntilde;adir Producto</a>
	<form name="consulta1" method="post" action="ejecuta.php">
Nombre del producto:
<input type="text" name="codigo" maxlength="50">
<input type="submit" value="buscar"></p>
	<table width="779" border="1">
	  <tr class="tablaprincipal">
	    <td width="59">Nombre Producto</td>
	    <td width="59">Estado</td>
	    <td width="59">Proovedor</td>
	    <td width="59">Precio</td>
	    <td width="108">Categoria</td>
	    <td width="108">Imagen</td>
        <td width="108">Acciones</td>
      </tr>
	  <?php do { ?>
	  <tr>
	    <td><?php echo $row_Recordset1['strNombre']; ?></td>
	    <td><?php echo $row_Recordset1['intEst']; ?></td>
	    <td><?php echo $row_Recordset1['strPos']; ?></td>
	    <td><?php echo $row_Recordset1['flPrecio']; ?></td>
	    <td><?php echo $row_Recordset1['strCategoria']; ?></td>
      <td><?php echo "<img class=\"imagen\" src=\""."Imagenes/".$row_Recordset1['Imagen']."\"/>";?></td>
	    <td><a href="productos_edit.php?recordID=<?php echo $row_Recordset1['idProductos']; ?>">Editar</a> - <a href="productos_delete.php?recordID=<?php echo $row_Recordset1['idProductos']; ?>">Eliminar </a></td>
      </tr>
	  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </table>
	</p>
    </div>
  <div class="footer">Administracion Seven</div>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>

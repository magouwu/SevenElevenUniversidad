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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE dbproductos SET strNombre=%s, strPos=%s, flPrecio=%s, strImagen=%s, intEst=%s WHERE idProductos=%s",
                       GetSQLValueString($_POST['strNombre'], "text"),
                       GetSQLValueString($_POST['strPos'], "text"),
                       GetSQLValueString($_POST['flPrecio'], "double"),
                       GetSQLValueString($_POST['strImagen'], "text"),                       GetSQLValueString($_POST['intEst'], "int"),
                       GetSQLValueString($_POST['idProductos'], "int"));

  mysql_select_db($database_conexiontienda, $conexiontienda);
  $Result1 = mysql_query($updateSQL, $conexiontienda) or die(mysql_error());

  $updateGoTo = "productos_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$varProductos_DatosProductos = "0";
if (isset($_GET["recordID"])) {
  $varProductos_DatosProductos = $_GET["recordID"];
}
mysql_select_db($database_conexiontienda, $conexiontienda);
$query_DatosProductos = sprintf("SELECT * FROM dbproductos WHERE dbproductos.idProductos = %s", GetSQLValueString($varProductos_DatosProductos, "int"));
$DatosProductos = mysql_query($query_DatosProductos, $conexiontienda) or die(mysql_error());
$row_DatosProductos = mysql_fetch_assoc($DatosProductos);
$totalRows_DatosProductos = mysql_num_rows($DatosProductos);
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
 
	<script>
function subirimagen()
{
	self.name = 'opener';
	remote = open('gestionimagen.php', 'remote', 'width=400,height=150,location=no,scrollbars=yes,menubars=no,toolbars=no,resizable=yes,fullscreen=no, status=yes');
 	remote.focus();
	}

</script>
    <h1><center>Editar Productos</center></h1>
	<p>&nbsp;</p>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Nombre:</td>
          <td><input type="text" name="strNombre" value="<?php echo htmlentities($row_DatosProductos['strNombre'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Pos:</td>
          <td><input type="text" name="strPos" value="<?php echo htmlentities($row_DatosProductos['strPos'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Precio:</td>
          <td><input type="text" name="flPrecio" value="<?php echo htmlentities($row_DatosProductos['flPrecio'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Imagen:</td>
          <td><input type="text" name="strImagen" value="<?php echo htmlentities($row_DatosProductos['strImagen'], ENT_COMPAT, 'iso-8859-1'); ?>" size="32" /><input name="button" type="button" id="button" value="Subir Imagen" onclick="javascript:subirimagen();" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Est:</td>
          <td><select name="intEst">
            <option value="1" <?php if (!(strcmp(1, htmlentities($row_DatosProductos['intEst'], ENT_COMPAT, 'iso-8859-1')))) {echo "SELECTED";} ?>>Activo</option>
            <option value="0" <?php if (!(strcmp(0, htmlentities($row_DatosProductos['intEst'], ENT_COMPAT, 'iso-8859-1')))) {echo "SELECTED";} ?>>Inactivo</option>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Actualizar registro" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form1" />
      <input type="hidden" name="idProductos" value="<?php echo $row_DatosProductos['idProductos']; ?>" />
    </form>
    <p>&nbsp;</p>
    </div>
  <div class="footer">Administracion Seven</div>
  </div>
</body>
</html>
<?php
mysql_free_result($DatosProductos);
?>

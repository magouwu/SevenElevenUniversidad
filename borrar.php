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

$varUsuario_ConsultaFunction = "0";
if (isset(xxxxx)) {
  $varUsuario_ConsultaFunction = xxxxx;
}
mysql_select_db($database_conexiontienda, $conexiontienda);
$query_ConsultaFunction = sprintf("SELECT dbadmin.strNombre FROM dbadmin WHERE dbadmin.idUsuario = %s", GetSQLValueString($varUsuario_ConsultaFunction, "int"));
$ConsultaFunction = mysql_query($query_ConsultaFunction, $conexiontienda) or die(mysql_error());
$row_ConsultaFunction = mysql_fetch_assoc($ConsultaFunction);
$totalRows_ConsultaFunction = mysql_num_rows($ConsultaFunction);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php echo $row_ConsultaFunction['strNombre']; ?>
</body>
</html>
<?php
mysql_free_result($ConsultaFunction);
?>

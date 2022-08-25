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
function ObtenerNombreUsuario($identificador)
{
	global $database_conexiontienda, $conexiontienda;
	mysql_select_db($database_conexiontienda, $conexiontienda);
	$query_ConsultaFunction = sprintf("SELECT dbadmin.strNombre FROM dbadmin WHERE dbadmin.idUsuario = %s", $identificador);
	$ConsultaFunction = mysql_query($query_ConsultaFunction, $conexiontienda) or die(mysql_error());
	$row_ConsultaFunction = mysql_fetch_assoc($ConsultaFunction);
	$totalRows_ConsultaFunction = mysql_num_rows($ConsultaFunction);
	echo $row_ConsultaFunction['strNombre']; 
	mysql_free_result($ConsultaFunction);
}
?>
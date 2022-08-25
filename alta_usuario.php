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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="alta_emailerror.php";
  $loginUsername = $_POST['strEmail'];
  $LoginRS__query = sprintf("SELECT strEmail FROM dbadmin WHERE strEmail=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_conexiontienda, $conexiontienda);
  $LoginRS=mysql_query($LoginRS__query, $conexiontienda) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the reqeuested ustrname
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO dbadmin (strNombre, strEmail, strPassword) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['strNombre'], "text"),
                       GetSQLValueString($_POST['strEmail'], "text"),
                       GetSQLValueString($_POST['strPassword'], "text"));

  mysql_select_db($database_conexiontienda, $conexiontienda);
  $Result1 = mysql_query($insertSQL, $conexiontienda) or die(mysql_error());

  $insertGoTo = "alta_chido.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>

<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body,td,th {
	font-size: 18px;
}
</style>
<link href="Estilo/principal.css" rel="stylesheet" type="text/css" />
</head>

<body>

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
    <h1><Alta Usuario<br />
        <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
          <table align="center">
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Nombre:</td>
              <td><span id="sprytextfield1">
                <input type="text" name="strNombre" value="" size="20" />
              <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Email:</td>
              <td><span id="sprytextfield2">
              <input type="text" name="strEmail" value="" size="20" />
              <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Password:</td>
              <td><span id="sprytextfield3">
                <input type="password" name="strPassword" value="" size="20" />
              <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">&nbsp;</td>
              <td><input type="submit" value="Registrar" /></td>
            </tr>
          </table>
          <input type="hidden" name="MM_insert" value="form1" />
        </form>
        <p>&nbsp;</p>
<br />
    <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
    </script>
    </h1>
  <div>
  <div class="footer">
    <p>Seven</p>

 

    </div>
  </div>
</body>
</html>

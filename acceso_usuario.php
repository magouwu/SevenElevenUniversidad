<?php require_once('Connections/conexiontienda.php'); ?>


<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['strEmail'])) {
  $loginUsername=$_POST['strEmail'];
  $password=$_POST['strPassword'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "acceso_chido.php";
  $MM_redirectLoginFailed = "acceso_error.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conexiontienda, $conexiontienda);
  
  $LoginRS__query=sprintf("SELECT idUsuario, strEmail, strPassword FROM dbadmin WHERE strEmail=%s AND strPassword=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $conexiontienda) or die(mysql_error());
  $row_LoginRS = mysql_fetch_assoc($LoginRS);
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;
	$_SESSION['MM_idUsuario'] = $row_LoginRS["idUsuario"];	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Documento sin título</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
<link href="Estilo/principal.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="container">
  <div class="header"><!-- end .header --><img src="images/sven.png" width="961" height="122" /></div>
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
    <h1><!-- InstanceBeginEditable name="Contenido" -->Acceso Usuario<br />
    <!-- InstanceEndEditable --></h1>
    <!-- InstanceBeginEditable name="EditRegion4" -->
    <form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
      <p>
        <label for="strEmail"></label>
        Email:    
        <span id="sprytextfield1">
        <input type="text" name="strEmail" id="strEmail" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span> </p>
      <p>Contraseña:
        <input type="password" name="strPassword" id="strPassword" />
      </p>
      <p> 
        <input type="submit" name="button" id="button" value="Enviar" />
      </p>
    </form>
    <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email");
    </script>
    <!-- InstanceEndEditable --><!-- end .content --></div>
  <div class="footer">
    <p>Seven</p>

 

    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>

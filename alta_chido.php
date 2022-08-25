<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Documento sin título</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
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
    <h1><!-- InstanceBeginEditable name="Contenido" -->Se Ha Registrado Con Exito!<br />
      <br />
    <!-- InstanceEndEditable --></h1>
    <!-- InstanceBeginEditable name="EditRegion4" --><!-- InstanceEndEditable --><!-- end .content --></div>
  <div class="footer">
    <p>Seven</p>

 

    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>

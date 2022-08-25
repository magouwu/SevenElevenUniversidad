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

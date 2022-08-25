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
 

    <h1>Su Busqueda Ha Finalizado...</h1>
	<p>
	<?php require_once('../Connections/conexiontienda.php'); ?><?php



/******** CONECTAR CON BASE DE DATOS **************** */
/******** Recuerda cambiar por tus datos ***********/ 
   $conexiontienda = mysql_pconnect($hostname_conexiontienda, $username_conexiontienda, $password_conexiontienda)
or trigger_error(mysql_error(),E_USER_ERROR); 

/* ********************************************** */
/********* CONECTA CON LA BASE DE DATOS  **************** */
   $database_conexiontienda = mysql_select_db("seven",$conexiontienda)
   or trigger_error(mysql_error(),E_USER_ERROR); 

/* ********************************************** */
/*ejecutamos la consulta, que solicita nombre, precio y existencia de la
tabla productos */
$sql = "SELECT strNombre, strPos, flPrecio, intEst,strCategoria, Imagen FROM dbproductos WHERE codigo='"
      .$_POST['codigo']."'";
$result = mysql_query ($sql);
// verificamos que no haya error
if (! $result){
   echo "La consulta SQL contiene errores.".mysql_error();
   exit();
}else {
    echo "<table border='1'> <tr>
	    <td>Nombre Producto</td>
	    <td>Estado</td>
	    <td>Proovedor</td>
	    <td>Precio</td>
	    <td>Categoria</td>
	    <td>Imagen</td>
      </tr><tr>";
//obtenemos los datos resultado de la consulta
    while ($row = mysql_fetch_row($result)){
                echo "<td>".$row_Recordset1['strNombre']." </td>
	    <td>".$row_Recordset1['intEst']."</td>
	    <td>" .$row_Recordset1['strPos']."</td>
	    <td>".$row_Recordset1['flPrecio']."</td>
	    <td>".$row_Recordset1['strCategoria']."</td>
      <td>".$row_Recordset1['Imagen']."</td>";
   }
   echo "</tr></table>";
 }
?> </p>
	</div>
  <div class="footer">Administracion Seven</div>
</div>
</body>
</html>

<?php
$hostname_conexiontienda = "localhost";
$database_conexiontienda = "seven";
$username_conexiontienda = "root";
$password_conexiontienda = "usbw";
$conexiontienda = mysql_pconnect($hostname_conexiontienda, $username_conexiontienda, $password_conexiontienda) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
<?php
define('DB_base','cascada');
define('DB_usuario','root');
define('DB_clave','');
define('DB_host','localhost');

$mysqli=new mysqli(DB_host,DB_usuario, DB_clave, DB_base);
?>
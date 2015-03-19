<?php
$host = "localhost";
$user = "root";
$pass = "";
$banco = "fabricadetalentos";
// Conecta-se ao banco de dados MySQL
$mysqli = new mysqli($host, $user, $pass, $banco);
$mysqli->query("set names utf8");
//date_default_timezone_set('America/Sao_Paulo');
date_default_timezone_set('America/Araguaina');
// Caso algo tenha dado errado, exibe uma mensagem de erro
if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
?>
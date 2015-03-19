<?php
include "../valida_cookies.php"; 
$funcao = $_GET['funcao'];

if($funcao == "verificaPercentual"){

	$idquestionario = $_SESSION['id_questionario'];

	$sql = "select sum(peso) as total from questoes_grupos where idquestionario = '".$idquestionario."'";
	$rs = $mysqli->query($sql);
	$row = $rs->fetch_array();

	if(($row[0] + $_GET["percentual"]) > 100){
		echo "true";
	}else{
		echo "false";
	}

}

if($funcao == "validaUsuario"){

	$sql = "select *  from usuarios where usuario = '".$_GET['usuario']."'";
	$rs = $mysqli->query($sql);
	
	if($rs->num_rows != 0){
		echo "true";
	}else{
		echo "false";
	}

}


if($funcao == "validaQuestionarioAtivo"){

	$sql = "select *  from usuarios where usuario = '".$_GET['usuario']."'";
	$rs = $mysqli->query($sql);
	
	if($rs->num_rows != 0){
		echo "true";
	}else{
		echo "false";
	}

}

// Acentua??o
header("Content-Type: text/html; charset=utf-8",true);
?>
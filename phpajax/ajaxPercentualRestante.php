<?php
include "../valida_cookies.php";
/* RECEIVE VALUE */
$validateValue=$_REQUEST['fieldValue'];
$validateId=$_REQUEST['fieldId'];


$validateError= "Este usuário já existe.";
$validateSuccess= "Este usuário é válido.";



	/* RETURN VALUE */
	$arrayToJs = array();
	$arrayToJs[0] = $validateId;
$sql = "select sum(peso) as total from questoes_grupos where idquestionario = '".$_SESSION['id_questionario']."'";
$rs = $mysqli->query($sql);
$row = $rs->fetch_array();


if(($row[0] + $validateValue) <= 100){		// validate??
	$arrayToJs[1] = true;			// RETURN TRUE
	echo json_encode($arrayToJs);			// RETURN ARRAY WITH success
}else{
	for($x=0;$x<1000000;$x++){
		if($x == 990000){
			$arrayToJs[1] = false;
			echo json_encode($arrayToJs);		// RETURN ARRAY WITH ERROR
		}
	}
	
}

?>
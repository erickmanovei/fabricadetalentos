<?php
//Open database connection
include "../conecta.php";
include "../valida_cookies.php";
include "../fc/funcoesphp.php";


try
{
	

	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get records from database
		$sqlu = "SELECT * from eventos";
		
		if(isset($_GET["nome"])and(!empty($_GET["nome"]))){
			$sqlu .= " where nome like '%".$_GET['nome']."%' COLLATE utf8_general_ci";
		}
		$sql2 = $sqlu;
		
		$sqlu .= " ORDER BY " . $_GET["jtSorting"] . " LIMIT ".$_GET['jtStartIndex'].",".$_GET['jtPageSize'];
		
		$result = $mysqli->query($sqlu);
		$result2 = $mysqli->query($sql2);
		
		//Add all records to an array
		$rows = array();
		while($row = $result->fetch_array())
		{
		    $rows[] = $row;
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Records'] = $rows;
		$jTableResult['TotalRecordCount'] = $result2->num_rows; //retorna o total de registros
		print json_encode($jTableResult);
	}
	//Creating a new record (createAction)
	else if(($_GET["action"] == "create")and($tipo_usuario == 3))
	{
		$resultado = "OK";
		$erro = "";
		
		if(!isset($_POST["idquestionario"]) or empty($_POST["idquestionario"])){
				$resultado = "ERROR";
				$erro = "É obrigatória a escolha de um questionário. Caso não exista questionário a escolher, crie ou ative um no menu Cadastros -> Questionários";
		}else{			
			//Insert record into database
			$result = $mysqli->query("INSERT INTO eventos(nome, dataini, datafim, graus360, idquestionario) VALUES('".$_POST['nome']."', '".gravaData($_POST['dataini'])."', '".gravaData($_POST['datafim'])."', '".$_POST['graus360']."', '".$_POST['idquestionario']."')");
			
			//Get last inserted record (to return to jTable)
			$result = $mysqli->query("select * FROM eventos where id = LAST_INSERT_ID();");
			$row = $result->fetch_array();
			$jTableResult['Record'] = $row;
		}
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = $resultado;
		$jTableResult['Message'] = $erro;		
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	}
	//Updating a record (updateAction)
	else if(($_GET["action"] == "update")and($tipo_usuario == 3))
	{
		$resultado = "OK";
		$erro = "";
		
		//Update record in database
		$sql = "select * from eventos where id = '".$_POST['id']."' and dataini > '".date('Y-m-d')."'";
		$rs = $mysqli->query($sql);
		if($rs->num_rows == 1){
			if(!isset($_POST["idquestionario"]) or empty($_POST["idquestionario"])){
				$resultado = "ERROR";
				$erro = "É obrigatória a escolha de um questionário. Caso não exista questionário a escolher, crie ou ative um no menu Cadastros -> Questionários";
			}else{				
				$result = $mysqli->query("UPDATE eventos SET nome = '" . $_POST['nome'] . "', dataini = '" . gravaData($_POST['dataini']) . "', datafim = '" . gravaData($_POST['datafim']) . "', graus360 = '" . $_POST['graus360'] . "', idquestionario = '" . $_POST['idquestionario'] . "' WHERE id = '" . $_POST['id'] . "'");	
			}
			
		}else{
			$resultado = "ERROR";
			$erro = "Não é permitida a alteração de um evento depois de iniciado.";
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = $resultado;
		$jTableResult['Message'] = $erro;
		print json_encode($jTableResult);
	}
	


}
catch(Exception $ex)
{
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>
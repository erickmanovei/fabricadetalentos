<?php
//Open database connection
include "../conecta.php";
include "../valida_cookies.php";


try
{
	

	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get records from database
		$sqlu = "SELECT * from usuarios where ativo = 'sim' and usuario = '".$nome_usuario."' and senha = '".$senha_usuario."'";
		
		
		$result = $mysqli->query($sqlu);
		
		
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
		print json_encode($jTableResult);
	}
	
	else if($_GET["action"] == "update")
	{
		//Update record in database
		
		$result = $mysqli->query("UPDATE usuarios SET senha = '" . $_POST['senha'] . "', email = '" . $_POST['email'] . "' WHERE id = '" . $_POST['id'] . "' and usuario = '".$nome_usuario."' and senha = '".$senha_usuario."'");	
		$_SESSION["senha_usuario"] = $_POST['senha'];
		

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
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
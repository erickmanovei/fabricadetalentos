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
		$sqlu = "SELECT * from tipousuario";
		
		if(isset($_GET["nome"])and(!empty($_GET["nome"]))){
			$sqlu .= " where nome like '%".$_GET['nome']."%' COLLATE utf8_general_ci";
		}
		
		$sqlu .= " ORDER BY " . $_GET["jtSorting"] . " LIMIT ".$_GET['jtStartIndex'].",".$_GET['jtPageSize'];
		
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
		$jTableResult['TotalRecordCount'] = $result->num_rows; //retorna o total de registros
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
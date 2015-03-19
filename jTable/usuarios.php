<?php
//Open database connection
include "../conecta.php";
include "../valida_cookies.php";
include "../dao/UsuariosDAO.php";
include "../fc/funcoesphp.php";

try
{
	

	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get records from database
		$sqlu = "SELECT * from usuarios where ativo = 'sim'";
		
		if(isset($_GET["nome"])and(!empty($_GET["nome"]))){
			$sqlu .= " and nome like '%".$_GET['nome']."%' COLLATE utf8_general_ci";
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
	else if($_GET["action"] == "create")
	{
		$resultado = "OK";
		$mensagem = "";
		
		if(($_POST['idtipousuario'] != 1) and ($tipo_usuario != 3)){
			$resultado = "ERROR";
			$mensagem = "Você não tem permissão para criar administradores.";
			
		}else{
		//Insert record into database
		$result = $mysqli->query("INSERT INTO usuarios(idtipousuario, usuario, senha, nome, email, ativo, novasenha) VALUES('".$_POST['idtipousuario']."', '".$_POST['usuario']."', '".$_POST['senha']."', '".$_POST['nome']."', '".$_POST['email']."', 'sim', 'sim')");
		}
		
	
		//Get last inserted record (to return to jTable)
		$result = $mysqli->query("select * FROM usuarios where id = LAST_INSERT_ID();");
		$row = $result->fetch_array();
		
		enviarEmail($row[0], "Bem vindo ao sistema de Avaliação de Desempenho!", 
		"Olá Sr(a). ".$row[4].",
		<br><br>
		Você agora já possui um usuário e senha para acessar o sistema de Avaliação de Desempenho!<br><br>
		Os dados são os que seguem:<br><br>
		Usuário: ".$row[2]."<br>
		Senha: ".$row[3]."");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = $resultado;
		$jTableResult['Message'] = $mensagem;
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	}
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in database
		$resultado = "OK";
		$mensagem = "";
		
		if(($_POST['idtipousuario'] != 1) and ($tipo_usuario != 3)){
			$resultado = "ERROR";
			$mensagem = "Você não tem permissão para criar administradores.";
			
		}else{
		$result = $mysqli->query("UPDATE usuarios SET idtipousuario = '" . $_POST['idtipousuario'] . "', nome = '" . $_POST['nome'] . "', email = '" . $_POST['email'] . "' WHERE id = '" . $_POST['id'] . "'");	
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = $resultado;
		$jTableResult['Message'] = $mensagem;
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$resultado = "OK";
		$mensagem = "";
		
		if($tipo_usuario == 1){
			$resultado = "ERROR";
			$mensagem = "Você não tem permissão para esta operação.";			
		}else{
		$result = $mysqli->query("UPDATE usuarios set ativo = 'nao' WHERE id = " . $_POST['id'] . ";");
		}
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = $resultado;
		$jTableResult['Message'] = $mensagem;
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
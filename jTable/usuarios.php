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
		$dao = new UsuariosDAO();
		
		//verifica se existe alguma condição extra		
		$sqlu = "";
		if(isset($_GET["nome"])and(!empty($_GET["nome"]))){
			$sqlu .= " and nome like '%".$_GET['nome']."%' COLLATE utf8_general_ci";
		}
		$sqlu .= " ORDER BY " . $_GET["jtSorting"] . " LIMIT ".$_GET['jtStartIndex'].",".$_GET['jtPageSize'];
		
				
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Records'] = $dao->listarArray($sqlu);
		$jTableResult['TotalRecordCount'] = count($dao->listarArray()); //retorna o total de registros
		print json_encode($jTableResult);
		
	}
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{
		$resultado = "OK";
		$mensagem = "";
		
		$dao = new UsuariosDAO();
		$vo = new UsuariosVO();
		
		if(($_POST['idtipousuario'] != 1) and ($tipo_usuario != 3)){
			$resultado = "ERROR";
			$mensagem = "Você não tem permissão para criar administradores.";
			
		}else{
			//Insert record into database
			$vo->setIdtipousuario($_POST['idtipousuario']);
			$vo->setUsuario($_POST['usuario']);
			$vo->setSenha($_POST['senha']);
			$vo->setNome($_POST['nome']);
			$vo->setEmail($_POST['email']);
			$vo->setAtivo("sim");
			$vo->setNovasenha("sim");
			$ultimoid = $dao->insert($vo);
		}
		
	
		//Get last inserted record (to return to jTable)
		
		$row = $dao->listarArray("and id = '".$ultimoid."'");
		
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
		$dao = new UsuariosDAO();
		$vo = new UsuariosVO();
		
		$vo->setId($_POST['id']);
		$vo->setIdtipousuario($_POST['idtipousuario']);
		$vo->setUsuario($_POST['usuario']);
		$vo->setSenha($_POST['senha']);
		$vo->setNome($_POST['nome']);
		$vo->setEmail($_POST['email']);
		$vo->setAtivo("sim");
		$vo->setNovasenha("sim");
		
		//Update record in database
		$resultado = "OK";
		$mensagem = "";
		
		if(($_POST['idtipousuario'] != 1) and ($tipo_usuario != 3)){
			$resultado = "ERROR";
			$mensagem = "Você não tem permissão para criar administradores.";
			
		}else{
			$dao->update($vo);
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
		$dao = new UsuariosDAO();
		//Delete from database
		$resultado = "OK";
		$mensagem = "";
		
		if($tipo_usuario == 1){
			$resultado = "ERROR";
			$mensagem = "Você não tem permissão para esta operação.";			
		}else{
			$dao->delete($_POST["id"]);
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
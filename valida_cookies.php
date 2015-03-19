<?php
session_start();
session_cache_expire(480);
include "conecta.php";
if(IsSet($_SESSION['nome_usuario']))
	{
		$nome_usuario = $_SESSION['nome_usuario'];
		
	}
if(IsSet($_SESSION['senha_usuario']))
	{
		$senha_usuario = $_SESSION['senha_usuario'];
		
	}
if(IsSet($_SESSION['tipo_usuario']))
	{
		$tipo_usuario = $_SESSION['tipo_usuario'];
		
	}
	
if(IsSet($_SESSION['id_usuario']))
	{
		$id_usuario = $_SESSION['id_usuario'];
		
	}
	
if(!(empty($nome_usuario) OR empty($senha_usuario)))
	{
		$sql = "select usuario, senha, idtipousuario, id from usuarios where usuario = '".$nome_usuario."'";
		
		$query = $mysqli->query($sql);
		$linhas = $query->num_rows;
		if($linhas != '0')
		{
			while ($registro = $query->fetch_array()) 
			{
				$senha = $registro[1];
				$idtipousuario = $registro[2];
				$idusuario = $registro[3];
			}
		}
				
		
		if($linhas==1)
			{
				if($senha_usuario != $senha)
					{
						unset($_SESSION['nome_usuario']);
						unset($_SESSION['senha_usuario']);
						unset($_SESSION['tipo_usuario']);
						unset($_SESSION['id_usuario']);
						echo "<script>alert(\"Você não efetuou o login!\"); location.href=\"index.php\";</script>";
					
						exit;
					}

			}
		else
			{
				unset($_SESSION['nome_usuario']);
				unset($_SESSION['senha_usuario']);
				unset($_SESSION['tipo_usuario']);
				unset($_SESSION['id_usuario']);
				echo "<script>alert(\"Você não efetuou o login 2!\"); location.href=\"index.php\";</script>";
				
				exit;
			}
	}
else {
	echo "<script>alert(\"Você não efetuou o login!\"); location.href=\"index.php\";</script>";
				
	exit;
}
?>
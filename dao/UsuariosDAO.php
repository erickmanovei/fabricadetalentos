<?php 
if(file_exists("vo/UsuariosVO.php")){
	include "vo/UsuariosVO.php";
}
if(file_exists("../vo/UsuariosVO.php")){
	include "../vo/UsuariosVO.php";
}


class UsuariosDAO{

	
	
	private function __clone(){}
	
	
	function listar($condicoes = ""){
	
		if(file_exists("conecta.php")){
			include "conecta.php";
		}
		if(file_exists("../conecta.php")){
			include "../conecta.php";
		}
		
		$sql = "select * from usuarios where ativo = 'sim' ".$condicoes;		
		$rs = $mysqli->query($sql);
		
		$listaUsuarios = array();
		
		if($rs->num_rows > 0){			
			while($row = $rs->fetch_array()){				
				
				$vo = new UsuariosVO();
				
				$vo->setId($row[0]);
				$vo->setIdtipousuario($row[1]);
				$vo->setUsuario($row[2]);
				$vo->setSenha($row[3]);
				$vo->setNome($row[4]);
				$vo->setEmail($row[5]);
				$vo->setAtivo($row[6]);
				$vo->setNovasenha($row[7]);
				
				$listaUsuarios[] = $vo;					
			}
		}
		
		//var_dump($listaUsuarios);
		return $listaUsuarios;
	}
	
	function listarArray($condicoes = ""){
	
		if(file_exists("conecta.php")){
			include "conecta.php";
		}
		if(file_exists("../conecta.php")){
			include "../conecta.php";
		}
		
		$sql = "select * from usuarios where ativo = 'sim' ".$condicoes;		
		$rs = $mysqli->query($sql);
		
		if($rs->num_rows > 0){			
			while($row = $rs->fetch_array()){				
				$listaUsuarios[] = $row;					
			}
		}
		return $listaUsuarios;
	}
	
	function getUsuarioById($id){
	
		if(file_exists("conecta.php")){
			include "conecta.php";
		}
		if(file_exists("../conecta.php")){
			include "../conecta.php";
		}
		
		$sql = "select * from usuarios where ativo = 'sim' and id = '".$id."'";		
		$rs = $mysqli->query($sql);
		
		
		if($rs->num_rows > 0){			
			while($row = $rs->fetch_array()){				
				
				$vo = new UsuariosVO();
				
				$vo->setId($row[0]);
				$vo->setIdtipousuario($row[1]);
				$vo->setUsuario($row[2]);
				$vo->setSenha($row[3]);
				$vo->setNome($row[4]);
				$vo->setEmail($row[5]);
				$vo->setAtivo($row[8]);
				$vo->setNovasenha($row[9]);
								
			}
		}
		
		//var_dump($listaUsuarios);
		return $vo;
	}
	
	function insert(UsuariosVO $vo){
	
		if(file_exists("conecta.php")){
			include "conecta.php";
		}
		if(file_exists("../conecta.php")){
			include "../conecta.php";
		}
		
		$stmt = $mysqli->prepare("INSERT INTO usuarios (idtipousuario, usuario, senha, nome, email,  ativo, novasenha) VALUES (?, ?, ?, ?, ?, ?, ?)");
		
		$idtipousuario = $vo->getIdtipousuario();
		$usuario = $vo->getUsuario();
		$senha = $vo->getSenha();
		$nome = $vo->getNome();
		$email = $vo->getEmail();
		$ativo = $vo->getAtivo();
		$novasenha = "sim";
		
		$stmt->bind_param("issssss", $idtipousuario, $usuario, $senha, $nome, $email, $ativo, $novasenha);
		
		if($stmt->execute()){			
			return $mysqli->insert_id;
		}else{			
			return 0;
		}	
				
	}
	
	function update(UsuariosVO $vo){
	
		if(file_exists("conecta.php")){
			include "conecta.php";
		}
		if(file_exists("../conecta.php")){
			include "../conecta.php";
		}
		
		$stmt = $mysqli->prepare("UPDATE usuarios set idtipousuario = ?, usuario = ?, senha = ?, nome = ?, email = ?, ativo = ?, novasenha = ? WHERE id = ?");
		
		$id = $vo->getId();
		$idtipousuario = $vo->getIdtipousuario();
		$usuario = $vo->getUsuario();
		$senha = $vo->getSenha();
		$nome = $vo->getNome();
		$email = $vo->getEmail();
		$ativo = $vo->getAtivo();
		$novasenha = $vo->getNovasenha();
		
		$stmt->bind_param("issssssi", $idtipousuario, $usuario, $senha, $nome, $email, $ativo, $novasenha, $id);
		
		if($stmt->execute()){			
			return true;
		}else{			
			return false;
		}	
				
	}
	
	function delete($id){
	
		if(file_exists("conecta.php")){
			include "conecta.php";
		}
		if(file_exists("../conecta.php")){
			include "../conecta.php";
		}
		
		$stmt = $mysqli->prepare("UPDATE usuarios set ativo = 'nao' WHERE id = ?");	
		
		$stmt->bind_param("i", $id);
		
		if($stmt->execute()){			
			return true;
		}else{			
			return false;
		}	
				
	}
	
	
	
	public function __destruct() { 
		foreach ($this as $key => $value) { 
			unset($this->$key); 
		}
	}
	
	


}
?>
     
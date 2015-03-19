<?php 

include "vo/ConfiguracoesVO.php";


class ConfiguracoesDAO{

	
	
	private function __clone(){}
	
	
	function listar($condicoes = ""){
	
		include "conecta.php";
		
		$sql = "select * from configuracoes ".$condicoes;		
		$rs = $mysqli->query($sql);
		$listaConfiguracoes = array();
		
		if($rs->num_rows > 0){			
			while($row = $rs->fetch_array()){				
				
				$vo = new ConfiguracoesVO();
				
				$vo->setId($row[0]);
				$vo->setNome($row[1]);
				$vo->setDescricao($row[2]);
				$vo->setRemetente($row[3]);
				$vo->setEmail($row[4]);
				$vo->setSenha($row[5]);
				$vo->setSmtp($row[6]);
				$vo->setPorta($row[7]);
				
				$listaConfiguracoes[] = $vo;					
			}
		}
		
		return $listaConfiguracoes;
	}
	
	function getConfiguracoesByName($nome){
	
		include "conecta.php";
		
		$sql = "select * from configuracoes where nome = '".$nome."'";		
		$rs = $mysqli->query($sql);
		$rows = array();
		
		$vo = new ConfiguracoesVO();
		
		
		if($rs->num_rows > 0){
			while($row = $rs->fetch_array()){
				
				$vo->setId($row[0]);
				$vo->setNome($row[1]);
				$vo->setDescricao($row[2]);
				$vo->setRemetente($row[3]);
				$vo->setEmail($row[4]);
				$vo->setSenha($row[5]);
				$vo->setSmtp($row[6]);
				$vo->setPorta($row[7]);
				
			}			
		}
		return $vo;
	}
	
	
	
	function insert(ConfiguracoesVO $vo){
	
		include "conecta.php";
		
		$stmt = $mysqli->prepare("INSERT INTO configuracoes (nome, descricao, remetente, email, senha, smtp, porta) VALUES (?, ?, ?, ?, ?, ?, ?)");
		
		$nome = $vo->getNome();
		$descricao = $vo->getDescricao();
		$remetente = $vo->getRemetente();
		$email = $vo->getEmail();
		$senha = $vo->getSenha();
		$smtp = $vo->getSmtp();
		$porta = $vo->getPorta();
		
		$stmt->bind_param("ssssssi", $nome, $descricao, $remetente, $email, $senha, $smtp, $porta);
		
		if($stmt->execute()){			
			return $mysqli->insert_id;
		}else{			
			return 0;
		}	
				
	}
	
	function update(ConfiguracoesVO $vo){
	
		include "conecta.php";
		
		$stmt = $mysqli->prepare("UPDATE configuracoes set nome = ?, descricao = ?, remetente = ?, email = ?, senha = ?, smtp = ?, porta = ? WHERE id = ?");
		
		$nome = $vo->getNome();
		$descricao = $vo->getDescricao();
		$remetente = $vo->getRemetente();
		$email = $vo->getEmail();
		$senha = $vo->getSenha();
		$smtp = $vo->getSmtp();
		$porta = $vo->getPorta();
		$id = $vo->getId();
		
		$stmt->bind_param("ssssssii", $nome, $descricao, $remetente, $email, $senha, $smtp, $porta, $id);
		
		if($stmt->execute()){			
			return true;
		}else{			
			return false;
		}	
				
	}
	
	function delete($id){
	
		include "conecta.php";
		
		
				
	}
	
	
	public function __destruct() { 
		foreach ($this as $key => $value) { 
			unset($this->$key); 
		}
	}


}
?>
     
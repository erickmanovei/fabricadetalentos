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
				$vo->setSetor($row[6]);
				$vo->setSubordinadode($row[7]);
				$vo->setAtivo($row[8]);
				$vo->setNovasenha($row[9]);
								
			}
		}
		
		//var_dump($listaUsuarios);
		return $vo;
	}
	
	function insert(UsuariosVO $vo){
	
		include "conecta.php";
		
		$stmt = $mysqli->prepare("INSERT INTO usuarios (idtipousuario, usuario, senha, nome, email, setor, subordinadode, ativo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		
		$idtipousuario = $vo->getIdtipousuario();
		$usuario = $vo->getUsuario();
		$senha = $vo->getSenha();
		$nome = $vo->getNome();
		$email = $vo->getEmail();
		$setor = $vo->getSetor();
		$subordinadode = $vo->getSubordinadode();
		$ativo = $vo->getAtivo();
		
		$stmt->bind_param("issssiiss", $idtipousuario, $usuario, $senha, $nome, $email, $setor, $subordinadode, $ativo, "sim");
		
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
		
		$stmt = $mysqli->prepare("UPDATE usuarios set idtipousuario = ?, usuario = ?, senha = ?, nome = ?, email = ?, setor = ?, subordinadode = ?, ativo = ?, novasenha = ? WHERE id = ?");
		
		$id = $vo->getId();
		$idtipousuario = $vo->getIdtipousuario();
		$usuario = $vo->getUsuario();
		$senha = $vo->getSenha();
		$nome = $vo->getNome();
		$email = $vo->getEmail();
		$setor = $vo->getSetor();
		$subordinadode = $vo->getSubordinadode();
		$ativo = $vo->getAtivo();
		$novasenha = $vo->getNovasenha();
		
		$stmt->bind_param("issssiissi", $idtipousuario, $usuario, $senha, $nome, $email, $setor, $subordinadode, $ativo, $novasenha, $id);
		
		if($stmt->execute()){			
			return true;
		}else{			
			return false;
		}	
				
	}
	
	function delete($id){
	
		include "conecta.php";
		
		$stmt = $mysqli->prepare("UPDATE usuarios set ativo = 'nao' WHERE id = ?");	
		
		$stmt->bind_param("i", $id);
		
		if($stmt->execute()){			
			return true;
		}else{			
			return false;
		}	
				
	}
	
	
	function listarSubordinados($idcoordenador){
	
		include "conecta.php";
		
		$sql = "select * from usuarios where subordinadode = '".$idcoordenador."'";		
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
				$vo->setSetor($row[6]);
				$vo->setSubordinadode($row[7]);
				$vo->setAtivo($row[8]);
				$vo->setNovasenha($row[9]);
				
				$listaUsuarios[] = $vo;					
			}
		}
		
		//var_dump($listaUsuarios);
		return $listaUsuarios;
	}
	
	function listarSubordinadosAvaliacoes($idcoordenador, $idevento, $avaliado){
	
		include "conecta.php";
		
		if($avaliado == 'sim'){
			$and = "in";
		}else{
			$and = "not in";
		}	
		
		$sql = "select * from usuarios where subordinadode = '".$idcoordenador."' and id ".$and." (select idavaliado from avaliacoes where idavaliador = '".$idcoordenador."' and idevento = '".$idevento."')";
		
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
				$vo->setSetor($row[6]);
				$vo->setSubordinadode($row[7]);
				$vo->setAtivo($row[8]);
				$vo->setNovasenha($row[9]);
				
				$listaUsuarios[] = $vo;					
			}
		}
		
		//var_dump($listaUsuarios);
		return $listaUsuarios;
	}
	
	function listarAvaliacoes($idevento, $idtipoavaliacao){
	
		include "conecta.php";
		
				
		$sql = "select * from usuarios where id in (select idavaliado from avaliacoes where idevento = '".$idevento."' and idtipoavaliacao = '".$idtipoavaliacao."') order by nome";
		
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
				$vo->setSetor($row[6]);
				$vo->setSubordinadode($row[7]);
				$vo->setAtivo($row[8]);
				$vo->setNovasenha($row[9]);
				
				$listaUsuarios[] = $vo;					
			}
		}
		
		//var_dump($listaUsuarios);
		return $listaUsuarios;
	}
	
	
	function fezAutoAvaliacao($idusuario, $idevento){
	
		include "conecta.php";
		
				
		$sql = "select * from usuarios where id = '".$idusuario."' and id in (select idavaliador from avaliacoes where idavaliador = '".$idusuario."' and idavaliado = '".$idusuario."' and idevento = '".$idevento."' and idtipoavaliacao = '3')";
		
		$rs = $mysqli->query($sql);
		
		if($rs->num_rows > 0){
			return true;
		}else{
			return false;
		}
		
	}
	
	
	function fezAvaliacao($idavaliador, $idsubordinado, $idevento){
	
		include "conecta.php";
			
			$usuariodao = new UsuariosDAO();
			$avaliador = new UsuariosVO();
			$avaliador = $usuariodao->getUsuarioById($idavaliador);
			$subordinado = new UsuariosVO();
			$subordinado = $usuariodao->getUsuarioById($idsubordinado);
		
			
			//verifica se já foi feita a avaliação
			$sql = "select * from avaliacoes where idavaliador = '".$avaliador->getId()."' and idavaliado = '".$subordinado->getId()."' and idevento = '".$idevento."' and idtipoavaliacao = '1'";
			
			$rs = $mysqli->query($sql);					
			if($rs->num_rows > 0){
				return true;
			}else{
				return false;
			}					
					
	}
	
	function fezAvaliacao360($idavaliador, $idavaliado, $idevento){
	
		include "conecta.php";
			
			$usuariodao = new UsuariosDAO();
			$avaliador = new UsuariosVO();
			$avaliador = $usuariodao->getUsuarioById($idavaliador);
			$avaliado = new UsuariosVO();
			$avaliado = $usuariodao->getUsuarioById($idavaliado);
		
			
			//verifica se já foi feita a avaliação
			$sql = "select * from avaliacoes where idavaliador = '".$avaliador->getId()."' and idavaliado = '".$avaliado->getId()."' and idevento = '".$idevento."' and idtipoavaliacao = '2'";
			
			$rs = $mysqli->query($sql);					
			if($rs->num_rows > 0){
				return true;
			}else{
				return false;
			}					
					
	}
	
	
	function verificaCoordenacao($idcoordenador, $idsubordinado){
	
		include "conecta.php";
			
			$usuariodao = new UsuariosDAO();
			$coordenador = new UsuariosVO();
			$coordenador = $usuariodao->getUsuarioById($idcoordenador);
			$subordinado = new UsuariosVO();
			$subordinado = $usuariodao->getUsuarioById($idsubordinado);
		
			//verifica se é o coordenador desse subordinado
				if($coordenador->getId() != $subordinado->getSubordinadode()){
					return false;
				}else{
					return true;					
				}		
	}
	
	
	function verificaSuperior($idusuario, $idsuperior){
	
		include "conecta.php";
			
			$usuariodao = new UsuariosDAO();
			$usuario = new UsuariosVO();
			$usuario = $usuariodao->getUsuarioById($idusuario);
			$superior = new UsuariosVO();
			$superior = $usuariodao->getUsuarioById($idsuperior);
		
			//verifica se é o coordenador desse subordinado
				if($usuario->getSubordinadode() != $superior->getId()){
					return false;
				}else{
					return true;					
				}		
	}
	
	
	
	function temSubordinados($idcoordenador){
	
		include "conecta.php";
		
		$sql = "select * from usuarios where subordinadode = '".$idcoordenador."'";		
		$rs = $mysqli->query($sql);
		
		if($rs->num_rows >0){
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
     
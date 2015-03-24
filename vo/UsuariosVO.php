<?php 


class UsuariosVO{
	
	private $id;
	private $idtipousuario;
	private $usuario;
	private $senha;
	private $nome;
	private $email;
	private $setor;
	private $novasenha;
	
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	
	public function getIdtipousuario(){
		return $this->idtipousuario;
	}
	public function setIdtipousuario($idtipousuario){
		$this->idtipousuario = $idtipousuario;
	}
	
	public function getUsuario(){
		return $this->usuario;
	}
	function setUsuario($usuario){
		$this->usuario = $usuario;
	}
	
	public function getSenha(){
		return $this->senha;
	}
	public function setSenha($senha){
		$this->senha = $senha;
	}
	
	public function getNome(){
		return $this->nome;
	}
	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function getEmail(){
		return $this->email;
	}
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function getAtivo(){
		return $this->ativo;
	}
	public function setAtivo($ativo){
		$this->ativo = $ativo;
	}
	
	public function getNovasenha(){
		return $this->novasenha;
	}
	public function setNovasenha($novasenha){
		$this->novasenha = $novasenha;
	}
}
?>
     
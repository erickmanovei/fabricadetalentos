<?php 


class ConfiguracoesVO{
	
	private $id;
	private $nome;
	private $descricao;
	private $remetente;
	private $email;
	private $senha;
	private $smtp;
	private $porta;
	
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	
	public function getNome(){
		return $this->nome;
	}
	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function getDescricao(){
		return $this->descricao;
	}
	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}
	
	public function getRemetente(){
		return $this->remetente;
	}
	public function setRemetente($remetente){
		$this->remetente = $remetente;
	}
	
	public function getEmail(){
		return $this->email;
	}
	public function setEmail($email){
		$this->email = $email;
	}	
	
	public function getSenha(){
		return $this->senha;
	}
	public function setSenha($senha){
		$this->senha = $senha;
	}
	
	public function getSmtp(){
		return $this->smtp;
	}
	public function setSmtp($smtp){
		$this->smtp = $smtp;
	}
	
	public function getPorta(){
		return $this->porta;
	}
	public function setPorta($porta){
		$this->porta = $porta;
	}
}
?>
     
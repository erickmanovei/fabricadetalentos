<?php

function ValidaData($dat){
	$data = explode("-","$dat"); // fatia a string $dat em pedados, usando / como referência
	$y = $data[0];
	$m = $data[1];
	$d = $data[2];
 
	// verifica se a data é válida!
	// 1 = true (válida)
	// 0 = false (inválida)
	$res = checkdate($m,$d,$y);
	if ($res == 1){
	   return $y."-".$m."-".$d;
	} else {
		$d--;
		return ValidaData($y."-".$m."-".$d);
	}
}
function mostraData($data){
	$ano = $data[0].$data[1].$data[2].$data[3];
	$mes = $data[5].$data[6];
	$dia = $data[8].$data[9];
	return $dia."/".$mes."/".$ano;
}


function mostraDataHora($data){
	$ano = $data[0].$data[1].$data[2].$data[3];
	$mes = $data[5].$data[6];
	$dia = $data[8].$data[9];
	$hora = $data[11].$data[12].$data[13].$data[14].$data[15].$data[16].$data[17].$data[18];
	return $dia."/".$mes."/".$ano." ".$hora;
}

function gravaData($data){
	$ano = $data[6].$data[7].$data[8].$data[9];
	$mes = $data[3].$data[4];
	$dia = $data[0].$data[1];
	return ValidaData($ano."-".$mes."-".$dia);
}

function realparafloat($valor){
	$valor = str_replace(".", "", $valor);	
	$valor = str_replace(",", ".", $valor);	
	return $valor;
}
function floatparareal($valor){
	$valor = number_format($valor, 2, ',', '.');
	return $valor;
}


function mesEscrito($mes){
	switch($mes){
		case 1:
		return "Janeiro";
		break;	
		case 2:
		return "Fevereiro";
		break;
		case 3:
		return "Março";
		break;
		case 4:
		return "Abril";
		break;
		case 5:
		return "Maio";
		break;
		case 6:
		return "Junho";
		break;
		case 7:
		return "Julho";
		break;
		case 8:
		return "Agosto";
		break;
		case 9:
		return "Setembro";
		break;
		case 10:
		return "Outubro";
		break;
		case 11:
		return "Novembro";
		break;
		case 12:
		return "Dezembro";
		break;
	}
}

function enviarEmail($iddestinatario, $assunto, $mensagem){
	//inicia envio do email
	require("phpmailer/class.phpmailer.php"); // ADICIONA O SCRIPT DE ENVIO DE E-MAILS
	
	//pega configurações de e-mail
	if(file_exists("dao/ConfiguracoesDAO.php")){
		include "dao/ConfiguracoesDAO.php";
	}
	if(file_exists("../dao/ConfiguracoesDAO.php")){
		include "../dao/ConfiguracoesDAO.php";
	}
	
	$confdao = new ConfiguracoesDAO();
	$conf = new ConfiguracoesVO();
	$conf = $confdao->getConfiguracoesByName("email");
	
	$usuario = new UsuariosVO();
	$usuariodao = new UsuariosDAO();
	$usuario = $usuariodao->getUsuarioById($iddestinatario);
	
	// O BLOCO ABAIXO INICIALIZA O ENVIO
	$para = $usuario->getEmail();
	$nomen = utf8_decode($usuario->getNome());
	$mail = new PHPMailer(); // INICIA A CLASSE PHPMAILER
	$mail->IsSMTP(); //ESSA OPÇÃO HABILITA O ENVIO DE SMTP
	
	
	$mail->Host = $conf->getSmtp(); //SERVIDOR DE SMTP, USE smtp.SeuDominio.com OU smtp.hostsys.com.br 
	$mail->SMTPAuth = true; //ATIVA O SMTP AUTENTICADO
	$mail->Username = $conf->getEmail(); //EMAIL PARA SMTP AUTENTICADO (pode ser qualquer conta de email do seu domínio)
	$mail->Password = $conf->getSenha(); //SENHA DO EMAIL PARA SMTP AUTENTICADO
	$mail->From = $conf->getEmail(); //E-MAIL DO REMETENTE 
	$mail->FromName = utf8_decode($conf->getRemetente()); //NOME DO REMETENTE
	$mail->AddAddress($para,$nomen); //E-MAIL DO DESINATÁRIO, NOME DO DESINATÁRIO --> AS VARIÁVEIS ALI PODEM FAZER REFERÊNCIA A DADOS VINDO DE $_GET OU $_POST, OU AINDA DO BANCO DE DADOS
	$mail->WordWrap = 50; // ATIVAR QUEBRA DE LINHA
	$mail->IsHTML(true); //ATIVA MENSAGEM NO FORMATO HTML
	$assunto = utf8_decode($assunto);
	$mail->Subject = $assunto; //ASSUNTO DA MENSAGEM
	$mensagem = utf8_decode($mensagem);
	$mail->Port = $conf->getPorta();
	
	$mail->Body = $mensagem; //MENSAGEM NO FORMATO HTML, PODE SER TEXTO OU IMAGEM
	
	
	// verifica se está tudo ok com oa parametros acima, se nao, avisa do erro. Se sim, envia.
	if(!$mail->Send())   { 
	return false;
	}
	else{
	return true;
	}
	//ate aqui
}

function peso($nota){
	if($nota >= 1 and $nota <= 4){
		return 0;	
	}
	elseif($nota >= 5 and $nota <= 6){
		return 0.33;
	}
	elseif($nota >= 7 and $nota <= 8){
		return 0.66;	
	}
	elseif($nota >= 9){
		return 1;	
	}
	
}

?>
<?php
include "conecta.php";
include "dao/UsuariosDAO.php";
include "fc/funcoesphp.php";

if(isset($_POST["usuario"]) and !empty($_POST["usuario"])){
	$nomeusuario = addslashes($_POST["usuario"]);	
	$usuariodao = new UsuariosDAO();
	$usuario = $usuariodao->listar("and usuario = '".$nomeusuario."'");
	
	if(count($usuario) == 0){
		echo '<script type="text/javascript">alert("Usuário Inexistente");</script>';
	}else{
		$senhanova = substr(md5(date('Hms')), 1, 8);
		$usuario[0]->setSenha($senhanova);
		$usuario[0]->setNovasenha('sim');
		$usuariodao->update($usuario[0]);
		$retorno = enviarEmail($usuario[0]->getId(), "Recuperação de Senha - Avaliação de Desempenho", 
		"Prezado(a) Senhor(a) ".$usuario[0]->getNome().",
		<br><br>
		Sua senha de acesso ao Sistema de Avaliação de Desempenho é: <b>".$usuario[0]->getSenha()."</b>");
		
		if($retorno){
			echo '<script type="text/javascript">alert("Uma nova senha foi enviada para seu e-mail. Verifique a Caixa de Entrada, SPAM ou Lixo eletrônico."); location.href="index.php";</script>';	
		}else{
			echo '<script type="text/javascript">alert("Erro ao enviar e-mail. Consulte o administrador do sistema.");</script>';	
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/icon.png">

    <title>Sistema de Avaliação de Desempenho</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<p align="center">
				<img src="img/webcon.png" border="0" width="200">
			</p>			
		</div>
	</div>
	
    <div class="container">	
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Informe seu Usuário</h3>
                    </div>
                    <div class="panel-body">					
						
                        <form role="form" action="esqueciminhasenha.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuário" name="usuario" type="text" autofocus>
                                </div>
                                
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block" type="submit">Recuperar Senha</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>

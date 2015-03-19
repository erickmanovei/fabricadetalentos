<?php
header("Content-Type: text/html; charset=UTF-8", true);
include ("conecta.php");
$usuario = addslashes($_POST["usuario"]);
$senha = addslashes($_POST["senha"]);

//verifica se o usuário está bloqueado
$sqlb = "select max(data) from bloqueios where usuario = '".$usuario."'";
$rsb = $mysqli->query($sqlb);
if($rsb->num_rows > 0){
	$data1 = $rsb->fetch_array();
	$data2 = date('Y-m-d H:i:s');
	$diferenca = (strtotime($data2) - strtotime($data1[0]))/60; 
	if($diferenca < 10){
		echo "<script>alert(\"Usuário Bloqueado! Aguarde 30 minutos para tentar novamente\"); location.href=\"index.php\";</script>";
		exit;
	}
}


$sql = "select usuario, senha, idtipousuario, id from usuarios where usuario = '".$usuario."'";
$query = $mysqli->query($sql);
$linhas = $query->num_rows;


while ($registro = $query->fetch_array()) 
{	  
	  $senhaBanco = $registro[1];
	  $idtipousuario = $registro[2];
	  $idusuario = $registro[3];
}


if($linhas==0)
{
	echo "<script>alert(\"Usuário ou senha incorreta!\"); location.href=\"index.php\";</script>";
}
else
{
	if($senha != $senhaBanco)
	{
		session_start();
		if(isset($_SESSION['atavbl'])){
			$_SESSION['atavbl'] += 1;
			
			if($_SESSION['atavbl'] >= 3){
				$sqls = "insert into bloqueios(usuario, data) values('".$usuario."', '".date('Y-m-d H:i:s')."')";
				$mysqli->query($sqls);
			}
		}else{
			$_SESSION['atavbl'] = 1;
		}
		$tentativas = 3 - $_SESSION['atavbl'];		
		echo "<script>alert(\"Usuário ou senha incorreta! Você tem mais ".$tentativas." tentativas.\"); location.href=\"index.php\";</script>";
	}
	else
	{
		//mostra tela de redefinição de senha se ainda não tiver redefinido
		include "dao/UsuariosDAO.php";
		$usuariodao = new UsuariosDAO();
		$usuvo = new UsuariosVO();
		$usuvo = $usuariodao->listar("and usuario = '".$usuario."' and senha = '".$senha."'");
		
		if($usuvo[0]->getNovasenha() == 'sim'){
			if(isset($_POST["novasenha"])){
				$novasenha = $_POST["novasenha"];
				$usuvo[0]->setSenha($novasenha);
				$usuvo[0]->setNovasenha('nao');
				$usuariodao->update($usuvo[0]);
					session_start();
					$_SESSION['nome_usuario'] = $usuario;
					$_SESSION['senha_usuario'] = $usuvo[0]->getSenha();;
					$_SESSION['tipo_usuario'] = $idtipousuario;
					$_SESSION['id_usuario'] = $idusuario;
					header("Location: inicio.php");
				
			}else{
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
	
    <script type="text/jscript">
		function verificaSenha(){
			if(document.getElementById('novasenha').value == ""){
				alert("Preencha com uma senha");	
				return false;	
			}else{
				if(document.getElementById('novasenha').value == document.getElementById('repnovasenha').value){
					//form1.submit();
				}else{
					alert("As senhas não correspondem");	
					return false;			
				}	
			}
		}
	</script>

</head>

<body>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<p align="center">
				<img src="img/avaliacao.png" border="0" width="200">
			</p>			
		</div>
	</div>
	
    <div class="container">	
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Redefina Sua Senha</h3>
                    </div>
                    <div class="panel-body">					
						
                        <form role="form" name="form1" action="login.php" method="post" onSubmit="javascript: return verificaSenha();">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Nova Senha" name="novasenha" id="novasenha" type="password" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Repita Nova Senha" name="repnovasenha" id="repnovasenha" type="password" value="">
                                </div>
                                <?php
									$usuario = addslashes($_POST["usuario"]);
									$senhaantiga = addslashes($_POST["senha"]);
								?>
								<input name="usuario" type="hidden" value="<?php echo $usuario; ?>">
                                <input name="senha" type="hidden" value="<?php echo $senhaantiga; ?>">
                                
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>
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

                
                <?php	
			}
			
		}else{		
			session_start();
			$_SESSION['nome_usuario'] = $usuario;
			$_SESSION['senha_usuario'] = $senha;
			$_SESSION['tipo_usuario'] = $idtipousuario;
			$_SESSION['id_usuario'] = $idusuario;
			header("Location: inicio.php");
		}
	}
}
	

?>


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
						
                        <form role="form" name="form1" action="redefinirsenha.php" method="post" onSubmit="javascript: return verificaSenha();">
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

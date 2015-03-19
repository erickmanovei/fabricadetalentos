<?php include "valida_cookies.php"; ?>
<?php include "header.php"; ?>
<?php include "menu.php"; ?>
<?php
include "dao/ConfiguracoesDAO.php";
$confdao = new ConfiguracoesDAO();
$conf = new ConfiguracoesVO();
$conf = $confdao->getConfiguracoesByName("email");

if(isset($_POST["remetente"])){
	$conf->setRemetente(addslashes($_POST["remetente"]));
	$conf->setEmail(addslashes($_POST["email"]));
	$conf->setSenha(addslashes($_POST["senha"]));
	$conf->setSmtp(addslashes($_POST["smtp"]));
	$conf->setPorta(addslashes($_POST["porta"]));
	
	if($confdao->update($conf)){
		echo '<script type="text/javascript">alert("Alteração Realizada"); </script>';
	}
	
}

?>

            
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Configurações</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                    	<div class="panel-body">
                              <form name="form1" action="configuracoes.php" method="post">
                                <div class="form-group">
                                    <label>Nome do Remetente dos E-mails</label>
                                    <input type="text" name="remetente" value="<?php echo $conf->getRemetente(); ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="text" name="email" value="<?php echo $conf->getEmail(); ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Senha do E-mail</label>
                                    <input type="password" name="senha" value="<?php echo $conf->getSenha(); ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>SMTP do E-mail</label>
                                    <input type="text" name="smtp" value="<?php echo $conf->getSmtp(); ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Porta do SMTP</label>
                                    <input type="text" name="porta" value="<?php echo $conf->getPorta(); ?>" class="form-control">
                                    <p class="help-block">A porta padrão é a 587</p>
                                </div>
                                <button type="submit" class="btn btn-outline btn-primary btn-lg btn-block">Gravar</button>
                                
                              
                              </form> 
                          </div>                   
                      
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
        </div>
        <!-- /#page-wrapper -->
		
	</div>
    <!-- /#wrapper -->

    

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	

<?php include "footer.php"; ?>

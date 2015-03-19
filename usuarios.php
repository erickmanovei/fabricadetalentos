<?php include "valida_cookies.php"; ?>
<?php include "header.php"; ?>
<?php include "menu.php"; 

if($tipo_usuario == 1){ echo '<script type="text/javascript">alert("Acesso não permitido."); </script>'; exit; }

$busca = ""; 
if(isset($_POST["nome"])){
	$busca = "&nome=".addslashes($_POST["nome"]);
}
?>


            
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Usuários</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        
                        <!-- aqui começam os usuarios -->
						<div class="filtering" style="background-color:#CCC">
							<form method="post" action="usuarios.php">
									<div class="input-group custom-search-form">
										<input type="text" name="nome" class="form-control" placeholder="Buscar Usuário">
										<span class="input-group-btn">
										<button class="btn btn-default" type="submit">
											<i class="fa fa-search"></i>
										</button>
										</span>
									</div>
										
							</form>
						</div>
                              <div id="usuarios" style="width: 100%;"></div>
								<script type="text/javascript">
                            
                                    $(document).ready(function () {
                            
                                        //Prepare jTable
                                        $('#usuarios').jtable({
                                            title: 'Tabela de Usuários',
											paging: true,
											pageSize: 10, //Set page size (default: 10)
											sorting: true, //Enable sorting
           									defaultSorting: 'nome ASC', //Set default sorting
											selecting: true,
                                            actions: {
                                                listAction: 'jTable/usuarios.php?action=list<?php echo $busca; ?>',
                                                createAction: 'jTable/usuarios.php?action=create',
                                                updateAction: 'jTable/usuarios.php?action=update',
                                                deleteAction: 'jTable/usuarios.php?action=delete'
                                            },
											messages: {
												serverCommunicationError: 'Ocorreu um erro ao comunicar com o servidor.',
												loadingMessage: 'Carregando dados...',
												noDataAvailable: 'Sem dados gravados!',
												addNewRecord: 'Adicionar',
												editRecord: 'Editar',
												areYouSure: 'Você tem certeza?',
												deleteConfirmation: 'Essa informação será deletada. Você tem certeza?',
												save: 'Salvar',
												saving: 'Salvando',
												cancel: 'Cancelar',
												deleteText: 'Excluir',
												deleting: 'Excluindo',
												error: 'Erro',
												close: 'Fechar',
												cannotLoadOptionsFor: 'Não foi possível carregar',
												pagingInfo: 'Mostrando {0}-{1} de {2}',
												pageSizeChangeLabel: 'Quantidade de Linhas',
												gotoPageLabel: 'Ir para a página',
												canNotDeletedRecords: 'Não foi deletado {0} de {1} informações!',
												deleteProggress: 'Deletado {0} de {1} informações, processando...'

											},
                                            fields: {
                                                id: {
                                                    key: true,
                                                    create: false,
                                                    edit: false,
                                                    list: false
                                                },
												
												idtipousuario: {
                                                    title: 'Tipo de Usuário',
													list: true,
													options: 'jTable/listatipousuario.php'												
                                                },
												
                                                nome: {
                                                    title: 'Nome'													
                                                },
												email: {
                                                    title: 'E-mail'													
                                                },
												usuario: {
                                                    title: 'Usuário',
													edit: false,
													input: function (data) {
														if (data.record) {
																return '<input type="text" name="usuario" id="usuario" value="' + data.record.usuario + '" />';
														}else{
															return '<input type="text" name="usuario" id="usuario" value="" />';
														}
													}
                                                },
												senha: {
													list: false,
													edit: false,
													type: 'password',
                                                    title: 'Senha',
													input: function (data) {
														if (data.record) {
															return '<input type="password" name="senha" id="senha" value="' + data.record.senha + '" />';
														}else{
															return '<input type="password" name="senha" id="senha" value="" />';
														}
													}													
                                                },
												repsenha: {
													list: false,
													edit: false,
													type: 'password',
                                                    title: 'Repita a Senha'	,
													input: function (data) {
														if (data.record) {
															return '<input type="password" name="repsenha" id="repsenha" value="' + data.record.senha + '" />';
														}else{
															return '<input type="password" name="repsenha" id="repsenha" value="" />';
														}
													}													
                                                }
												
                                            },
											 //Initialize validation logic when a form is created
											formCreated: function (event, data) {
												data.form.find('input[name="nome"]').addClass('validate[required]');
												data.form.find('input[name="email"]').addClass('validate[required,custom[email]]');
												data.form.find('input[name="usuario"]').addClass('validate[required,funcCall[validaUsuario]]');
												data.form.find('input[name="repsenha"]').addClass('validate[required,equals[senha]]');
												data.form.validationEngine();
											},
											//Validate form when it is being submitted
											formSubmitting: function (event, data) {
												return data.form.validationEngine('validate');
											},
											//Dispose validation logic when form is closed
											formClosed: function (event, data) {
												data.form.validationEngine('hide');
												data.form.validationEngine('detach');
											}

                                        });
                            
                                        //Load person list from server
                                        $('#usuarios').jtable('load');
										
                           
                                    });
									
									
									function validaUsuario(field, rules, i, options){	
										var response;
										$.ajax({
											
											url: "fc/ajax.php?funcao=validaUsuario&usuario=" + field.val(),
											async: false,
											type : "get",
											success: function(data){
												response = data;												
											}
										});
										
										if(response == 'true'){
											return "Usuário já existe. Favor escolher outro.";
										}
										
									}
                            
                                </script>
                              
                              <!-- receitas até aqui -->
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

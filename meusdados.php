<?php include "valida_cookies.php"; ?>
<?php include "header.php"; ?>
<?php include "menu.php"; ?>
            
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Meus Dados</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        
                        <!-- aqui começam os meusdados -->
						
                              <div id="meusdados" style="width: 100%;"></div>
								<script type="text/javascript">
                            
                                    $(document).ready(function () {
                            
                                        //Prepare jTable
                                        $('#meusdados').jtable({
                                            title: 'Meus Dados',
											
                                            actions: {
                                                listAction: 'jTable/meusdados.php?action=list',
                                                updateAction: 'jTable/meusdados.php?action=update'                                                
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
													create: false,
                                                    edit: false,
													options: 'jTable/listatipousuario.php'												
                                                },
												
                                                nome: {
                                                    title: 'Nome',
													list: true,
													create: false,
                                                    edit: false,													
                                                },
												email: {
                                                    title: 'E-mail'													
                                                },
												usuario: {
                                                    title: 'Usuário',
													list: true,
													create: false,
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
												data.form.find('input[name="usuario"]').addClass('validate[required]');
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
                                        $('#meusdados').jtable('load');
										
                           
                                    });
                            
                                </script>
                              
                              <!-- receitas até aqui -->
                              <div class="form-group">
                                  <form>
                                        <div id="queue"></div>
                                        <input id="file_upload" name="file_upload" type="file" multiple="true">
                                    </form>
                                
                                    <script type="text/javascript">
                                        <?php $timestamp = time();?>
                                        $(function() {
                                            $('#file_upload').uploadify({
                                                'formData'     : {
                                                    'timestamp' : '<?php echo $timestamp;?>',
                                                    'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
                                                },
                                                'swf'      : 'fotos/up/uploadify.swf',
                                                'uploader' : 'fotos/up/uploadify.php?id=<?php echo $id_usuario; ?>',
                                                'auto'     : true,
												'buttonText' : 'Alterar Foto',
                                                'fileSizeLimit' : '1000KB',
                                                'fileTypeExts' : '*.jpg',
                                                'multi'    : false
                                            });
										});
                                        
                                    </script>
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

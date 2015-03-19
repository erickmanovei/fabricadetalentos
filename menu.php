            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form" align="center">
                                <!-- <input type="text" class="form-control" placeholder="Buscar...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span> -->
                            <?php
								if(file_exists("fotos/".$id_usuario.".jpg")){
									echo '<img width="100%" style="border-radius: 20px" src="fotos/'.$id_usuario.'.jpg" border="0" />';
								}else{
									echo '<img width="100%" style="border-radius: 20px" src="fotos/semfoto.jpg" border="0" />';	
								}
							?>                            
                                  
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a class="active" href="inicio.php"><i class="fa fa-dashboard fa-fw"></i> Início</a>
                        </li>
                        <?php
						if($tipo_usuario == 2 or $tipo_usuario == 3){
						?>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Cadastros<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li>
                                    <a href="usuarios.php">Usuários</a>
                                </li>
								<li>
                                    <a href="tiposusuario.php">Tipos de Usuário</a>
                                </li>
								
                                
								
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <?php } ?>
                        
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

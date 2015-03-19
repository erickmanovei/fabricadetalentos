<?php include "valida_cookies.php"; ?>
<?php include "header.php"; ?>
<?php include "menu.php"; ?>

<?php

include "dao/UsuariosDAO.php";
include "fc/funcoesphp.php";

$usuariosdao = new UsuariosDAO();



?>
            
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Cursos Inscritos</h1>
                </div>
				
                <!-- /.col-lg-12 -->
            </div>
			
        </div>
        <!-- /#page-wrapper -->
		
	</div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    
	 <!-- Flot Charts JavaScript -->
    <script src="js/plugins/flot/excanvas.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    

	

	
	

<?php include "footer.php"; ?>

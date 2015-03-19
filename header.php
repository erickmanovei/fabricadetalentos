<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
	<link rel="shortcut icon" href="img/icon.png">
    <meta name="author" content="">

    <title>Fábrica de Talentos - Sistema de Ensino à Distância</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/plugins/timeline.css" rel="stylesheet">
	
	<!-- DataTables CSS -->
    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	
    
    <script src="js/funcoes.js"></script>
	
	
	
	<!-- Include one of jTable styles. -->
	<link href="jTable/themes/lightcolor/gray/jtable.min.css" rel="stylesheet" type="text/css" />	
	<link href="jTable/jquery-ui-1.11.2/jquery-ui.css" rel="stylesheet" type="text/css" />
	 
	<!-- Include jTable script file. -->
	<script src="jTable/jquery-2.1.1.min.js" type="text/javascript"></script>
	<script src="jTable/jquery-ui-1.11.2/jquery-ui.js" type="text/javascript"></script>
	<script src="jTable/jquery.jtable.min.js" type="text/javascript"></script>
	
	<!-- Include validation engine script file. -->
	<link href="jTable/validationengine/css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="jTable/validationengine/js/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="jTable/validationengine/js/languages/jquery.validationEngine-pt_BR.js"></script>
	
	
    <!-- Add fancyBox -->
	<script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
    <!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <script type="text/javascript">
		//$('.fancybox').fancybox();
		
		 $('.fancybox').attr("rel","gallery").fancybox({
		 }); // fancybox
		 $("#printBtn").click(function() {
			$('#myIframe')[0].print();
		});
		
	</script>
    
    <!-- uploadfy -->
    <script src="fotos/up/jquery.uploadify.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="fotos/up/uploadify.css">
    
    <style type="text/css">
		div#fancy_print {
	  /* set proper path for your print image */
		background: url("img/print.png") no-repeat scroll left top transparent;
		cursor: pointer;
		width: 58px; /* the size of your print image */
		height: 60px;
		left: -15px;
		position: absolute;
		top: -12px;
		z-index: 9999;
		display: block;
	}
	</style>
    
</head>

<body>


    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="inicio.php">Fábrica de Talentos</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="meusdados.php"><i class="fa fa-user fa-fw"></i> Meus Dados</a>
                        </li>
                        <?php if($tipo_usuario ==3){ ?>
                        <li><a href="configuracoes.php"><i class="fa fa-gear fa-fw"></i> Configurações</a>
                        </li>
                        <?php } ?>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            

<?php
    include("class/security.php");
    include ("conn/conn.php");
	//error_reporting(0);
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
	
	// Start button configuration
    $BOTONES_NAVEGACION = "
		<div class='col-md-12' align='center'>
			<div class='btn-group btn-group-sm'>
				<a class='btn btn-success' href='https://www.cmw.smcsalud.cu' role='button'>Web SMC</a>
				<a type='button' class='btn btn-danger' href='class\logout.php'>Logout [" . $_SESSION["user"] . "]</a>
			</div>
		</div>";
	// Finish button configuration

    $LISTA_ENCABEZADO_1 = $mysqli->query("SELECT * FROM tbl_encabezado_1 ORDER BY cod1");
?>

<!doctype html>
<html lang="es">
    <head>
        <!-- Start required meta tags for Bootstrap -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Finish required meta tags for Bootstrap -->

        <link rel="icon" href="../img/favicon.svg">
        <title>Tarifario de Precios</title>

        <!-- Start of links to CSS files -->
        <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../css/main.css" rel="stylesheet" media="screen">
        <link href="../css/datepicker.min" rel="stylesheet" media="screen">
        <link href="../css/fontawesome.css" rel="stylesheet" media="screen">
        <link href="../css/signin.css" rel="stylesheet" media="screen">
        <!-- Finish of links to CSS files -->

        <!-- Start of links to JS files -->
        <script src="../js/bootstrap.js"></script>
        <script src="../js/jquery-3.6.0.js"></script>
        <script src="../js/datepicker.min.js"></script>
        <script src="../js/main.js"></script>
        <script src="../js/fontawesome.js"></script>
        <!-- Finish of links to JS files -->
    </head>

    <body>
        <div class="container">
            <!-- Header start -->
            <div align="center">
                <div class="row">
                    <div class="col" align="center"><i class="fas fa-money-check-alt fa-6x text-success"></i></div>
                </div>	
                
                <div class="display-6 text-secondary">Tarifario de precios</div>
                <div align="center" style="font-size:10px">&nbsp;</div>
            </div>
            <!-- Header end -->
            
            <!-- Body start -->
            <div class="row" align="center">
                <div class="col-sm"></div>

                <div class="col-md-8" align="justify">
                    <div class="fs-4 text-secondary">Mediante este sitio usted podr&aacute; acceder de manera r&aacute;pida y din&aacute;mica al Listado de Precios a utilizar en los distintos Sistemas de la Comercializadora de Servicios M&eacute;dicos Cubanos de Camag&uuml;ey.</div>
                    <div class="fs-5 text-danger">Estos Listados no son de dominio p&uacute;blico, por lo tanto, mantenga discreci&oacute;n sobre los mismos.</div>
                    <div align="center" style="font-size:8px">&nbsp;</div>
                    <div align="center" class="fs-5 text-secondary">Seleccione el Listado de Precios a consultar</div>
                </div>
                
                <div class="col-sm"></div>
            </div>
			<div align="center" style="font-size:8px">&nbsp;</div>
			<div class="row">
				<div class="col-sm"></div>
				<div class="col-md-3" align="center">
					<a class='btn btn-success font-monospace' href='services/' role='button'><i class="fas fa-4x fa-user-md"></i><br><br><h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Servicios&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4></a>
				</div>
			
				<div class="col-md-3" align="center">
					<a class='btn btn-primary font-monospace' href='medicines/' role='button'><i class="fas fa-4x fa-pills"></i><br><br><h4>&nbsp;&nbsp;&nbsp;Medicamentos&nbsp;&nbsp;&nbsp;</h4></a>
				</div>	
				<div class="col-sm"></div>
			</div>
			
			
            <!-- Body end -->

            <!-- Start footer -->
            <div id="footer">
                <?php echo $BOTONES_NAVEGACION; ?>
            </div>
            <!-- Footer end -->
        </div>
    </body>
</html>
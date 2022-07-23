<?php
    include("../class/security.php");
    include ("../conn/conn.php");
	error_reporting(0);

    if(isset($_GET['cod1']) && isset($_GET['cod2'])){
        $COD1 = $_GET['cod1'];
        $COD2 = $_GET['cod2'];

        $QUERY_TITULO1 = $mysqli->query("SELECT * FROM tbl_encabezado_1 WHERE cod1='$COD1'");
        $QUERY_TITULO2 = $mysqli->query("SELECT * FROM tbl_encabezado_2 WHERE cod1='$COD1' AND cod2='$COD2'");

        while($rowTITULO1 = $QUERY_TITULO1->fetch_assoc()) {
		    $TITULO1 = $rowTITULO1['descripcion'];
		}

        while($rowTITULO2 = $QUERY_TITULO2->fetch_assoc()) {
		    $TITULO2 = $rowTITULO2['descripcion'];
		}
    } else {
        echo"<script>window.location.href='index.php'; </script>";
    }

    $LISTA_ENCABEZADO_3 = $mysqli->query("SELECT * FROM tbl_encabezado_3 WHERE cod1='$COD1' AND cod2='$COD2' ORDER BY cod1");

	// Start button configuration
    $BOTONES_NAVEGACION = "
		<div class='col-md-12' align='center'>
			<div class='btn-group btn-group-sm'>
				<a class='btn btn-success' href='https://www.cmw.smcsalud.cu' role='button'>Web SMC</a>
				<a class='btn btn-warning' href='..' role='button'>Men&uacute;</a>
				<a type='button' class='btn btn-danger' href='../class/logout.php'>Logout [" . $_SESSION["user"] . "]</a>
			</div>
		</div>";
	// Finish button configuration
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

        <link rel="icon" href="../../img/favicon.svg">
        <title>Tarifario de Precios</title>

        <!-- Start of links to CSS files -->
        <link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../../css/main.css" rel="stylesheet" media="screen">
        <link href="../../css/datepicker.min" rel="stylesheet" media="screen">
        <link href="../../css/fontawesome.css" rel="stylesheet" media="screen">
        <link href="../../css/signin.css" rel="stylesheet" media="screen">
        <!-- Finish of links to CSS files -->

        <!-- Start of links to JS files -->
        <script src="../../js/bootstrap.js"></script>
        <script src="../../js/jquery-3.6.0.js"></script>
        <script src="../../js/datepicker.min.js"></script>
        <script src="../../js/main.js"></script>
        <script src="../../js/fontawesome.js"></script>
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
                <div class='alert alert-success alert-dismissible fade show' role='alert'><strong><?php echo $TITULO1; ?></strong>&nbsp;->&nbsp;<?php echo $TITULO2; ?></div>
                <?php 
					// Comprobando si el servicio seleccionado tiene subnivel
					if(isset($_POST['head3'])){
                        $COD3 = $_POST['cboEncabezado3'];
                        echo $COD3;
                        echo"<script>window.location.href='result.php?cod1=$COD1&cod2=$COD2&cod3=$COD3';</script>";
					}
				?>

                <form name="frmSelect1" method="post" action="">
                    <div class="col-sm"></div>

                    <div class="col-md-8" align="center">
                        <div class="fs-6 text-secondary" align="left">&nbsp;Selecciona un subservicio de la lista</div>
                        <select name="cboEncabezado3" class="form-select form-select-lg" id="responsive_text" aria-label=".form-select-lg" required>
                            <option disabled value="" selected hidden>...</option>
                            <?php 
                                while($rowEncabezado3 = $LISTA_ENCABEZADO_3->fetch_assoc()) 
                                {
                                    echo "<option value='" . $rowEncabezado3['cod3'] . "'>" . $rowEncabezado3['cod3'] . "&nbsp;-&nbsp;" . utf8_encode(strtoupper($rowEncabezado3['descripcion'])) . "</option>";
                                } 
                            ?>
                        </select>

                        <div align="center" style="font-size:4px">&nbsp;</div>
                        
                        <div class="row">
                            <div class="col-md-12" align="right">
                                <a class='class="w-25 btn btn-lg btn-warning' href='index.php' role='button'>&nbsp;&nbsp;&nbsp;Reiniciar proceso&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;<button class="btn btn-lg btn-primary" type="submit" name="head3">&nbsp;&nbsp;&nbsp;Siguiente&nbsp;&nbsp;&nbsp;</button>
                        </div>
                    </div>
                    
                    

                    <div class="col-sm"></div>

                </form>
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
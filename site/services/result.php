<?php
    include("../class/security.php");
    include ("../conn/conn.php");
    setlocale (LC_TIME,"spanish");
	header('Content-Type:text/html; charset=UTF-8');
	error_reporting(0);

    $COD1OK=0;
    $COD2OK=0;
    $COD3OK=0;

    if(isset($_GET['cod1'])){
        $COD1 = $_GET['cod1'];
        $QUERY_TITULO1 = $mysqli->query("SELECT * FROM tbl_encabezado_1 WHERE cod1='$COD1'");
        while($row = $QUERY_TITULO1->fetch_assoc()) 
		{
		$SUBNIVEL1_TITULO = $row['descripcion'];
		}
        $COD1OK=1;
        $CODIGO_FINAL = $COD1 . ".";
    } else {
        echo"<script>window.location.href='index.php'; </script>";
    }
    
    if(isset($_GET['cod2'])){
        $COD2 = $_GET['cod2'];
        $QUERY_TITULO2 = $mysqli->query("SELECT * FROM tbl_encabezado_2 WHERE cod1='$COD1' AND cod2='$COD2'");
        while($row = $QUERY_TITULO2->fetch_assoc()) 
		{
		$SUBNIVEL2_TITULO = $row['descripcion'];
		}
        $COD2OK=1;
        $CODIGO_FINAL = $COD2 . ".";
    }

    if(isset($_GET['cod3'])){
        $COD3 = $_GET['cod3'];
        $QUERY_TITULO3 = $mysqli->query("SELECT * FROM tbl_encabezado_3 WHERE cod1='$COD1' AND cod2='$COD2' AND cod3='$COD3'");
        while($row = $QUERY_TITULO3->fetch_assoc()) 
		{
		$SUBNIVEL3_TITULO = $row['descripcion'];
		}
        $COD3OK=1;
        $CODIGO_FINAL = $COD3 . ".";
    }

    $CONSULTA_MYSQL = $mysqli->query("SELECT * FROM tbl_servicios WHERE codigo LIKE '$CODIGO_FINAL%' ORDER BY codigo");
	// Start button configuration
    $BOTONES_NAVEGACION = "
		<div class='col-md-12' align='center'>
			<div class='btn-group btn-group-sm'>
				<a class='btn btn-success' href='https://www.cmw.smcsalud.cu' role='button'>Web SMC</a>
                <a class='btn btn-warning' href='index.php' role='button'>Reiniciar proceso</a>
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
        <!-- Definiendo el alto de la tabla -->
		<style type="text/css"> 
			thead tr th {position: sticky; top: 0; z-index: 10;}
			.table-responsive {height:336px;}
        </style> 
		<!-- Definiendo el alto de la tabla -->
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
                <?php 
                    switch ($COD1OK + $COD2OK + $COD3OK) {
                        case "1":
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>$SUBNIVEL1_TITULO</strong></div>";
                            break;
                        case "2":
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>$SUBNIVEL1_TITULO</strong>&nbsp;->&nbsp;" . $SUBNIVEL2_TITULO . "</div>";
                            break;
                        case "3":
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>$SUBNIVEL1_TITULO</strong>&nbsp;->&nbsp;" . $SUBNIVEL2_TITULO . "&nbsp;->&nbsp;" . $SUBNIVEL3_TITULO . "</div>";
                            break;		
                    }
                ?>

				<div class="row">
					<div class="col-md-12" align="center">
						<div class="table-responsive">
							<table class='table table-hover table-sm' id='testTable'>
								<thead class="table-success text-white">
									<tr>
										<th class='fs-6 ajustar text-start'>&nbsp;C&oacute;digo</th>
										<th class='fs-6 ajustar text-start'>&nbsp;Servicio</th>
										<th class='fs-6 ajustar text-start'>&nbsp;Tipo</th>
										<th class='fs-6 ajustar text-middle'>&nbsp;Unidad</th>
										<th class='fs-6 ajustar text-end'>&nbsp;Precio USD</th>
										<th class='fs-6 ajustar text-end'>&nbsp;Precio CUP</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if(mysqli_num_rows($CONSULTA_MYSQL) == 0)
										{
											echo '<tr><td colspan="8">&nbsp;No se encontraron resultados.</td></tr>';
										} else {
											while($row = mysqli_fetch_assoc($CONSULTA_MYSQL))
											{												
												echo "<tr>";
													echo "<td class='align-middle fs-6 ajustar' align='left'>" . $row['codigo'] . "</td>";
													echo "<td class='align-middle fs-6 ajustar' align='left'>" . utf8_encode($row['descripcion']) . "</td>";
													echo "<td class='align-middle fs-6 ajustar' align='left'>" . $row['denominacion'] . "</td>";
													echo "<td class='align-middle fs-6 ajustar' align='center'>" . $row['unidad'] . "</td>";
													echo "<td class='align-middle fs-6 ajustar' align='right'>" . number_format($row['precio_new_usd'], 2, '.', '') . "</td>";
													echo "<td class='align-middle fs-6 ajustar' align='right'>" . number_format($row['precio_new_cup'], 2, '.', '') . "</td>";
												echo "</tr>";
											}
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>	
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
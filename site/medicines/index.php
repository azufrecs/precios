<?php
    include("../class/security.php");
    include ("../conn/conn.php");
    setlocale (LC_TIME,"spanish");
	header('Content-Type:text/html; charset=UTF-8');
	error_reporting(0);

    $CONSULTA_MYSQL = $mysqli->query("SELECT * FROM tbl_medicamentos ORDER BY grupo, descripcion");
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
        <!-- Definiendo el alto de la tabla -->
		<style type="text/css"> 
			thead tr th {position: sticky; top: 0; z-index: 10;}
			.table-responsive {height:430px;}
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
			<div class="row">
				<div class="col-md-12" align="center">
					<div class="table-responsive">
						<table class='table table-hover table-sm' id='testTable'>
							<thead class="table-success text-white">
								<tr>
									<th class='fs-6 ajustar text-start'>&nbsp;C&oacute;digo</th>
									<th class='fs-6 ajustar text-start'>&nbsp;Dscripci&oacute;n</th>
									<th class='fs-6 ajustar text-start'>&nbsp;UM</th>
									<th class='fs-6 ajustar text-end'>&nbsp;Precio USD</th>
									<th class='fs-6 ajustar text-end'>&nbsp;Precio CUP</th>
									<th class='fs-6 ajustar text-end'>&nbsp;grupo</th>
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
											if (strlen(trim($row['descripcion'])) > 50){
												$DESCRIPPCIONN =  substr(trim(strtoupper($row['descripcion'])), 0, 75) . "...";
											} else {
												$DESCRIPPCIONN = trim(strtoupper($row['descripcion']));
											}
											
											if ($row['grupo'] == "extra"){
												$COLOR_FILA=" style='background-color:#93D3A2;' ";
											} else {
												$COLOR_FILA=" style='background-color:#EEEEEE;' ";
											}
											
											echo "<tr>";
												echo "<td class='align-middle fs-6 ajustar' align='left' ".$COLOR_FILA.">" . $row['codigo'] . "</td>";
												echo "<td class='align-middle fs-6 ajustar' align='left' ".$COLOR_FILA.">" . utf8_encode($DESCRIPPCIONN) . "</td>";
												echo "<td class='align-middle fs-6 ajustar' align='center' ".$COLOR_FILA.">" . $row['um'] . "</td>";
												echo "<td class='align-middle fs-6 ajustar' align='right' ".$COLOR_FILA.">" . number_format($row['precio_usd'], 2, '.', '') . "</td>";
												echo "<td class='align-middle fs-6 ajustar' align='right' ".$COLOR_FILA.">" . number_format($row['precio_cup'], 2, '.', '') . "</td>";
												echo "<td class='align-middle fs-6 ajustar' align='left' ".$COLOR_FILA.">" . $row['grupo'] . "</td>";
											echo "</tr>";
										}
									}
								?>
							</tbody>
						</table>
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
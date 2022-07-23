<?php 
	error_reporting(0);
	
	// Start button configuration
	$BOTONES_NAVEGACION = "
	<div class='col-md-12' align='center'>
		<a class='btn btn-sm btn-success' href='https://www.cmw.smcsalud.cu' role='button'>Web SMC</a>
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
		
		<link rel="icon" href="img/favicon.svg">
		<title>Tarifario de Precios</title>

		<!-- Start of links to CSS files -->
		<link href="css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="css/datepicker.min" rel="stylesheet" media="screen">
		<link href="css/fontawesome.css" rel="stylesheet" media="screen">
		<link href="css/main.css" rel="stylesheet" media="screen">
		<link href="css/signin.css" rel="stylesheet" media="screen">
		<!-- Finish of links to CSS files -->
		
		<!-- Start of links to JS files -->
		<script src="js/bootstrap.js"></script>
		<script src="js/datepicker.min.js"></script>
		<script src="js/fontawesome.js"></script>
		<script src="js/jquery-3.6.0.js"></script>
		<script src="js/main.js"></script>
		<!-- Finish of links to JS files -->
	</head>

	<body>
		<div class="container">
			<div align="center">
				<!-- Header start -->
				<div class="row">
					<div class="col" align="center"><i class="fas fa-money-check-alt fa-10x text-success"></i></div>
				</div>	
				
				<div class="display-6 text-secondary">Tarifario de precios, autent&iacute;quese</div>
				<div align="center" style="font-size:20px">&nbsp;</div>
				<!-- Header end -->

				<form name="frmInicio" method="post" action="" class="form-signin">
					<div class="form-floating">
						<input type="text" class="form-control" name="txtLoginUsername" id="txtLoginUsername" placeholder="Usuario de proxy" autocomplete="off" required autofocus>
						<label class="text-secondary" for="txtLoginUsername">Usuario de proxy</label>
					</div>
					
					<div align="center" style="font-size:3px">&nbsp;</div>

					<div class="form-floating">
						<input type="password" class="form-control" name="txtPassUsername" id="txtPassUsername" placeholder="Contrase&ntilde;a de proxy" autocomplete="off" required>
						<label class="text-secondary" for="txtPassUsername">Contrase&ntilde;a de proxy</label>
					</div>
					
					<div align="center" style="font-size:6px">&nbsp;</div>

					<button class="w-100 btn btn-lg btn-success" type="submit" name="login">Acceder</button>
				</form>

				<?php 
					// Start of the authentication procedure
					if(isset($_POST['login']))
					{
						$ldap_host 		= "172.30.1.2";									// IP de Servidor de dominio
						$ldap_domain 	= "@cmw.smcsalud.cu";							// Dominio de red
						$user 			= $_POST['txtLoginUsername'];					// Nombre de usuario capturado
						$user_full 		= $_POST['txtLoginUsername'] . $ldap_domain;	// Nombre de usuario capturado con dominio
						$pswd 			= $_POST['txtPassUsername'];					// Contraseña capturada
						$base_dn 		= "OU=USUARIOS,DC=cmw,DC=smcsalud,DC=cu";		// Unidad Organizativa de los usuarios del dominio
						$base_group 	= "CN=PRECIOS,DC=cmw,DC=smcsalud,DC=cu";		// Grupo en el cual se va a buscar al usuario capturado
						
						$ldap = ldap_connect($ldap_host) or die("<div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>¡Error!</strong>&nbsp;No se ha podido conectar al Controlador de Dominio SMC<br>Contacte al Administrador de la Red<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div><div id='footer'>" . $BOTONES_NAVEGACION . "</div>");
						ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3) or die ("<div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>¡Error!</strong>&nbsp;Imposible asignar el Protocolo LDAP<br>Contacte al Administrador de la Red<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div><div id='footer'>" . $BOTONES_NAVEGACION . "</div>");
						ldap_bind($ldap, $user_full, $pswd) or die("<div class='alert alert-warning alert-dismissible fade show' role='alert'><strong>¡Error!</strong>&nbsp;Usuario/contraseña inv&aacute;lidos, contraseña expirada o error de acceso al dominio<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div><div id='footer'>" . $BOTONES_NAVEGACION . "</div>");
						$filter = "(&(objectClass=user) (samaccountname=" . $user . ") (memberOf=" . $base_group . "))";
						$sr=ldap_search($ldap, $base_dn, $filter);

						if (count(ldap_get_entries($ldap, $sr))==1)
						{
							$_SERVER = array();
							$_SESSION = array();
							$_SESSION["autentica"] = "NO";
							exit("<div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>" . ucfirst(strtolower($user)) . "</strong>,&nbsp;usted no tiene permisos para usar este Sistema<br>Si esto le parece incorrecto contacte al Administrador de la Red<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div><div id='footer'>" . $BOTONES_NAVEGACION . "</div>");
						} else {
							// Getting full name oh the logged in user
							$attributes = array("displayname"); 
							$filter = "(&(sAMAccountName=$user))"; 
							$result = ldap_search($ldap, $base_dn, $filter, $attributes); 
							$entries = ldap_get_entries($ldap, $result); 

							session_start();
							$_SESSION["user"] = $user;
							$_SESSION["name"] = $entries[0]['displayname'][0];
							$_SESSION["autentica"] = "SI";
							echo"<script>window.location.href='site/'; </script>";
						}
					}
					// Finish of the authentication procedure
				?>
			</div>
		</div>

		<!-- Start footer -->
		<div id="footer">
			<?php echo $BOTONES_NAVEGACION; ?>
		</div>
		<!-- Footer end -->
	</body>
</html>
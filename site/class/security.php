<?php
	@session_start();
	if($_SESSION["autentica"] != "SI"){
		header("Location: https://www.cmw.smcsalud.cu");
		exit();
	}
?>

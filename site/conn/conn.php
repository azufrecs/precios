<?php
	$mysqli = new mysqli('127.0.0.1','precios','precios2012*/','precios');
	if ($mysqli->connect_error)
	{
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
?>
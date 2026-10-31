<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db   = "mi_proyecto";

	$conn = new mysqli($host, $user, $pass, $db);
	
	if ($conn->connect_error) {
	    die("Error en la conexión a la base de datos: " . $conn->connect_error);
	}
?>
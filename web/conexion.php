<?php
	$host = "sql209.infinityfree.com";
	$user = "if0_43117532";
	$pass = "K1KW6m7n9SIRUb";
	$db   = "if0_43117532_registro_usuarios_db";

	$conn = new mysqli($host, $user, $pass, $db);
	
	if ($conn->connect_error) {
	    die("Error en la conexión a la base de datos: " . $conn->connect_error);
	}
?>

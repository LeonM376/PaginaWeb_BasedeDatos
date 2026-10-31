<?php
session_start();
require_once 'conexion.php';

$accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

	if ($accion === 'registrar') {
    		$nombre = trim($_POST['nombre']);
    		$email = trim($_POST['email']);
    		$password = $_POST['password'];

    		$passwordHash = password_hash($password, PASSWORD_BCRYPT);

    		$stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
    		$stmt->bind_param("sss", $nombre, $email, $passwordHash);

    		if ($stmt->execute()) {
        		header("Location: usuarios.php?msg=registrado");
    		} else {
        		header("Location: usuarios.php?error=error_registro");
    		}
   		$stmt->close();
	}

	if ($accion === 'login') {
    		$email = trim($_POST['email']);
    		$password = $_POST['password'];

    		$stmt = $conn->prepare("SELECT id, nombre, password FROM usuarios WHERE email = ?");
    		$stmt->bind_param("s", $email);
    		$stmt->execute();
    		$result = $stmt->get_result();

    		if ($user = $result->fetch_assoc()) {
        		if (password_verify($password, $user['password'])) {
            			$_SESSION['usuario_id'] = $user['id'];
            			$_SESSION['usuario_nombre'] = $user['nombre'];
            			header("Location: usuarios.php?msg=login_ok");
            			exit;
        		}
   		}
    		header("Location: usuarios.php?error=login_fallido");
    		$stmt->close();
	}


	if ($accion === 'eliminar') {
    		$id = intval($_GET['id']);

    		$stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    		$stmt->bind_param("i", $id);
    		$stmt->execute();
    		$stmt->close();

    		header("Location: usuarios.php?msg=eliminado");
	}


	if ($accion === 'modificar') {
	    $id = intval($_POST['id']);
	    $nombre = trim($_POST['nombre']);
	    $email = trim($_POST['email']);
	
	    if (!empty($_POST['password'])) {
	        $passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);
	        $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ?, password = ? WHERE id = ?");
	        $stmt->bind_param("sssi", $nombre, $email, $passwordHash, $id);
	    } else {
	        $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
	        $stmt->bind_param("ssi", $nombre, $email, $id);
	    }

	    $stmt->execute();
	    $stmt->close();
	    header("Location: usuarios.php?msg=modificado");
	}

	if ($accion === 'logout') {
	    session_destroy();
	    header("Location: usuarios.php");
	}
?>
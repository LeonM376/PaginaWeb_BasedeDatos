<?php
session_start();
require_once 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="css/estilos.css">
    <meta charset="UTF-8">
    <meta name="author" content="Rubén Hisraim León Martínez">
    <title>Gestión de Usuarios</title>
</head>
<body>
    <h1>Módulo de Gestión de Usuarios</h1>

    <!-- Navegación con la misma estructura que index.html -->
    <nav>
        <p>
            <a href="index.html"><button type="button">Página Principal</button></a>
            <a href="autobiografia.html"><button type="button">Autobiografía</button></a>
            <a href="galeria.html"><button type="button">Galería de Amigos</button></a>
            <a href="contacto.html"><button type="button">Contacto</button></a>
            <a href="interaccionesJavaScript.html"><button type="button">InteraccionesJS</button></a>
        </p>
    </nav>

    <?php if (isset($_SESSION['usuario_nombre'])): ?>
        <div class="alerta">
            Bienvenido/a, <strong><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></strong> | 
            <a href="usuarios_backend.php?accion=logout" style="color: #c62828;">Cerrar Sesión</a>
        </div>
    <?php endif; ?>

    <div class="modulo-usuarios">
        <!-- 1. FORMULARIO DE INICIAR SESIÓN -->
        <div class="modulo-card">
            <h3>1. Iniciar Sesión</h3>
            <form action="usuarios_backend.php" method="POST">
                <input type="hidden" name="accion" value="login">
                
                <label>Correo Electrónico:</label>
                <input type="email" name="email" required>

                <label>Contraseña:</label>
                <input type="password" name="password" required>

                <button type="submit">Ingresar</button>
            </form>
        </div>

        <!-- 2. FORMULARIO DE REGISTRO -->
        <div class="modulo-card">
            <h3>2. Registrar Usuario</h3>
            <form action="usuarios_backend.php" method="POST" onsubmit="return validarRegistro()">
                <input type="hidden" name="accion" value="registrar">
                
                <label>Nombre Completo:</label>
                <input type="text" id="reg_nombre" name="nombre" required>

                <label>Correo Electrónico:</label>
                <input type="email" id="reg_email" name="email" required>

                <label>Contraseña:</label>
                <input type="password" id="reg_password" name="password" required>

                <label>Re-Contraseña:</label>
                <input type="password" id="reg_repassword" name="repassword" required>

                <button type="submit">Registrarse</button>
            </form>
        </div>
    </div>

    <!-- 4. SECCIÓN PARA MODIFICAR DATOS (Oculto hasta presionar Editar) -->
    <div id="sec_modificar" class="modulo-card" style="display:none; margin-bottom: 20px;">
        <h3>4. Modificar Datos de Usuario</h3>
        <form action="usuarios_backend.php" method="POST">
            <input type="hidden" name="accion" value="modificar">
            <input type="hidden" id="mod_id" name="id">

            <label>Nombre:</label>
            <input type="text" id="mod_nombre" name="nombre" required>

            <label>Email:</label>
            <input type="email" id="mod_email" name="email" required>

            <label>Nueva Contraseña (dejar en blanco si no desea cambiarla):</label>
            <input type="password" name="password">

            <button type="submit">Guardar Cambios</button>
            <button type="button" class="btn-cancelar" onclick="cancelarEdicion()">Cancelar</button>
        </form>
    </div>

    <!-- 3 y 4. TABLA DE USUARIOS REGISTRADOS Y ACCIONES DE ELIMINAR / EDITAR -->
    <h2>Lista de Usuarios en Base de Datos</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $resultado = $conn->query("SELECT id, nombre, email FROM usuarios");
            while ($row = $resultado->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td>
                    <!-- Modificar -->
                    <button type="button" class="btn-editar" onclick="editarUsuario(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars($row['nombre']); ?>', '<?php echo htmlspecialchars($row['email']); ?>')">Editar</button>
                    <!-- Eliminar -->
                    <a href="usuarios_backend.php?accion=eliminar&id=<?php echo $row['id']; ?>" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">
                        <button type="button" class="btn-eliminar">Eliminar</button>
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script src="script.js"></script>
</body>
</html>
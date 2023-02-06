<style>
    body {
        font: 14px sans-serif;
    }

    .wrapper {
        width: 360px;
        padding: 20px;
    }
</style>


<body>
    <div class="wrapper">
        <h3>Portal inici de sessió</h3>
        <h2>Inicio de sesión estudiante</h2>
        <p>Introducir credenciales para iniciar sesión.</p>

        <?php
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

        <form action="index.php?controller=Usuario&action=studentLogin" method="post">
            <div class="form-group">
                <label>DNI</label>
                <input placeholder="DNI" title="DNI" type="text" name="DNI" class="form-control <?php echo (!empty($DNI_err)) ? 'is-invalid' : ''; ?>" value="">
                <span class="invalid-feedback"><?php echo $DNI_err; ?></span>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input placeholder="contraseña" title="contraseña" type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="submit-btn">
                <input type="submit" class="btn btn-primary" value="Iniciar sesión">
            </div>
            <p>¿No tienes cuenta? <a href="/cursos/student/studentRegister.php">¡Regístrate ahora! :)</a>.</p>
        </form>
        <button type="button" onclick="window.location.href='../index.php'" class="btn btn-primary back-btn">
            <- Volver inicio</button>
    </div>
</body>
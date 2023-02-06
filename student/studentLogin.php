<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["role"] === "student") {
    header("location: studentPanel.php");
    exit;
}

// Include config file
require_once "../config.php";

// Define variables and initialize with empty values
$DNI = $password = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <img id="imgAjuntament" src="../assets/ajuntament.png" alt="ajuntament de badalona" />
    <h1 id="rainbow-title">InfoBDN</h1>
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/studentLogin.css">
    <style>
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 360px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h2>Inicio de sesión estudiante</h2>
        <p>Introducir credenciales para iniciar sesión.</p>

        <?php
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>DNI</label>
                <input placeholder="DNI" title="DNI" type="text" name="DNI" class="form-control <?php echo (!empty($DNI_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $DNI; ?>">
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

</html>
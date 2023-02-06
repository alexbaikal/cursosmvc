<?php


// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["role"] === "teacher") {
    header("location: teacherPanel.php");
    exit;
}

// Include config file
require_once "./config.php";

// Define variables and initialize with empty values
$DNI = $password = "";
$DNI_err = $password_err = $login_err = "";
$role = "teacher";
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if DNI is empty
    if (empty(trim($_POST["DNI"]))) {
        $DNI_err = "Por favor, introducir un DNI.";
    } else {
        $DNI = trim($_POST["DNI"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, introducir una contraseña.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($DNI_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT teacher_id, dni, password FROM teacher WHERE dni = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_DNI);

            // Set parameters
            $param_DNI = $DNI;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if DNI exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $DNI, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["role"] = $role;

                            // Redirect user to welcome page
                            header("location:./index.php?controller=Profesor&action=profesorPanel");
                        } else {
                            // Password is not valid, display a generic error message
                            $login_err = "DNI o contraseña incorrectos.";
                        }
                    }
                } else {
                    // DNI doesn't exist, display a generic error message
                    $login_err = "DNI o contraseña incorrectos.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<link rel="stylesheet" href="./views/profesor/styles/teacherLogin.css">

<h2>Inicio de sesión profesor</h2>
<div class="wrapper">

    <p>Introducir credenciales para iniciar sesión.</p>

    <?php
    if (!empty($login_err)) {
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
    }
    ?>

    <form action="./index.php?controller=Profesor&action=profesorLoginStart" method="post">
        <div class="form-group">
            <label>DNI</label>
            <input placeholder="DNI" title="DNI" type="text" name="DNI" class="form-control <?php echo (!empty($DNI_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $DNI; ?>">
            <span class="invalid-feedback"><?php echo $DNI_err; ?></span>
        </div>
        <div class="form-group">
            <label>Contraseña</label>
            <input placeholder="contraseña" type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        <div class="submit-btn">
            <input type="submit" class="btn btn-primary" value="Iniciar sesión">
        </div>
    </form>
    <br>
    <button type="button" onclick="window.location.href='../index.php'" class="btn btn-primary back-btn">
        <- Volver inicio</button>
</div>
</body>
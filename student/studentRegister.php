<?php
// Include config file
require_once "../config.php";

// Define variables and initialize with empty values
$DNI = $name = $surname = $age = $password = $confirm_password = $upload_image = $tmp_upload_image = "";
$DNI_err = $name_err = $surname_err = $age_err = $password_err = $confirm_password_err = $upload_image_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["DNI"]))) {
        $DNI_err = "Por favor, introducir un DNI.";
    } elseif (!preg_match('/^[a-zA-Z0-9]+$/', trim($_POST["DNI"]))) {
        $DNI_err = "El DNI sólo puede contener letras y números.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id_student FROM students WHERE DNI = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_DNI);

            // Set parameters
            $param_DNI = trim($_POST["DNI"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $DNI_err = "Ya existe un usuario con este DNI.";
                } else {
                    $DNI = trim($_POST["DNI"]);
                }
            } else {
                echo "Hubo un error en la base de datos. Inténtalo de nuevo más tarde.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate username
    if (empty(trim($_POST["name"]))) {
        $name_err = "Por favor, introducir un nombre.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["name"]))) {
        $name_err = "El DNI sólo puede contener letras. números y barras bajas.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id_student FROM students WHERE DNI = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_DNI);

            // Set parameters
            $param_DNI = trim($_POST["DNI"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $DNI_err = "Ya existe un usuario con este DNI.";
                } else {
                    $name = trim($_POST["name"]);
                }
            } else {
                echo "Hubo un error en la base de datos. Inténtalo de nuevo más tarde.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }


    // Validate surname
    if (empty(trim($_POST["surname"]))) {
        $surname_err = "Por favor, introducir apellidos.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["surname"]))) {
        $surname_err = "Los apellidos sólo pueden contener letras. números y barras bajas.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id_student FROM students WHERE DNI = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_DNI);

            // Set parameters
            $param_DNI = trim($_POST["DNI"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $DNI_err = "Ya existe un usuario con este DNI.";
                } else {
                    $surname = trim($_POST["surname"]);
                }
            } else {
                echo "Hubo un error en la base de datos. Inténtalo de nuevo más tarde.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate age
    if (empty(trim($_POST["age"]))) {
        $age_err = "Por favor, introducir edad.";
    } elseif (!preg_match('/^[0-9]+$/', trim($_POST["age"]))) {
        $age_err = "La edad sólo puede contener números.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id_student FROM students WHERE DNI = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_DNI);

            // Set parameters
            $param_DNI = trim($_POST["DNI"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $DNI_err = "Ya existe un usuario con este DNI.";
                } else {
                    $surname = trim($_POST["surname"]);
                }
            } else {
                echo "Hubo un error en la base de datos. Inténtalo de nuevo más tarde.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }


    // Validate file
    if (isset($_POST['subbtn'])) {
        // Set parameters
        $param_upload_image = $_FILES['uploadfile']['name'];

        $upload_image = $_FILES['uploadfile']['name'];


        $tmp_upload_image = $_FILES['uploadfile']['tmp_name'];
        echo "" . $upload_image;

        if (isset($upload_image) and !empty($upload_image)) {
        } else {
            echo "No hay imagen seleccionada.";
        }
    } else {

        $upload_image_err = "Por favor, introducir una imagen de nuevo.";
    }




    // Check input errors before inserting in database
    if (empty($dni_err) && empty($name_err) && empty($surname_err) && empty($age_err) && empty($password_err) && empty($confirm_password_err) && empty($upload_image_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO students (DNI, name, surname, age, password, image) VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_DNI, $param_name, $param_surname, $param_age, $param_password, $param_upload_image);

            // Set parameters
            $param_dni = $DNI;
            $param_name = $name;
            $param_surname = $surname;
            $param_age = $age;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_upload_image = time() . $upload_image;

            $folder = '../profilepics/';


            move_uploaded_file($tmp_upload_image, $folder . time() . $upload_image);


            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: studentLogin.php");
            } else {
                echo "Error en la base de datos.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registrar estudiante</title>
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
        <h2>Registrar alumno</h2>
        <p>Rellene los campos para registrarse.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>DNI</label>
                <input placeholder="DNI" title="DNI" type="text" name="DNI" class="form-control <?php echo (!empty($DNI_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $DNI; ?>">
                <span class="invalid-feedback"><?php echo $DNI_err; ?></span>
            </div>
            <div class="form-group">
                <label>Nombre</label>
                <input placeholder="Nombre" title="Nombre" type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                <span class="invalid-feedback"><?php echo $name_err; ?></span>
            </div>
            <div class="form-group">
                <label>Apellidos</label>
                <input placeholder="Apellidos" title="Apellidos" type="text" name="surname" class="form-control <?php echo (!empty($surname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $surname; ?>">
                <span class="invalid-feedback"><?php echo $surname_err; ?></span>
            </div>
            <div class="form-group">
                <label>Edad</label>
                <select class="form-control" name="age" id="age">
                    <option value="">
                        <p>-- Escoger una edad --</p>
                    </option>
                    <?php for ($i = 1; $i <= 99; $i++) { ?>
                        <option value="<?php echo "$i"; ?>"><?php echo "$i"; ?></option>
                    <?php }
                    ?>
                    <span class="invalid-feedback"><?php echo $age_err; ?></span>
                </select>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input placeholder="contraseña" title="contraseña" type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirmar contraseña</label>
                <input placeholder="confirmar contraseña" title="confirmar contraseña" type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <p>Foto de perfil</p>
            <input style="margin-bottom: 20px;" type="file" name="uploadfile" <?php echo (!empty($upload_image_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $file_upload; ?>">
            <div class="form-group buttons">
                <br />
                <input type="submit" name="subbtn" class="btn btn-primary" value="Registrar">
                <input type="reset" class="btn btn-secondary ml-2" value="Borrar campos">
            </div>
            <p>¿Ya tienes una cuenta de estudiante? <a href="studentLogin.php">Inicia sesión</a>.</p>
        </form>
    </div>
</body>

</html>
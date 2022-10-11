<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "admin") {
    header("location: adminLogin.php");
    exit;
}
?>

<?php
// Include config file
require_once "../config.php";

// Define variables and initialize with empty values
$dni = $name = $surname = $title = $description = $password = $confirm_password = $upload_image = $tmp_upload_image = "";
$dni_error = $name_err = $surname_err = $title_err = $description_err = $password_err = $confirm_password_err = $upload_image_err = "";


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate DNI
    if (empty(trim($_POST["dni"]))) {
        $dni_err = "Por favor, introducir DNI.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["dni"]))) {
        $dni_err = "El DNI sólo puede incluir letras o números.";
    } else {
        // Validar que el DNI sea Español
        $dni = trim($_POST["dni"]);
        if (!preg_match('/^[0-9]{8}[A-Z]$/', $dni)) {
            $dni_err = "El DNI no es válido.";
        } else {
            // Set parameters
            $param_dni = trim($_POST["dni"]);

            $dni = trim($_POST["dni"]);
        }
    }


    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Por favor, introducir un nombre.";
    } else {

        // Set parameters
        $param_name = trim($_POST["name"]);


        $name = trim($_POST["name"]);
    }


    // Validate surname
    if (empty(trim($_POST["surname"]))) {
        $surname_err = "Por favor, introducir apellidos.";
    } else {
        $param_surname = trim($_POST["surname"]);

        $surname = trim($_POST["surname"]);
    }

    // Validate title
    if (empty(trim($_POST["title"]))) {
        $title_err = "Por favor, introducir un título.";
    } else {

        // Set parameters
        $param_title = trim($_POST["title"]);

        $title = trim($_POST["title"]);
    }



    // Set parameters
    $param_description = trim($_POST["description"]);


    $description = trim($_POST["description"]);



    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, ingrese una contraseña.";
    } elseif (strlen(trim($_POST["password"])) < 5) {
        $password_err = "La contraseña tiene que contener como mínimo 5 caracteres.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Por favor, confirme la contraseña introducida.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Las contraseñas no coinciden.";
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

?>



<?php

    // Check input errors before inserting in database
    if (empty($dni_err) && empty($name_err) && empty($surname_err) && empty($title_err) && empty($description_err) && empty($password_err) && empty($confirm_password_err) && empty($upload_image_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO teacher (dni, name, surname, title, description, password, image) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_dni, $param_name, $param_surname, $param_title, $param_description, $param_password, $param_upload_image);

            // Set parameters
            $param_dni = $dni;
            $param_name = $name;
            $param_surname = $surname;
            $param_title = $title;
            $param_description = $description;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_upload_image = time() . $upload_image;

            $folder = '../profilepics/';


            move_uploaded_file($tmp_upload_image, $folder . time() . $upload_image);


            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: adminTeachers.php");
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
    <title>Afegir professor</title>
    <link rel="stylesheet" type="text/css" href="../styles/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/sidebar.css">

    <style>
        body {
            font: 14px sans-serif;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .wrapper {
            width: 360px;
            padding: 20px;
        }
    </style>
</head>

<body>

    <!--sidebar on top of everything using bootstrap and grid-->
    <div class="row">
        <div class="col-2">
            <div class="sidebar">
                <!--button to hide sidebar-->
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">❌</a>
                <a href="./adminPanel.php">Inici</a>
                <a href="./adminCourses.php">Cursos 🏫</a>
                <a href="./adminTeachers.php">Professors 👨‍🎓</a>
                <a href="../logout.php">Tancar sessió ❌</a>
            </div>
            <!--button that calls openNav()-->
            <button class="openbtn" onclick="openNav()">☰</button>

        </div>
        <div class="col-10">

        </div>
    </div>



    <div class="wrapper">
        <h2>Añadir profesor</h2>
        <p>Crear cuenta de profesor</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">


            <div class="form-group">
                <label>DNI</label>
                <input type="text" name="dni" class="form-control <?php echo (!empty($dni_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $dni; ?>">
                <span class="invalid-feedback"><?php echo $dni_err; ?></span>
            </div>
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                <span class="invalid-feedback"><?php echo $name_err; ?></span>
            </div>
            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" name="surname" class="form-control <?php echo (!empty($surname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $surname; ?>">
                <span class="invalid-feedback"><?php echo $surname_err; ?></span>
            </div>
            <div class="form-group">
                <label>Título</label>
                <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
                <span class="invalid-feedback"><?php echo $title_err; ?></span>
            </div>
            <div class="form-group">
                <label>Descripción</label>
                <input type="text" name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $description; ?>">
                <span class="invalid-feedback"><?php echo $description_err; ?></span>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirmar contraseña</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <p>Foto de perfil</p>
            <input type="file" name="uploadfile" <?php echo (!empty($upload_image_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $file_upload; ?>">
            <div class="form-group">
                <br />
                <input type="submit" name="subbtn" class="btn btn-primary" value="Registrar">
                <input type="reset" class="btn btn-secondary ml-2" value="Borrar campos">
            </div>



            <p><a href="adminTeachers.php">Panel profesores</a></p>
        </form>
    </div>

    <script>
        closeNav();

        function openNav() {
            document.getElementsByClassName("sidebar")[0].style.width = "250px";
        }

        function closeNav() {
            document.getElementsByClassName("sidebar")[0].style.width = "0";
        }
    </script>
</body>

</html>
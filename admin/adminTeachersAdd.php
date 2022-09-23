<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../index.php");
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
        $dni_err = "Si us plau, introduïu cognoms.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["dni"]))) {
        $dni_err = "El DNI només pot incluïr lletres, números o barres baixes.";
    } else {

        // Set parameters
        $param_dni = trim($_POST["dni"]);

        $dni = trim($_POST["dni"]);
    }


    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Si us plau, introduïu un nom.";
    } else {

        // Set parameters
        $param_name = trim($_POST["name"]);


        $name = trim($_POST["name"]);
    }


    // Validate surname
    if (empty(trim($_POST["surname"]))) {
        $surname_err = "Si us plau, introduïu cognoms.";
    } else {
        $param_surname = trim($_POST["surname"]);

        $surname = trim($_POST["surname"]);
    }

    // Validate title
    if (empty(trim($_POST["title"]))) {
        $title_err = "Si us plau, introduïu títol.";
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
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 5) {
        $password_err = "La contrasenya ha de tenir com a mínim 6 caracters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Si us plau, confirmi la contrasenya.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Les contrasenyes no coincideixen.";
        }
    }
 
    // Validate description
    if(isset($_POST['subbtn'])) {
         // Set parameters
         $param_upload_image = $_FILES['uploadfile']['name'];

   $upload_image = $_FILES['uploadfile']['name'];


   $tmp_upload_image = $_FILES['uploadfile']['tmp_name'];
   echo"". $upload_image;

   if(isset($upload_image) and !empty($upload_image)) {

   } else {
    echo "No hay imagen seleccionada"; 

   }

    } else {
        
        $upload_image_err = "Si us plau, introduïu imatge.";
    }

?>



<?php

    // Check input errors before inserting in database
    if (empty($dni_err) && empty($name_err) && empty($surname_err) && empty($title_err) && empty($description_err) && empty($password_err) && empty($password_err) && empty($confirm_password_err) && empty($upload_image_err)) {

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
            $param_upload_image = time().$upload_image;

            $folder = '../profilepics/';


            move_uploaded_file($tmp_upload_image, $folder.time().$upload_image);


            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: adminTeachers.php");
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Afegir professor</title>
    <link rel="stylesheet" type="text/css" href="../styles/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    <div class="wrapper">
        <h2>Afegir professor</h2>
        <p>Crear compte de professor</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" >
            
        
        <div class="form-group">
                <label>DNI</label>
                <input type="text" name="dni" class="form-control <?php echo (!empty($dni_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $dni; ?>">
                <span class="invalid-feedback"><?php echo $dni_err; ?></span>
            </div>
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                <span class="invalid-feedback"><?php echo $name_err; ?></span>
            </div>
            <div class="form-group">
                <label>Cognoms</label>
                <input type="text" name="surname" class="form-control <?php echo (!empty($surname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $surname; ?>">
                <span class="invalid-feedback"><?php echo $surname_err; ?></span>
            </div>
            <div class="form-group">
                <label>Títol</label>
                <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
                <span class="invalid-feedback"><?php echo $title_err; ?></span>
            </div>
            <div class="form-group">
                <label>Descripció</label>
                <input type="text" name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $description; ?>">
                <span class="invalid-feedback"><?php echo $description_err; ?></span>
            </div>
            <div class="form-group">
                <label>Constrasenya</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirmar constrasenya</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <p>Foto de perfil</p>
            <input type="file" name="uploadfile" <?php echo (!empty($file_upload_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $file_upload; ?>">
            <div class="form-group">
                <br />
                <input type="submit" name="subbtn" class="btn btn-primary" value="Crear">
                <input type="reset" class="btn btn-secondary ml-2" value="Esborrar">
            </div>

         

            <p><a href="adminTeachers.php">Panel professors</a></p>
        </form>
    </div>
</body>

</html>
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
$teacher_id = $name = $description = $start = $end = "";
$teacher_id_error = $name_err = $description_err = $start_err = $end_err = "";


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate DNI
    if (empty(trim($_POST["teacher_id"]))) {
        $teacher_id_err = "Si us plau, introduïu cognoms.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["teacher_id"]))) {
        $teacher_id_err = "El DNI només pot incluïr lletres, números o barres baixes.";
    } else {

        // Set parameters
        $param_teacher_id = trim($_POST["teacher_id"]);

        $teacher_id = trim($_POST["teacher_id"]);
    }


    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Si us plau, introduïu un nom.";
    } else {

        // Set parameters
        $param_name = trim($_POST["name"]);


        $name = trim($_POST["name"]);
    }


    // Set parameters
    $param_description = trim($_POST["description"]);


    $description = trim($_POST["description"]);

    // validate start date and end date

    //validate and format start and end to timestamp

    $start = trim($_POST["start"]);
    $end = trim($_POST["end"]);

    $start = strtotime($start);
    $end = strtotime($end);

    // Validate start
    if (empty(trim($_POST["start"]))) {
        $start_err = "Si us plau, introduïu una data d'inici.";
    } else {
        $param_start = trim($_POST["start"]);
    }

    // Validate end
    if (empty(trim($_POST["end"]))) {
        $end_err = "Si us plau, introduïu una data de finalització.";
    } else {
        $param_end = trim($_POST["end"]);
    }


    echo $teacher_id;
    echo $name;
    echo $description;
    echo $start;
    echo $end;



?>



<?php

    // Check input errors before inserting in database
    if (empty($teacher_id_err) && empty($name_err) && empty($description_err) && empty($start_err) && empty($end_err)) {

        // Prepare an insert statement

        $sql = "INSERT INTO courses (teacher_id, name, description, start, end) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_teacher_id, $param_name, $param_description, $param_start, $param_end);
            // Set parameters
            $param_teacher_id = $teacher_id;
            $param_name = $name;
            $param_start = $start;
            $param_end = $end;
            
            echo "teacher_id: " . $teacher_id . "<br>";
            echo "name: " . $name . "<br>";
            echo "description: " . $description . "<br>";
            echo "start: " . $start . "<br>";
            echo "end: " . $end . "<br>";


            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: adminCourses.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Afegir curs</title>
    <link rel="stylesheet" type="text/css" href="../styles/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        <h2>Afegir curs</h2>
        <p>Crear curs</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">


            <div class="form-group">
                <label>DNI</label>
                <input type="text" name="teacher_id" class="form-control <?php echo (!empty($teacher_id_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $teacher_id; ?>">
                <span class="invalid-feedback"><?php echo $teacher_id_err; ?></span>
            </div>
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                <span class="invalid-feedback"><?php echo $name_err; ?></span>
            </div>
            <div class="form-group">
                <label>Descripció</label>
                <input type="text" name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $description; ?>">
                <span class="invalid-feedback"><?php echo $description_err; ?></span>
            </div>
            <!--Add start and end date of course-->
            <div class="form-group">
                <label>Començament</label>
                <input type="date" name="start" class="form-control <?php echo (!empty($start_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $start; ?>">
                <span class="invalid-feedback"><?php echo $start_err; ?></span>
            </div>
            <div class="form-group">
                <label>Finalització</label>
                <input type="date" name="end" class="form-control <?php echo (!empty($end_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $end; ?>">
                <span class="invalid-feedback"><?php echo $end_err; ?></span>
            <div class="form-group">
                <br />
                <input type="submit" name="subbtn" class="btn btn-primary" value="Crear">
                <input type="reset" class="btn btn-secondary ml-2" value="Esborrar">
            </div>



            <p><a href="adminCourses.php">Panel cursos</a>.</p>
        </form>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/adminPanel.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="margin: 50px;">
    <h1>Panel Administrador</h1>
    <div class="container">
        <?php
        // Initialize the session
        session_start();

        // Check if the user is logged in, if not then redirect him to login page
        if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "admin") {
            header("location: adminLogin.php");
            exit;
        }
        ?>
        <a href="./adminCourses.php" class="btn btn-primary">✏️   Modificar cursos   🏫</a>
        <a href="./adminTeachers.php" class="btn btn-primary">✏️Modificar profesores👩‍🏫</a>
    </div>

    <p><a href="../logout.php"><u>Cerrar sesión ❌</u></a></p>
</body>

</html>
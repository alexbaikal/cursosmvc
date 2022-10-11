<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/studentPanel.css">
    <link rel="stylesheet" href="./styles/sidebar.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="margin: 50px;">


    <!--sidebar on top of everything using bootstrap and grid-->
    <div class="row">
        <div class="col-2">
            <div class="sidebar">
                <!--button to hide sidebar-->
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">❌</a>
                <a href="./studentPanel.php">Inici</a>
                <a href="./studentCourses.php">Cursos 👨‍🎓</a>
                <a href="./studentEnrollments.php">Matriculas 📋</a>
                <a href="../logout.php">Cerrar sessió</a>
            </div>
            <!--button that calls openNav()-->
            <button class="openbtn" onclick="openNav()">☰</button>

        </div>
        <div class="col-10">

        </div>
    </div>




    <h1>Panel Estudiante</h1>
    <div class="container">
        <?php
        // Initialize the session
        session_start();

        // Check if the user is logged in, if not then redirect him to login page
        if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "student") {
            header("location: login.php");
            exit;
        }
        ?>
        <a href="./studentCourses.php" class="btn btn-primary">Cursos disponibles 👁️</a>
        <a href="./studentEnrollments.php" class="btn btn-primary">Gestionar matricules 📋</a>
    </div>

    <p><a href="../logout.php"><u>Cerrar sesión ❌</u></a></p>

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
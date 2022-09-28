<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/admin.css">
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>

    <img id="imgAjuntament" src="./assets/ajuntament.png" alt="ajuntament de badalona" />
    <h1 id="rainbow-title">InfoBDN</h1>

    <br />
    <br />
    <div id="content">
    <h3>Portal inici de sessió</h3>

        <div id="loginBox">
            <p><a href="student/studentLogin.php" class="btn btn-primary">Estudiant</a></p>
            <p><a href="teacher/teacherLogin.php" class="btn btn-primary">Professor</a></p>
        </div>
    </div>

    <div id="bottom">
    <a href="./admin/adminLogin.php">Admin</a>
    <a href="./admin/adminLogin.php">Acerca de</a>
    <p>© 2021 INS La Pineda</p>
    </div>

</body>
<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'courses');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="margin: 50px;">
<h1>Panel Administrador</h1>
<div style="display:flex; justify-content: center; align-items: center; height: 50vh; margin: 50px;">
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<a href="./adminCourses.php"  class="btn btn-primary">Cursos</a>
<a href="./adminTeachers.php"  class="btn btn-primary">Professors</a>
</div>

<p><a href="../logout.php">Logout</a></p>
</body>
</html>


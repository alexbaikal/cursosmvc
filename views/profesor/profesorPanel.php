<h1>Panel Profesor</h1>
<link rel="stylesheet" href="./views/profesor/styles/teacherPanel.css">
<div class="container">
    <?php

    // Check if the user is logged in, if not then redirect him to login page
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "teacher") {
        header("location: index.php?controller=Profesor&action=profesorLoginStart");
        exit;
    }
    ?>
    <a href="./index.php?controller=Profesor&action=profesorCourses" class="btn btn-primary">👁️ Ver cursos 🔎</a>
</div>
<br />
<p><a href="./index.php?controller=Usuario&action=logout"><u>Cerrar sesión ❌</u></a></p>

</body>
<?php
class StudentController
{
    public function studentCourses() {
        // Check if the user is already logged in, if yes then redirect him to welcome page
        if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true && $_SESSION["role"] !== "student") {
            header("location: index.php?controller=Usuario&action=studentPanel");
            exit;
        } else {
            require_once "views/usuarios/studentCourses.php";
        }
    }

    public function studentEnrollments() {
        // Check if the user is already logged in, if yes then redirect him to welcome page
        if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true && $_SESSION["role"] !== "student") {
            header("location: index.php?controller=Usuario&action=studentPanel");
            exit;
        } else {
            require_once "views/usuarios/studentEnrollments.php";
        }
    }
}

?>
<?php
class ProfesorController {
    public function profesorLoginStart()
    {
        // Check if the user is already logged in, if yes then redirect him to welcome page
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["role"] === "teacher") {
            header("location: index.php?controller=Profesor&action=profesorPanel");
            exit;
        } else {
            require_once "views/profesor/profesorLogin.php";
        }
    }

    public function profesorPanel()
    {
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["role"] === "teacher") {
            require_once "views/profesor/profesorPanel.php";
        } else {
            header("location: index.php?controller=Profesor&action=profesorLoginStart");
        }
    }

    public function profesorCourses() {
        // Check if the user is already logged in, if yes then redirect him to welcome page
        if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true && $_SESSION["role"] !== "teacher") {
            header("location: index.php?controller=Usuario&action=profesorPanel");
            exit;
        } else {
            require_once "views/profesor/profesorCourses.php";
        }
    }
    public function profesorCourse() {
        // Check if the user is already logged in, if yes then redirect him to welcome page
        if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true && $_SESSION["role"] !== "teacher") {
            header("location: index.php?controller=Usuario&action=profesorPanel");
            exit;
        } else {
            require_once "views/profesor/profesorCourse.php";
        }
    }
}

?>
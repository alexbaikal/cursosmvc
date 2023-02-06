<?php
class AdminController
{
    public function adminLogin()
    {
        // Check if the user is already logged in, if yes then redirect him to welcome page
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["role"] === "admin") {
            header("location: ./admin/adminPanel.php");
            exit;
        } else {
            require_once "views/admin/adminLogin.php";
        }
    }
}

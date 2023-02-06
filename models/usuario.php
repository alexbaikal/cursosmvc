<?php
require_once("database.php");

class Usuario extends Database {

    private $DNI;
    private $password;


    function conectar(){
        $this->db->query("SET NAMES 'utf8'");
    }

    function setDNI($DNI) {
        $this->DNI = $DNI;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function getDNI() {
        return $this->DNI;
    }

    function getPassword() {
        return $this->password;
    }

    function mostrarInicio() {
        require_once "views/general/iniciarsesion.html";

    }

    function studentLogin() {
        
$DNI_err = $password_err = $login_err = "";
$role = "student";
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if DNI is empty
    if (empty(trim($_POST["DNI"]))) {
        $DNI_err = "Por favor, introducir un DNI.";
    } else {
        $DNI = trim($_POST["DNI"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, introducir una contraseña.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($DNI_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id_student, DNI, password FROM students WHERE DNI = ?";

        try {
            $query = $this->db->prepare($sql);
            $query->execute(array($DNI));
            $row = $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $query->execute(array($DNI));
        $row = $query->fetch(PDO::FETCH_ASSOC);

        

        if ($row) {
            $id = $row["id_student"];
            $DNI = $row["DNI"];
            $hashed_password = $row["password"];
            if (password_verify($password, $hashed_password)) {
                // Password is correct
                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["DNI"] = $DNI;
                $_SESSION["role"] = $role;

                // Redirect user to welcome page
                header("location: index.php?controller=Usuario&action=studentPanel");
            } else {
                // Display an error message if password is not valid
                $login_err = "Contraseña incorrecta.";
            }
        } else {
            // Display an error message if DNI doesn't exist
            $login_err = "Usuario no encontrado.";
        }

                return $login_err;

    }

    }
    }




}
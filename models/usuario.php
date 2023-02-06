<?php
require_once("database.php");

class Usuario extends Database
{

    private $DNI;
    private $password;
    private $nombre;
    private $apellidos;
    private $email;
    private $role;
    private $edad;


    function conectar()
    {
        $this->db->query("SET NAMES 'utf8'");
    }

    function setDNI($DNI)
    {
        $this->DNI = $DNI;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setRole($role)
    {
        $this->role = $role;
    }

    function setEdad($edad)
    {
        $this->edad = $edad;
    }

    function getDNI()
    {
        return $this->DNI;
    }

    function getPassword()
    {
        return $this->password;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getApellidos()
    {
        return $this->apellidos;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getRole()
    {
        return $this->role;
    }

    function getEdad()
    {
        return $this->edad;
    }

    function mostrarInicio()
    {
        require_once "views/general/iniciarsesion.html";
    }

    function studentLogin()
    {

        $DNI_err = $password_err = "";
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
                        return "Contraseña incorrecta.";
                    }
                } else {
                    // Display an error message if DNI doesn't exist
                    return "Usuario no encontrado.";
                }
            }
        }
    }

    function studentRegister()
    {
        $DNI_err = $password_err = $confirm_password_err = $nombre_err = $apellidos_err = $edad_err = "";
        $role = "student";
        // Processing form data when form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Validate DNI
            if (empty(trim($_POST["DNI"]))) {
                $DNI_err = "Por favor, introducir un DNI.";
            } elseif (!preg_match('/^[a-zA-Z0-9]+$/', trim($_POST["DNI"]))) {
                $DNI_err = "El DNI sólo puede contener letras y números.";
            } else {
                $DNI = trim($_POST["DNI"]);
                if (!preg_match('/^[0-9]{8}[A-Z]$/', $DNI)) {
                    $DNI_err = "El DNI no es válido.";
                }
                // Prepare a select statement
                $sql = "SELECT id_student FROM students WHERE DNI = ?";

                try {
                    $query = $this->db->prepare($sql);
                    $query->execute(array(trim($_POST["DNI"])));
                    $row = $query->fetch(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }

                if ($row) {
                    $DNI_err = "Este DNI ya está registrado.";
                } else {
                    $DNI = trim($_POST["DNI"]);
                }
            }

            // Validate password
            if (empty(trim($_POST["password"]))) {
                $password_err = "Por favor, introducir una contraseña.";
            } elseif (strlen(trim($_POST["password"])) < 6) {
                $password_err = "La contraseña debe tener al menos 6 caracteres.";
            } else {
                $password = trim($_POST["password"]);
            }

            // Validate confirm password
            if (empty(trim($_POST["confirm_password"]))) {
                $confirm_password_err = "Por favor, confirmar la contraseña.";
            } else {
                $confirm_password = trim($_POST["confirm_password"]);
                if (empty($password_err) && ($password != $confirm_password)) {
                    $confirm_password_err = "Las contraseñas no coinciden.";
                }
            }

            // Validate nombre
            if (empty(trim($_POST["name"]))) {
                $nombre_err = "Por favor, introducir un nombre.";
            } else {
                $nombre = trim($_POST["name"]);
            }

            // Validate apellidos
            if (empty(trim($_POST["surname"]))) {
                $apellidos_err = "Por favor, introducir unos apellidos.";
            } else {
                $apellidos = trim($_POST["surname"]);
            }

            // Validate edad
            if (empty(trim($_POST["age"]))) {
                $edad_err = "Por favor, introducir una edad.";
            } else {
                $edad = trim($_POST["age"]);
            }


            


            // Check input errors before inserting in database
            if (empty($DNI_err) && empty($password_err) && empty($confirm_password_err) && empty($nombre_err) && empty($apellidos_err) && empty($email_err) && empty($edad_err)) {

                // Prepare an insert statement
                $sql = "INSERT INTO students (DNI, name, surname, age, password) VALUES (?, ?, ?, ?, ?)";

                try {
                    $query = $this->db->prepare($sql);
                    $query->execute(array($DNI, $nombre, $apellidos, $edad, password_hash($password, PASSWORD_DEFAULT)));
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }

                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $this->db->lastInsertId();
                $_SESSION["DNI"] = $DNI;
                $_SESSION["role"] = $role;

                // Redirect user to welcome page
                header("location: index.php?controller=Usuario&action=studentPanel");
            } else {
                //print all errors
                echo "<div style='margin-top:150px;'>";
                echo $DNI_err." ";
                echo $password_err. " ";
                echo $confirm_password_err . " ";
                echo $nombre_err . " ";
                echo $apellidos_err . " ";
                echo $edad_err . " ";
                echo "</div>";
            }

            // Close connection
            unset($query);
        }
    }
}

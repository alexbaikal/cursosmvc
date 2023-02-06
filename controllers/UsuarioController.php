<?php
class UsuarioController
{
    //El controller tiene las diferentes acciones que se pueden hacer 
    public function mostrarInicio()
    {
    }

    public function studentLoginStart()
    {
        // Check if the user is already logged in, if yes then redirect him to welcome page
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["role"] === "student") {
            header("location: index.php?controller=Usuario&action=studentPanel");
            exit;
        } else {
            require_once "views/usuarios/studentLogin.php";
        }
    }

    public function studentLogin()
    {

        // Check if the user is already logged in, if yes then redirect him to welcome page
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["role"] === "student") {
            header("location: index.php");
            exit;
        }

        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
            $DNI = isset($_POST['DNI']) ? $_POST['DNI'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            $errores = array();
            if (empty($DNI)) {
                $errores['DNI'] = "El DNI está vacío";
            }
            if (empty($password)) {
                $errores['password'] = "La contraseña está vacía";
            }
            if (count($errores) == 0) {
                require_once "./models/usuario.php";
                $login_result = "";
                $usuario = new Usuario();
                $usuario->setDNI($DNI);
                $usuario->setPassword($password);
                $login_result = $usuario->studentLogin();
                echo $login_result;
                //after 3 seconds redirect to index.php?controller=Usuario&action=mostrarTodos if $login_result is not "Contraseña incorrecta" or "Usuario no encontrado"
                if ($login_result != "Contraseña incorrecta" && $login_result != "Usuario no encontrado.") {
                    header("refresh:3;url=index.php?controller=Usuario&action=studentPanel");
                } else {
                    header("refresh:3;url=index.php?controller=Usuario&action=studentLoginStart");
                }
            } else {
                //echo all errors
                foreach ($errores as $error) {
                    echo $error . "<br>";
                    //after 3 seconds redirect to index.php?controller=Usuario&action=loginUsuario
                    header("refresh:3;url=index.php?controller=Usuario&action=studentLoginStart");
                }

                //header("Location: index.php?controller=Usuario&action=loginUsuario");
            }
        }
    }

    public function studentRegister()
    {
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["role"] === "student") {
            header("location: index.php?controller=Usuario&action=studentPanel");
            exit;
        } else {

            if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
                $DNI = isset($_POST['DNI']) ? $_POST['DNI'] : false;
                $name = isset($_POST['name']) ? $_POST['name'] : "";
                $surname = isset($_POST['surname']) ? $_POST['surname'] : false;
                $age = isset($_POST['age']) ? $_POST['age'] : false;
                $password = isset($_POST['password']) ? $_POST['password'] : false;
                $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : false;
                $errores = array();
                if (empty($DNI)) {
                    $errores['DNI'] = "El DNI está vacío";
                }
                if (empty($name)) {
                    $errores['nombre'] = "El nombre está vacío";
                }
                if (empty($surname)) {
                    $errores['surname'] = "Los apellidos están vacíos";
                }
                
                if (empty($password)) {
                    $errores['password'] = "La contraseña está vacía";
                }
                if (empty($age)) {
                    $errores['age'] = "La edad está vacía";
                }
                if (count($errores) == 0) {
                    require_once "./models/usuario.php";
                    $usuario = new Usuario();
                    $usuario->setDNI($DNI);
                    $usuario->setNombre($name);
                    $usuario->setApellidos($surname);
                    $usuario->setEdad($age);
                    $usuario->setPassword($password);
                    $usuario->setRole("student");
                    $usuario->studentRegister();
                    //after 3 seconds redirect to index.php?controller=Usuario&action=mostrarTodos if $register_result is not "El usuario ya existe"
                    
                } else {
                    //echo all errors
                    echo "<div style='margin-top: 150px;'>";
                    foreach ($errores as $error) {
                        echo $error . "<br>";
                        //after 3 seconds redirect to index.php?controller=Usuario&action=loginUsuario
                        //header("refresh:3;url=index.php?controller=Usuario&action=studentRegister");
                    }
                    echo "</div>";

                    //header("Location: index.php?controller=Usuario&action=loginUsuario");
                }
            } else {
                $DNI = $name = $surname = $age = $password = $confirm_password = $upload_image = $tmp_upload_image = "";
                $DNI_err = $name_err = $surname_err = $age_err = $password_err = $confirm_password_err = $upload_image_err = "";
            }


            require_once "views/usuarios/studentRegister.php";
        }
    }


    public function studentPanel()
    {
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["role"] === "student") {
            require_once "views/usuarios/studentPanel.php";
        } else {
            header("location: index.php?controller=Usuario&action=studentLoginStart");
        }
    }




    public function registrarUsuario()
    {
        require_once "views/usuarios/registrarUsuario.php";
    }

    public function loginUsuario()
    {
        require_once "views/usuarios/loginUsuario.php";
    }

    


    


    public function logout()
    {
        // remove all session variables
        session_unset();
        // destroy the session 
        session_destroy();
        header("Location: index.php");
    }

    public function modificar()
    {
        echo "Estoy en modificar";
    }
    public function eliminar()
    {
        echo "Estoy en eliminar";
    }


}

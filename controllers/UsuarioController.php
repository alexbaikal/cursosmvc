<?php
class UsuarioController{
    //El controller tiene las diferentes acciones que se pueden hacer 
    public function mostrarInicio(){

    }

    public function studentLoginStart() {
        // Check if the user is already logged in, if yes then redirect him to welcome page
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["role"] === "student") {
            header("location: index.php?controller=Usuario&action=studentPanel");
            exit;
        } else {
            require_once "views/usuarios/studentLogin.php";
        }
    }

    public function studentLogin() {

        // Check if the user is already logged in, if yes then redirect him to welcome page
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["role"] === "student") {
            header("location: index.php");
            exit;
        }

        if (isset($_POST)) {
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
                        echo $error."<br>";
                        //after 3 seconds redirect to index.php?controller=Usuario&action=loginUsuario
                        header("refresh:3;url=index.php?controller=Usuario&action=studentLoginStart");
                    }
                    
                    //header("Location: index.php?controller=Usuario&action=loginUsuario");
                }
            } else {
                echo "Hubo un error con el método POST";
                //header("Location: index.php?controller=Usuario&action=loginUsuario");
            }
            
        }


        public function studentPanel() {
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["role"] === "student") {
                require_once "views/usuarios/studentPanel.php";
            } else {
                header("location: index.php?controller=Usuario&action=studentLoginStart");
            }
        }
    



    public function registrarUsuario(){
        require_once "views/usuarios/registrarUsuario.php";
    }

    public function loginUsuario() {
        require_once "views/usuarios/loginUsuario.php";
    }

    public function login() {
   
        
        if (isset($_POST)) {
            $email = isset($_POST['correo']) ? $_POST['correo'] : false;
            $password = isset($_POST['contrasena']) ? $_POST['contrasena'] : false;
            $errores = array();
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = "El email no es válido";
            }
            if (empty($password)) {
                $errores['password'] = "La contraseña está vacía";
            }
            if (count($errores) == 0) {
                require_once "./models/usuario.php";
                $usuario = new Usuario();
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                $login_result = $usuario->loginUsuario();
                echo $login_result;
                //after 3 seconds redirect to index.php?controller=Usuario&action=mostrarTodos if $login_result is not "Contraseña incorrecta" or "Usuario no encontrado"
                if ($login_result != "Contraseña incorrecta" && $login_result != "Usuario no encontrado") {
                    header("refresh:3;url=index.php?controller=Usuario&action=mostrarTodos");               
                } else {
                    header("refresh:3;url=index.php?controller=Usuario&action=loginUsuario");
                }
                } else {
                    //echo all errors
                    foreach ($errores as $error) {
                        echo $error."<br>";
                        //after 3 seconds redirect to index.php?controller=Usuario&action=loginUsuario
                        header("refresh:3;url=index.php?controller=Usuario&action=loginUsuario");
                    }
                    
                    //header("Location: index.php?controller=Usuario&action=loginUsuario");
                }
            } else {
                echo "Hubo un error con el método POST";
                //header("Location: index.php?controller=Usuario&action=loginUsuario");
            }
            
        }
    


    public function alta(){
       if (isset($_POST)){
        //Falta acabar
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
        $correo = isset($_POST['correo']) ? $_POST['correo'] : false;
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
        $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : false;
        $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
        $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
        $cp = isset($_POST['cp']) ? $_POST['cp'] : false;
        $fecha = date("Y-m-d");
        $errores = array();
        if (empty($nombre) || is_numeric($nombre) || preg_match("/[0-9]/", $nombre)){
            $errores['nombre'] = "El nombre no es válido";
        }
        if (empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $errores['correo'] = "El correo no es válido";
        }
        if (empty($telefono) || !is_numeric($telefono)){
            $errores['telefono'] = "El teléfono no es válido.";
        }
        if (empty($contrasena)){
            $errores['contrasena'] = "La contraseña está vacía.";
        }
        if (empty($direccion)){
            $errores['direccion'] = "La dirección está vacía.";
        }
        if (empty($provincia)){
            $errores['provincia'] = "La provincia está vacía.";
        }
        if (empty($cp) || !is_numeric($cp)){
            $errores['cp'] = "El código postal no es válido.";
        }
        if (count($errores) == 0){
            require_once "models/usuario.php";
            $usuario = new Usuario();
            $usuario->setUsername($nombre);
            $usuario->setPassword($contrasena);
            $usuario->setEmail($correo);
            $usuario->setPhone($telefono);
            $usuario->setAddress($direccion);
            $usuario->setProvince($provincia);
            $usuario->setCp($cp);
            $usuario->conectar();
            echo "".$usuario->registrarUsuario();
            //wait 3 seconds and go to controller=Usuario&action=mostrarTodos
            header("refresh:3;url=index.php?controller=Usuario&action=mostrarTodos");
        }else{
            //echo the errors
            foreach ($errores as $error){
                echo "<br>".$error;
            }
            //wait 3 seconds and go to controller=Usuario&action=registrar
            header("refresh:3;url=index.php?controller=Usuario&action=registrar");
        }
       }  

    }


    public function logout() {
        // remove all session variables
        session_unset(); 
        // destroy the session 
        session_destroy(); 
        header("Location: index.php?controller=Usuario&action=mostrarTodos");
    }

    public function modificar(){
       echo "Estoy en modificar";
    }  
    public function eliminar(){
        echo "Estoy en eliminar";
    }  

    public function iniciarModificarUsuario() {
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            require_once "models/usuario.php";
            $usuario = new Usuario();
            $usuario->setUserId($user_id);
            $usuario->conectar();
            $usuario->mostrarUsuario();
        } else {
            echo "No se ha recibido el id del usuario";
        }
    }

    //get user data from $_POST and update the database
    function modificarUsuario() {
        if (isset($_POST)) {
            require_once "models/usuario.php";
            $usuario = new Usuario();
            $usuario->setUsername($_POST['nombre']);
            $usuario->setPhone($_POST['telefono']);
            $usuario->setAddress($_POST['direccion']);
            $usuario->setProvince($_POST['provincia']);
            $usuario->setCp($_POST['cp']);
            $usuario->setUserId($_POST['user_id']);
            $usuario->conectar();

            $usuario->modificarUsuario();
            }
    }

}

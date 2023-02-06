<!--Controlador frontal: fichero que se encarga de cargarlo absolutamente todo -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/admin.css">
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/studentLogin.css">
    <link rel="stylesheet" href="./views/usuarios/componentes/styles/studentPanel.css">
    <link rel="stylesheet" href="./views/usuarios/componentes/styles/studentLogin.css">

    <title>InfoBDN</title>
</head>
<body>
<?php 
// Initialize the session
session_start();

require_once "autoload.php";

/*
if (isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $role = $_SESSION['role'];
    require_once "./models/usuario.php";
    $usuario = new Usuario();
    $nombre_usuario = $usuario->getNombreUsuario($user_id);
}
*/


if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["role"] === "student") {
    require_once "views/usuarios/componentes/sidebarEstudiante.html";
}
require_once "views/general/cabecera.html";






if (isset($_GET['controller'])){
    $nombreController = $_GET['controller']."Controller";
}
else{
    //Controlador per dedecte
    $nombreController = "UsuarioController";
}
if (class_exists($nombreController)){
    $controlador = new $nombreController();
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }
    else{
        require_once "./models/usuario.php";
        $usuario = new Usuario();

        $usuario->mostrarInicio();

        $action ="mostrarInicio";
    }
    $controlador->$action();   
}else{

    echo "No existe el controlador";
}
require_once "views/general/pie.html";
?>
</body>
</html>



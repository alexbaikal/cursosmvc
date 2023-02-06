<?php
require_once("models/database.php");

class Login extends Database
{
    private $id_usuario;

    function getIdUsuario()
    {
        return $this->id_usuario;
    }

    function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    function conectar()
    {
        $this->db->query("SET NAMES 'utf8'");
    }
}
?>
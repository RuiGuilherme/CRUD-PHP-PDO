<?php
require_once ('php\Model\UsuariosDAO.php');

class Usuario {
    public $idnome;
    public $idmail;
    public $idsenha;
    public static $lasterror;
    function __construct()
    {
        $this->DAO = new UsuariosDAO();
        return;
    }
    public function Insert($User){
        return $this->DAO->Insert($User);
    }

    public function Select($User){
        return $this->DAO->Select($User);
    }

    public function Update($User){
        return $this->DAO->Update($User);
    }

    public function Delete($User){
        return $this->DAO->Delete($User);
    }
}
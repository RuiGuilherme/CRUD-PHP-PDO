<?php
require_once ('Conexao.php');
require_once ('php\Controller\Usuario.php');
require_once ('Sessionmanager.php');

class UsuariosDAO
{
    function __construct()
    {
        $this->con = new Conexao();
        $this->session = new SessionManager();
        $this->pdo = $this->con->Connect();
    }

    function Insert($User) {
        try{
            $options = ['cost' => 11];
            $stmt = $this->pdo->prepare("INSERT INTO users (idnome, idmail, idsenha) VALUES (:idNome, :idMail, :idSenha)");
            $param = array(
                    ":idNome" => stripslashes($User->idnome),
                    ":idMail" => stripslashes($User->idmail),
                    ":idSenha" => password_hash($User->idsenha, PASSWORD_BCRYPT, $options)
            );
            $stmt->execute($param);
            return true;
        }
        catch (PDOException $ex){
			//Caso o debug não funfe: $ex->getMessage();
            return false;
        }
    }

    function Select($User){
        try {
            $this->user = new Usuario();
            $stmt = $this->pdo->prepare("SELECT idsenha FROM users WHERE idmail = :idMail");
            $stmt->bindValue(':idMail', stripslashes($User->idmail), PDO::PARAM_STR);
            $stmt->execute();
            $userbd = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0){
                if (password_verify($User->idsenha, $userbd['idsenha'])){
						$this->session->sessionStart($userbd['idmail']);
                    return true;
                }
                else {
                    $this->user::$lastError = "Senha incorreta, tente novamente!";
                }
            }
            else {
                $this->user::$lastError = "Este e-mail não foi registrado, tente novamente!";
            }
			return false;
        }
        catch (PDOException $ex) {
            //Caso o debug não funfe: $ex->getMessage();
            return false;
        }
    }
	
    public function Update($User) {
        try {
            $stmt = $this->pdo->prepare("UPDATE users SET idnome= :idNome, idmail= :idMail WHERE idmail = ".stripslashes($User->idmail)."");
                    $stmt->bindParam(":idNome", stripslashes($User->idNome), PDO::PARAM_STR);
                    $stmt->bindParam(":idMail", stripslashes($User->idmail), PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }
        catch (PDOException $ex) {
			//Caso o debug não funfe: $ex->getMessage();
            return false;
        }
    }    	

    public function Delete($User) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM users WHERE idmail = :idMail");
                    $stmt->bindParam(":idMail", stripslashes($User->idmail), PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }
        catch (PDOException $ex) {
			//Caso o debug não funfe: $ex->getMessage();
            return false;
        }
    }   	
}
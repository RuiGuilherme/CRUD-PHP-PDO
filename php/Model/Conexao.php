<?php
/**
 * Conexao short summary.
 *
 * Conexao description.
 *
 * @version 1.0
 * @author Rui
 */
date_default_timezone_set('America/Sao_Paulo');

class Conexao
{

    private $user;

    private $pass;

    private $host;

    private $base;

    private $file;

    public $pdo;

    public function Connect() {
        try{
            $this->user = "root";   
            $this->pass = "";
            $this->host = "localhost";
            $this->base = "localbase";
            $parametros = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8");
            $this->file = "mysql:host=" . $this->host . ";dbname=" . $this->base;
            $this->pdo = new PDO($this->file, $this->user, $this->pass, $parametros);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->pdo->setAttribute(PDO::ATTR_PERSISTENT, true);
            $this->pdo->setAttribute(PDO::NULL_EMPTY_STRING, true);
            //return $this->pdo;
        }
        catch(PDOException $ex){
			//echo $ex->getMessage();
			//return false
        }
    }
}
<?php

class DbConnect {
    private $pdo;
    private $dsn_mysql ="mysql:host=localhost;dbname=nice25;charset=utf8";
    private $user = "root";
    private $password = "";
    public function connect() { 
      try{
           $this->pdo = new PDO($this->dsn_mysql, $this->user, $this->password);
      } catch(PDOException $e){
           die('Cound not connection to database because:'. $e->getMessage());
      }  
      return $this->pdo;  
    }                     
}

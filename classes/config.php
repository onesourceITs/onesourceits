<?php
/*
                ** Config class to create connection to one source db **
*/

class Connection {
    private $host = "localhost";
    private $user= "mydba";
    private $pass = "kotajadyqa6em";
    private $dbName= "ositsprojects";

    public function dbConn(){
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "the connection was made successfully!";
            return $conn;
        }
        catch(PDOException $e){
            echo "Error connecting to ".$this->dbName." : ".$e->getMessage();
        }
    }
}


?>
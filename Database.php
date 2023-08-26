<?php

class Database
{
    private $host="localhost:3306";
    private $db_name="psdizajn_korisnici_db";
    private $username="psdizajn_root";
    private $password="#D{5NTXmkqNl";
    private $conn;

    public function connect()
    {
        $this->conn=null;
        try
        {
        $this->conn=new PDO("mysql:host=".$this->host.";dbname=".$this->db_name,$this->username,$this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo "Greška pri spajanju na bazu: ".$e->getMessage();
        }
        return $this->conn;
    }

}


?>
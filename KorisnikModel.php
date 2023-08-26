<?php

include_once "./Database.php";

class KorisnikModel
{
    private $conn;
    private $table="korisnici";

    public function __construct($db)
    {
        $this->conn=$db;
    }

    public function emailPostoji($email)
    {
        //metoda vraća true ili false
        $query="SELECT email FROM ".$this->table." WHERE email=?";
        $stmt=$this->conn->prepare($query);
        $stmt->bindParam(1,$email);
        $stmt->execute();

        if ($stmt->rowCount()>0)
        {
            return true; //mail već postoji u bazi
        }
        else{
            return false; //mail ne postoji u bazi
        }
    }

}



?>
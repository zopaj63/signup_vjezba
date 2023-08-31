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


}



?>
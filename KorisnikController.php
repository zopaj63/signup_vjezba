<?php

include_once "./Registracija.php";

class KorisnikController
{
    private $model;

    public function __construct()
    {
        $database=new Database();
        $db=$database->connect();
        $this->model=new KorisnikModel($db);
    }

    public function prikaziRegistraciju()
    {
        include "Registracija.php";
    }
}



?>
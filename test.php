<?php

include_once "./Database.php";
include_once "./KorisnikModel.php";

$database=new Database();
$db=$database->connect();

$korisnikModel=new KorisnikModel($db);

$testEmail="zoran.pajnic@ege.hr";

if ($korisnikModel->emailPostoji($testEmail))
{
    echo "Mail postoji\n";
}
else
{
    echo "Mail ne postoji\n";
}




?>
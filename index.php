<?php

    require "autoload.php";

    $config=new Config("config.ini");
    $db=Database::getInstance($config);
    $conn=$db->getConnection();

    if ($conn)
    {
        echo "Uspješno spajanje na bazu";
    }
    else
    {
        echo "Spoj nije uspio";
    }



?>
<?php

namespace Voldre\Blog\Model;

// Precise you're using PDO Class; because it's not a function in Manager class!
use \PDO;
//PDO in namespace on the root

abstract class Manager
{
    protected function DB_connect()
    {   
        $db = new  PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
        return $db; // Don't forget to return the db variable
    }
}

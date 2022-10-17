<?php

class Bdd
{
    private $bdd;

    function __construct(){
        try
        {
            $this->bdd = new PDO('mysql:host=localhost;dbname=projet_lprs;charset=utf8', 'root', '');
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e)
        {
            die('Error : ' . $e->getMessage());
        }
    }

    public function getBdd()
    {
        return $this->bdd;
    }
}
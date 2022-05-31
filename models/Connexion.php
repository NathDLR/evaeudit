<?php

class Connexion
{
    private static $db;

    private static function setConnexion(){

        //self::$db = new PDO('mysql:dbname=audit;host=127.0.0.1','root','',  array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        self::$db = new PDO('mysql:dbname=audit;host=localhost','root','', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    public static function getConnexion(){
        if(self::$db == null){
            self::setConnexion();
        }
        return self::$db;
    }
}
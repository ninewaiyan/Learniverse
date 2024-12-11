<?php

class Database{
    // requirment-localhost,port,username,password,dbname
    static $host="localhost";
    static $username="root";
    static $password="1234";
    static $dbname="learniversedb";
    static $connection;


    public static function connect(){
        try{
            if(self::$connection==null){
                self::$connection =new PDO("mysql:host=".self::$host.";port=3306;dbname=".self::$dbname,self::$username,self::$password);
                return self::$connection;
            } 
            return self::$connection;          
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public static function disconnect(){
        self::$connection=null;
    }
}

?>
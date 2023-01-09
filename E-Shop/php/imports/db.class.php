<?php
class DB {

    protected static $instance;

    protected function __construct() {}

    public static function getInstance() {

        if(empty(self::$instance)) {

            $db_info = array(
                "db_host" => "db.mp.spse-net.cz",
                "db_user" => "kasalpe18",
                "db_pass" => "hadobycyluho",
                "db_name" => "kasalpe18_1",
                "db_charset" => "UTF-8");

            try {
                self::$instance = new PDO("mysql:host=".$db_info['db_host'].';dbname='.$db_info['db_name'], $db_info['db_user'], $db_info['db_pass']);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);  
                self::$instance->query('SET NAMES utf8');
                self::$instance->query('SET CHARACTER SET utf8');

            } catch(PDOException $error) {
                echo $error->getMessage();
            }

        }
        return self::$instance;
    }
}

?>
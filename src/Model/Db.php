<?php

class Db extends PDO{

    public function __construct() {
        $config = [
            'type' => 'mysql',
            'dbname' => 'twitter',
            'login' => 'root',
            'pass' => 'coderslab',
            'charset' => 'utf8',
            'host' => 'localhost'
        ];

        parent::__construct("{$config['type']}:host={$config['host']};dbname={$config['dbname']}", $config['login'], $config['pass'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$config['charset']}"));
    }
}



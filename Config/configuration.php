<?php
CONST URLS =  array(
        'jquery' => 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js',
        'directory' => '/PHP_Rush_MVC/'
    );
CONST FOLDERS =  array(
        'controllers' => 'Controllers/',
        'views' => 'Views/',
        'models' => 'Models/'
    );
CONST DATABASE = array(
        'name' => 'MVC_Rush',
        'user' => 'root',
        'password' => 'root',
        'type' => 'mysql',
        'host' => '127.0.0.1',
        'charset' => 'utf8',
        'port' => '3306',
        'options' => array (
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => true
        )
    );



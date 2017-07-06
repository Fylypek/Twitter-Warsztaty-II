<?php

// autoloader
require 'src/Model/Db.php';
require 'src/Model/Session.php';
require 'src/Model/Router.php';
require 'src/Model/Action.php';


$url = $_SERVER['PHP_SELF'];

$router = new Router($url);



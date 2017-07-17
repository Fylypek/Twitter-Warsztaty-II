<?php


// autoloader
require 'src/Model/Db.php';
require 'src/Model/Session.php';
require 'src/Model/Router.php';
require 'src/Model/Action.php';
require 'src/Model/ActionLogin.php';
require 'src/Model/ActionNoNRender.php';
require 'src/Model/Record.php';
require 'src/Model/View.php';


require 'src/Record/Users.php';
require 'src/Record/Tweets.php';

$url = $_SERVER['PHP_SELF'];

$router = new Router($url);


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
    <head>
            <title>Tweeter</title>
    </head>
    
    <body>
        <h1>Twitter</h1>
        <h2>Witaj użytkowniku</h2>
        
        
        <form action="" method="POST">
            <input type="submit" name="wyloguj" value="Wyloguj">
        </form>
        
    </body>
</html>


<?php

// autoloader
require 'Db.php';
require 'Session.php';

Session::init();
$db = new Db();

if(!empty($_POST['wyloguj']))
{
    $sessionId = Session::get('sessionId');
    $sql = "UPDATE users SET sessionId=null where sessionId='$sessionId'";
    $db->query($sql);
    
    Session::set('sessionId', null);
    
    
    header('Location: http://localhost/Twitter-Warsztaty-II/index.php');
}




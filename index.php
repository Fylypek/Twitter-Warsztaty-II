<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
    <head>
        
            <title>Tweeter</title>
    </head>
    
    <body>
        <h1>Twitter</h1>
        
        
        <div>
            <h2>
                Logowanie
            </h2>
            <form action="" method="POST">
                <input name="login" type="text" placeholder="Login"/>
                <input name="password" type="password" placeholder="Hasło"/>
                <input type="submit" name="zaloguj" value="Zaloguj"/>
            </form>            
        </div>
        
        
        <div>
            <h2>
                Rejestracja
            </h2>
            <form action="" method="POST">
                <input name="login" type="text" placeholder="Login"/>
                <input name="password" type="password" placeholder="Hasło"/>
                <input name="imie" type="text" placeholder="Imię"/>
                <input name="nazwisko" type="text" placeholder="Nazwisko"/>
                <input name="email" type="email" placeholder="E-mail"/>
                <input type="submit" name="zarejestruj" value="Zarejestruj"/>
            </form>            
        </div>
    </body>
</html>


<?php

// autoloader
require 'Db.php';
require 'Session.php';

Session::init();
$db = new Db();


if(!empty(Session::get('sessionId')))
{
    $sessionId = Session::get('sessionId');
    $select = $db->query("SELECT * FROM users where sessionId='$sessionId'");
    $users = $select->fetchAll();
    
    if(!empty($users))
    {
        header('Location: http://localhost/Twitter-Warsztaty-II/stronaGlowna.php');
    }
}

if(!empty($_POST['zaloguj']))
{
    $login = $_POST['login'];
    $password = $_POST['password'];
    
    $login = $db->quote($login);
    $password = sha1($password);
    
    $select = $db->query("SELECT * FROM users where login=$login and password='$password'");
    $users = $select->fetchAll();
    
    if(!empty($users))
    {
        
        $sessionId = sha1(date("YmdHis"));
        
        $sql = "UPDATE users SET sessionId='$sessionId' where id={$users[0]['id']}";
        $db->query($sql);
        
        Session::set('sessionId', $sessionId);
        
        header('Location: http://localhost/Twitter-Warsztaty-II/stronaGlowna.php');
    }
    else {
        echo "Błędne hasło<br>";
    }
    
}      

if(!empty($_POST['zarejestruj']))
{
    die(var_dump('zarejestruj', $_POST));
}

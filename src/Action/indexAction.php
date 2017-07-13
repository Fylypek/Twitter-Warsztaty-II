<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of indexAction
 *
 * @author fylypek
 */
class indexAction extends Action
{
    public function onAction()
    {
        if(!empty(Session::get('sessionId')))
        {
            $sessionId = Session::get('sessionId');
//            $select = $this->db->query("SELECT * FROM users where sessionId='$sessionId'");
//            $users = $select->fetchAll();

            $users = Users::select("sessionId='$sessionId'");
            
            if(!empty($users))
            {
                $baseUrl = Router::$baseUrl;
                header("Location: {$baseUrl}/login/main");
            }
        }

        if(!empty($_POST['zaloguj']))
        {
            $login = $_POST['login'];
            $password = $_POST['password'];

            $login = Record::getDb()->quote($login);
            $password = sha1($password);

            
            
//            $select = $this->db->query("SELECT * FROM users where login=$login and password='$password'");
            $user = Users::selectOne("login=$login and password='$password'"); //$select->fetchAll();

            if(!empty($user))
            {

                $sessionId = sha1(date("YmdHis"));

//                $sql = "UPDATE users SET sessionId='$sessionId' where id={$users[0]['id']}";
//                $this->db->query($sql);
                $user->setSessionId($sessionId);
                
//                die(var_dump($user));
                
                $user->save();
                
                Session::set('sessionId', $sessionId);

                $baseUrl = Router::$baseUrl;
                header("Location: {$baseUrl}/login/main");
            }
            else {
                echo "Błędne hasło<br>";
            }

        }      

        if(!empty($_POST['zarejestruj']))
        {
            die(var_dump('zarejestruj', $_POST));
        }        
    }
}

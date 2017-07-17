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
    
    public function permission()
    {
        if(!empty(Session::get('sessionId')))
        {
            $sessionId = Session::get('sessionId');

            $users = Users::select("sessionId='$sessionId'");
            
            if(!empty($users))
            {
                $baseUrl = Router::$baseUrl;
                header("Location: {$baseUrl}/login/main");
            }
        }        
    }
    
    public function onAction()
    {
        if(!empty($_POST['zaloguj']))
        {
            $login = $_POST['login'];
            $password = $_POST['password'];

            $login = Record::getDb()->quote($login);
            $password = sha1($password);

            $user = Users::selectOne("login=$login and password='$password'"); //$select->fetchAll();
            
            if(!empty($user))
            {

                $sessionId = sha1(date("YmdHis"));

                $user->setSessionId($sessionId);
                
                $user->save();
                
                Session::set('sessionId', $sessionId);

                $baseUrl = Router::$baseUrl;
                header("Location: {$baseUrl}/login/main");
            }
            else 
            {
                $this->view->message = "Błędne hasło";
            }
        }      

        if(!empty($_POST['zarejestruj']))
        {
            $login = $_POST['login'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $user = new Users();
            
            $user->setEmail($email);
            $user->setLogin($login);
            $user->setPassword(sha1($password));
            
            $user->save();
            
            $this->view->message = "Zarejestrowano";
        }        
    }
}

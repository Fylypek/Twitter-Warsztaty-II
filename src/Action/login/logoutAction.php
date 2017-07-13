<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of logoutAction
 *
 * @author fylypek
 */
class logoutAction extends ActionNoNRender
{
    public function onAction() 
    {
        if(!empty($_POST['wyloguj']))
        {
            $sessionId = Session::get('sessionId');
            
            $user = Users::selectOne("sessionId='$sessionId'");

            $user->setSessionId(null);
            $user->save();
            
            Session::set('sessionId', null);

            $baseUrl = Router::$baseUrl;
            header("Location: {$baseUrl}");
        }
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ActionLogin
 *
 * @author fylypek
 */
abstract class ActionLogin extends Action
{ 
    public function permission()
    {
        if(empty(Session::get('sessionId')))
        {
            $baseUrl = Router::$baseUrl;
            header("Location: {$baseUrl}/");
        }
        else
        {
            $sessionId = Session::get('sessionId');

            $users = Users::select("sessionId='$sessionId'");
            
            if(empty($users))
            {
                $baseUrl = Router::$baseUrl;
                header("Location: {$baseUrl}/");
            }
        }        
    }
    
    public function render()
    {
        $this->view->render();
    }    
}

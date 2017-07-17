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
    protected $user;
    
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

            $user = Users::selectOne("sessionId='$sessionId'");
            
            if(empty($user))
            {
                $baseUrl = Router::$baseUrl;
                header("Location: {$baseUrl}/");
            }
           
            $this->user = $user;
        }        
    }
    
    public function render()
    {
        $this->view->render();
    }    
}

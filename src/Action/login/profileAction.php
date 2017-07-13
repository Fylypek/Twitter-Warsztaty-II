<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of profileAction
 *
 * @author fylypek
 */
class profileAction extends ActionLogin
{
    public function onAction() 
    {
        $sessionId = Session::get('sessionId');
        $user = Users::selectOne("sessionId='$sessionId'");
        
        $this->view->user = $user;
        
        if(!empty($_POST['save']))
        {
            $user->setLogin($_POST['login']);
            $user->setPassword(sha1($_POST['password']));
            $user->setEmail($_POST['email']);
            
            $user->save();
        }
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sendTwitterAction
 *
 * @author fylypek
 */
class sendTwitterAction extends ActionNoNRender
{
    public function onAction() 
    {    
        if(!empty($_POST['send']))
        {
            $tweet = new Tweets();
            $tweet->setText($_POST['text']);
            $tweet->setUserId($this->user->getId());
            $tweet->save();
        }  
        
        $baseUrl = Router::$baseUrl;
        header("Location: {$baseUrl}/login/main");
    }
}

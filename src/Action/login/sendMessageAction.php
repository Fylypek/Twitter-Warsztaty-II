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
class sendMessageAction extends ActionNoNRender
{
    public function onAction() 
    {    
        if(!empty($_POST['send']))
        {
            $message = new Messages();
            $message->setAuthorId($this->user->getId());
            $message->setRecipientId($_POST['recipientId']);
            $message->setStatus(1);
            $message->setText($_POST['text']);
            $message->save();
        }  
        
        $baseUrl = Router::$baseUrl;
        header("Location: {$baseUrl}/login/message");
    }
}

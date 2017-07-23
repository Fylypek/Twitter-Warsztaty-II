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
class sendCommentAction extends ActionNoNRender
{
    public function onAction() 
    {
        if(!empty($_POST['send']))
        {
            $comment = new Comments();
            
            $comment->setText($_POST['comment']);
            $comment->setTweetId($_POST['tweetId']);
            $comment->setUserId($this->user->getId());
            
            $comment->save();
            
            $baseUrl = Router::$baseUrl;
            header("Location: {$baseUrl}");
        }
    }
}

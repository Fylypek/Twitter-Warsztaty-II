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
class messageAction extends ActionLogin
{
    public function onAction() 
    {
        $users = Users::select();
        $this->view->users = $users;
        
        if(!empty($_POST['submitUser'])){
            $recipientId = $_POST['userId'];
            Session::set('recipientId', $recipientId);
        }
        
        $recipientId = Session::get('recipientId');
        
        $this->view->recipientId = $recipientId;
        
        if(!empty($recipientId)){
            
            $limit = 5;
            if(!empty($_POST['moreMessages']))
            {
                $limit = $_POST['limit'] + 5;    
            }         
            $this->view->limit = $limit;
            
            $where = " (authorId = '{$this->user->getId()}' AND recipientId = '$recipientId') OR ( recipientId =  '{$this->user->getId()}' AND authorId = '$recipientId') ";
            
            $messages = Messages::select($where, ' creationDate DESC', $limit);
            
            
            foreach($messages as $message){
                if($message->getAuthorId() != $this->user->getId()){
                    $message->setStatus('2');
                    $message->save();
                }
                
            }
            
            
            $this->view->messages = $messages;
        }
        

    }
}

<?php

/**
 * Description of mainAction
 *
 * @author fylypek
 */
class mainAction extends ActionLogin
{
    public function onAction() 
    {
        $limit = 5;
        if(!empty($_POST['moreTweets']))
        {
            $limit = $_POST['limit'] + 5;    
        } 
        
        $tweets = Tweets::select(null,'creationDate DESC', $limit);
        
        foreach($tweets as $tweet)
        {
            $tweet->author = Users::selectOne("id = {$tweet->getUserId()}");
        }
        
        $this->view->limit = $limit;
        $this->view->tweets = $tweets;
        
        if(!empty($_POST['comment']))
        {
            $this->view->comment = true;
        }
        
        
    }
}

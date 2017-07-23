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
        if(!empty($_POST['hidden']))
        {
            Session::set('showComments', null);
            Session::set('tweetId', null);
        }
        
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
            Session::set('showComments', true);
            Session::set('tweetId', $_POST['tweetId']);

        }
        if(Session::get('showComments'))
        {
            $this->view->tweetId = Session::get('tweetId');
            $this->view->comments = Comments::select("tweetId = ". Record::getDb()->quote(Session::get('tweetId')));
        }
        
    }
}

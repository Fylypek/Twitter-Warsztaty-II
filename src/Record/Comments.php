<?php

class Comments extends Record
{
    private $id;
    private $userId;
    private $userName;
    private $tweetId;
    private $text;
    private $creationDate;
    
    public function __construct() {
        $this->id = -1;
        $this->userId = "";
        $this->userName = "";
        $this->tweetId = "";
        $this->text = "";
        $this->creationDate = "";
    }
    
    function getId() {
        return $this->id;
    }
    function getUserId() {
        return $this->userId;
    }
    function getUserName() {
        return $this->userName;
    }
    function getTweetId() {
        return $this->tweetId;
    }
    function getText() {
        return $this->text;
    }
    function getCreationDate() {
        return $this->creationDate;
    }
    
    function setUserId($userId) {
        $this->userId = $userId;
    }
    function setTweetId($tweetId) {
        $this->tweetId = $tweetId;
    }
    function setText($text) {
        $this->text = $text;
    }
    function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }
    
    public function save()
    {
        $id = $this->getId();
        $userId = $this->getUserId();
        $userName = $this->getUserName();
        $tweetId = $this->getTweetId();
        $text = $this->getText();
        $creationDate = $this->getCreationDate();
        
        $sql = "UPDATE Comments set userId = $userId, userName = $userName,"
                . " tweetId = $tweetId, text = $text, creationDate = $creationDate where id = $id";
        $this->db->query($sql);
        
    }
    
    
    public static function select($where)
    {
        $sql = "SELECT * FROM comments where $where";
        $select = Record::getDb()->query($sql);
        $comments = $select->fetchAll();
        
        $collection = [];
        
        foreach($comments as $comment)
        {
            $commentObj = new Comments();
            $commentObj->setId($comment['id'])
                    ->setUserId($comment['userId'])
                    ->setUserName($comment['userName'])
                    ->setTweetId($comment['tweetId'])
                    ->setText($comment['text'])
                    ->setCreationDate($comment['creationDate'])
            ;
            
            $collection[] = $commentObj; 
        }
        return $collection;
    }
    
    public static function selectOne($where)
    {
        $sql = "SELECT * FROM comments where $where";
        $select = Record::getDb()->query($sql);
        $comments = $select->fetchAll();
        
        $collection = [];
        
        foreach($comments as $comment)
        {
            $commentObj = new Comments();
            $commentObj->setId($comment['id'])
                    ->setUserId($comment['userId'])
                    ->setUserName($comment['userName'])
                    ->setTweetId($comment['tweetId'])
                    ->setText($comment['text'])
                    ->setCreationDate($comment['creationDate'])
            ;
            
            $collection[] = $commentObj; 
        }
        
        return !empty($collection)?$collection[0]:null;
    }
}

<?php

class Tweets extends Record
{
    private $id;
    private $userId;
    private $userName;
    private $text;
    private $creationDate;
    
    public function __construct() {
        $this->id = -1;
        $this->userId = "";
        $this->userName = "";
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
    function getText() {
        return $this->text;
    }
    function getCreationDate() {
        return $this->creationDate;
    }
    
    function setUserId($userId) {
        $this->userId = $userId;
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
        $text = $this->getText();
        $creationDate = $this->getCreationDate();
        
        $sql = "UPDATE Tweets set userId = $userId, userName = $userName,"
                . " text = $text, creationDate = $creationDate where id = $id";
        $this->db->query($sql);
        
    }
    
    
    public static function select($where)
    {
        $sql = "SELECT * FROM tweets where $where";
        $select = Record::getDb()->query($sql);
        $tweets = $select->fetchAll();
        
        $collection = [];
        
        foreach($tweets as $tweet)
        {
            $tweetObj = new Tweets();
            $tweetObj->setId($tweet['id'])
                    ->setUserId($tweet['userId'])
                    ->setUserName($tweet['userName'])
                    ->setText($tweet['text'])
                    ->setCreationDate($tweet['creationDate'])
            ;
            
            $collection[] = $tweetObj; 
        }
        return $collection;
    }   
}

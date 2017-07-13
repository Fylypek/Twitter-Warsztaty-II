<?php

class Tweets extends Record
{
    private $id;
    private $userId;
//    private $userName;
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
//    function getUserName() {
//        return $this->userName;
//    }
    function getText() {
        return $this->text;
    }
    function getCreationDate() {
        return $this->creationDate;
    }
    
    function setId($id) {
        $this->id = $id;
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
        $id = empty($this->getId())?'null':Record::getDb()->quote($this->getId());
        $userId = empty($this->getUserId())?'null':Record::getDb()->quote($this->getUserId());
        $userName = empty($this->getUserName())?'null':Record::getDb()->quote($this->getUserName());
        $text = empty($this->getText())?'null':Record::getDb()->quote($this->getText());
//        $creationDate = empty($this->getCreationDate())?'null':Record::getDb()->quote($this->getCreationDate());
        
        $tweet = self::selectOne("id = $id");
        
        if(!empty($tweet))
        {        
            $sql = "UPDATE tweets set userId = $userId, userName = $userName, text = $text where id = $id";
            $this->db->query($sql);
        } else 
        {
            $sql = "INSERT INTO tweets (`userId`,`userName`,`text`) VALUES ($userId,$userName,$text)";
            $result = Record::getDb()->query($sql);            
        }
        
        return $result;        
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
    
    public static function selectOne($where)
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
        
        return !empty($collection)?$collection[0]:null;
    }
}

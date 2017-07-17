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
//        $this->userName = "";
        $this->text = "";
        $this->creationDate = "";
    }
    
    public function getId() {
        return $this->id;
    }
    public function getUserId() {
        return $this->userId;
    }
//    function getUserName() {
//        return $this->userName;
//    }
    public function getText() {
        return $this->text;
    }
    public function getCreationDate() {
        return $this->creationDate;
    }
    
    public function setId($id) {
        $this->id = $id;
        return $this;
    }    
    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }
    public function setText($text) {
        $this->text = $text;
        return $this;
    }
    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
        return $this;
    }
    
    public function save()
    {
        $id = empty($this->getId())?'null':Record::getDb()->quote($this->getId());
        $userId = empty($this->getUserId())?'null':Record::getDb()->quote($this->getUserId());
//        $userName = empty($this->getUserName())?'null':Record::getDb()->quote($this->getUserName());
        $text = empty($this->getText())?'null':Record::getDb()->quote($this->getText());
//        $creationDate = empty($this->getCreationDate())?'null':Record::getDb()->quote($this->getCreationDate());
        
        $tweet = self::selectOne("id = $id");
        
        if(!empty($tweet))
        {        
            $sql = "UPDATE tweets set userId = $userId, text = $text where id = $id";
            $this->db->query($sql);
        } else 
        {
            $sql = "INSERT INTO tweets (`userId`,`text`) VALUES ($userId,$text)";
            $result = Record::getDb()->query($sql);            
        }
        
        return $result;        
    }
    
    public static function select($where = null, $order= null, $limit = null)
    {
        if(empty($where))
        {
            $sql = "SELECT * FROM tweets";
        }
        else{
            $sql = "SELECT * FROM tweets where $where";
        }
        
        
        if(!empty($order))
        {
            $sql .= " ORDER BY $order";
        }
        
        if(!empty($limit))
        {
            $sql .= " LIMIT $limit";
        }
        
        $select = Record::getDb()->query($sql);
        $tweets = $select->fetchAll();
        
        $collection = [];
        
        foreach($tweets as $tweet)
        {
//            die(var_dump($tweet));
            $tweetObj = new Tweets();
//            var_dump($tweetObj);
            $tweetObj->setId($tweet['id'])
                    ->setUserId($tweet['userId'])
//                    ->setUserName($tweet['userName'])
                    ->setText($tweet['text'])
                    ->setCreationDate($tweet['creationDate'])
            ;
//            die(var_dump($tweetObj));
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
//                    ->setUserName($tweet['userName'])
                    ->setText($tweet['text'])
                    ->setCreationDate($tweet['creationDate'])
            ;
            
            $collection[] = $tweetObj; 
        }
        
        return !empty($collection)?$collection[0]:null;
    }
}

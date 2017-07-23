<?php

class Comments extends Record
{
    private $id;
    private $userId;
    private $tweetId;
    private $text;
    private $creationDate;
    
    public function __construct() {
        $this->id = -1;
        $this->userId = "";
        $this->tweetId = "";
        $this->text = "";
        $this->creationDate = "";
    }
    
    public function getId() {
        return $this->id;
    }
    public function getUserId() {
        return $this->userId;
    }
    public function getTweetId() {
        return $this->tweetId;
    }
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
    public function setTweetId($tweetId) {
        $this->tweetId = $tweetId;
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
//        $id = $this->getId();
//        $userId = $this->getUserId();
//        $tweetId = $this->getTweetId();
//        $text = $this->getText();
//        $creationDate = $this->getCreationDate();
        
//        $sql = "UPDATE Comments set userId = $userId, userName = $userName,"
//                . " tweetId = $tweetId, text = $text, creationDate = $creationDate where id = $id";
//        $this->db->query($sql);
        
        
        $id = empty($this->getId())?'null':Record::getDb()->quote($this->getId());
        $userId = empty($this->getUserId())?'null':Record::getDb()->quote($this->getUserId());
        $tweetId = empty($this->getTweetId())?'null':Record::getDb()->quote($this->getTweetId());
        $text = empty($this->getText())?'null':Record::getDb()->quote($this->getText());
        
        $comment = self::selectOne("id = $id");
        
        if(!empty($comment))
        {        
            $sql = "UPDATE comments set userId = $userId, tweetId = $tweetId, text = $text where id = $id";
            $this->db->query($sql);
        } else 
        {
            $sql = "INSERT INTO comments (`userId`,`tweetId`,`text`) VALUES ($userId,$tweetId,$text)";
            $result = Record::getDb()->query($sql);            
        }
        
        return $result;
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
                    ->setTweetId($comment['tweetId'])
                    ->setText($comment['text'])
                    ->setCreationDate($comment['creationDate'])
            ;
            
            $collection[] = $commentObj; 
        }
        
        return !empty($collection)?$collection[0]:null;
    }
}

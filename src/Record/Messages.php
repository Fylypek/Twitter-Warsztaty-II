<?php


class Messages extends Record
{
    private $id;
    private $authorId;
    private $recipientId;
    private $text;
    private $creationDate;
    private $status;
    
    public function __construct() {
        $this->id = -1;
        $this->authorId = "";
        $this->recipientId = "";
        $this->text = "";
        $this->creationDate = "";
        $this->status = 0;
    }
    
    public function getId() {
        return $this->id;
    }
    public function getAuthorId() {
        return $this->authorId;
    }
    public function getRecipientId() {
        return $this->recipientId;
    }
    public function getText() {
        return $this->text;
    }
    public function getCreationDate() {
        return $this->creationDate;
    }
    public function getStatus() {
        return $this->status;
    }
    
    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    public function setAuthorId($authorId) {
        $this->authorId = $authorId;
        return $this;
    }
    public function setRecipientId($recipientId) {
        $this->recipientId = $recipientId;
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
    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }
    
    public function save()
    {
//        $id = $this->getId();
//        $authorId = $this->getAuthorId();
//        $recipientId = $this->getRecipientId();
//        $text = $this->getText();
//        $creationDate = $this->getCreationDate();
//        $status = $this->getStatus();
//        
//        $sql = "UPDATE messages set authorId = $authorId, authorName = $authorName, recipientId = $recipientId,"
//                . " recipientName = $recipientName, text = $text, creationDate = $creationDate, status = $status where id = $id";
//        $this->db->query($sql);
        
        
        
        $id = empty($this->getId())?'null':Record::getDb()->quote($this->getId());
        $authorId = empty($this->getAuthorId())?'null':Record::getDb()->quote($this->getAuthorId());
        $recipientId = empty($this->getRecipientId())?'null':Record::getDb()->quote($this->getRecipientId());
        $text = empty($this->getText())?'null':Record::getDb()->quote($this->getText());
        $status = empty($this->getStatus())?'null':Record::getDb()->quote($this->getStatus());
        
        $message = self::selectOne("id = $id");
        
        if(!empty($message))
        {        
            $sql = "UPDATE messages set authorId = $authorId, recipientId = $recipientId, text = $text, status = $status where id = $id";
            $result = Record::getDb()->query($sql);
        } else 
        {
            $sql = "INSERT INTO messages (`authorId`,`recipientId`,`text`,`status`) VALUES ($authorId,$recipientId,$text,$status)";
            $result = Record::getDb()->query($sql);            
        }
        
        return $result;
        
    }
    
    public static function select($where = null, $order= null, $limit = null)
    {
        if(empty($where))
        {
            $sql = "SELECT * FROM messages";
        }
        else{
            $sql = "SELECT * FROM messages where $where";
        }
        
        
        if(!empty($order))
        {
            $sql .= " ORDER BY $order";
        }
        
        if(!empty($limit))
        {
            $sql .= " LIMIT $limit";
        }
//        die($sql);
        $select = Record::getDb()->query($sql);
        $messages = $select->fetchAll();
        
        $collection = [];
        
        foreach($messages as $message)
        {
            $messageObj = new Messages();
            $messageObj->setId($message['id'])
                    ->setAuthorId($message['authorId'])
                    ->setRecipientId($message['recipientId'])
                    ->setText($message['text'])
                    ->setCreationDate($message['creationDate'])
                    ->setStatus($message['status'])
            ;
            
            $collection[] = $messageObj; 
        }
        return $collection;
    }
    
    public static function selectOne($where = null, $order= null, $limit = null)
    {
        if(empty($where))
        {
            $sql = "SELECT * FROM messages";
        }
        else{
            $sql = "SELECT * FROM messages where $where";
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
        $messages = $select->fetchAll();
        
        $collection = [];
        
        foreach($messages as $message)
        {
            $messageObj = new Messages();
            $messageObj->setId($message['id'])
                    ->setAuthorId($message['authorId'])
                    ->setRecipientId($message['recipientId'])
                    ->setText($message['text'])
                    ->setCreationDate($message['creationDate'])
                    ->setStatus($message['status'])
            ;
            
            $collection[] = $messageObj; 
        }
        
        return !empty($collection)?$collection[0]:null;
    }
}

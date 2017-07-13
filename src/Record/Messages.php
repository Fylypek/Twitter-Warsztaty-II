<?php


class Messages extends Record
{
    private $id;
    private $authorId;
    private $authorName;
    private $recipientId;
    private $recipientName;
    private $text;
    private $creationDate;
    private $status;
    
    public function __construct() {
        $this->id = -1;
        $this->authorId = "";
        $this->authorName = "";
        $this->recipientId = "";
        $this->recipientName = "";
        $this->text = "";
        $this->creationDate = "";
        $this->status = 0;
    }
    
    function getId() {
        return $this->id;
    }
    function getAuthorId() {
        return $this->authorId;
    }
    function getAuthorName() {
        return $this->authorName;
    }
    function getRecipientId() {
        return $this->recipientId;
    }
    
    function getRecipientName() {
        return $this->recipientName;
    }
    function getText() {
        return $this->text;
    }
    function getCreationDate() {
        return $this->creationDate;
    }
    function getStatus() {
        return $this->status;
    }
    
    function setAuthorId($authorId) {
        $this->authorId = $authorId;
    }
    function setRecipientId($recipientId) {
        $this->recipientId = $recipientId;
    }
    function setText($text) {
        $this->text = $text;
    }
    function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }
    function setStatus($status) {
        $this->status = $status;
    }
    
    public function save()
    {
        $id = $this->getId();
        $authorId = $this->getAuthorId();
        $authorName = $this->getAuthorName();
        $recipientId = $this->getRecipientId();
        $recipientName = $this->getRecipientName();
        $text = $this->getText();
        $creationDate = $this->getCreationDate();
        $status = $this->getStatus();
        
        $sql = "UPDATE Messages set authorId = $authorId, authorName = $authorName, recipientId = $recipientId,"
                . " recipientName = $recipientName, text = $text, creationDate = $creationDate, status = $status where id = $id";
        $this->db->query($sql);
        
    }
    
    public static function select($where)
    {
        $sql = "SELECT * FROM messages where $where";
        $select = Record::getDb()->query($sql);
        $messages = $select->fetchAll();
        
        $collection = [];
        
        foreach($messages as $message)
        {
            $messageObj = new Messages();
            $messageObj->setId($message['id'])
                    ->setAuthorId($message['authorId'])
                    ->setAuthorName($message['authorName'])
                    ->setRecipientId($message['recipientId'])
                    ->setRecipientName($message['recipientName'])
                    ->setText($message['text'])
                    ->setCreationDate($message['creationDate'])
                    ->setStatus($message['status'])
            ;
            
            $collection[] = $messageObj; 
        }
        return $collection;
    }
    
    public static function selectOne($where)
    {
        $sql = "SELECT * FROM messages where $where";
        $select = Record::getDb()->query($sql);
        $messages = $select->fetchAll();
        
        $collection = [];
        
        foreach($messages as $message)
        {
            $messageObj = new Messages();
            $messageObj->setId($message['id'])
                    ->setAuthorId($message['authorId'])
                    ->setAuthorName($message['authorName'])
                    ->setRecipientId($message['recipientId'])
                    ->setRecipientName($message['recipientName'])
                    ->setText($message['text'])
                    ->setCreationDate($message['creationDate'])
                    ->setStatus($message['status'])
            ;
            
            $collection[] = $messageObj; 
        }
        
        return !empty($collection)?$collection[0]:null;
    }
}

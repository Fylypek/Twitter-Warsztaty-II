<?php

class Users extends Record
{
    private $id;
    private $login;
    private $password;
    private $email;
    private $sessionId;


    public function __construct() 
    {
        $this->id = -1;
        $this->login = "";
        $this->password = "";
        $this->email = "";
        $this->sessionId = "";
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSessionId()
    {
        return $this->sessionId;
    }    
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
        return $this;
    }  
    
    public function save()
    {
        $id = $this->getId();
        $login = $this->getLogin();
        $password = $this->getPassword();
        $email = $this->getEmail();
        $sessionId = $this->getSessionId();
        
        $sql = "UPDATE Users set login = $login, password = $password, email = $email, sessionId = $sessionId where id = $id";
        $this->db->query($sql);
        
    }
    
    
    public static function select($where)
    {
        $sql = "SELECT * FROM users where $where";
        $select = Record::getDb()->query($sql);
        $users = $select->fetchAll();
        
        $collection = [];
        
        foreach($users as $user)
        {
            $userObj = new Users();
            $userObj->setId($user['id'])
                    ->setLogin($user['login'])
                    ->setPassword($user['password'])
                    ->setEmail($user['email'])
                    ->setSessionId($user['sessionId'])
            ;
            
            $collection[] = $userObj; 
        }
        return $collection;
    }   
    
    public static function selectOne($where)
    {
        $sql = "SELECT * FROM users where $where";
        $select = Record::getDb()->query($sql);
        $users = $select->fetchAll();
        
        $collection = [];
        
        foreach($users as $user)
        {
            $userObj = new Users();
            $userObj->setId($user['id'])
                    ->setLogin($user['login'])
                    ->setPassword($user['password'])
                    ->setEmail($user['email'])
                    ->setSessionId($user['sessionId'])
            ;
            
            $collection[] = $userObj; 
        }
        
        return !empty($collection)?$collection[0]:null;
    }       


    
    
    
}





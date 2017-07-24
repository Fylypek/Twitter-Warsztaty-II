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
    
    public function save($validuj = true, $validArrayColumn = null, $validArrayFunction = null)
    {
        $id = empty($this->getId())?'null':Record::getDb()->quote($this->getId());
        $login = empty($this->getLogin())?'null':Record::getDb()->quote($this->getLogin());
        $password = empty($this->getPassword())?'null':Record::getDb()->quote($this->getPassword());
        $email = empty($this->getEmail())?'null':Record::getDb()->quote($this->getEmail());
        $sessionId = empty($this->getSessionId())?'null':Record::getDb()->quote($this->getSessionId());
        
        $user = self::selectOne("id = $id");
        
//        $error = $this->validacion($validuj,$validArrayColumn,$validArrayFunction);
//        if(empty($error)){
            if(!empty($user))
            {
                $sql = "UPDATE users set login = $login, password = $password, email = $email, sessionId = $sessionId where id = $id";
                $result = Record::getDb()->query($sql);
            } else 
            {
                $sql = "INSERT INTO users (`login`,`password`,`email`,`sessionId`) VALUES ($login,$password,$email,$sessionId)";
                $result = Record::getDb()->query($sql);            
            }
//        }
//        $error = [];
//        $result = ['result' => $result, 'error' => $error];
        
        return $result;
    }
    
//    public function validacion($validuj = true, $validArrayColumn = null, $validArrayFunction = null)
//    {
//        if(!$validuj){
//            return [];
//        }
//        
//    }
    
    public static function select($where = null, $order= null, $limit = null)
    {
        if(empty($where))
        {
            $sql = "SELECT * FROM users";
        }
        else{
            $sql = "SELECT * FROM users where $where";
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





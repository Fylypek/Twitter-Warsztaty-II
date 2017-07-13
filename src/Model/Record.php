<?php

/**
 * Description of Record
 *
 * @author fylypek
 */
class Record
{
    private static $db;

    public static function getDb()
    {
        if (empty(self::$db))
            self::$db = new Db();

        return self::$db;
    }
    
    public function __construct() 
    {
//        $this->db = 
    }
    
    
//    public static function select($where)
//    {
//        
//    }
}

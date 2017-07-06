<?php


/**
 * Description of Action
 *
 * @author fylypek
 */
abstract class Action {
    
    protected $db;
    
    public function __construct() 
    {
        Session::init();
        $this->db = new Db();
    }
    
    public function init()
    {
        
    }
    
    public function onAction()
    {
        
    }  
    
    public function preAction()
    {
        
    }   
    
    public function postAction()
    {
        
    }    
}

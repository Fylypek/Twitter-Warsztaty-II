<?php


/**
 * Description of Action
 *
 * @author fylypek
 */
abstract class Action {
    
//    protected $db;
    
    protected $view;


    public function __construct($file) 
    {
        Session::init();
        $this->view = new View($file);
//        $this->db = new Db();
    }
    
    public function init()
    {
        
    }
    
    public function permission()
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
    
    public function render()
    {
        require 'src/Action/indexView.php';
    }
}

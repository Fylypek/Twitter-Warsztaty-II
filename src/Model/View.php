<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of View
 *
 * @author fylypek
 */
class View 
{
    protected $file;

    public function __construct($file) 
    {
        $this->file = $file;
    }
    
    
    public function render()
    {
        require 'src/Action/layout/header.php';
        require 'src/Action/layout/menu.php';
        require $this->file;
        require 'src/Action/layout/footer.php';
    }
}

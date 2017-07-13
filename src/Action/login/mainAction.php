<?php

/**
 * Description of mainAction
 *
 * @author fylypek
 */
class mainAction extends ActionLogin
{
    public function onAction() 
    {
        if(!empty($_POST['send']))
        {
            die(var_dump($_POST));
        }
    }
}

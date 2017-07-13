<?php

/**
 * Description of mainAction
 *
 * @author fylypek
 */
class mainAction extends Action
{
    public function onAction() 
    {
        if(!empty($_POST['wyloguj']))
        {
            $sessionId = Session::get('sessionId');
//            $sql = "UPDATE users SET sessionId=null where sessionId='$sessionId'";
            
            $user = Users::selectOne("sessionId='$sessionId'");
//            die(var_dump($user));
//            $this->db->query($sql);

            Session::set('sessionId', null);

            $baseUrl = Router::$baseUrl;
            header("Location: {$baseUrl}");
        }
    }
}

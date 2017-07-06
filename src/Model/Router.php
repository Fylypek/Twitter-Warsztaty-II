<?php

/**
 * Description of Router
 *
 * @author fylypek
 */
class Router {

    public static $baseUrl = "http://localhost/Twitter-Warsztaty-II/index.php";
    
    public function __construct($url) {

        $url = substr($url, 32);

        if (empty($url)) {
            require 'src/Action/indexAction.php';
            require 'src/Action/indexView.php';

            $action = new indexAction();
        } else {
            $array_url = explode("/", $url);

            $path = 'src/Action/';

            foreach ($array_url as $param) {
                $path = $path . $param;

                if (is_dir($path)) {
                    $path .= "/";
                } else {
                    try {
                        require $path . 'Action.php';
                        require $path . 'View.php';
                    } catch (Exception $e) {
                        die(var_dump($e));
                    }

                    $actionString = "{$param}Action";
                    $action = new $actionString();
                }
            }
        }

        $action->init();
        $action->preAction();
        $action->onAction();
        $action->postAction();
    }

}

<?php

class Core
{
    private $_url;
    private $_dispatcher;

    function __construct($url)
    {
        $this->_url = $url;
    }

    public function run()
    {
        $this->runPDO();
        $this->setSession();
        $controller_arr = Dispatcher::getController($this->_url);
        $file = "../".FOLDERS['controllers']. $controller_arr[0] . ".php";

        if (file_exists($file)) {
            require $file;
        } else {
            echo "controller file not found !";
            return null;
        }

        if (isset($controller_arr[1])) {
            $method = $controller_arr[1];
            $argument = isset($controller_arr[2])?$controller_arr[2]:null;
            $controller_arr[0]::getInstance()->{$controller_arr[1]}($argument);
        }
    }
    private function setSession(){
        $session = Session::getInstance();
    }
    private function runPDO(){
        $pdo = Database::getInstance();
    }
}

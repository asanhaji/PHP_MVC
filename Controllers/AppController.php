<?php

class AppController
{
    protected $model;
    private $twig;
    protected $params;

    public function __construct()
    {
        //$this->model = loadModel("ArticlesModel");
        $loader = new Twig_Loader_Filesystem('../Views'); // Dossier contenant les templates
        $this->twig = new Twig_Environment($loader, array(
        'cache' => false,
        ));
    }

    public static function getInstance()
    {
        static $instances = array();
        $calledClass = get_called_class();
        if (!isset($instances[$calledClass])) {
            $instances[$calledClass] = new $calledClass();
        }
        return $instances[$calledClass];
    }

    public function loadModel($name)
    {
        if (!isset($this->model)) {
            $file = "../".FOLDERS['models']. $name . "Model.php";
            if (file_exists($file)) {
                require $file;
            } else {
                echo "model file not found !";
                return null;
            }
            $modelName = $name.'Model';
            $this->model = new $modelName();
        }
        return $this->model;
    }
    public function render($file, $params = null)
    {
        $this->beforeRender($params);
        echo $this->twig->render($file, $this->params);
    }
    public function redirect($file, $params = null)
    {
        $this->beforeRender($params);
        echo $this->twig->forward($file, $this->params);
    }

    public function beforeRender($params = null)
    {
        if(isset($params)){
            foreach ($params as $key => $value) {
                $this->params[$key] = $value;
            }
        }
        $this->params['file_css'] = '/PHP_Rush_MVC/Webroot/Css/style.css';
        $this->params['directory'] = URLS['directory'];
        $this->params['jquery'] = URLS['jquery'];
        $this->params['articles_js'] = '/PHP_Rush_MVC/Webroot/Js/article_select.js';
        $this->params['forms_js'] = '/PHP_Rush_MVC/Webroot/Js/forms.js';
        $this->params['is_logged'] = Session::isLogged();
        $this->params['is_admin'] = Session::isAdmin();
        $this->params['is_writer'] = Session::isWriter();
        //var_dump($this->params);
    }
}

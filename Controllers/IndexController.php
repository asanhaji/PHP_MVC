<?php
require "../Controllers/ArticlesController.php";

class IndexController extends AppController
{
    function __constructor(){
        parent::__constructor();
    }

    public function loadDefaultHomepage(){
      $newarr = ArticlesController::getInstance()->getArticles();
    }
    public function loadError($err_type){
        $params['loaderror'] = true;
        $this->render("index.html.twig", $params);
    }
}

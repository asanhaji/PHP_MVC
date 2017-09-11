<?php

class ArticlesController extends AppController {

  private static $_instance = null;
  public $allart;

  public function __construct()
  {
    parent::__construct();
    $this->model = parent::loadModel("Articles");
  }

  public static function getInstance()
  {
    return parent::getInstance();
  }

  public function getArticleInControllerWithTandC($title, $content) {
    $article = $this->model->getArticleByFilter('title', $title, 'content', $content);
    $newarr['article_id'] = $article[0]->id;
    $newarr['article_title'] = $article[0]->title;
    $newarr['article_content'] = $article[0]->content;
    return $newarr;
  }

  public function getArticleInControllerWithId($id) {
    $article = $this->model->getArticleByFilter('id', $id);
    $newarr['article_id'] = $article[0]->id;
    $newarr['article_title'] = $article[0]->title;
    $newarr['article_content'] = $article[0]->content;
    return $newarr;
  }

  public function addArticle() {
    if(isset($_POST['art_title']) && isset($_POST['art_content'])){
      $article = $this->model->createArticle($_POST['art_content'], $_POST['art_title'], "1");
      $dsp = $this->getArticleInControllerWithTandC($_POST['art_title'], $_POST['art_content']);
      $this->getArticle($dsp['article_id']);
    }
    else {
      $this->render("article_creation.html.twig");
    }
  }

  public function getArticles() {
    $articles = $this->model->getAllArticles();
    $this->render("index.html.twig", array("articles" => $articles));
  }

  public function getArticle($id) {
    if(isset($_GET)) {
      $articles = $this->model->getArticleByFilter("id", $id);
      $this->render("show_one_article.html.twig", array("articles" => $articles));
    }
    else {
      getArticles();
    }
  }

  public function editArticle($id) {
    if(isset($_POST['art_title']) && isset($_POST['art_content'])){
      $article = $this->model->updateArticle($id, 'content', $_POST['art_content'], 'title', $_POST['art_title']);
      $dsp = $this->getArticleInControllerWithTandC($_POST['art_title'], $_POST['art_content']);
      $this->getArticle($id);
    }
    else if(isset($_GET)) {
      $article = $this->model->getArticleByFilter("id", $id);
      $newarr['article_id'] = $article[0]->id;
      $newarr['article_title'] = $article[0]->title;
      $newarr['article_content'] = $article[0]->content;
      $this->render("edit_article.html.twig", $newarr);
    }
    else {
      $article = $this->model->getArticleByFilter("id", $id);
      $newarr['article_id'] = $article[0]->id;
      $newarr['article_title'] = $article[0]->title;
      $newarr['article_content'] = $article[0]->content;
      $this->render("edit_article.html.twig", $newarr);
    }
  }

  public function deleteArticle($id) {
    $articles = $this->model->deleteArticle('id', $id);
    //$comments = $this->model->deleteComment('article_id', $id);
    $this->getArticles();
  }

  public function addComment($id) {
    if(isset($_POST['art_comment'])){
      $comment = $this->model->createComment($_POST['art_comment'], $id, "1");
      $this->getArticle($id);
    }
    else {
      $article = $this->getArticleInControllerWithId($id);
      $this->render("comment_creation.html.twig", $article);
    }
  }

  public function getComments($id) {
    $articles = $this->model->getAllArticles();
    $this->render("index.html.twig", array("articles" => $articles));
  }
}

?>

<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 1. getAllArticles();
// 2. getArticleByFilter();
// 3. createArticle();
// 4. updateArticle();
// 5. deleteArticle();
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

include('Objects/Article.php');
include('Objects/Comment.php');


class ArticlesModel {

  protected $ladate;
  private $_articlesList;
  private $_commentsList;

  public function __CONSTRUCT() {
    date_default_timezone_set('UTC');
    $this->ladate = date('Y-m-d');
  }

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // NUMBER 1 => Get All Articles
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


  public function getAllArticles() {
    $article = Database::getInstance()->read("articles", "*");
    if($article != NULL) {
      $this->_articlesList = [];
      foreach ($article as $key => $value) {
        $newArticle = new Article($value['id'], $value['title'], $value['content'], $value['creation_date'], $value['edition_date'], $value['user_id']);
        array_push($this->_articlesList, $newArticle);
      }
      return $this->_articlesList;
    }
    return NULL;
  }

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // NUMBER 2 => Get Specific Articles (one or more)
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  public function getArticleByFilter(...$param){
    $i = 0;
    while($i < count($param)) {
      $array[$param[$i]] = $param[$i+1];
      $i += 2;
    }
    $article = Database::getInstance()->read("articles", "*", $array);
    $commarray['article_id'] = $article[0]['id'];
    $comments = Database::getInstance()->read("comments", "*", $commarray);
    if($article != NULL) {
      $this->_articlesList = [];
      $this->_commentsList = [];
      foreach ($article as $key => $value) {
        $newArticle = new Article($value['id'], $value['title'], $value['content'], $value['creation_date'], $value['edition_date'], $value['user_id']);
        array_push($this->_articlesList, $newArticle);
      }
      foreach ($comments as $key => $value) {
        $newComment = new Comment($value['id'], $value['content'], $value['article_id'], $value['user_id'], $value['creation_date'], $value['edition_date']);
        array_push($this->_commentsList, $newComment);
      }
      array_push($this->_articlesList, $this->_commentsList);
      return $this->_articlesList;
    }
    return NULL;
  }

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // NUMBER 3 => Creation of an Article
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  public function createArticle($content, $title, $user_id){
    $array = array(
      "title" => $title,
      "content" => $content,
      "creation_date" => $this->ladate,
      "edition_date" => $this->ladate,
      "user_id" => $user_id,
    );
    $article = Database::getInstance()->create("articles", $array);
    return $article;
  }

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // NUMBER 4 => Modification of a Article
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  public function updateArticle($id, ...$param) {
    $i = 0;
    while($i < count($param)) {
      $array[$param[$i]] = $param[$i+1];
      $i += 2;
    }
    $array['edition_date'] = $this->ladate;
    $article = Database::getInstance()->update("articles", "id", $id, $array);
    return $article;
  }

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // NUMBER 5 => Deletion of a Article
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  public function deleteArticle(...$param) {
    $i = 0;
    while($i < count($param)) {
      $array[$param[$i]] = $param[$i+1];
      $i += 2;
    }
    $article = Database::getInstance()->delete("articles", $array);
    return $article;
  }

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // NUMBER 6 => Creation of a Comment
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  public function createComment($content, $article_id, $user_id){
    $array = array(
      "content" => $content,
      "article_id" => $article_id,
      "user_id" => $user_id,
      "creation_date" => $this->ladate,
      "edition_date" => $this->ladate,
    );
    $comment = Database::getInstance()->create("comments", $array);
    return $comment;
  }

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // NUMBER 7 => Modification of a Comment
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  public function updateComment($id, ...$param) {
    $i = 0;
    while($i < count($param)) {
      $array[$param[$i]] = $param[$i+1];
      $i += 2;
    }
    $array['edition_date'] = $this->ladate;
    $comment = Database::getInstance()->update("comments", "id", $id, $array);
    return $comment;
  }

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // NUMBER 8 => Deletion of a Comment
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  public function deleteComment(...$param) {
    $i = 0;
    while($i < count($param)) {
      $array[$param[$i]] = $param[$i+1];
      $i += 2;
    }
    $comment = Database::getInstance()->delete("comments", $array);
    return $comment;
  }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// NUMBER 9 => Find all comments of an article
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function getComments($article_id){
  $array = array(
    "article_id" => $article_id,
  );
  $comment = Database::getInstance()->read("comments", "*", $array);
  return $comment;
}
}
?>

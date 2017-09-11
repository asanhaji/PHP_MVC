<?php
class Comment {
  public $id;
  public $content;
  public $article_id;
  public $user_id;
  public $creation_date;
  public $edition_date;

  public function __CONSTRUCT($id, $content = "", $article_id = "", $user_id = "", $creation_date = "", $edition_date = ""){
    $this->id = $id;
    $this->content = $content;
    $this->article_id = $article_id;
    $this->user_id = $user_id;
    $this->creation_date = $creation_date;
    $this->edition_date = $edition_date;
  }
}
?>

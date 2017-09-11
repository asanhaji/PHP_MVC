<?php
class Article {
  public $id;
  public $title;
  public $content;
  public $creation_date;
  public $edition_date;
  public $user_id;

  public function __CONSTRUCT($id, $title = "", $content = "", $creation_date = "", $edition_date = "", $user_id = ""){
    $this->id = $id;
    $this->title = $title;
    $this->content = $content;
    $this->creation_date = $creation_date;
    $this->edition_date = $edition_date;
    $this->user_id = $user_id;
  }
}
?>

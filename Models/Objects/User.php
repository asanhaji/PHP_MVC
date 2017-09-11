<?php
class User {
  public $id;
  public $username;
  public $password;
  public $email;
  public $group;
  public $status;
  public $creation_date;
  public $edition_date;

  public function __CONSTRUCT($id = null, $username = "", $password = "", $email = "", $group = "", $status = "", $creation_date = "", $edition_date = ""){
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
    $this->email = $email;
    $this->group = $group;
    $this->status = $status;
    $this->creation_date = $creation_date;
    $this->edition_date = $edition_date;
  }
}
?>

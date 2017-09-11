<?php
class AdminUsersController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = parent::loadModel("Admin");
    }

    public static function getInstance()
    {
        return parent::getInstance();
    }

    function getUser($id)
    {
        if (!Session::isAdmin()) {
            $this->render("index.html.twig");
            return;
        }
        $this->params = array("currentPage" => "admin");

        $user = $this->model->getUserByFilter('id', $id);
        if ($user) {
            $this->params['user'] = $user[0];
            $this->params['session_id'] = Session::read('id');
            if (count($_POST)) {
                if (isset($_POST['delete'])) {
                    $this->deleteUser($user[0]);
                } elseif (isset($_POST['edit'])) {
                    $valid_msg = FormValidator::user_edit_form($_POST);
                    if ($valid_msg != "") {
                        $this->params['error'] = $valid_msg;
                    } else {
                        $this->editUser($user[0]);
                    }
                }
            }
        } else {
            $this->params['error'] = "No user found.";
        }
            $this->render("adminuser.html.twig", $this->params);
    }

    function deleteUser($user)
    {
        $response_delete = $this->model->deleteUser("id", $user->id);
        if ($response_delete) {
            $this->params['deleted'] = true;
            unset($this->params['user']);
        } else {
            $this->params['error'] = "User could not be deleted.";
        }
    }

    function editUser($user)
    {
        $updArray = [];
        if ($_POST['email'] != $user->email) {
            array_push($updArray, 'email', $_POST['email']);
        }
        if ($_POST['username'] != $user->username) {
            array_push($updArray, 'username', $_POST['username']);
        }
        if ($_POST['group'] != $user->group) {
            array_push($updArray, 'group', $_POST['group']);
        }
        if ($_POST['status'] != $user->status) {
            array_push($updArray, 'status', $_POST['status']);
        }
        if (isset($_POST['password']) && $_POST['password'] != "") {
            array_push($updArray, 'password', $_POST['password']);
        }
        if (!count($updArray)) {
            $this->params['error'] = "Nothing to update.";
        } else {
            //toto
            if ($_POST['email'] != $user->email) {
                $email_user = $this->model->getUserByFilter('email', $_POST['email']);
            }
            if (isset($email_user) && count($email_user)) {
                $this->params['error'] = "email already exists ! Please choose another one.";
            } else {
                $response_edit = $this->model->updateUser($user->id, ...$updArray);
                if ($response_edit) {
                    $user = $this->model->getUserByFilter('id', $user->id);
                    if ($user) {
                        $this->params['user'] = $user[0];
                        $this->params['updated'] = true;
                    } else {
                        $this->params['error'] = "User not found after update.";
                    }
                } else {
                    $this->params['error'] = "User could not be updated.";
                }
            }
        }
    }

    function getUsers()
    {
        if (!Session::isAdmin()) {
            $this->render("index.html.twig");
            return;
        }
        $this->params = array("currentPage" => "admin");
        try {
            $users = $this->model->getAllUsers();
            if ($users) {
                $this->params['users'] = $users;
            } else {
                $this->params['error'] = "No user found";
            }
        } catch (Exception $e) {
            $this->params['error'] = $e->getMessage();
        }
            $this->render("admin.html.twig", $this->params);
    }
    
    function addUser()
    {
        if (!Session::isAdmin()) {
            $this->render("index.html.twig");
            return;
        }
        $this->params = array("currentPage" => "admin");
        if (count($_POST)) {
            $valid_msg = FormValidator::register_form($_POST);
            $this->params['username'] = $_POST['username'];
            $this->params['email'] = $_POST['email'];
            $this->params['password'] = $_POST['password'];
            $this->params['group'] = $_POST['group'];
            $this->params['status'] = $_POST['status'];

            if ($valid_msg != "") {
                $this->params['error'] = $valid_msg;
            } else {
                $response = $this->model->getUserByFilter('email', $this->params['email']);
                if (!$response) {
                    $response_add = $this->model->createUser($this->params['username'], $this->params['password'], $this->params['email'], $this->params['group'], $this->params['status'] );
                    if ($response_add) {
                        $user = $this->model->getUserByFilter('email', $this->params['email']);
                        $this->params['created'] = true;
                        unset($this->params['username']);
                        unset($this->params['email']);
                        unset($this->params['password']);
                        unset($this->params['group']);
                        unset($this->params['status']);
                    } else {
                        $this->params['error'] = "Failed to create user.";
                    }
                } else {
                    $this->params['error'] = "email already exists ! Please choose another one.";
                }
            }
        }
        $this->render("adminadduser.html.twig", $this->params);
    }
}

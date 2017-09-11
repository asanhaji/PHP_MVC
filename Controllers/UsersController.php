<?php
class UsersController extends AppController
{
    private $currentUserPage;
    public function __construct()
    {
        parent::__construct();
        $this->model = parent::loadModel("Users");
    }
    public static function getInstance()
    {
        return parent::getInstance();
    }

    public function registration()
    {
        if (Session::isLogged()) {
            $this->render("index.html.twig");
            return;
        }
        $params = array("currentPage" => "register");
        if (count($_POST)) {
            $valid_msg = FormValidator::register_form($_POST);
            $params['username'] = $_POST['username'];
            $params['email'] = $_POST['email'];
            $params['password'] = $_POST['password'];
            if ($valid_msg != "") {
                $params['error'] = $valid_msg;
            } else {
                try {
                    $response = $this->model->getUserByFilter('email', $params['email']);
                    if (!$response) {
                        $response_add = $this->model->createUser($params['username'], $params['password'], $params['email'], 1, 1 );
                        if ($response_add) {
                            $user = $this->model->getUserByFilter('email', $params['email']);
                            $params['registered'] = true;
                            unset($params['username']);
                            unset($params['email']);
                            unset($params['password']);
                            Session::login($user[0]);
                        } else {
                            $params['error'] = "Failed to create user.";
                        }
                    } else {
                        $params['error'] = "email already exists ! Please choose another one.";
                    }
                } catch (Exception $e) {
                    $params['error']  = $e->getMessage();
                }
            }
        }
        $this->render("registration.html.twig", $params);
    }
    public function login()
    {
        if (Session::isLogged()) {
            $this->render("index.html.twig");
            return;
        }
        $params = array("currentPage" => "login");
        if (count($_POST)) {
            $valid_msg = FormValidator::login_form($_POST);
            $params['email'] = $_POST['email'];
            $params['password'] = $_POST['password'];

            if ($valid_msg != "") {
                $params['error'] = $valid_msg;
            } else {
                $user = $this->model->getUserByFilter('email', $params['email']);
                if ($user) {
                    if (password_verify($params['password'], $user[0]->password)) {
                        $params['registered'] = true;
                        unset($params['email']);
                        unset($params['password']);
                        Session::login($user[0]);
                    } else {
                        $params['error'] = "Invalid Password.";
                    }
                } else {
                    $params['error'] = "User doesn't exist.";
                }
            }
        }
        $this->render("login.html.twig", $params);
    }
    public function myaccount()
    {
        if (!Session::isLogged()) {
            $this->render("index.html.twig");
            return;
        }
        $params = array("currentPage" => "myaccount");
        $params['username'] = !count($_POST) || !isset($_POST['username'])? Session::read('username'):$_POST['username'];
        $params['email'] = !count($_POST) || !isset($_POST['email'])? Session::read('email'):$_POST['email'];
        if (count($_POST)) {
            $valid_msg = FormValidator::user_edit_form($_POST);
            $params['email'] = $_POST['email'];
            $params['password'] = $_POST['password'];
            if ($valid_msg != "") {
                $params['error'] = $valid_msg;
            } else {
                if (isset($_POST['delete'])) {
                    $params['delete'] = true;
                    $response_delete = $this->model->deleteUser("id", Session::read('id'));
                    if ($response_delete) {
                        $params['deleted'] = true;
                        unset($params['email']);
                        unset($params['username']);
                        Session::logout();
                    } else {
                        $params['error'] = "User could not be deleted.";
                    }
                }
                if (isset($_POST['edit'])) {
                    $params['edit'] = true;
                    $updArray = [];
                    if ($_POST['email'] != Session::read('email')) {
                        array_push($updArray, 'email', $_POST['email']);
                    }
                    if ($_POST['username'] != Session::read('username')) {
                        array_push($updArray, $_POST['username']);
                    }
                    if (isset($_POST['password']) && $_POST['password'] != "") {
                        array_push($updArray, 'password', $_POST['password']);
                    }
                    if (!count($updArray)) {
                        $params['error'] = "Nothing to update.";
                    } else {
                        var_dump($_SESSION);
                        $response_edit = $this->model->updateUser(Session::read('id'), ...$updArray);
                        if ($response_edit) {
                            $user = $this->model->getUserByFilter('id', Session::read('id'));
                            if ($user) {
                                Session::write('username', $user[0]->username);
                                Session::write('email', $user[0]->email);
                                $params['username'] = $user[0]->username;
                                $params['email'] = $user[0]->email;
                                $params['updated'] = true;
                            } else {
                                $params['error'] = "User could not be updated.";
                            }
                        } else {
                            $params['error'] = "User could not be updated.";
                        }
                    }
                }
            }
        }
        $this->render("myaccount.html.twig", $params);
    }

    public function logout()
    {
        Session::logout();
        $params = array("currentPage" => "home");
        $this->render("index.html.twig");   
    }
}
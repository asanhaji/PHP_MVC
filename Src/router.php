<?php
const ROUTES = array
(
    'register' => array (
        'none' => array('controller'=>'UserController', 'method'=>'registration', 'need_args'=> false)
    ),
    'login' => array (
        'none' => array('controller'=>'UserController', 'method'=>'login', 'need_args'=> false)
    ),
    'logout' => array (
        'none' => array('controller'=>'UserController', 'method'=>'logout', 'need_args'=> false)
    ),
    'myaccount' => array (
        'none' => array('controller'=>'UserController', 'method'=>'myaccount', 'need_args'=> false)
    ),
    'admin' => array (
        'users' => array('controller'=>'AdminUsersController', 'method'=>'getUsers', 'need_args'=> false),
        'user' => array('controller'=>'AdminUsersController', 'method'=>'getUser', 'need_args'=> true),
        'useradd' => array('controller'=>'AdminUsersController', 'method'=>'addUser', 'need_args'=> false),
        'none' => array('controller'=>'AdminUsersController', 'method'=>'getUsers', 'need_args'=> true)

    ),
    'article' => array (
        'all' => array('controller'=>'ArticlesController', 'method'=>'getArticles', 'need_args'=> false),
        'articleid' => array('controller'=>'ArticlesController', 'method'=>'getArticle', 'need_args'=> true),
        'articleadd' => array('controller'=>'ArticlesController', 'method'=>'addArticle', 'need_args'=> false),
        'articledelete' => array('controller'=>'ArticlesController', 'method'=>'deleteArticle', 'need_args'=> true),
        'articleedit' => array('controller'=>'ArticlesController', 'method'=>'editArticle', 'need_args'=> true),
        'addcomment' => array('controller'=>'ArticlesController', 'method'=>'addcomment', 'need_args'=> true)
    ),

);

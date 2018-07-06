<?php
session_start();
require "model/Database.php";
require "model/Manager.php";
require "model/Article.php";
require "model/ArticleManager.php";
require "model/Comment.php";
require "model/CommentManager.php";
require "model/User.php";
require "model/UserManager.php";
// Controller
require "controller/BackController.php";
require "controller/FrontController.php";

  $frontController = new FrontController();


if (empty($_SERVER["QUERY_STRING"])){
  $frontController->home();
}
elseif (isset($_GET['action'])) {
    if ($_GET['action'] == 'commentView') {
        $frontController->commentView();
    }
    elseif ($_GET['action'] == 'login') {
      $frontController->login();
    }
}
else {
    listPosts();
}

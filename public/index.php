<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

require "../vendor/autoload.php";

use Matth\TwigBlog\Controller\ArticlesController;
use Matth\TwigBlog\Controller\UserController;

$userController = new UserController();
$articleController = new ArticlesController();

if (isset($_GET['controller'])) {
    switch ($_GET['controller']) {
        case 'articles':
            if (isset($_GET['action'], $_GET['id'])) {
                $articleController->getArticles($_POST, $_GET['id'], $_GET['action']);
            }
            else {
                $articleController->getArticles();
            }
            break;
        case 'user':
            if (isset($_GET['action'], $_GET['id'])) {
                $userController->getUsers($_POST, $_GET['id'], $_GET['action']);
            }
            else {
                $userController->getUsers();
            }
            break;

    }
}
else {
    $userController->getUsers();
}
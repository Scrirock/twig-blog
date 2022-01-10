<?php

namespace Matth\TwigBlog\Controller;

use Matth\TwigBlog\Classes\Controller;
use Matth\TwigBlog\Model\DB;
use Matth\TwigBlog\Model\Entity\User;
use Matth\TwigBlog\Model\Manager\UserManager;
use Twig\Error\Error;

class UserController extends Controller {

    public function getUsers($field = null, $id = null, $action = null){

        $manager = new UserManager();
        $db = new DB();

        $users = $manager->allUser();
        unset($users[4]);

        $oneUser = null;
        if (!is_null($id) && $id > 0) {
            $oneUser = $manager->oneUser($id);
            if ($action === "delete") {
                $user = new User(null, null, null, $id);
                $manager->deleteUser($user);
            }
        }

        if (isset($field['pseudo'], $field['email'], $field['password'])) {
            $pseudo = $db->sanitize($field['pseudo']);
            $email = $db->sanitize($field['email']);
            $password = password_hash($db->sanitize($field['password']), PASSWORD_BCRYPT);

            switch ($action) {
                case "edit":
                    $user = new User($pseudo, $password, $email, $id);
                    $manager->modifyUser($user);
                    break;
                case "addUser":
                    $article = new User($pseudo, $password, $email, null);
                    $manager->addUser($article);
                    break;
            }
        }

        try {
            $this->render('user.html.twig', [
                'pageTitle' => "Nombre d'utilisateur",
                'nbrItems' => count($users),
                'users' => $users,
                'user' => $oneUser,
                'action' => $action
            ]);
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }
}
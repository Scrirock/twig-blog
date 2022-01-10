<?php

namespace Matth\TwigBlog\Controller;

use Matth\TwigBlog\Classes\Controller;
use Matth\TwigBlog\Model\DB;
use Matth\TwigBlog\Model\Entity\Articles;
use Matth\TwigBlog\Model\Manager\ArticlesManager;
use Twig\Error\Error;

class ArticlesController extends Controller {

    public function getArticles($field = null, $id = null, $action = null): void {

        $manager = new ArticlesManager();
        $db = new DB();

        $allArticles = $manager->allArticles();
        $oneArticle = null;
        if (!is_null($id) && $id > 0) {
            $oneArticle = $manager->oneArticle($id);
            if ($action === "delete") {
                $article = new Articles(null, null, null, $id);
                $manager->deleteArticle($article);
            }
        }
        if (isset($field['title'], $field['content'])) {
            $title = $db->sanitize($field['title']);
            $content = $db->sanitize($field['content']);

            switch ($action) {
                case "edit":
                    $article = new Articles($title, $content, null, $id);
                    $manager->modifyArticle($article);
                    break;
                case "addArticle":
                    $article = new Articles($title, $content);
                    $manager->addArticle($article);
                    break;
            }
        }
        $authorList = $manager->getAuthor();
        if (isset($field['author'])) {
            $author = $db->sanitize($field['author']);

            $article = new Articles(null, null, $author, $id);
            $manager->addAuthor($article);
        }

        try {
            $this->render('article.html.twig', [
                'pageTitle' => "Nombre d'articles",
                'nbrItems' => count($allArticles),
                'articles' => $allArticles,
                'article' => $oneArticle,
                'action' => $action,
                'authorList' => $authorList
            ]);
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }

}
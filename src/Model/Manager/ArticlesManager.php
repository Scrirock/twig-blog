<?php


namespace Matth\TwigBlog\Model\Manager;


use Matth\TwigBlog\Model\DB;
use Matth\TwigBlog\Model\Entity\Articles;

class ArticlesManager {


    /**
     * Return an array of all the articles
     * @return array
     */
    public function allArticles(): array {

        $request = DB::getRepresentative()->prepare("
                    SELECT a.id as aId,
                           a.title,
                           a.content,
                           a.fk_user,
                           u.id as uId,
                           u.pseudo,
                           u.email                           
                        from article as a
                    INNER JOIN user as u
                        ON a.fk_user = u.id");
        if ($request->execute()) {
            return $request->fetchAll();
        }
    }

    public function oneArticle(string $id): array {
        $request = DB::getRepresentative()->prepare("SELECT * from article WHERE id = :id");
        $request->bindParam(":id", $id);
        if ($request->execute()) {
            return $request->fetch();
        }
    }

    public function addArticle(Articles $article): void {
        $request = DB::getRepresentative()->prepare("
                    INSERT INTO article (title, content) 
                    VALUES (:title, :content)");

        $title = $article->getTitle();
        $content = $article->getContent();

        $request->bindParam(":title", $title);
        $request->bindParam(":content", $content);

        $request->execute();
        header("Location: /");
    }

    public function modifyArticle(Articles $article): void {
        $request = DB::getRepresentative()->prepare("
                    UPDATE article 
                    SET title = :title,
                        content = :content
                    WHERE id = :id");

        $title = $article->getTitle();
        $content = $article->getContent();
        $id = $article->getId();

        $request->bindParam(":title", $title);
        $request->bindParam(":content", $content);
        $request->bindParam(":id", $id);

        $request->execute();
        header("Location: /");
    }

    public function deleteArticle(Articles $article){
        $request = DB::getRepresentative()->prepare("DELETE FROM article WHERE id = :id");
        $id = $article->getId();
        $request->bindParam(':id', $id);
        $request->execute();
        header("Location: /");
    }

    public function addAuthor(Articles $article){
        $request = DB::getRepresentative()->prepare("
                    UPDATE article 
                    SET fk_user = :author
                    WHERE id = :id");

        $author = $article->getAuthor();
        $id = $article->getId();

        $request->bindParam(':author', $author);
        $request->bindParam(':id', $id);

        $request->execute();
        header("Location: /");
    }

    public function getAuthor(): array {
        $request = DB::getRepresentative()->prepare("SELECT id, pseudo from user");
        if ($request->execute()) {
            return $request->fetchAll();
        }
    }
}
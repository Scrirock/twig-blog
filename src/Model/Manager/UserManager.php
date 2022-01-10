<?php

namespace Matth\TwigBlog\Model\Manager;

use Matth\TwigBlog\Model\DB;
use Matth\TwigBlog\Model\Entity\User;

class UserManager {

    public function allUser(): array{

        $request = DB::getRepresentative()->prepare("SELECT * from user");
        if ($request->execute()) {
            return $request->fetchAll();
        }
    }

    public function oneUser(string $id): array{

        $request = DB::getRepresentative()->prepare("SELECT * from user WHERE id = :id");
        $request->bindParam(":id", $id);

        if ($request->execute()) {
            return $request->fetch();
        }
    }

    public function addUser(User $user): void {
        $request = DB::getRepresentative()->prepare("
                    INSERT INTO user (pseudo, password, email) 
                    VALUES (:pseudo, :password, :email)");

        $pseudo = $user->getName();
        $password = $user->getPassword();
        $email = $user->getEmail();

        $request->bindParam(":pseudo", $pseudo);
        $request->bindParam(":password", $password);
        $request->bindParam(":email", $email);

        $request->execute();
        header("Location: /?controller=user");
    }

    public function deleteUser(User $user){
        $request = DB::getRepresentative()->prepare("DELETE FROM user WHERE id = :id");

        $id = $user->getId();
        $request->bindParam(':id', $id);

        $request->execute();
        header("Location: /?controller=user");
    }

    public function modifyUser(User $user) {

        $request = DB::getRepresentative()->prepare("
                    UPDATE user 
                    SET pseudo = :pseudo,
                        password = :password,
                        email = :email
                    WHERE id = :id");

        $pseudo = $user->getName();
        $password = $user->getPassword();
        $email = $user->getEmail();
        $id = $user->getId();

        $request->bindParam(":pseudo", $pseudo);
        $request->bindParam(":password", $password);
        $request->bindParam(":email", $email);
        $request->bindParam(":id", $id);

        $request->execute();
        header("Location: /?controller=user");
    }
}
<?php

namespace Matth\TwigBlog\Model\Entity;

class User{

    private ?int $id;
    private ?string $name;
    private ?string $password;
    private ?string $email;

    /**
     * User constructor.
     * @param string|null $name
     * @param string|null $password
     * @param string|null $email
     * @param int|null $id
     */
    public function __construct(string $name = null, string $password = null, string $email = null, int $id = null){
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User {
        $this->email = $email;
        return $this;
    }

}
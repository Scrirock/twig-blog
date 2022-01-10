<?php

namespace Matth\TwigBlog\Model\Entity;

class Articles{

    private ?int $id;
    private ?string $title;
    private ?string $content;
    private ?int $author;

    /**
     * Articles constructor.
     * @param string|null $title
     * @param string|null $content
     * @param int|null $author
     * @param int|null $id
     */
    public function __construct(?string $title = null, ?string $content = null, ?int $author = null, ?int $id = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Articles
     */
    public function setTitle(?string $title): Articles {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return Articles
     */
    public function setContent(?string $content): Articles {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAuthor(): ?int {
        return $this->author;
    }

    /**
     * @param int|null $author
     * @return Articles
     */
    public function setAuthor(?int $author): Articles {
        $this->author = $author;
        return $this;
    }

}
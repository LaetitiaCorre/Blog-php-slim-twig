<?php

namespace simplon\entities;

class Article {
    private $title;
    private $description;
    private $id;
    private $id_user;

    public function __construct(string $title,
                                string $description,
                                int $id=null,
                                int $id_user=null) {
        $this->title = $title;
        $this->description = $description;
        $this->id= $id;
        $this->id_user = $id;

    }



    /**
     * Get the value of id de l'article
     */ 
    public function getId():int
    {
        return $this->id;
    }

    /**
     * Set the value of id de l'article
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id_user
     */ 
    public function getId_user():int
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @return  self
     */ 
    public function setId_user(int $id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle():string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

}

<?php

namespace simplon\entities;

class User {
    private $id;
    private $name;
    private $surname;
    private $email;
    private $password;

    public function __construct(string $name,
                                string $surname,
                                string $email,
                                string $password,
                                int $id=null) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
    }

    

    /**
     * Get the value of id
     */ 
    public function getId():int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName():string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of birthdate
     */ 
    public function getSurname():string
    {
        return $this->surname;
    }

    /**
     * Set the value of birthdate
     *
     * @return  self
     */ 
    public function setSurname(string $surname)
    {
        $this->surname= $surname;

        return $this;
    }

    /**
     * Get the value of gender
     */ 
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

}

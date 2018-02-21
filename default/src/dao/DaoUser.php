<?php

namespace simplon\dao;
use simplon\entities\User;
use simplon\entities\Article;

use simplon\dao\Connect;
/**
 * Un Dao, pour Data Access Object, est une classe dont le but est de faire
 * le lien entre les tables SQL et les objets PHP (ou autre langage).
 * Le but est de centraliser dans la ou les classes DAO tous les appels
 * SQL pour ne pas avoir de SQL qui se balade partout dans note application
 * (comme ça, si on change de SGBD, ou de table, ou de database, on aura
 * juste le DAO à modifier et le reste de notre appli restera inchangé)
 */
class DaoUser {
    
    
    /**
     * La méthode getAll renvoie toutes les persons stockées en bdd
     * @return User[] la liste des person ou une liste vide
     */
    public function getAll():array {
        $users = [];
        
        try {
            $query = Connect::getInstance()->prepare('SELECT * FROM user');
            $query->execute();

            while($row = $query->fetch()) {
              $users[] = new User(
                $row['name'], 
                $row['surname'], 
                $row['email'],
                $row['password'],
                $row['id']
              );
            }
        } catch(\PDOException $e) {
            echo $e;
        }
        return $users;
    }
    /**
     * Méthode permettant de récupérer une Person en se basant sur
     * son Id
     * @return User|null renvoie soit la Person correspondante soit null
     * si pas de match
     */
    public function getById(int $id) {
        try {
            $query = Connect::getInstance()->prepare('SELECT * FROM user WHERE id=:id');
            $query->bindValue(':id', $id, \PDO::PARAM_INT);
            $query->execute();

            if($row = $query->fetch()) {
              return new User(
                $row['name'], 
                $row['surname'], 
                $row['email'],
                $row['password'],
                $row['id']
              );
            }
        }catch(\PDOException $e) {
            echo $e;
        }

        return null;
    }

    public function getByEmail(string $email) {
        try {
            $query = Connect::getInstance()->prepare('SELECT * FROM user WHERE email=:email');
            $query->bindValue(':email', $email, \PDO::PARAM_STR);
            $query->execute();

            if($row = $query->fetch()) {
              return new User( 
                $row['name'], 
                $row['surname'], 
                $row['email'],
                $row['password'],
                $row['id']
              );
            }
        }catch(\PDOException $e) {
            echo $e;
        }

        return null;
    }
  
    public function add(User $user) {
        try {
            $query = Connect::getInstance()->prepare('INSERT INTO user (name, surname, email, password) VALUES (:name, :surname, :email, :password)');
         
            $query->bindValue(':name',$user->getName(),\PDO::PARAM_STR);
            $query->bindValue(':surname',$user->getSurname(),\PDO::PARAM_STR);
            $query->bindValue(':email',$user->getEmail(),\PDO::PARAM_STR);
            $query->bindValue(':password',$user->getPassword(),\PDO::PARAM_STR);

            $query->execute();
    
            $user->setId(Connect::getInstance()->lastInsertId());
            
        }catch(\PDOException $e) {
            echo $e;
        }
    }

    public function update(User $user) {
        
        try {
            $query = Connect::getInstance()->prepare('UPDATE user SET name = :name, surname = :surname, email = :email, password = :password WHERE id = :id');
            $query->bindValue(':name',$user->getName(),\PDO::PARAM_STR);
            
            $query->bindValue(':surname',$user->getSurname(),\PDO::PARAM_STR);
            $query->bindValue(':email',$user->getEmail(),\PDO::PARAM_STR);
            $query->bindValue(':password',$user->getPassword(),\PDO::PARAM_STR);
            $query->bindValue(':id',$user->getId(),\PDO::PARAM_INT);
            $query->execute();
            
            
        }catch(\PDOException $e) {
            echo $e;
        }
    }

}
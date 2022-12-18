<?php

namespace ReseauSocial\Models\User;

require_once('src/lib/database.php');

use ReseauSocial\Lib\Database\DatabaseConnection;

class User
{
    public string $ID;
    public string $pseudo;
    public string $mdp;
    public string $email;
}

class Users
{
    public DatabaseConnection $connection;

    public function getUser(string $identifier): User
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT `pseudo` FROM `utilisateurs` WHERE id = ?"
        );
        $statement->execute([$identifier]);

        $row = $statement->fetch();	
        $user = new User();
        $user->name = $row['pseudo']; 

        return $user;
    }
}
<?php

namespace ReseauSocial\Models\User;

require_once('src/lib/database.php');

use ReseauSocial\Lib\Database\DatabaseConnection;

class User
{
    public string $ID;
    public string $name;
    public string $password;
}

class Users
{
    public DatabaseConnection $connection;

    public function getUser(string $identifier): User
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT `Name` FROM `user` WHERE ID = ?"
        );
        $statement->execute([$identifier]);

        $row = $statement->fetch();	
        $user = new User();
        $user->name = $row['Name']; 

        return $user;
    }
}
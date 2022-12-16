<?php

namespace ReseauSocial\Controllers\GetUserName;

require_once('src/lib/database.php');
require_once('src/models/user.php');

use ReseauSocial\Lib\Database\DatabaseConnection;
use ReseauSocial\Models\User\Users;

class GetUserName
{
    public function execute(string $identifier): string
    {
        $users = new Users();
        $users->connection = new DatabaseConnection();
        $user = $users->getUser($identifier);        

        return $user->name;
    }
}
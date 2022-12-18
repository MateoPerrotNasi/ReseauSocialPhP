<?php

namespace ReseauSocial\Models\Comment;

require_once('src/lib/database.php');

use ReseauSocial\Lib\Database\DatabaseConnection;

class Comment
{
    public string $identifier;
    public string $content;
    public string $userName;
    public string $dateEnvoi;
    public string $postidentifier;
}

class Comments
{
    public DatabaseConnection $connection;

    public function getComments(): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT `ID`, `Contenu`, `DateEnvoi`, `Pseudo`, `PostID` FROM `commentaire` ORDER BY `DateEnvoi` DESC"
        );
        $statement->execute();

        $comments = [];
        while ($row = $statement->fetch()) {
            $comment = new Comment();
            $comment->identifier = $row['ID'];
            $comment->content = $row['Contenu'];
            $comment->userName = $row['Pseudo'];
            $comment->dateEnvoi = $row['DateEnvoi'];
            $comment->postidentifier = $row['PostID'];
            $comments[] = $comment;
        }

        return $comments;
    }
    public function createComment(string $content, string $userName, string $postIdentifier)
    {
        $dateEnvoi = date('Y-m-d H:i:s');
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO `commentaire` (`Contenu`, `Pseudo`, `PostID`, `DateEnvoi`) VALUES (?, ?, ?, ?)"
        );
        $statement->execute([$content, $userName, $postIdentifier, $dateEnvoi]);
    }
}
<?php

namespace ReseauSocial\Models\Post;

require_once('src/lib/database.php');

use ReseauSocial\Lib\Database\DatabaseConnection;

class Post
{
    public string $content;
    public string $userName;
    public string $reactionYes;
    public string $reactionNo;
    public string $reactionLaugh;
    public string $reactionLove;
    public string $reactionSad;
    public string $identifier;
    public string $dateEnvoi;
}

class Posts
{
    public DatabaseConnection $connection;

    public function getPost(string $identifier): Post
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT ID, Content, UserName, DateEnvoi FROM post WHERE ID = ?"
        );
        $statement->execute([$identifier]);

        $row = $statement->fetch();	
        $post = new Post();
        $post->identifier = $row['ID'];
        $post->content = $row['Content'];
        $post->userID = $row['UserName'];

        $post->dateEnvoi = $row['DateEnvoi'];

        return $post;
    }

    public function getPosts(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT ID, Content, UserName, DateEnvoi, ReactionYes, ReactionNo, ReactionLaugh, ReactionLove, ReactionSad FROM post ORDER BY DateEnvoi DESC"
        );
        $feed = [];
        while(($row = $statement->fetch())) {
            $post = new Post();
            $post->identifier = $row['ID'];
            $post->content = $row['Content'];
            $post->userName = $row['UserName'];
            $post->reactionYes = $row['ReactionYes'];
            $post->reactionNo = $row['ReactionNo'];
            $post->reactionLaugh = $row['ReactionLaugh'];
            $post->reactionLove = $row['ReactionLove'];
            $post->reactionSad = $row['ReactionSad'];
            $post->dateEnvoi = $row['DateEnvoi'];
            $feed[] = $post;
        }
        $statement->execute();

        return $feed;
    }
    public function createPost(string $content, string $userName)
    {
        $dateEnvoi = date('Y-m-d H:i:s');
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO `post` (Content, UserName, DateEnvoi) VALUES (?, ?, ?)"
        );
        $isAdded = $statement->execute([$content, $userName, $dateEnvoi]);
        if ($isAdded >! 0) {
            throw new Exception("Le post n'a pas pu être ajouté");
        }
    }
    public function deletePost(string $identifier)
    {
        $statement = $this->connection->getConnection()->prepare(
            "DELETE FROM `post` WHERE ID = ?"
        );
        $isDeleted = $statement->execute([$identifier]);
        if ($isDeleted >! 0) {
            throw new Exception("Le post n'a pas pu être supprimé");
        }
    }
    public function addReaction(string $identifier, string $reaction)
    {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE `post` SET $reaction = $reaction + 1 WHERE ID = ?"
        );
        $isAdded = $statement->execute([$identifier]);
        if ($isAdded >! 0) {
            throw new Exception("La réaction n'a pas pu être ajoutée");
        }
    }
    public function removeReaction(string $identifier, string $reaction)
    {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE `post` SET $reaction = $reaction - 1 WHERE ID = ?"
        );
        $isRemoved = $statement->execute([$identifier]);
        if ($isRemoved >! 0) {
            throw new Exception("La réaction n'a pas pu être supprimée");
        }
    }
}
?>
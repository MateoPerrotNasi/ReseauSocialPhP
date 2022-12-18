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

    public function getPosts(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT ID, Contenu, PseudoUtilisateur, DateEnvoi, ReactionOui, ReactionNon, ReactionRire, ReactionCoeur, ReactionPleur FROM poste ORDER BY DateEnvoi DESC"
        );
        $feed = [];
        while(($row = $statement->fetch())) {
            $post = new Post();
            $post->identifier = $row['ID'];
            $post->content = $row['Contenu'];
            $post->userName = $row['PseudoUtilisateur'];
            $post->reactionYes = $row['ReactionOui'];
            $post->reactionNo = $row['ReactionNon'];
            $post->reactionLaugh = $row['ReactionRire'];
            $post->reactionLove = $row['ReactionCoeur'];
            $post->reactionSad = $row['ReactionPleur'];
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
            "INSERT INTO `poste` (Contenu, PseudoUtilisateur, DateEnvoi) VALUES (?, ?, ?)"
        );
        $isAdded = $statement->execute([$content, $userName, $dateEnvoi]);
        if ($isAdded >! 0) {
            throw new Exception("Le post n'a pas pu être ajouté");
        }
    }
    public function deletePost(string $identifier)
    {
        $statement = $this->connection->getConnection()->prepare(
            "DELETE FROM `poste` WHERE ID = ?"
        );
        $isDeleted = $statement->execute([$identifier]);
        if ($isDeleted >! 0) {
            throw new Exception("Le post n'a pas pu être supprimé");
        }
    }
    public function modifyPost(string $identifier, string $content) {
        $dateModified = date('Y-m-d H:i:s');
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE `poste` SET Contenu = ? DateModification = ? WHERE ID = ?"
        );
        $isModified = $statement->execute([$content, $dateModified, $identifier]);
        if ($isModified >! 0) {
            throw new Exception("Le post n'a pas pu être modifié");
        }
    }
    public function addReaction(string $identifier, string $reaction)
    {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE `poste` SET $reaction = $reaction + 1 WHERE ID = ?"
        );
        $isAdded = $statement->execute([$identifier]);
        if ($isAdded >! 0) {
            throw new Exception("La réaction n'a pas pu être ajoutée");
        }
    }
    public function removeReaction(string $identifier, string $reaction)
    {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE `poste` SET $reaction = $reaction - 1 WHERE ID = ?"
        );
        $isRemoved = $statement->execute([$identifier]);
        if ($isRemoved >! 0) {
            throw new Exception("La réaction n'a pas pu être supprimée");
        }
    }
}
?>
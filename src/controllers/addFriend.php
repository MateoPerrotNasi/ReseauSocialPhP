<?php

    // On démarre la session
    session_start();

    // On récupère le pdo
    $pdo = new PDO('mysql:host=localhost;dbname=reseausocial', 'root', '');
    
    // On récupère le pseudo de la session
    $envoyeur = $_COOKIE['user'];

    // On crée une classe pour les demandes d'amis
    class FriendRequest {

    // On déclare les propriétés
    private $pdo;
    private $envoyeur;
    private $receveur;
    private $friend_verif = 0;

    // On crée le constructeur pdo
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // On crée le setter de receveur
    public function setReceveur($receveur) {
        $this->receveur = $receveur;
    }

    // On crée le setter de envoyeur (qui est le pseudo de la session)
    public function setCookie($envoyeur) {
        $this->envoyeur = $envoyeur;
    }

    // On crée la fonction send
    public function send() {

        // On vérifie si la demande d'amis existe déjà    
        $query = "SELECT * FROM friend_requests WHERE envoyeur = '$this->envoyeur' AND receveur = '$this->receveur'";
        $result = $this->pdo->query($query);

        // Si la demande d'amis existe déjà, on ne fait rien
        if ($result->rowCount() > 0) {

            // Sinon on l'envoie
            } else {

                $result = $this->pdo->query("INSERT INTO friend_requests (envoyeur,receveur,friend_verif) VALUES ('$this->envoyeur','$this->receveur','$this->friend_verif')");
            }
        
        // On redirige vers la liste d'amis
        if ($result) {

            header('Location: http://localhost/ReseauSocial/templates/friend_list.php?status=success');
            exit();
        } else {

            header('Location: http://localhost/ReseauSocial/templates/friend_list.php?status=error');
            exit();
        }
    }
}

    // On effectue les actions si le formulaire est envoyé
    if (isset($_POST["submit"])) {

        @$receveur = $_POST["receveur"];
        $friendRequest = new FriendRequest($pdo);
        $friendRequest->setReceveur($receveur);
        $friendRequest->setCookie($envoyeur);
        $friendRequest->send();
    }

?>
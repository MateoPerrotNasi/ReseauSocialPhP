<?php

   // On démarre la session
   session_start();

   //include('../src/controllers/add_friend.php');

   //Récupération des données saisies par l'utilisateur
   @$pseudo=$_POST["pseudo"];
   @$mdp=md5($_POST["mdp"]);
   @$valider=$_POST["valider"];
   $erreur=""; 
   $pdo = new PDO('mysql:host=localhost;dbname=reseausocial', 'root', '');

   if(isset($valider)){
      include('../src/lib/database.php');
      // On vérifie que le pseudo et le mot de passe sont corrects
      $sel=$pdo->prepare("select * from utilisateurs where pseudo=? and mdp=? limit 1");
      $sel->execute(array($pseudo,$mdp));
      $tab=$sel->fetchAll();

      if(count($tab)>0){
         $_SESSION["email"]=ucfirst(strtolower($tab[0]["email"])).
         " ".strtoupper($tab[0]["email"]);
         $_SESSION["autoriser"]="oui";
         
         // On enregistre le pseudo dans un cookie
         setcookie('user', $pseudo, time() + (86400 * 30), '/');
         $_SESSION["pseudo"]=$pseudo;
         header("location:../index.php");
      }

      else
         $erreur="Mauvais pseudo ou mot de passe!";
         // setcookie('user', "Invité", time() + (86400 * 30), '/');
         // header("location:index.php");
   }
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" href="../style.css" />
   </head>
   <body onLoad="document.fo.pseudo.focus()">
      <h1>Authentification [ <a href="inscription.php">Créer un compte</a> ]</h1>
      <div class="erreur"><?php echo $erreur ?></div>
      <form name="fo" method="post" action="">
         <input type="text" name="pseudo" placeholder="Pseudo" /><br />
         <input type="password" name="mdp" placeholder="Mot de passe" /><br />
         <input type="submit" name="valider" value="S'authentifier" />
      </form>
   </body>
</html>
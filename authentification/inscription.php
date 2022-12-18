<?php

   // On démarre la session
   session_start();
   // Récupération des données saisies par l'utilisateur
   @$email=$_POST["email"];
   @$pseudo=$_POST["pseudo"];
   @$mdp=$_POST["mdp"];
   @$valider=$_POST["valider"];
   $erreur="";
   $pdo = new PDO('mysql:host=localhost;dbname=reseausocial', 'root', '');

   // On vérifie que l'insctiption est valide
   if(isset($valider)){
      if(empty($email)) $erreur="Email vide!";
      elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) $erreur="Email invalide!";
      elseif(empty($pseudo)) $erreur="Pseudo vide!";
      elseif(strlen($pseudo) > 20) $erreur="Pseudo trop long!";
      elseif(empty($mdp)) $erreur="Mot de passe vide!";
      
      else{

         // On récupère le pdo
         include('../src/lib/database.php');
         
         // On vérifie que le pseudo et l'email n'existent pas déjà (ne marche pas)
         $selection=$pdo->prepare("SELECT id FROM utilisateurs WHERE pseudo=? LIMIT 1");
         $selection->execute(array($pseudo));
         $tab=$selection->fetchAll();
         
         if(count($tab)>0)
            $erreur="Le pseudo existe déjà!";

         $selection2=$pdo->prepare("SELECT id FROM utilisateurs WHERE email=? LIMIT 1");
         $selection2->execute(array($pseudo));
         $tab2=$selection2->fetchAll();
         
         if(count($tab2)>0)
            $erreur="L'email existe déjà!";  
         
            else{
            // On insère les données dans la base de données du nouvel utilisateur
            $ins=$pdo->prepare("insert into utilisateurs(email,pseudo,mdp) values(?,?,?)");
            if($ins->execute(array($email,$pseudo,md5($mdp))))
               header("location:login.php");
         }   
      }
   }
?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" href="../style.css" />
   </head>
   <body>
      <h1>Inscription</h1>
      <h1>[ <a href="login.php">Déja un compte ?</a> ]</h1>
      <div class="erreur"><?php echo $erreur ?></div>
      <form name="fo" method="post" action="">
         <input type="text" name="email" placeholder="Email" value="<?php echo $email?>" /><br />
         <input type="text" name="pseudo" placeholder="Pseudo" value="<?php echo $pseudo?>" /><br />
         <input type="password" name="mdp" placeholder="Mot de passe" /><br />
         <input type="submit" name="valider" value="S'authentifier" />
      </form>
   </body>
</html>
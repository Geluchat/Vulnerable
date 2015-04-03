<!-- Page d'accueil -->
<?php
	session_start();
	include('bdd.php'); // On inclue la connection a la base de donnees
     if(isset($_SESSION['pseudo']))
     {
          if(isset($_POST['message'])) 
          {
               $stmt  = $pdo->prepare("SELECT idutilisateur FROM utilisateur WHERE pseudo= :pseudo");
               $stmt->execute(array(
               'pseudo' => $_SESSION['pseudo']
               ));
               $ligne = $stmt->fetchAll();
               
               $stmt  = $pdo->prepare("INSERT INTO message VALUES (default, :message , :iduser)");
               $stmt->execute(array(
               'message' => $_POST['message'],
               'iduser' => $ligne[0]['idutilisateur']
               ));
               
          }
          $sql ="SELECT * FROM message ORDER BY idmessage DESC";
          foreach  ($pdo->query($sql) as $row) {
          
               $stmt  = $pdo->prepare("SELECT pseudo FROM utilisateur WHERE idutilisateur= :id");
               $stmt->execute(array(
               'id' => $row['idutilisateur']
               ));
               $ligne1 = $stmt->fetchAll();
               echo $ligne1[0]['pseudo'].' a dit: '.$row['contenu'].' <br>'."\n";
          }
          echo "<br> \n";
               
          echo'	<form name="message" action="" method="post">
                    <fieldset>
                         <legend>Envoyer un message</legend>
                         <input name="message" type="textarea" /><br><br>
                         <input type="reset" name="annuler" value="Annuler" />
                         <input type="submit" name="valider" value="Valider" />
                    
                    </fieldset>
               </form> 
               <a href="./profile.php"> Votre profil </a><br>
               <a href="./affiche.php?id=1"> Autre profils </a>
          ';
     }
     else header('Location: index.php');
?>
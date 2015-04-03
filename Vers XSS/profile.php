<?php
	session_start();
	include('bdd.php'); // On inclue la connection a la base de donnees
	
     if(isset($_SESSION['pseudo']))
     {
          if(isset($_POST['humeur']))
          {
          
               $stmt  = $pdo->prepare("SELECT * FROM utilisateur WHERE pseudo= :pseudo");
               $stmt->execute(array(
               'pseudo' => $_SESSION['pseudo']
               ));
               
               $ligne = $stmt->fetchAll();
               $stmt  = $pdo->prepare("UPDATE utilisateur SET etat_actuel= :ea WHERE idutilisateur=:id");
               $stmt->execute(array(
               'ea' => $_POST['humeur'],
               'id' => $ligne[0]['idutilisateur']
               ));
               
          }
     $stmt  = $pdo->prepare("SELECT * FROM utilisateur WHERE pseudo= :pseudo");
     $stmt->execute(array(
     'pseudo' => $_SESSION['pseudo']
     ));
     $ligne = $stmt->fetchAll();

     
     echo 'Votre pseudo: '.$ligne[0]['pseudo'].'<br />Votre humeur: '.$ligne[0]['etat_actuel'].'<br />';
     echo'
     <form name="humeur" action="" method="post">
                    Votre nouvelle humeur: 	<input name="humeur" type="text" />
                                                  <input type="submit" name="valider" value="Changer" />
     </form> 
     ';
     }
      else header('Location: index.php');
?>
<?php
	session_start();
	include('bdd.php'); // On inclue la connection a la base de donnees
	if(isset($_GET['id']))
	{
          $stmt  = $pdo->prepare("SELECT * FROM utilisateur WHERE idutilisateur= :id");
          $stmt->execute(array(
          'id' => $_GET['id']
          ));
          $ligne = $stmt->fetchAll();
		echo 'Pseudo: '.$ligne[0]['pseudo'].'<br />Humeur: '.$ligne[0]['etat_actuel'].'<br />';
	}
	else header('Location: shout.php');
?>
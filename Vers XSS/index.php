<!-- Page d'accueil -->
<?php
	session_start();
	include('bdd.php'); // On inclue la connection a la base de donnees

	if(isset($_POST['pseudo'])) // Connection au panel administrateur
	{
          $stmt  = $pdo->prepare("SELECT idutilisateur FROM utilisateur WHERE pseudo= :pseudo");
          $stmt->execute(array(
          'pseudo' => $_POST['pseudo']
          ));
          $ligne = $stmt->fetchAll();

		if(!empty($ligne[0]['idutilisateur']))
		{
			$_SESSION['pseudo']=$_POST['pseudo'];
			echo 'Connecté, vous pouvez aller sur la shout <a href="./shout.php" >Shout</a>';
		}
		else echo 'Utilisateur inexistant';
	}

echo'
	<form name="message" action="" method="post">
		<fieldset>
			<legend>Se connecter</legend>
			<input name="pseudo" type="text" /><br /><br />
			<input type="reset" name="annuler" value="Annuler" />
			<input type="submit" name="valider" value="Valider" />
		
		</fieldset>
	</form> 
     ';
?>
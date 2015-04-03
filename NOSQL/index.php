<?php
if (isset($_POST['usr_name']) && isset($_POST['usr_password']))
	{
	$usr_name = ($_POST['usr_name']);
	$usr_password = ($_POST['usr_password']);
     $con = new MongoClient(); // Connexion a MongoDB
 
     if ($con) // Si la connexion a fonctionné
          {
 
          $db = $con->test;
          $people = $db->people;
          $qry = array(
               "user" => $usr_name,
               "password" => $usr_password
          ); // Construction de la requête NOSQL
 
          $result = $people->findOne($qry); // Recherche de l'utilisateur
          if ($result) // Si les identifiants correspondes on connecte l'utilisateur
               {
               echo("Bienvenue Administrateur"); // Zone Admin
               exit(0);
               }
          }
       else
          {
          die("Mongo DB not installed");
          }
     }
 
echo'
     <form action="" method="POST">
     Login:
     <input type="text" id="usr_name" name="usr_name"  />
     Password:
     <input type="password" id="usr_password" name="usr_password" />  
     <input  name="submitForm" id="submitForm" type="submit" value="Login" />
     </form>
';
?>
<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
	include("../pdo.php");
		
	
	if(isset($_GET["email"]) && isset($_GET["mdp"]))
	{
		if (isGood($_GET["email"], $_GET["mdp"]))
		{
			if(isExist($_GET["email"]))
			{
				echo getToken($_GET["email"]);
			} else {
				$token = uniqid('', true);
				$id_user = getIDUser($_GET["email"]);
				$bdd = getPDO();
				$req = $bdd->prepare("INSERT INTO session (id_user, token) VALUES(".$id_user.", '".$token."');");
				$result = $req->execute();
				
				if ($result == 1)
				{
					echo getToken($_GET["email"]);
				} else { 
					return "ERROR"; 
				}	

			}	
			
		} else {
			echo "BAD CONNEXION";
		}
	} else {
		echo "ERROR";
	}


	function getToken($email)
	{
		$bdd = getPDO();
		$retour = "";
		$req = $bdd->query("SELECT s.* FROM session s  INNER JOIN user u ON s.id_user = u.id WHERE u.email='".$email."'");
		if($resultat = $req->fetch() )
		{
		    $retour = $resultat["token"];
		}
		$req->closeCursor();
		return $retour;
	}

	function getIDUser($email)
	{
		$bdd = getPDO();
		$retour = "";
		$req = $bdd->query("SELECT * FROM user WHERE email='".$email."'");
		if($resultat = $req->fetch() )
		{
		    $retour = $resultat["id"];
		}
		$req->closeCursor();
		return $retour;
	}

	function isGood($email, $mdp)
	{
		$bdd = getPDO();

			$req = $bdd->query("SELECT * FROM user WHERE email='".$email."' AND mdp='".$mdp."' ");
			$data = $req->fetchAll();
			if(count($data) > 0){
				return true;
			} else {
				return false;
			}
	}

	function isExist($email)
	{
		$bdd = getPDO();

			$req = $bdd->query("SELECT s.* FROM user u INNER JOIN session s ON s.id_user = u.id WHERE u.email='".$email."' ");
			$data = $req->fetchAll();
			if(count($data) > 0){
				return true;
			} else {
				return false;
			}
	}

?>

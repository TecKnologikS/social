<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
	include("../pdo.php");
		
	
	if(isset($_GET["name"]) && isset($_GET["first"]) && isset($_GET["birth"]) && isset($_GET["email"]) && isset($_GET["mdp"]))
	{
		echo add($_GET["name"], $_GET["first"], $_GET["birth"], $_GET["email"], $_GET["mdp"]);
	} else {
		echo "ERROR";
	}

	function add($name, $first, $birth, $email, $mdp)
	{
		$bdd = getPDO();

		if (!isExist($email)) {
			$req = $bdd->prepare("INSERT INTO user (name, first, birth_date, status, email, mdp) VALUES('".$name."', '".$first."', '".$birth."', 10, '".$email."', '".$mdp."');");
			$result = $req->execute();
			
			if ($result == 1)
			{
				$token = uniqid('', true);
				$id_user = getIDUser($email);
				$bdd = getPDO();
				$req = $bdd->prepare("INSERT INTO session (id_user, token) VALUES(".$id_user.", '".$token."');");
				$result = $req->execute();
				
				if ($result == 1)
				{
					return getToken($_GET["email"]);
				} else { 
					return "ERROR TOKEN"; 
				}		
			} else { 
				return "ERROR INSERT"; 
			}	
			
		} else {
			$req = $bdd->prepare("UPDATE user  SET status=10 WHERE email='".$email."';");
			$result = $req->execute();
			
			if ($result == 1)
			{
				if(isExistToken($email))
				{
					return getToken($email);
				} else {
					$token = uniqid('', true);
					$id_user = getIDUser($email);
					$bdd = getPDO();
					$req = $bdd->prepare("INSERT INTO session (id_user, token) VALUES(".$id_user.", '".$token."');");
					$result = $req->execute();
					
					if ($result == 1)
					{
						return getToken($_GET["email"]);
					} else { 
						return "ERROR TOKEN"; 
					}	

				}	
			} else { 
				return "ERROR UPDATE"; 
			}	
		}
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

	function isExist($email)
	{
		$bdd = getPDO();

			$req = $bdd->query("SELECT * FROM user WHERE email='".$email."' ");
			$data = $req->fetchAll();
			if(count($data) > 0){
				return true;
			} else {
				return false;
			}
	}
	function isExistToken($email)
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

?>

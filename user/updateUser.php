<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
	include("../pdo.php");
		
	
	if(isset($_GET["email"]))
	{
		if (isExist($_GET["email"]))
		{
			$critere = "";
			if (isset($_GET["name"]))
			{
				if ($critere != "")
				{
					$critere = $critere.", ";
				}
				$critere =  $critere."name='".$_GET["name"]."'";
			}
			if (isset($_GET["first"]))
			{
				if ($critere != "")
				{
					$critere = $critere." ,";
				}
				$critere = $critere."first='".$_GET["first"]."'";
			}
			if (isset($_GET["birth"]))
			{
				if ($critere != "")
				{
					$critere = $critere." ,";
				}
				$critere = $critere."birth_date='".$_GET["birth"]."'";
			}
			if (isset($_GET["mdp"]))
			{
				if ($critere != "")
				{
					$critere = $critere." ,";
				}
				$critere = $critere."mdp='".$_GET["mdp"]."'";
			}

			if($critere != "")
			{
				echo update($_GET["email"], $critere);
			} else {
				echo "rien a modifier";
			}
		}
	} else {
		echo "ERROR";
	}

	function update($email, $value)
	{
		$bdd = getPDO();

		$req = $bdd->prepare("update user SET ".$value." WHERE email='".$email."'");
		$result = $req->execute();
		
		if ($result == 1)
		{
			return "OK";
		} else { 
			return "ERROR"; 
		}	
			
		
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

?>

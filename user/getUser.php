<?php
	include("user.php");
	if (isset($_GET["id"]))	{
		echo json_encode(getUserByID($_GET["id"]));
	}

	if (isset($_GET["name"]))	{
		echo json_encode(getUserByName($_GET["name"]));
	}

	

 	function getUserByID($id)
        {
		$user = new User();
		$bdd = new PDO('mysql:host=localhost;dbname=socialnet', 'root', 'root');
		$resultats = $bdd->query("SELECT * FROM user WHERE ID=".$id);
		$row = $resultats->fetch();
		if ($row != null)
		{
			$user->id = $row["id"];
			$user->name = $row["name"];
			$user->first_name = $row["first"];
		}
                return $user;
        }

	function getUserByName($name)
        {
		$user = new User();
		$bdd = new PDO('mysql:host=localhost;dbname=socialnet', 'root', 'root');
		$resultats = $bdd->query("SELECT * FROM user WHERE name LIKE '%".$name."' OR first LIKE '%".$name."%'");
		$row = $resultats->fetch();
		if ($row != null)
		{
			$user->id = $row["id"];
			$user->name = $row["name"];
			$user->first_name = $row["first"];
		}
                return $user;
        }


?>

      


 

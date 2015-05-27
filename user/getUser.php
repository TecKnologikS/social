<?php
	include("user.php");
	include("UserDAO.php");
	if (isset($_GET["id"]))	{
		if (isset($_GET["output"]))
		{
			if ($_GET["output"] == "xml")
			{
				echo wddx_serialize_value(getUserByID($_GET["id"]));
			} else {
				echo json_encode(getUserByID($_GET["id"]));
			}
		} else {
			echo json_encode(getUserByID($_GET["id"]));
		}
	}

	if (isset($_GET["name"]))	{
		if (isset($_GET["output"]))
		{
			if ($_GET["output"] == "xml")
			{
				echo wddx_serialize_value(getUserByName($_GET["name"]));
			} else {
				echo json_encode(getUserByName($_GET["name"]));
			}
		} else {
			echo json_encode(getUserByName($_GET["name"]));
		}
	}

	

 	function getUserByID($id)
        {
		return getUser(" id=".$id);
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

      


 

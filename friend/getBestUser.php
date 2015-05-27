<?php

	include("../pdo.php");
	include("friend.php");
	include("../user/user.php");
	
	if(isset($_GET["token"]) && isset($_GET["offset"]) && isset($_GET["limit"]))
	{
		$end = $_GET["offset"] + $_GET["limit"];
		if (isset($_GET["output"]))
		{
			if ($_GET["output"] == "xml")
			{
				echo wddx_serialize_value(get($_GET["token"], $_GET["offset"], $end));
			} else {
				echo json_encode(get($_GET["token"], $_GET["offset"], $end));
			}
		} else {
			echo json_encode(get($_GET["token"], $_GET["offset"], $end));
		}
	} else {
		echo "ERROR";
	}

	function get($token, $start, $end)
	{
		$bdd = getPDO();
		$id_me = getIDUser($token);
		$friends = array();
		$req = $bdd->query("SELECT DISTINCT u.*, (SELECT COUNT(*) FROM post p WHERE p.id_author=u.id) as nbPost FROM user u  WHERE u.id != ".$id_me." ORDER BY nbPost LIMIT ".$start.", ".$end."");

		while($resultat = $req->fetch())
		{
			$user = new User();
			rowToUser($resultat, $user);
		    array_push($friends, $user);
		}
		$req->closeCursor();
		return $friends;
		
	}

?>

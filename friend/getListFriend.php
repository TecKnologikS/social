<?php

	include("../pdo.php");
	include("friend.php");
	include("../user/user.php");
	
	if(isset($_GET["id_me"]) && isset($_GET["offset"]) && isset($_GET["limit"]))
	{
		$end = $_GET["offset"] + $_GET["limit"];
		echo json_encode(get($_GET["id_me"], $_GET["offset"], $end));
	} else {
		echo "ERROR";
	}

	function get($id_me, $start, $end)
	{
		$bdd = getPDO();
		$friends = array();
		$req = $bdd->query("SELECT DISTINCT u.* FROM user u INNER JOIN friend f ON f.id_person1=".$id_me." OR f.id_person2=".$id_me." LIMIT ".$start.", ".$end."");
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

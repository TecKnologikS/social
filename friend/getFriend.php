<?php

	include("../pdo.php");
	include("friend.php");
	include("../user/user.php");
	
	if(isset($_GET["id_me"]) && isset($_GET["id_friend"]))
	{
		echo json_encode(get($_GET["id_me"], $_GET["id_friend"]));
	} else {
		echo "ERROR";
	}

	function get($id_me, $id_friend)
	{
		$bdd = getPDO();
		if (isFriend($id_me, $id_friend)) {
			$user = new User();
			$req = $bdd->query("SELECT * FROM user WHERE id=".$id_friend."");
			//$req->setFetchMode(PDO::FETCH_OBJ);
			if($resultat = $req->fetch() )
			{
			    rowToUser($resultat, $user);
			}
			$req->closeCursor();
			return $user;
		} else {
			return 	Friend::NOT_FRIEND;
		}
	}

?>

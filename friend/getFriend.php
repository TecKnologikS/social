<?php

	include("../pdo.php");
	include("friend.php");
	include("../user/user.php");
	
	if(isset($_GET["token"]) && isset($_GET["id_friend"]))
	{
		if (isset($_GET["output"]))
		{
			if ($_GET["output"] == "xml")
			{
				echo wddx_serialize_value(get($_GET["token"], $_GET["id_friend"]));
			} else {
				echo json_encode(get($_GET["token"], $_GET["id_friend"]));
			}
		} else {
			echo json_encode(get($_GET["token"], $_GET["id_friend"]));
		}
	} else {
		echo "ERROR";
	}

	function get($token, $id_friend)
	{
		$bdd = getPDO();
		$id_me = getIDUser($token);
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

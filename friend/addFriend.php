<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
	include("friend.php");
	include("../pdo.php");
		
	
	if(isset($_GET["token"]) && isset($_GET["id"]))
	{
		echo add($_GET["token"], $_GET["id"]);
	} else {
		echo "ERROR";
	}

	function add($token, $id_friend)
	{
		$bdd = getPDO();
		$id_me = getIDUser($token);
		if (!isFriend($id_me, $id_friend)) {
			$req = $bdd->prepare("INSERT INTO friend (id_person1, id_person2, status) VALUES(".$id_me.", ".$id_friend.", ".Friend::STATUS_WAIT.");");
			$result = $req->execute();
			
			if ($result == 1)
			{
				return Friend::ADD_FRIEND_OK;
			} else { 
				return Friend::ADD_FRIEND_ERROR; 
			}	
			
		} else {
			return 	"ERROR";
		}
	}

?>

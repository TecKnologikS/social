<?php

	include("../pdo.php");
	include("friend.php");
	
	if(isset($_GET["token"]) && isset($_GET["id"]))
	{
		echo update($_GET["token"], $_GET["id"]);
	} else {
		echo "ERROR";
	}

	function update($token, $id_friend)
	{
		$bdd = getPDO();
		$id_me = getIDUser($token);
		if (isFriend($id_me, $id_friend)) {
			$req = $bdd->prepare("UPDATE friend SET status=".Friend::STATUS_OK." WHERE (id_person1=".$id_me." AND id_person2=".$id_friend.") OR (id_person1=".$id_friend." AND id_person2=".$id_me.")");
			$result = $req->execute();
			if ($result == 1) {
				return Friend::ACCEPT_FRIEND_OK;
			} else {
				return Friend::ACCEPT_FRIEND_ERROR;
			}
		} else {
			return 	Friend::NOT_FRIEND;
		}
	}

?>

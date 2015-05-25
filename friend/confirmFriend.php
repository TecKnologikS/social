<?php

	include("../pdo.php");
	include("friend.php");
	
	if(isset($_GET["id1"]) && isset($_GET["id2"]))
	{
		echo update($_GET["id1"], $_GET["id2"]);
	} else {
		echo "ERROR";
	}

	function update($id_me, $id_friend)
	{
		if (!isFriend($id_me, $id_friend)) {
			$req = $bdd->query("UPDATE friend SET status=".$Friend::STATUS_OK." WHERE (id_person1=".$id_me." AND id_person2=".$id_friend.") OR (id_person1=".$id_friend." AND id_person2=".$id_me.")");
			$data = $req->fetchAll();
			if(count($data) > 0){
				return Friend::ADD_FRIEND_OK;
			} else {
				return Friend::ADD_FRIEND_ERROR;
			}
		} else {
			return 	Friend::ALREADY_FRIEND;
		}
	}

?>

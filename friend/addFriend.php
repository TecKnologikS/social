<?php
	include("../pdo.php");
	include("Friend.php");
	
	if(isset($_GET["id1"]) && isset($_GET["id2"]))
	{
		echo add($_GET["id1"], $_GET["id2"]);
	} else {
		echo "ERROR";
	}

	function add($id_me, $id_friend)
	{
		if (!isFriend()) {
			$req = $bdd->query("INSERT INTO friend (id_person1, id_person2, status) VALUES(".$id_me.", ".$id_friend.", ".Friend::STATUS_WAIT.");");
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

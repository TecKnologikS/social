<?php

	include("../pdo.php");
	include("friend.php");
	
	if(isset($_GET["id1"]) && isset($_GET["status"]))
	{
		echo get($_GET["id1"], $_GET["status"]);
	} else if(isset($_GET["id1"])) {
		echo get($_GET["id1"], 20);
	} else {
		echo "ERROR";
	}

	function get($id_me, $code_status)
	{
		if (!isFriend($id_me, $id_friend)) {
			$req = $bdd->query("SELECT * FROM friend WHERE (id_person1=".$id_me." OR id_person2=".$id_me.") AND status=".$code_status."");
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

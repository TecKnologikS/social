<?php

	include("../pdo.php");
	include("friend.php");
	
	if(isset($_GET["email"]) && isset($_GET["id2"]))
	{
		echo delete($_GET["id1"], $_GET["id2"]);
	} else {
		echo "ERROR";
	}

	function delete($email)
	{
		$bdd = getPDO();
		if (isFriend($id_me, $id_friend)) {
			$req = $bdd->prepare("UPDATE user SET status=20 WHERE email='".$email."'");
			$result = $req->execute();
			if ($result == 1) {
				return Friend::DELETE_FRIEND_OK;
			} else {
				return Friend::DELETE_FRIEND_ERROR;
			}
		} else {
			return 	Friend::NOT_FRIEND;
		}
	}

	function isExist($email)
	{
		$bdd = getPDO();

			$req = $bdd->query("SELECT * FROM user WHERE email='".$email."' ");
			$data = $req->fetchAll();
			if(count($data) > 0){
				return true;
			} else {
				return false;
			}
	}


?>

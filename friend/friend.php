<?php

	class Friend
	{
		const ADD_FRIEND_OK = 100;
		const ADD_FRIEND_ERROR = 101;
		const ALREADY_FRIEND = 102;
		const ASK_FRIEND_OK = 103;
		const DELETE_FRIEND_OK = 104;
		const DELETE_FRIEND_ERROR = 105;
		const ACCEPT_FRIEND_OK = 106;
		const ACCEPT_FRIEND_ERROR = 107;
		const NOT_FRIEND = 108;

		const BDD_ID_PERSON1 = "id_person1";
		const BDD_ID_PERSON2 = "id_person2";
		const BDD_STATUS = "status";

		var $id_person1;
		var $id_person2;
		var $status;


		const STATUS_WAIT = 10;
		const STATUS_OK = 20;
		//Status : 10 : en cours (demande) et 20 : friends

		function Friend()
		{
			$this->id_person1 = 0;
			$this->id_person2 = 0;
			$this->status = 0;
		}

	}

	function rowToFriend($row, $friend)
	{
		$friend->id_person1 = $row[Friend::BDD_ID_PERSON1];
		$friend->id_person2 = $row[Friend::BDD_ID_PERSON2];
		$friend->status = $row[Friend::BDD_STATUS];
	} 

	function isFriend($id_person1, $id_person2)
	{
		$bdd = getPDO();
		$req = $bdd->query("SELECT * FROM friend WHERE (id_person1=".$id_person1." AND id_person2 = ".$id_person2.") OR (id_person1=".$id_person2." AND id_person2 = ".$id_person1.")");
			$data = $req->fetchAll();
			if(count($data) > 0){
				return true;
			} else {
				return false;
			}
	}

?>

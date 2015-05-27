<?php

	include("../pdo.php");

	/*
	100 : ok add
	101 : already like
	102 : error add
	103 : not like
	*/

	if(isset($_GET["id_me"]) && isset($_GET["id_comment"]))
	{
		$id_me = $_GET["id_me"];
		$id_comment = $_GET["id_comment"];
		if (isLikeComment($id_me, $id_comment))
		{
			$req = $bdd->prepare("INSERT INTO like_comment (id_author, id_comment) VALUES(".$id_me.", ".$id_comment.");");
			$result = $req->execute();
			
			if ($result == 1)
			{
				echo "100";
			} else { 
				echo "102";
			}	
		} else {
			echo "101";
		}
	} else if (isset($_GET["id_me"]) && isset($_GET["id_post"])) {
		$id_me = $_GET["id_me"];
		$id_post = $_GET["id_post"];
		if (isLikePost($id_me, $id_post))
		{
			$req = $bdd->prepare("INSERT INTO like_post (id_author, id_post) VALUES(".$id_me.", ".$id_post.");");
			$result = $req->execute();
			
			if ($result == 1)
			{
				echo "100";
			} else { 
				echo "102";
			}	
		} else {
			echo "101";
		}
	} else {
		echo "ERROR";
	}

	function isLikePost($id_me, $id_post)
	{
		$bdd = getPDO();
		$req = $bdd->query("SELECT * FROM like_post WHERE id_author=".$id_me." AND id_post=".$id_post."");
			$data = $req->fetchAll();
			if(count($data) > 0){
				return true;
			} else {
				return false;
			}
	
	}

	function isLikeComment($id_me, $id_comment)
	{
		$bdd = getPDO();
		$req = $bdd->query("SELECT * FROM like_comment WHERE id_author=".$id_me." AND id_comment=".$id_comment."");
			$data = $req->fetchAll();
			if(count($data) > 0){
				return true;
			} else {
				return false;
			}
	
	}

?>
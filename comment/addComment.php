<?php
	include("../pdo.php");
	include("comment.php");
	$dateT = "NOW()";
	
	if(isset($_GET["id_post"]) && isset($_GET["id_author"]) && isset($_GET["content"]) && isset($_GET["id_person"]) && isset($dateT))
	{
		echo add($_GET["id_post"], $_GET["id_author"], $_GET["content"], $_GET["id_person"], $dateT);
	} else {
		echo "ERROR";
	}
	
	
	function add($id_post, $id_author, $content, $id_person, $dateT)
	{
		if (!isComment($id_post, $id_author, $content, $id_person, $dateT)) {
			return 	Comment::ALREADY_POST;
		} else {
			
			$bdd = getPDO();
			$req = $bdd->query("INSERT INTO comment(id_post, id_author, content, date_mod) VALUES(".$id_post.", ".$id_author.", '".$content."', ".$dateT." );");
			
			
			
			// $req2 = $bdd->query("INSERT INTO tag(id_post, id_person, date_mod) VALUES(".$id_post.", ".$id_person.", ".$dateT.");");
			
			// $result2 = $req2->execute();
			
			// if ($result2 == 1)
			// {
				// return Comment::ADD_COMMENT_OK;
			// } else { 
				// return Comment::ADD_COMMENT_ERROR;
			// }	
			
			$result = $req->execute();
			
			if ($result == 1)
			{
				return Comment::ADD_COMMENT_OK;
			} else {
				return Comment::ADD_COMMENT_ERROR;
			}	
		}
	}

?>
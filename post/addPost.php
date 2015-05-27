<?php
	ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
	include("../pdo.php");
	include("post.php");

	$dateT = "NOW()";
	
	if(isset($_GET["id_author"]) && isset($_GET["content"]) && isset($dateT))
	{
		echo add($_GET["id_author"], $_GET["content"], $dateT);
	} else {
		echo "ERROR";
	}
	
	function add($id_author, $content, $dateT)
	{
		if (!isPost($id_author, $content, $dateT)) {
			return 	Post::ALREADY_POST;
		} else {
			
			$bdd = getPDO();
			$req = $bdd->query("INSERT INTO post(id_author, datePost) VALUES(".$id_author.", ".$dateT." );");
			$utils = $bdd->query("select id from post where id_author=".$id_author." and datePost=".$dateT."");
			$id_post = (int) $utils->fetchColumn();
			$req2 = $bdd->prepare("INSERT INTO comment(id_post, id_author, content, date_mod) VALUES(".$id_post.", ".$id_author.", '".$content."', ".$dateT." );");
			$result = $req2->execute();
			
			if ($result == 1)
			{
				return Post::ADD_POST_OK;
			} else { 
				return Post::ADD_POST_ERROR;
			}	
		}
	}

?>
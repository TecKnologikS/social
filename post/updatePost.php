<?php
ini_set('display_errors',1);
	include("../pdo.php");
	include("post.php");
	
	if(isset($_GET["id_author"]) && isset($_GET["content"]) && isset($_GET["datePost"]))
	{
		echo update($_GET["id_author"], $_GET["content"], $_GET["datePost"]);
	} else {
		echo "ERROR";
	}

	function update($id_author, $content, $datePost)
	{
		if (isUpdatePost($id_author, $content, $datePost)) {
			$bdd=getPDO();
			$utils = $bdd->query("select id from post where id_author=".$id_author." and datePost like '".$datePost."%'");
			$id_post = (int) $utils->fetchColumn();
			$req = $bdd->query("UPDATE comment SET content = '".$content."' where id_post = ".$id_post."");
			$result = $req->execute();
			if ($result == 1) {
				return Post::ACCEPT_POST_OK;
			} else {
				return Post::ACCEPT_POST_ERROR;
			}
		} else {
			return 	Post::NOT_POST;
		}
		
	}

?>

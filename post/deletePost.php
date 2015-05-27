<?php

	include("../pdo.php");
	include("post.php");
	
	if(isset($_GET["id_author"]) && isset($_GET["datePost"]))
	{
		echo delete($_GET["id_author"], $_GET["datePost"]);
	} else {
		echo "ERROR";
	}

	
		function delete($id_author, $datePost)
		{
			if (isDeletePost($id_author, $datePost)) {
				$bdd = getPDO();
				$utils = $bdd->query("select id from post where id_author=".$id_author." and datePost like '".$datePost."%'");
				$id_post = (int) $utils->fetchColumn();
				$req = $bdd->query("DELETE FROM comment WHERE id_post=".$id_post."");
				$req2 = $bdd->query("DELETE FROM post WHERE id=".$id_post."");
				$result = $req->execute();
				$result2 = $req2->execute();
				if ($result2 == 1) {
				return Post::DELETE_POST_OK;
			} else {
				return Post::DELETE_POST_ERROR;
			}
		} else {
			return 	Post::NOT_POST;
		}
		}
?>

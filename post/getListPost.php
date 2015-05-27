<?php
	include("../pdo.php");
	include("post.php");
	
	if(isset($_GET["id_author"], $_GET["nbAff"], $_GET["AffAp"]))
	{
		echo ListPost($_GET["id_author"], $_GET["nbAff"], $_GET["AffAp"]);
	} else {
		echo "ERROR";
	}
	
	function ListPost($id_author, $nbAff, $AffAp)
	{
		if (!isListPost($id_author, $nbAff, $AffAp)) {
			return 	Post::ALREADY_POST;
		} else {
			
			$bdd = getPDO();
			$requete= $bdd->prepare("SELECT * FROM post, comment, friend, user where friend.id_person1 = user.id and user.id = post.id_author and post.id = comment.id_post and post.id_author=".$id_author." ORDER BY datePost desc Limit ".$nbAff." offset ".$AffAp.";");
			$requete->execute();
			while ($data = $requete->fetch(PDO::FETCH_ASSOC)) {
			   print_r ($data);
			   echo '<br>';
			}
			if(count($data) > 0){
				return Post::ADD_POST_OK;
			} else {
				return Post::ADD_POST_ERROR;
			}
		}
	}

?>
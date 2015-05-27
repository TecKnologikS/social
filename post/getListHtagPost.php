<?php
	include("../pdo.php");
	include("post.php");
	
	if(isset($_GET["id_author"], $_GET["Htag"], $_GET["nbAff"], $_GET["AffAp"]))
	{
		echo ListHtagPost($_GET["id_author"], $_GET["Htag"], $_GET["nbAff"], $_GET["AffAp"]);
	} else {
		echo "ERROR";
	}
	
	function ListHtagPost($id_author, $Htag, $nbAff, $AffAp)
	{
		if (!isListHtagPost($id_author, $Htag, $nbAff, $AffAp)) {
			return 	Post::ALREADY_POST;
		} else {
			
			$bdd = getPDO();
			$requete= $bdd->prepare("SELECT * FROM post, comment, friend, user, tag where friend.id_person1=user.id and user.id=post.id_author and post.id=comment.id_post and comment.id_post=tag.id_post and post.id_author=".$id_author." and tag.libelle='".$Htag."' ORDER BY datePost desc Limit ".$nbAff." offset ".$AffAp."");
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
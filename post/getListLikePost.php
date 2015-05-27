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
			$requete= $bdd->prepare("SELECT p.*, (SELECT COUNT(*) FROM like_post lp WHERE lp.id_post = p.id ) as nbLike FROM post p ORDER BY nbLike DESC Limit ".$nbAff." offset ".$AffAp."");
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
	
	if (isset($_GET["id_author"]))	{
		echo json_encode(getListPostLike($_GET["id_author"]));
	}


	function getListPostLike($idauthor)
        {
		$post = new Post();
		$bdd = getPDO();
		$resultats = $bdd->query("select * from user u, like_post f, post p where u.id = f.id_author and f.id_author = p.id_author and f.id_author = ".$idauthor."");
		$row = $resultats->fetch();
		if ($row != null)
		{
			$post->idauthor = $row["idauthor"];
			$post->content = $row["content"];
		}
                return $post;
        }


?>

      


 

<?php

	class Post
	{
		const ADD_POST_OK = 100;
		const ADD_POST_ERROR = 101;
		const ALREADY_POST = 102;
		const ASK_POST_OK = 103;
		const DELETE_POST_OK = 104;
		const DELETE_POST_ERROR = 105;
		const ACCEPT_POST_OK = 106;
		const ACCEPT_POST_ERROR = 107;
		const NOT_POST = 108;

		const BDD_ID_AUTHOR = "id_author";
		const BDD_CONTENT = "content";
		const BDD_DATEPOST = "datePost";

		var $id_author;
		var $content;
		var $datepost;


		function Post()
		{
			$this->id_author = 0;
			$this->content = 0;
			$this->datepost = 0;
		}

	}

	function rowToPost($row, $Post)
	{
		$Post->id_author = $row[Post::BDD_id_author];
		$Post->content = $row[Post::BDD_content];
		$Post->datePost = $row[Post::BDD_datepost];
	}    

	function isPost($id_author, $content, $dateT)
	{
		$bdd=getPDO();
		$req = $bdd->query("SELECT id_author from Post WHERE (id_author=".$id_author." AND datePost=".$dateT.")");
			$data = $req->fetchAll();
			if(count($data) > 0){
				return Post::ADD_POST_ERROR;
			} else {
				return Post::ADD_POST_OK;
			}
			
	}
	
	function isDeletePost($id_author, $datePost)
	{
		$bdd=getPDO();
		$req = $bdd->query("SELECT id_author, datePost from Post WHERE id_author=".$id_author." AND datePost like '".$datePost."%';");
		$data = $req->fetchAll();
			if(count($data) > 0){
					return Post::DELETE_POST_OK;
				} else {
					return Post::DELETE_POST_ERROR;
				}
	}
	
	function isUpdatePost($id_author, $content, $datePost)
	{
		$bdd=getPDO();
		$req = $bdd->query("SELECT id_author, datePost from Post WHERE id_author=".$id_author." AND datePost like '".$datePost."%';");
		$data = $req->fetchAll();
			if(count($data) > 0){
					return Post::ACCEPT_POST_OK;
				} else {
					return Post::ACCEPT_POST_ERROR;
				}
	}
	
	function isListPost($id_author, $nbAff, $AffAp)
	{
		$bdd=getPDO();
		$req = $bdd->query("SELECT * from Post WHERE id_author=".$id_author.";");
		$data = $req->fetchAll();
			if(count($data) > 0){
					return Post::ACCEPT_POST_OK;
				} else {
					return Post::ACCEPT_POST_ERROR;
				}
	}
	
	function isListHtagPost($id_author, $Htag, $nbAff, $AffAp)
	{
		$bdd=getPDO();
		$req = $bdd->query("SELECT * from Post WHERE id_author=".$id_author.";");
		$data = $req->fetchAll();
			if(count($data) > 0){
					return Post::ACCEPT_POST_OK;
				} else {
					return Post::ACCEPT_POST_ERROR;
				}
	}
	
	
?>

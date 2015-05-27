<?php

	class comment
	{
		const ADD_COMMENT_OK = 100;
		const ADD_COMMENT_ERROR = 101;
		const ALREADY_POST = 102;
		const ASK_COMMENT_OK = 103;
		const DELETE_COMMENT_OK = 104;
		const DELETE_COMMENT_ERROR = 105;
		const ACCEPT_COMMENT_OK = 106;
		const ACCEPT_COMMENT_ERROR = 107;
		const NOT_COMMENT = 108;


	}
 

	function isComment($id_post, $id_author, $content, $dateT, $id_person)
	{
		$bdd=getPDO();
		$req = $bdd->query("SELECT id_post from comment WHERE id_author=".$id_author."");
			$data = $req->fetchAll();
			if(count($data) > 0){
				return Comment::ADD_COMMENT_OK;
			} else {
				return Comment::ADD_COMMENT_ERROR;
			}
			
	}
	
	function isDeleteComment($id_author, $datePost)
	{
		$bdd=getPDO();
		$req = $bdd->query("SELECT id_author, datePost from Post WHERE id_author=".$id_author." AND datePost like '".$datePost."%';");
		$data = $req->fetchAll();
			if(count($data) > 0){
					return Comment::DELETE_POST_OK;
				} else {
					return Comment::DELETE_POST_ERROR;
				}
	}
	
	function isUpdatePost($id_author, $content, $datePost)
	{
		$bdd=getPDO();
		$req = $bdd->query("SELECT id_author, datePost from Post WHERE id_author=".$id_author." AND datePost like '".$datePost."%';");
		$data = $req->fetchAll();
			if(count($data) > 0){
					return Comment::ACCEPT_POST_OK;
				} else {
					return Comment::ACCEPT_POST_ERROR;
				}
	}
	
	
?>

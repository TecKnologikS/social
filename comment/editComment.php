<?php
include("../BusinessLayer.php");
class CommentEdit extends BusinessLayer
{
	public function __construct()
	{
		parent::__construct();
	}
	public function run()
	{
		try
		{
			if($this->getMethod() == "POST")
	    	{
				$_idComment = $this->getRequest("idComment");
				$_user_idUser = $this->getIdUser();
				$_content = $this->getRequest("content");
        		$params = array(
								":idComment" => $_idComment,
								":user_idUser" => $_user_idUser,
								":content" => $_content
								);
				$statement = $this->m_db->prepare("UPDATE comment
													
													SET content = :content 
													
													WHERE idComment = :idComment
														AND user_idUser = :user_idUser");
														
				if($statement && $statement->execute($params))
				{
					$this->addData(array(
										"idComment" => $_idComment,
										"content" => $_content
										));
				}
				else
				{
					$this->setCode(10);
				}
			}
			else
			{
				$this->setCode(8);
			}
		}
		catch(PDOException $e)
		{
			if(DEBUG) $this->addData(array("msg" => $e->getMessage()));
			$this->setCode(13);
		}
		catch(Exception $e)
		{
			if(DEBUG) $this->addData(array("msg" => $e->getMessage()));
			$this->setCode(4);
		}
		finally
		{
			$this->response();
		}
	}
}
$api = new CommentEdit();
$api->run();
?>
<?php
include("../BusinessLayer.php");
class CommentLike extends BusinessLayer
{
	public function __construct()
	{
		parent::__construct();
	}
	public function run()
	{
		try
		{
			if($this->getMethod() == "GET")
	    	{
				$_user_idUser = $this->getIdUser();
				$_comment_idComment = $this->getRequest("idComment");
				$_createdDate = date("Y-m-d H:i:s");
        		$params = array(
								":user_idUser" => $_user_idUser,
								":comment_idComment" => $_comment_idComment,
								":createdDate" => $_createdDate
								);
				$statement = $this->m_db->prepare("SELECT *
				
													FROM comment_like
													
													WHERE user_idUser = :user_idUser
														AND comment_idComment = :comment_idComment");
														
				if($statement->execute($params) && $statement->rowCount() == 1)
				{
				  	
				  	$result = $statement->fetch();
				  
					$statement = $this->m_db->prepare("DELETE FROM comment_like
					
														WHERE idComment_like = ?");
					
					if($statement && $statement->execute(array($result['idComment_like'])))
          			{
						$this->setCode(3);		
					}
					else
					{
						$this->setCode(10);
					}
				}
				else
				{
					//Like
					$statement = $this->m_db->prepare("INSERT INTO comment_like
														(
															user_idUser, 
															comment_idComment, 
															created_date
														)
														
														VALUES
														(
															:user_idUser, 
															:comment_idComment, 
															:createdDate
														)");
														
					if($statement && $statement->execute($params))
          			{
            			$_idCommentLike = $this->m_db->lastInsertId();
						
						$this->setCode(2);
            			$this->addData(array(
											"idComment_like" => $_idComment_like,
											"createdDate" => $_createdDate
											));
          			}
					else
					{
						$this->setCode(10);
					}
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
$api = new CommentLike();
$api->run();
?>
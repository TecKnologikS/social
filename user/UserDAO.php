<?php 


function getPDO()
{
	return new PDO('mysql:host=localhost;dbname=socialnet', 'root', 'root');
}

function getUser($Critere)
{
	$user = new User();
	$bdd = getPDO();
	$resultats = $bdd->query("SELECT * FROM user WHERE ".$Critere);
	$row = $resultats->fetch();
	if ($row != null)
	{
		rowToUser($row, $user);
	}
        return $user;
}

function rowToUser($row, $user)
{
	$user->id = $row["id"];
	$user->name = $row["name"];
	$user->first_name = $row["first"];
}

?>

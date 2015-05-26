<?php 

$dsn = 'mysql:dbname=socialnet;host=localhost';
$user = 'root';
$password = 'root';
function getPDO()
{
	try
	    {
	        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	        $bdd = new PDO('mysql:host=localhost;dbname=socialnet', 'root2', 'root', $pdo_options);
	 
	                return $bdd;
	    }
	    catch (Exception $e)
	    {
	           die('Erreur : ' . $e->getMessage());
	    }
}


//$bdd = new PDO('mysql:host=localhost;dbname=socialnet', 'root', 'root');

?>

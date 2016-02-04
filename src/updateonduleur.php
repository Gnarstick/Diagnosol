<?php


$nom = $_GET['Nom'];
$owner = $_GET['Owner'];


session_start();

$userlog = $_SESSION['login'];

if ($userlog=="diagnosol-master")
{
	
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM onduleurs WHERE Nom = '$nom' AND owner = 'all'";
$compteur = 0;

$reponse = mysqli_query($conn, $sql);
while($donnees = mysqli_fetch_array($reponse))
{
	$compteur = $compteur + reccount($nom, "all", $compteur);
}

$newnom = $nom;
if ($compteur != 0)
{
	$newnom = $newnom . " (" . $compteur . ")";
}

$sql = "UPDATE onduleurs set Nom = '$newnom', owner = 'all' WHERE Nom = '$nom' AND owner = '$owner'";

mysqli_query($conn, $sql);
mysqli_close($conn);


header('Location: onduleur.php');
}
else
{
	header('Location: onduleur.php');
}

function reccount ($name, $user, $compteur)
{
	if ($compteur != 0)
	{
		$tempname = $name . " (" . $compteur . ")";
	}
	else
	{
		$tempname = $name;
	}
	$sql = "SELECT * FROM onduleurs WHERE Nom = '$tempname' AND owner = '$user'";
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "diagnosol";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) 
	{
		die("Connection failed: " . mysqli_connect_error());
	}

	$reponse = mysqli_query($conn, $sql);
	while($donnees = mysqli_fetch_array($reponse))	
	{
		$compteur = $compteur +1;
		return 1 + reccount($name, $user, $compteur);
	}
	return 0;

}
?>
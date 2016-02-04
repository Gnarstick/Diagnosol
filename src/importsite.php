<?php
session_start();
$userlog = $_SESSION['login'];

if ($userlog == "")
{
	header('Location: ./connexionhtml.php');
}
else
{

$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

$lat = $_POST['place_latitude'];
$long = $_POST['place_longitude'];
$nom = $_POST['place_name'];

if($userlog == "diagnosol-master")
{
	$userlog = "all";
}

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) 
{
	die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM station";
																
$min = array("", 10000000000);

$reponse = mysqli_query($conn, $sql);
while($donnees = mysqli_fetch_array($reponse))
{
	$min = getmin($min, $lat, $long, $donnees['Latitude'], $donnees['Longitude'], $donnees['Nom']);
}

$sql3 = "SELECT * FROM site_relation WHERE name = '$nom' AND owner = '$userlog'";
$compteur = 0;

$reponse3 = mysqli_query($conn, $sql3);
while($donnees = mysqli_fetch_array($reponse3))
{
	$compteur = $compteur + reccount($nom, $userlog, $compteur);
}

if ($compteur != 0)
{
	$nom = $nom . " (" . $compteur . ")";
}

$sql2 = "INSERT INTO site_relation (`name`, `latitude`, `longitude`, `station`, `owner`) VALUES ('$nom','$lat','$long','$min[0]','$userlog')";

//test pour voir si les data sont add comme il faut
if (mysqli_query($conn, $sql2)) {
//    echo "New record created successfully";
} else {
   //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);


header('Location: site.php');
}

function triangle($xu,$yu,$x,$y)
{
	return sqrt(($xu - $x)*($xu - $x) + ($yu - $y)*($yu - $y));
}

function getmin($min, $xu, $yu, $x1, $y1, $name)
{
	if ($min[1]< triangle($xu, $yu, $x1, $y1))
	{
		return $min;
	}
	else
	{
		return array($name, triangle($xu, $yu, $x1, $y1));
	}
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
	$sql = "SELECT * FROM site_relation WHERE name = '$tempname' AND owner = '$user'";
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
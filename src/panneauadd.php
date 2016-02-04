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

//print_r($_POST);

$nom = $_POST['panneau_name'];
$pmpp = $_POST['panneau_puinomi'];
$vmpp = $_POST['panneau_tensnomi'];
$impp = $_POST['panneau_cournomi'];
$voc = $_POST['panneau_tensouvert'];
$isc = $_POST['panneau_courantIsc'];
$rendement = $_POST['panneau_rendement'];
$noct = $_POST['panneau_noct'];
$temppmpp = $_POST['panneau_coeftpmpp'];
$annee = $_POST['panneau_annee'];
$long = $_POST['panneau_long'];
$larg = $_POST['panneau_larg'];
$lien = $_POST['onduleur_lien'];
$prix = $_POST['panneau_prix'];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($userlog == "diagnosol-master")
{
	$userlog = "all";
}

$sql = "SELECT * FROM panneaux WHERE Nom = '$nom' AND owner = '$userlog'";
$compteur = 0;

$reponse = mysqli_query($conn, $sql);
while($donnees = mysqli_fetch_array($reponse))
{
	$compteur = $compteur + reccount($nom, $userlog, $compteur);
}

if ($compteur != 0)
{
	$nom = $nom . " (" . $compteur . ")";
}

$sq2 = "INSERT INTO panneaux (`Nom`, `Puissance_nominale_Pmpp`, `Tension_nominale_Vmpp`, `Courant_nominal_Impp`, `Tension_circuit_ouvert_Voc`, `Courant_court-circuit_Isc`, `Rendement`, `NOCT`, `Coefficient_Temp_Pmpp`, `Annee`, `Longueur`, `Largeur`, `Prix`, `lien`, `owner`) VALUES ('$nom','$pmpp','$vmpp','$impp','$voc','$isc','$rendement','$noct','$temppmpp','$annee','$long','$larg','$prix', '$lien', '$userlog')";

//test pour voir si les data sont add comme il faut
if (mysqli_query($conn, $sq2)) {
//    echo "New record created successfully";
} else {
   //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

header('Location: panneaux.php');
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
	
	$sql = "SELECT * FROM panneaux WHERE Nom = '$tempname' AND owner = '$user'";
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
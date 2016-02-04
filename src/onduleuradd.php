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
$mppt = $_POST['turbine_start_speed'];
$string = $_POST['onduleur_nbpvstring'];
$name = $_POST['onduleur_name'];
$pays = $_POST['onduleur_land'];
$constructeur = $_POST['onduleur_manufacturer'];
$puientmax = $_POST['oduleur_entermaxpower'];
$DCmax = $_POST['onduleur_tension'];
$courantmax = $_POST['onduleur_courantentremax'];
$ACnominal = $_POST['onduleur_acnominal'];
$ACmax = $_POST['onduleur_acmax'];
$courantsortiemax = $_POST['onduleur_courantsortiemax'];
$rendement = $_POST['onduleur_rendement'];
$annee = $_POST['onduleur_annee'];
$lien = $_POST['onduleur_lien'];
$prix = $_POST['onduleur_prix'];

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

$sql = "SELECT * FROM onduleurs WHERE Nom = '$name' AND owner = '$userlog'";
$compteur = 0;

$reponse = mysqli_query($conn, $sql);
while($donnees = mysqli_fetch_array($reponse))
{
	$compteur = $compteur + reccount($name, $userlog, $compteur);
}

if ($compteur != 0)
{
	$name = $name . " (" . $compteur . ")";
}
$sql2 = "INSERT INTO onduleurs (`MPPT`, `PV_string`, `Nom`, `Pays`, `Constructeur`, `Puissance_entree_max`, `Tension_DC_max`, `Courant_entree_max`, `Puissance_AC_nominal`, `Puissance_AC_Max`, `Courant_sortie_max`, `Rendement`, `Annee`, `Prix`, `Lien`, `owner`) VALUES ('$mppt', '$string', '$name', '$pays', '$constructeur', '$puientmax', '$DCmax', '$courantmax', '$ACnominal', '$ACmax', '$courantsortiemax', '$rendement', '$annee', '$prix', '$lien', '$userlog')";

//test pour voir si les data sont add comme il faut
if (mysqli_query($conn, $sql2)) {
//    echo "New record created successfully";
} else {
//   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

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
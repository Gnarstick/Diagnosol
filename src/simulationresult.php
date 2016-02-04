<!DOCTYPE html> <!--  -->
<html>
    <head>
        <meta charset="utf-8">
        <title>DiagnoSOL &bull; Résultats de Simulation</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="../img/favicon.ico">
        <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="favicon.ico" /><![endif]-->
        
        <!-- Bootstrap.css -->
        	<link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css" />
        
        <!-- personal CSS -->
        	<link type="text/css" rel="stylesheet" href="../css/perso.css" />
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
        	<script type="text/javascript" src="../js/highcharts.js"></script>
        	<script type="text/javascript" src="../js/exporting.js"></script>
    </head>
	
	<?php 
	session_start();
	session_get_cookie_params();
	$userlog = $_SESSION['login']; 
	?>
	
    <body>
        
        <noscript><br> &nbsp; 
        <b style="color: #ff0000;background-color: rgba(255, 255, 255, 0.8);border-radius: 4px;"> &nbsp; 
            <span class="glyphicon glyphicon-alert"></span> &nbsp;
            Ce site nécessite JavaScript pour fonctionner, veuillez l'activer. &nbsp;
            <span class="glyphicon glyphicon-alert"></span> &nbsp; </b> &nbsp; 
        </noscript>

 <!-- navigation bar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
                    </button>
                    
                    <a href="/">
                        <img id="logoCALSIMEOL" src="../img/logo.jpg" alt="logo" />                    </a> 
                </div>
                
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/">Accueil</a></li>
                        <li class="active"><a href="simulation.php">Simulation</a></li>
                        <li><a href="site.php">Sites</a></li>
                        <li><a href="panneaux.php">Panneaux</a></li>
                        <li><a href="onduleur.php">Onduleurs</a></li>
                        <li><a href="propos.php">A propos</a></li>
						<li><a href="FAQ.php">F.A.Q</a></li></ul>
						<ul class="nav navbar-nav navbar-right"><li><a <?php if($userlog == ""){echo "href=\"connexionhtml.php\"";}else{echo "href=\"connexion.php\"";}?> ><?php if($userlog == ""){echo "Connexion";}else{echo "Déconnexion";} ?></a></li>
                    </ul>
                </div><!--/.nav-collapse -->
                
              </div>
        </nav>
        <div class="container" style="padding-top:40px">
<!-- Homepage -->

<?php

//print_r($_POST);
// recuperation des parametre de la page precedent
$villepost = $_POST['place_choice'];
$onduleurpost = $_POST['onduleur_choice'];
$panneaupost = $_POST['panneau_choice'];

list($Ville, $Villeowner) = explode('.', $villepost);
list($Onduleur, $Onduleurowner) = explode('.', $onduleurpost);
list($Panneauxformu, $Panneauxformuowner) = explode('.', $panneaupost);

$surfaceutilisateur = $_POST['surface'];
$productionutilisateur = $_POST['production'];
$priceutilisateur = $_POST['prix'];
$orientation = $_POST['orientation_choice'];
$inclinaison = $_POST['inclinaison_choice'];
$integration = $_POST['integration_choice'];
$marge = $_POST['marge'];

//variables statiques
$coutmaindoeuvre = 0.25;
$joursparmoi = array('31', '28.25', '31', '30', '31', '30', '31', '31', '30', '31', '30', '31');
$orientationtab = array(array("Est", 0.93,  0.90, 0.79, 0.78, 0.55), array("Sud-Est", 0.93, 0.96, 0.92, 0.88, 0.66), array("Sud", 0.93, 1.00, 0.97, 0.91, 0.68), array("Sud-Ouest", 0.93, 0.96, 0.92, 0.88, 0.66), array("Ouest", 0.93, 0.90, 0.79, 0.78, 0.55));
$tauxinflation = 0.03;
$tauxactua = 0.10;


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

//requete pour la ville
$sql3 = "SELECT * FROM site_relation WHERE name = '$Ville' AND owner='$Villeowner'";
//reponse pour la ville
$reponseville = mysqli_query($conn, $sql3);
$donneesville = mysqli_fetch_array($reponseville);

$station = $donneesville['station'];

//Requete sql utilisé pour trouver la bonne ville dans la database
$sql = "SELECT * FROM meteo WHERE Ville = '$station'";
//Requete pour l'onduleur
$sql1 = "SELECT * FROM onduleurs WHERE Nom = '$Onduleur' AND owner='$Onduleurowner'";
//Requete pour le panneau
$sql2 = "SELECT * FROM panneaux WHERE Nom = '$Panneauxformu' AND owner='$Panneauxformuowner'";
//Requete pour le nombre d'heure de soleil
$sql3 = "SELECT COUNT(*) FROM meteo WHERE Ville='$station'and Irradiation >0";


//reponse pour les courbes
$reponse = mysqli_query($conn, $sql);
$reponse1 = mysqli_query($conn, $sql);
$reponse2 = mysqli_query($conn, $sql);
$reponse3 = mysqli_query($conn, $sql);

//reponse pour le nombre d'heure
$reponse4 = mysqli_query($conn, $sql3);

$donneesheure = mysqli_fetch_array($reponse4);

$nbheuresoleil = $donneesheure[0];

if ($Onduleur != "Selection automatique")
{
	$reponseonduleur = mysqli_query($conn, $sql1);
	$donneesonduleur = mysqli_fetch_array($reponseonduleur);
}
	
$reponsepanneau = mysqli_query($conn, $sql2);
$donneespanneau = mysqli_fetch_array($reponsepanneau);


//Fonctions utilisées pour les calcules

//fonction de retour de valeur inclinaison/orientation pour le tableau (index de l'array)
function inclinaison_number($inclinaison)
{
	switch($inclinaison)
	{
		case 0:
			return 1;
			break;
		case 30:
			return 2;
			break;
		case 45:
			return 3;
			break;
		case 60:
			return 4;
			break;
		case 90:
			return 5;
			break;
	}
}

function orientation_number($orientation)
{
	switch($orientation)
	{
		case "Est":
			return 0;
			break;
		case "Sud-Est":
			return 1;
			break;
		case "Sud":
			return 2;
			break;
		case "Sud-Ouest":
			return 3;
			break;
		case "Ouest":
			return 4;
			break;
	}
}

// Calcul de la température du module
function tempmod($S, $NOCT , $Tair)
{
	return $Tair + (($NOCT - 20)/80) * $S; //S = irradiation (en W/m²) divisée par 10
}

function temperaturedatacourbe($reponse, $NOCT)
{
	$tableau;
	$data;
	$cmpj = 0;
	$month = 1;
	
	for ($j = 0; $j <24; $j++)
	{
		$tableau[$j] = 0;
	}
	
	while($donnees = mysqli_fetch_array($reponse))
				{
						if ($month == $donnees['Month'])
						{
							if ($donnees['Time'] == 0)
							{
								$cmpj = $cmpj + 1;
							}
							$tableau[round($donnees['Time'])] = $tableau[round($donnees['Time'])] + tempmod($donnees['Irradiation']/10,$NOCT,$donnees['Temperature']);
							
						}
						else
						{
							for ($i = 0; $i <= sizeof($tableau)-1; $i++)
							{
								$tableau[$i] = $tableau[$i]/$cmpj;
								$data[$month][$i] = round($tableau[$i], 2);
								$tableau[$i] = 0;
							}
							$month++;
							$cmpj = 0;
							if ($donnees['Time'] == 0)
							{
								$cmpj = $cmpj + 1;
							}
							$tableau[round($donnees['Time'])] = $tableau[round($donnees['Time'])] + tempmod($donnees['Irradiation']/10,$NOCT,$donnees['Temperature']);
						}
				}
				for ($i = 0; $i <= sizeof($tableau)-1; $i++)
				{
					$tableau[$i] = $tableau[$i]/$cmpj;
					$data[$month][$i] = round($tableau[$i], 2);
					$tableau[$i] = 0;
				}
				return $data;
}

function lossesA ($Tcell)
{
	return ($Tcell - 25) * 0.4;
}


function lossesB($lossesA)
{
	if($lossesA > 0)
	{
		return $lossesA;
	}
	else
	{
		return 0;
	}
}


// Calcul de la production d'un module en prenant en compte les pertes liées à la température
function lossesC($nominalpower, $lossesB)
{
	return $nominalpower - (($lossesB / 100)*$nominalpower);
}

function produmoduledatacourbe($reponse, $datatempmonth, $nominalpower)
{
	$tableau;
	$data;
	$cmpj = 0;
	$month = 1;
	
	for ($j = 0; $j <24; $j++)
	{
		$tableau[$j] = 0;
	}
	
	while($donnees = mysqli_fetch_array($reponse))
				{
						if ($month == $donnees['Month'])
						{
							if ($donnees['Time'] == 0)
							{
								$cmpj = $cmpj + 1;
							}
							$tableau[round($donnees['Time'])] = $tableau[round($donnees['Time'])] + lossesC($nominalpower, lossesB(lossesA($donnees['Temperature'])));
						}
						else
						{
							for ($i = 0; $i <= sizeof($tableau) - 1; $i++)
							{
								$tableau[$i] = $tableau[$i]/$cmpj;
								$data[$month][$i] = round($tableau[$i], 2);
								$tableau[$i] = 0;
							}
							$month++;
							$cmpj = 0;
							if ($donnees['Time'] == 0)
							{
								$cmpj = $cmpj + 1;
							}
							$tableau[round($donnees['Time'])] = $tableau[round($donnees['Time'])] + lossesC($nominalpower, lossesB(lossesA($donnees['Temperature'])));
						}
				}
				for ($i = 0; $i <= sizeof($tableau)-1; $i++)
							{
								$tableau[$i] = $tableau[$i]/$cmpj;
								$data[$month][$i] = round($tableau[$i], 2);
								$tableau[$i] = 0;
							}
	return $data;
}

// Production d'un module

function irradiationmoy($reponse)
{
	$irradiationmoy = 0;
	$cmp = 0;

	while($donnees = mysqli_fetch_array($reponse))
				{
					if ($donnees['Irradiation'] != 0)
					{
						$cmp = $cmp + 1;
						$irradiationmoy = $irradiationmoy +  $donnees['Irradiation'];
					}
				}
	if ($cmp != 0)
	{
		return $irradiationmoy/$cmp;
	}
	else
	{
		return $irradiationmoy;
	}
}

function irradiationdatacourbe($reponse)
{
	$tableau;
	$data;
	$cmpj = 0;
	$month = 1;
	
	for ($j = 0; $j <24; $j++)
	{
		$tableau[$j] = 0;
	}
	
	while($donnees = mysqli_fetch_array($reponse))
				{
						if ($month == $donnees['Month'])
						{
							if ($donnees['Time'] == 0)
							{
								$cmpj = $cmpj + 1;
							}
							if ($donnees['Irradiation'] >= 0)
							{
								$tableau[round($donnees['Time'])] = $tableau[round($donnees['Time'])] + $donnees['Irradiation'];
							}
						}
						else
						{
							for ($i = 0; $i <= sizeof($tableau) - 1; $i++)
							{
								$tableau[$i] = $tableau[$i]/$cmpj;
								$data[$month][$i] = round($tableau[$i], 2);
								$tableau[$i] = 0;
							}
							$month++;
							$cmpj = 0;
							if ($donnees['Time'] == 0)
							{
								$cmpj = $cmpj + 1;
							}
							if ($donnees['Irradiation'] >= 0)
							{
								$tableau[round($donnees['Time'])] = $tableau[round($donnees['Time'])] + $donnees['Irradiation'];
							}
						}
				}
				for ($i = 0; $i <= sizeof($tableau)-1; $i++)
							{
								$tableau[$i] = $tableau[$i]/$cmpj;
								$data[$month][$i] = round($tableau[$i], 2);
								$tableau[$i] = 0;
							}
	return $data;
}

//output d'un module
function outpoutmod($irradiation, $lossesC, $orientationtab, $orientation, $inclinaison)
{
  return($irradiation / 1000)*$lossesC*$orientationtab[orientation_number($orientation)][inclinaison_number($inclinaison)];
}

function poweroutpoutdatacourbe($datairra, $dataperte, $orientationtab, $orientation, $inclinaison)
{
	$data;
	
	for($k = 0; $k < 24; $k++)
	{
		for($l = 1; $l < 13; $l++)
		{
			$data[$l][$k] = outpoutmod($datairra[$l][$k], $dataperte[$l][$k], $orientationtab, $orientation, $inclinaison);
		}
	}
	
	return $data;
}

function nbonduleur($nbreelpnxparinv,  $nbtheoriquepnxparinv)
{
	if ($nbreelpnxparinv > $nbtheoriquepnxparinv)
	{
		return $nbtheoriquepnxparinv;
	}
	else
	{
		return $nbreelpnxparinv;
	}
}
	
function nbonduleurdeuxiemecondition($nbreel, $pmpp, $puisondu)
{
		while($puisondu < $pmpp * $nbreel)
		{
			$nbreel--;
		}
		return $nbreel; 
}
	
//Calcul du power outputtotal annuel
function outputannuel($production, $nbmod, $jours)
{
	$data;
	
	for ($j = 1; $j <13; $j++)
	{
		$data[$j] = 0;
	}
	
	for($k = 0; $k < 24; $k++)
	{
		for($l = 1; $l < 13; $l++)
		{
			$data[$l] = $data[$l] + round($production[$l][$k] * $nbmod * $jours[$l-1], 2);
		}
	}
	
	return $data;
}
	
function produtparheure($production, $nbheure)
{
	return round(($production/$nbheure), 2);
}
	
function array_sum_dim($array)
{
	$sum = 0;
	$divcmp = 0;
	foreach($array as $value)
	{
		$divcmp = $divcmp + sizeof($value);
		$sum = $sum + array_sum($value);
	}
	return $sum/$divcmp;
}

function affichagedonneetablea($donnees)
{
	return "Nom: " . $donnees['Nom'] . "<br>" . 
	       "Puissance nominale Pmpp: " . $donnees['Puissance_nominale_Pmpp'] . " W" . "<br>" . 
		   "Tension nominale Vmpp: " . $donnees['Tension_nominale_Vmpp'] . " V" . "<br>" .
		   "Courant nominal Impp: " . $donnees['Courant_nominal_Impp'] . " A" . "<br>" .
		   "Tension circuit ouvert Voc: " . $donnees['Tension_circuit_ouvert_Voc'] . " V" . "<br>" .
		   "Courant court-circuit Isc: " . $donnees['Courant_court-circuit_Isc'] . " A" . "<br>" .
		   "Rendement: " . $donnees['Rendement'] . "<br>" .
		   "NOCT: " . $donnees['NOCT'] . " °C" . "<br>" . 
		   "Coefficient Temp Pmpp: " . $donnees['Coefficient_Temp_Pmpp'] . " %/°C" . "<br>" .
		   "Année: " . $donnees['Annee'] . "<br>" .
		   "Longueur: " . $donnees['Longueur'] . " mm" . "<br>" .
		   "Largeur: " . $donnees['Largeur'] . " mm" . "<br>" .
		   "Prix: " . $donnees['Prix']. " €" ;
	
}

function affichagedonneeondu($donnees)
{
	return "Nom: " . $donnees['Nom'] . "<br>" . 
	       "Constructeur: " . $donnees['Constructeur'] . "<br>" . 
		   "Pays: " . $donnees['Pays'] . "<br>" .
		   "Puissance entree max: " . $donnees['Puissance_entree_max'] . " W" . "<br>" .
		   "Tension DC max: " . $donnees['Tension_DC_max'] . " V" . "<br>" .
		   "Courant entrée max: " . $donnees['Courant_entree_max'] . " A" . "<br>" .
		   "MPPT: " . $donnees['MPPT'] . "<br>" .
		   "PV string: " . $donnees['PV_string'] . "<br>" . 
		   "Puissance AC nominal: " . $donnees['Puissance_AC_nominal'] . " W" . "<br>" .
		   "Puissance AC Max: " . $donnees['Puissance_AC_Max'] . " W" . "<br>" .
		   "Courant sortie max: " . $donnees['Courant_sortie_max'] . " A" . "<br>" .
		   "Rendement: " . $donnees['Rendement'] . " %" . "<br>" .
		   "Année: " . $donnees['Annee'] . "<br>" .
		   "Prix: " . $donnees['Prix'] . " €";
}

function prixrevente($production, $type)
{
	switch ($type)
	{
		case "ISB":
			if ($production < 36000)
			{
				return 0.144;
			}
			else
			{
				return 0.1368;
			}
			break;
		case "IAB":
			return 0.2539;
			break;
		case "Autre":
			return 0.06;
			break;
	}
}

// Debut des differents calcules

$datatempmonth = temperaturedatacourbe($reponse2, $donneespanneau['NOCT']);

// Calcul des pertes liées à la température du module 
//Valeurs DB
$nominalpower = $donneespanneau['Puissance_nominale_Pmpp'];

$dataprodmonth = produmoduledatacourbe($reponse3, $datatempmonth, $nominalpower);

$irradiationmoy = irradiationmoy($reponse);

$datairramonth = irradiationdatacourbe($reponse1);

$dataoutpmonth = poweroutpoutdatacourbe($datairramonth, $dataprodmonth, $orientationtab, $orientation, $inclinaison);
// DESIGN OF THE PV ARRAY

if($surfaceutilisateur == "")
{
	$PVarea = 0;
}
else
{
	$PVarea = $surfaceutilisateur;
}

		
if($priceutilisateur != "") //si tu as un prix
{

	$PVarea = 0;
	$totalpriceneed = 0;
	$lastnbmodule = 0;
	$lastnbondu = 0;
	$numbermodules = 0;
	$nbonduleurtotal = 0;
	$pricetotalmodule = 0;
	$pricetotalonduleur = 0;
	$pricemodule = $donneespanneau['Prix'];
	$PVtensionnominaleVmpp = $donneespanneau['Tension_nominale_Vmpp'];
	$PVtensioncircuitouvertVoc = $donneespanneau['Tension_circuit_ouvert_Voc'];
	
	if ($Onduleur != "Selection automatique")
	{
		
		$priceonduleur = $donneesonduleur['Prix'];
		$invtensionDCmax = $donneesonduleur['Tension_DC_max'];
		$invpuissanceentreemax = $donneesonduleur['Puissance_entree_max'];
		$nbMPPT = $donneesonduleur['MPPT'];
	
		while($totalpriceneed < $priceutilisateur)
		{

			$numbermodules = $PVarea / ($donneespanneau['Longueur']/1000 * $donneespanneau['Largeur']/1000);

// Design de l'onduleur

// L'onduleur doit être dimensionné de telle sorte à couvrir la puissance de tous les équipements AC en même temps. Du coup, sa taille doit être supérieure de 20 à 30% de la somme de la puissance des équipements.
// On suppose que cette puissance égale 8000W.
// De plus, en France le voltage est à 220V et  à 50 Hz

	
			$nbreelpnxparinv;
			$nbtheoriquepnxparinv;
	
			$nbreelpnxparinv = floor($invtensionDCmax / $PVtensionnominaleVmpp);
			$nbtheoriquepnxparinv = floor($invtensionDCmax / $PVtensioncircuitouvertVoc);
	
	
	
			$nbreelpnxparinvaprescondi = floor(nbonduleurdeuxiemecondition(floor(nbonduleur($nbreelpnxparinv, $nbtheoriquepnxparinv)*$nbMPPT), $nominalpower, $invpuissanceentreemax));
	
			$nbonduleurtotal = ceil($numbermodules /  $nbreelpnxparinvaprescondi);
	
		//calc prix
			$pricetotalonduleur = $priceonduleur * round($nbonduleurtotal,0);
			$pricetotalmodule = $pricemodule * round($numbermodules,0);
			$totalpriceneed = ($pricetotalonduleur + $pricetotalmodule) + ($pricetotalonduleur + $pricetotalmodule) * $coutmaindoeuvre;
			if ($totalpriceneed < $priceutilisateur)
			{
				$PVarea = $PVarea + $donneespanneau['Longueur']/1000 * $donneespanneau['Largeur']/1000;
				$lastnbmodule = $numbermodules;
				$lastnbondu = $nbonduleurtotal;
			}
			else
			{
				$numbermodules = $lastnbmodule;
				$nbonduleurtotal = $lastnbondu;
				$pricetotalonduleur = $priceonduleur * round($nbonduleurtotal,0);
				$pricetotalmodule = $pricemodule * round($numbermodules,0);
			}
		}
	}
	else
	{
	
		while($totalpriceneed < $priceutilisateur)
		{
			// Calcul du nombre de modules

			$numbermodules = $PVarea / ($donneespanneau['Longueur']/1000 * $donneespanneau['Largeur']/1000);
			//calc prix
			$pricetotalmodule = $pricemodule * $numbermodules;
			$pricetotalonduleur = $pricetotalmodule * 0.20;
			$totalpriceneed = ($pricetotalonduleur 	+ $pricetotalmodule) + ($pricetotalonduleur + $pricetotalmodule) * $coutmaindoeuvre;
			if ($totalpriceneed < $priceutilisateur)
			{
				$PVarea = $PVarea + $donneespanneau['Longueur']/1000 * $donneespanneau['Largeur']/1000;
				$lastnbmodule = $numbermodules;
			}
			else
			{
				$numbermodules = $lastnbmodule;
				$pricetotalmodule = $pricemodule * $numbermodules;
				$pricetotalonduleur = $pricetotalmodule * 0.20;
			}
		}
	}
}
else //si tu as pas de prix
{		
	
	if ($productionutilisateur == "") //si tu as une surface il faut < surface demandée
	{
		$numbermodules = floor($PVarea / ($donneespanneau['Longueur']/1000 * $donneespanneau['Largeur']/1000));
	}
	else //Sinon si tu as une demande journaliere il faut etre > demande
	{
		$numbermodules = ceil($productionutilisateur / $nominalpower);
	}
	$pricemodule = $donneespanneau['Prix'];
	
	if ($Onduleur != "Selection automatique")
	{
		$priceonduleur = $donneesonduleur['Prix'];
	

// Design de l'onduleur

// L'onduleur doit être dimensionné de telle sorte à couvrir la puissance de tous les équipements AC en même temps. Du coup, sa taille doit être supérieure de 20 à 30% de la somme de la puissance des équipements.
// On suppose que cette puissance égale 8000W.
// De plus, en France le voltage est à 220V et  à 50 Hz

		$invtensionDCmax = $donneesonduleur['Tension_DC_max'];
		$invpuissanceentreemax = $donneesonduleur['Puissance_entree_max'];
		$PVtensionnominaleVmpp = $donneespanneau['Tension_nominale_Vmpp'];
		$PVtensioncircuitouvertVoc = $donneespanneau['Tension_circuit_ouvert_Voc'];
		$nbMPPT = $donneesonduleur['MPPT'];
		$nbreelpnxparinv;
		$nbtheoriquepnxparinv;
	
		$nbreelpnxparinv = floor($invtensionDCmax / $PVtensionnominaleVmpp);
		$nbtheoriquepnxparinv = floor($invtensionDCmax / $PVtensioncircuitouvertVoc);
	
	
	
		$nbreelpnxparinvaprescondi = floor(nbonduleurdeuxiemecondition(floor(nbonduleur($nbreelpnxparinv, $nbtheoriquepnxparinv)*$nbMPPT), $nominalpower, $invpuissanceentreemax));
	
		$nbonduleurtotal = ceil($numbermodules /  $nbreelpnxparinvaprescondi);
		//calc prix
		$pricetotalonduleur = $priceonduleur * round($nbonduleurtotal,0);
		$pricetotalmodule = $pricemodule * round($numbermodules,0);
	}
	else
	{
		$pricetotalmodule = $pricemodule * round($numbermodules,0);
		$pricetotalonduleur = $pricetotalmodule * 0.20;
	}
	
}

$totalannuel = outputannuel($dataoutpmonth, $numbermodules, $joursparmoi);

$totalannuelnograph = round(array_sum($totalannuel)/1000, 2);

$pricestuff = round($pricetotalonduleur+$pricetotalmodule,2) + round(($pricetotalonduleur+$pricetotalmodule) * ($marge/100) ,2);

$prixrevente = prixrevente(round($nominalpower * $numbermodules / 1000, 2), $integration);

// ------------------------------------ FINANCE -------------------------------------------

//graph rentabilité
//PWond1 = valeur actuelle de l'onduleur 10ans
$PWond1 = $pricetotalonduleur * pow(((1 + $tauxinflation)/(1 + $tauxactua)), 10);
////PWond1 = valeur actuelle de l'onduleur 20ans
$PWond2 = $PWond1 * pow(((1 + $tauxinflation)/(1 + $tauxactua)), 20);
$limitepartiesup = round(round($pricetotalonduleur+$pricetotalmodule,2) + round(($pricetotalonduleur+$pricetotalmodule) * $marge/100,2) + round($PWond1,2) + round($PWond1 * $marge/100,2) + round($PWond2,2) + round($PWond2 * $marge/100,2) + round(($pricetotalonduleur+$pricetotalmodule)* $coutmaindoeuvre,2));
$tabprixrevente[0] = 0;
$tabprixrevente[1] = prixrevente(round($nominalpower * $numbermodules / 1000, 2), $integration);
for ($j = 2; $j < 26; $j++)
{
		$tabprixrevente[$j] = $tabprixrevente[$j-1] + $tabprixrevente[$j-1] * 0.04;
}
$cumul = 0;
$limite = 0;
for ($j = 1; $j < 26; $j++)
{
	$cumul = $cumul + ($tabprixrevente[$j] * $totalannuelnograph);
	
	if (($cumul >= $limitepartiesup)&&($limite == 0))
	{
		$limite = $j;
	}
}

if ($limite == 0)
{
	$limite = 25;
}

?>

<div class="row">
            <div class="clearness col-sm-12">
                
                <div class="row">
                    <div class="lead col-sm-6" style="margin-bottom:-20px; color:#0C4C69">
                        <h1><b>Informations :</b></h1>
                    </div>
                </div>
				
				<div class="row">
                    <div class="lead col col-sm-6" style="margin-bottom:5px; margin-left:30px; margin-top:5px;">
					<!--- nom provenant de la db -->
                        <h3>Lieu: <?php echo $Ville; ?></h3>
						<h3>Panneau:  <?php echo $Panneauxformu; ?>
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="<?php echo affichagedonneetablea($donneespanneau); ?>">
											<span class="glyphicon glyphicon-menu-right" style="font-size:80%"></span>
										</a></h3>
						<h3>Onduleur: <?php echo $Onduleur; ?>
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="<?php if(!isset($donneesonduleur)){echo "Vos onduleurs doivent être capable de supporter une capacité de " . number_format(round($nominalpower * $numbermodules / 1000, 2), 2, ',', ' ') . " kW";}else{echo affichagedonneeondu($donneesonduleur);}; ?>">
											<span class="glyphicon glyphicon-menu-right" style="font-size:80%"></span>
										</a></h3>
						<h3> Orientation: <?php echo $orientation; ?></h3>
						<h3> Inclinaison: <?php echo $inclinaison; ?>°</h3>
						<h3> Intégration: <?php echo $integration; ?>
										<a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="<?php if($integration == "IAB"){echo "[0-9kWc->25,39 c€/kWh] Les panneaux sont intégrés au bati et jouent un rôle de couverture. Ils garantissent l'étanchéité des toits.";}
                                           if ($integration == "ISB"){echo "[0-36kWc->14,4c€/kWh / 36-100kWc->13,68c€/kWh] Les panneaux solaires sont directement fixés sur la toiture existante en surimposition.";}
                                           if ($integration == "Autre"){echo "[0-12MWc->6,12c€/kWh] Autre type d'installation";} ?>">
											<span class="glyphicon glyphicon-menu-right" style="font-size:80%"></span>
										</a></h3>
						<h3> Critère choisi : <?php if ($surfaceutilisateur != "") {echo "Surface - " . number_format($surfaceutilisateur, 0, ',', ' ') . " m<sup>2</sup>";} 
													if ($priceutilisateur != "") {echo "Prix - " . number_format($priceutilisateur, 0, ',', ' ') . "€";}
													if ($productionutilisateur !="") {echo "Puissance - " . number_format($productionutilisateur, 0, ',', ' ') . "W";} ?></h3>
                    </div>

                    <div class="col-sm-5" style="margin-bottom: 20px">
                            <div align="center" id="googleMap" style="margin-left: 30px;width:350px; height:350px;"></div>
                        	</div>
                    	
                    	<div class="lead col-sm-12" style="color:#0C4C69;margin-bottom:-10px;">
                        	<h1><b>Résultats de l'étude:</b></h1>
                   		</div>
                </div>
				
				<div class="row">
                    <div class="col-sm-6">
                       <table class="table table-responsive table-striped table-condensed">
					     <tr>
							<td><b>&nbsp; Surface de l'installation:</b></td><td> <?php echo number_format(round($numbermodules * $donneespanneau['Longueur']/1000 * $donneespanneau['Largeur']/1000, 2), 2, ',', ' '); ?> </td><td>m<sup>2</sup></td>
						</tr>
						<tr>
							<td><b>&nbsp; Température maximale du module :</b></td><td> <?php echo number_format(max(max($datatempmonth)), 2, ',', ' '); ?> </td><td>°C</td>
						</tr>
						<tr>
							<td><b>&nbsp; Puissance nominale installée :</b></td><td> <?php echo number_format(round($nominalpower * $numbermodules / 1000, 2), 2, ',', ' '); ?> </td><td>kW</td>
						</tr>
                         <tr>
                            <td><b>&nbsp; Puissance max délivrée par panneau en fonctionnement :</b></td><td> <?php echo number_format(round(produtparheure(array_sum($totalannuel), $nbheuresoleil)/$numbermodules, 2), 2, ',', ' '); ?> </td><td>W</td>
                         </tr>
						<tr>
                            <td><b>&nbsp; Puissance max de l'installation en fonctionnement :</b></td><td> <?php echo number_format(produtparheure(array_sum($totalannuel), $nbheuresoleil), 2, ',', ' '); ?> </td><td>W</td>
                         </tr>
						 <tr>
							<td><b>&nbsp; Prix de vente de l'électricité :<b></td><td><?php echo $prixrevente?></td><td>€/kWh</td>
						 </tr>
                        </table>
                    </div>
                    <div class="col-sm-6">
                       <table class="table table-responsive table-striped table-condensed">
                          <tr>
                            <td><b>&nbsp; Nombre de panneaux :</b></td><td> <?php echo number_format(ceil($numbermodules), 0, ',', ' '); ?> </td><td>unités</td>
                          </tr>
						  <tr>
                            <td><b>&nbsp; Nombre d'onduleurs :</b></td><td> <?php if($Onduleur != "Selection automatique"){echo number_format(ceil($nbonduleurtotal), 0, ',', ' ');}else{echo "ND";} ?> </td><td>unités</td>
                          </tr>
						  <tr>
						  <td><b>&nbsp; Rayonnement solaire moyen :</b></td><td><?php echo number_format(round(array_sum_dim($datairramonth),2), 2, ',', ' '); ?> </td><td>W/m<sup>2</sup></td>
						  </tr>
						  <tr>
                            <td><b>&nbsp; Production annuelle de l'installation :</b></td><td> <?php echo number_format($totalannuelnograph, 2, ',', ' ') ?> </td><td>kWh</td>
                          </tr>
						  <tr>
						  <td><b>&nbsp; Coût de l'installation :</b></td><td><?php echo number_format($pricestuff + round($pricestuff * $coutmaindoeuvre,2), 2, ',', ' '); ?> </td><td>€</td>
						  </tr>
						  <tr>
						  <td><b>&nbsp; Retour sur investissement :</b></td><td><?php if($limite < 25) {echo number_format($limite, 0, ',', ' ')/*number_format(round(round(round($pricetotalonduleur+$pricetotalmodule,2) + round(($pricetotalonduleur+$pricetotalmodule) * $marge/100,2) + round(($pricetotalonduleur+$pricetotalmodule)* $coutmaindoeuvre,2))/(prixrevente(round($nominalpower * $numbermodules / 1000, 2), $integration)* $totalannuelnograph),1), 1, ',', ' ')*/;}else{echo " > 25 <a href=\"#pop\" class=\"pop\" data-toggle=\"popover\" data-html=\"true\" data-trigger=\"focus\" data-placement=\"auto\"
                                                               data-content=\"Une installation est considérée comme non rentable quand la période de rentabilité dépasse 25 ans. Cela est du par le besoin de changer l'intégrallité des panneaux après une période de 25 ans\"
                                                               title=\"<b>Attention : Information</b>\">
                                                                    <span class=\"glyphicon glyphicon-warning-sign\" style=\"color:red;\"></span>
                                                            </a>";} ?></td><td>ans</td>
						  </tr>
                        </table>
                    </div>
                </div>
				
				<div class="row">
					<div class ="col-sm-6 col-sm-offset-4">
						<h4><span class="glyphicon glyphicon-tree-deciduous" style="color: green;"></span><b>Emission de CO2 évitée par an: <?php echo number_format(round($totalannuelnograph * 0.089, 2), 2, ',', ' '); /* valeur pour la france */ ?> kg/an</b></h4>
					</div>
				</div>
				
				  <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b>Production moyenne d'un panneau </b></div>
                                <div class="panel-body"><br>
                                      <div id="chart5"></div>
                                      <span class="btn btn-info btn-xs pull-left" id="displayTab5"><span class="glyphicon glyphicon-list"></span>&nbsp; Afficher / Masquer tableau</span>
                                      <span class="btn btn-info btn-xs pull-right" id="displayFormule5"><span class="glyphicon glyphicon-superscript"></span>&nbsp; Afficher / Masquer explication</span></br></br>
									  <div class="table-responsive">
										<p class="legende5" style="display: none;"><b>Valeurs exprimées en W </b></p>
                                        <table id="tab5" class="table table-striped table-condensed">
											<tbody><tr>
														<th>Heure</th>
                                                        <th>Janvier</th>
                                                        <th>Février</th>
                                                        <th>Mars</th>
														<th>Avril</th>
														<th>Mai</th>
														<th>Juin</th>
														<th>Juillet</th>
														<th>Aout</th>
														<th>Septembre</th>
														<th>Octobre</th>
														<th>Novembre</th>
														<th>Décembre</th>
                                                </tr>
												<?php for($k = 0; $k < 24; $k++)
													{ ?>
														<tr><td><b> <?php echo $k. " h" ?></b></td>
														<?php for($l = 1; $l < 13; $l++)
															{ ?>															
															<td> <?php echo $dataoutpmonth[$l][$k]; ?></td>
															<?php } ?>
												<?php } ?>
											</tbody>
										</table>
                                      </div>
									  <div id="formule5" style="display:none">
											</br>
											<p>Le graphique de la production journalière représente l’énergie produite en moyenne chaque mois en fonction de l’heure.</p>
											 <p>Chaque courbe permet de visualiser la production moyenne horaire pour le mois en question.</p>
											  <p> Afin d’expliquer le calcul effectué, prenons l’exemple du mois de Janvier.
											   La production journalière de ce mois est égale à la somme des productions relevées chaque heure de chaque jour divisée par le nombre de jour dans le mois puis multipliée par le rendement du panneau choisi.</p>
									  </div>
                                 </div>
                            </div>
                        </div>
						<div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b>Production annuelle</b></div>
                                <div class="panel-body"><br>
                                      <div id="chart6"></div>
                                      <span class="btn btn-info btn-xs pull-left" id="displayTab6"><span class="glyphicon glyphicon-list"></span>&nbsp; Afficher / Masquer tableau</span>
                                      <span class="btn btn-info btn-xs pull-right" id="displayFormule6"><span class="glyphicon glyphicon-superscript"></span>&nbsp; Afficher / Masquer explication</span></br></br>
   									  <div class="table-responsive">
									    <p class="legende6" style="display: none;"><b>Valeurs exprimées en Wh </b></p>
                                        <table id="tab6" class="table table-striped table-condensed">
											<tbody><tr>
                                                        <th>Janvier</th>
                                                        <th>Février</th>
                                                        <th>Mars</th>
														<th>Avril</th>
														<th>Mai</th>
														<th>Juin</th>
														<th>Juillet</th>
														<th>Aout</th>
														<th>Septembre</th>
														<th>Octobre</th>
														<th>Novembre</th>
														<th>Décembre</th>
                                                </tr>
												<tr>
												<?php 
												for($l = 1; $l < 13; $l++)
													{ ?>															
														 <td><?php echo $totalannuel[$l]; ?></td>
												<?php 
													} ?>
												</tr>
											</tbody>
										</table>
                                      </div>
									  <div id="formule6" style="display:none">
											</br>
											<p>Ce graphique représente la part de production d'énergie pour chaque mois.
												La somme de la production mensuelle permet d'obtenir la production annuelle.
											</p>
									  </div>
                                 </div>
                            </div>
                        </div>
				  </div>

				<div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b>Evolution du revenu</b></div>
                                <div class="panel-body"><br>
                                      <div id="chart7"></div>
                                      <span class="btn btn-info btn-xs pull-left" id="displayTab7"><span class="glyphicon glyphicon-list"></span>&nbsp; Afficher / Masquer tableau</span>
                                      <span class="btn btn-info btn-xs pull-right" id="displayFormule7"><span class="glyphicon glyphicon-superscript"></span>&nbsp; Afficher / Masquer explication</span></br></br>
									  <div class="table-responsive">
									  <p class="legende7" style="display: none;"><b>Valeurs exprimées en € </b></p>
                                        <table id="tab7" class="table table-striped table-condensed">
											<tbody><tr>
														<th>Heure</th>
                                                        <th>Janvier</th>
                                                        <th>Février</th>
                                                        <th>Mars</th>
														<th>Avril</th>
														<th>Mai</th>
														<th>Juin</th>
														<th>Juillet</th>
														<th>Aout</th>
														<th>Septembre</th>
														<th>Octobre</th>
														<th>Novembre</th>
														<th>Décembre</th>
                                                </tr>
												<tr><?php for($l = 1; $l < 13; $l++)
															{ ?>															
															<td> <?php echo round($totalannuel[$l]/1000 * $prixrevente, 2); ?> </td>
															<?php } ?>
												</tr>
											</tbody>
										</table>
                                      </div>
									  <div id="formule7" style="display:none">
											</br>
											<p>Cette courbe vous permet de visualiser le revenu mensuel que génère votre installation. 
											Ce revenu est le résultat de la vente de l’énergie produite par l’installation.
											La courbe représente l’évolution annuelle du revenu.</p>
									  </div>
                                 </div>
                            </div>
                        </div>
						<div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b>Coût du projet</b></div>
                                <div class="panel-body"><br>
                                      <div id="chart2"></div>
                                      <span class="btn btn-info btn-xs pull-left" id="displayTab2"><span class="glyphicon glyphicon-list"></span>&nbsp; Afficher / Masquer tableau</span>
									  <span class="btn btn-info btn-xs pull-right" id="displayFormule2"><span class="glyphicon glyphicon-superscript"></span>&nbsp; Afficher / Masquer explication</span></br></br>
                                      <div class="table-responsive">
									  <p class="legende2" style="display: none;"><b>Valeurs exprimées en €</b></p>
                                        <table id="tab2" class="table table-striped table-condensed">
											<tbody><tr>
														<th></th>
                                                        <th>Nombre</th>
														<th>Prix Unitaire</th>
                                                        <th>Prix Total</th>
                                                </tr>
												<tr><td>Onduleurs</td><td><?php if ($Onduleur != "Selection automatique"){echo round($nbonduleurtotal,0);}else{echo "-";}?></td><td><?php if ($Onduleur != "Selection automatique"){echo $donneesonduleur['Prix'];}else{echo "-";} ?></td><td><?php if ($Onduleur != "Selection automatique"){echo $priceonduleur*round($nbonduleurtotal,0);}else{echo $pricetotalonduleur;} ?></td></tr>
												<tr><td>Panneaux</td><td><?php echo round($numbermodules,0)?></td><td><?php echo $donneespanneau['Prix']; ?></td><td><?php echo $pricemodule*round($numbermodules,0) ?></td></tr>
												<tr><td>Main d'oeurvre</td><td> - </td><td> - </td><td><?php echo round($pricestuff*$coutmaindoeuvre,2); ?></td></tr>
												<tr><td>Marge</td><td> - </td><td> - </td><td><?php echo round(($pricetotalonduleur+$pricetotalmodule) * ($marge/100) ,2); ?></td></tr>
											</tbody>
										</table>
                                      </div>
									  <div id="formule2" style="display:none">
											</br>
											<p><p><b> Calcul du coût de l'installation :</b></p>
											<p> Prix unitaire panneau * nombre de panneau + Prix unitaire ondulaire * nombre onduleur (1) + prix main d'oeuvre (2) + marge installateur (3)</p>
											<p>	(1) Dans le cas où vous avez choisi "Selection automatique", le coût de l'onduleur est estimé à 20% du coût des panneaux installés</p> 
											<p> (2) Le prix de main d'oeuvre est estimé à 25% du coût des panneaux</p>
											<p> (3) la marge de l'installateur est calculée à partir du prix des panneaux, le calcul est le suivant : prix unitaire panneau * nombre de panneau * pourcentage de marge</p></div>
                                 </div>
                            </div>
                        </div>
						
									
			</div>
			
			<div class="row">
			<div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b>Retour sur investissement</b></div>
                                <div class="panel-body"><br>
                                      <div id="chart8"></div>
                                      <span class="btn btn-info btn-xs pull-left" id="displayTab8"><span class="glyphicon glyphicon-list"></span>&nbsp; Afficher / Masquer tableau</span>
                                      <span class="btn btn-info btn-xs pull-right" id="displayFormule8"><span class="glyphicon glyphicon-superscript"></span>&nbsp; Afficher / Masquer explication</span></br></br>
   									  <div class="table-responsive">
                                        <table id="tab8" class="table table-striped table-condensed">
											<tbody>
												<tr>
													<?php for ($i = 0; $i < 26; $i++)
													{
														echo "<th>" . $i . "</th>";
													}
													?>
												</tr>
												<tr>
													<?php 
													$cumuleaffichage = 0;
													for ($i = 0; $i < $limite; $i++)
													{
														$cumuleaffichage = $cumuleaffichage + round($totalannuelnograph * $tabprixrevente[$i], 2); 
														echo "<th style=\"color:red\">" . round(($cumuleaffichage * 100) / $limitepartiesup,2) . "%</th>";
													}
													for ($i = $limite; $i < 26; $i++)
													{
														$cumuleaffichage = $cumuleaffichage + round($totalannuelnograph * $tabprixrevente[$i], 2);
														if (round(($cumuleaffichage * 100) / $limitepartiesup,2) > 100)
														{
															echo "<th style=\"color:green\">" . round(($cumuleaffichage * 100) / $limitepartiesup,2) . "%</th>";
														}
														else
														{
															echo "<th style=\"color:red\">" . round(($cumuleaffichage * 100) / $limitepartiesup,2) . "%</th>";
														}
													}
													?>
												</tr>
											</tbody>
										</table>
                                      </div>
									  <div id="formule8" style="display:none">
											</br>
											<p>
											   Cette courbe représente le retour sur investissement en fonction du temps.
											   La partie rouge de la courbe représente le temps de remboursement de l’installation.
											   La partie verte de la courbe représente le bénéfice généré après remboursement.
											   Le tableau permet de visualiser le pourcentage de retour sur investissement chaque année.
											</p>
									  </div>
                                 </div>
                            </div>
                        </div>
						<div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b>Puissance d'un panneau en fonction de la tempèrature</b></div>
                                <div class="panel-body"><br>
                                      <div id="chart4"></div>
                                      <span class="btn btn-info btn-xs pull-left" id="displayTab4"><span class="glyphicon glyphicon-list"></span>&nbsp; Afficher / Masquer tableau</span>
									  <span class="btn btn-info btn-xs pull-right" id="displayFormule4"><span class="glyphicon glyphicon-superscript"></span>&nbsp; Afficher / Masquer explication</span></br></br>
									  <div class="table-responsive">
										<p class="legende4" style="display: none;"><b>Valeurs exprimées en W </b></p>
                                        <table id="tab4" class="table table-striped table-condensed">
											<tbody><tr>
														<th>Heure</th>
                                                        <th>Janvier</th>
                                                        <th>Février</th>
                                                        <th>Mars</th>
														<th>Avril</th>
														<th>Mai</th>
														<th>Juin</th>
														<th>Juillet</th>
														<th>Aout</th>
														<th>Septembre</th>
														<th>Octobre</th>
														<th>Novembre</th>
														<th>Décembre</th>
                                                </tr>
												<?php for($k = 0; $k < 24; $k++)
													{ ?>
														<tr><td><b> <?php echo $k. " h" ?></b></td>
														<?php for($l = 1; $l < 13; $l++)
															{ ?>															
															<td> <?php echo $dataprodmonth[$l][$k]; ?> </td>
															<?php } ?>
												<?php } ?>
											</tbody>
										</table>
                                      </div>
									  <div id="formule4" style="display:none">
											</br>
											<p>Ces courbes permettent d'observer les pertes de puissance causées par l'augmentation de la température du module. 
												Plus la température du module est élevée, plus la puissance nominale du module diminue.</p>
									  </div>
                                 </div>
                            </div>
                        </div>
						
									
			</div>
			
			<div class="row">
			<div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b>Température moyenne du module</b></div>
                                <div class="panel-body"><br>
                                      <div id="chart3"></div>
                                      <span class="btn btn-info btn-xs pull-left" id="displayTab3"><span class="glyphicon glyphicon-list"></span>&nbsp; Afficher / Masquer tableau</span>
                                      <span class="btn btn-info btn-xs pull-right" id="displayFormule3"><span class="glyphicon glyphicon-superscript"></span>&nbsp; Afficher / Masquer explication</span></br></br>
									  <div class="table-responsive">
										<p class="legende3" style="display: none;"><b>Valeurs exprimées en °C</b></p>
                                        <table id="tab3" class="table table-striped table-condensed">
											<tbody><tr>
														<th>Heure</th>
                                                        <th>Janvier</th>
                                                        <th>Février</th>
                                                        <th>Mars</th>
														<th>Avril</th>
														<th>Mai</th>
														<th>Juin</th>
														<th>Juillet</th>
														<th>Aout</th>
														<th>Septembre</th>
														<th>Octobre</th>
														<th>Novembre</th>
														<th>Décembre</th>
                                                </tr>
												<?php for($k = 0; $k < 24; $k++)
													{ ?>
														<tr><td><b> <?php echo $k. " h" ?></b></td>
														<?php for($l = 1; $l < 13; $l++)
															{ ?>															
															<td> <?php echo $datatempmonth[$l][$k]; ?> </td>
															<?php } ?>
												<?php } ?>
											</tbody>
										</table>
                                      </div>
									  <div id="formule3" style="display:none">
											</br>
											<p> La <b>température moyenne d'un module</b> est un paramètre important dans le dimensionnement des panneaux photovoltaiques.
												Cela permet de calculer les pertes d'énergie causées par l'échauffement du module.</p>
											<p> <b>Explication : </b>Chaque courbe représente la température moyenne journalière d'un module par mois.
												Par exemple pour le mois de janvier, on a effectué une moyenne journalière des valeurs mesurées chaque heure.
												Ce qui nous a permis d'obtenir les différents points de la courbe. Par exmple à 12h au mois de Janvier, on a en moyenne une temperature de module de 11,13°C.</p>
											<p>	La température moyenne du module dépend du matériel et du site choisi. </p>
									  </div>
                                 </div>
                            </div>
                        </div>
                    
						<div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b>Rayonnement moyen</b></div>
                                <div class="panel-body"><br>
                                      <div id="chart1"></div>
                                      <span class="btn btn-info btn-xs pull-left" id="displayTab1"><span class="glyphicon glyphicon-list"></span>&nbsp; Afficher / Masquer tableau</span>
                                      <span class="btn btn-info btn-xs pull-right" id="displayFormule1"><span class="glyphicon glyphicon-superscript"></span>&nbsp; Afficher / Masquer explication</span></br></br>
									  <div class="table-responsive">
										<p class="legende1" style="display: none;"><b>Valeurs exprimées en W/m² </b></p>
                                        <table id="tab1" class="table table-striped table-condensed">
											<tbody><tr>
														<th>Heure</th>
                                                        <th>Janvier</th>
                                                        <th>Février</th>
                                                        <th>Mars</th>
														<th>Avril</th>
														<th>Mai</th>
														<th>Juin</th>
														<th>Juillet</th>
														<th>Aout</th>
														<th>Septembre</th>
														<th>Octobre</th>
														<th>Novembre</th>
														<th>Décembre</th>
                                                </tr>
												<?php for($k = 0; $k < 24; $k++)
													{ ?>
														<tr><td><b> <?php echo $k. " h" ?></b></td>
														<?php for($l = 1; $l < 13; $l++)
															{ ?>															
															<td> <?php echo $datairramonth[$l][$k]; ?> </td>
															<?php } ?>
												<?php } ?>
											</tbody>
										</table>
                                      </div>
									  <div id="formule1" style="display:none">
											</br>
											<p> <b>Irradiation solaire :</b> Exposition d'un corps à un flux de rayonnements qui provient du soleil.</p>
											<p> Une courbe d'irradiation solaire moyenne est définie pour chaque mois en fonction du site choisi. 
												Un capteur solaire mesure l'irradiation instantanée chaque heure pendant 1 an. 
												Chacune des courbes représente donc une moyenne, pour chaque jour du mois considéré, de l'irradiation reçue par un module par heure.  </p>
											</br>
											<p> <b>Rayonnement global </b>= rayonnement diffus + rayonnement direct + rayonnement réfléchi (albédo) </p>
											<img src="../img/rayonnementsolaire.jpg" class="img-responsive center-block"> </img>
									  </div>
                                 </div>
                            </div>
                    </div>
									
			</div>
			<div class="form-group">
                                <button class="pull-right btn btn-success" id="print"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> &nbsp; Télécharger en PDF</button>
            </div>
			
		</div>
 
		</div>
			
	</div>
	
	

<!-------------------------------------------------------------------------JavaScript------------------------------------------------------------>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp" type="text/javascript"></script>
<script type="text/javascript">

var map, marker;

$(function () {
  var mapOptions={
  zoom: 5,
  center: new google.maps.LatLng(<?php echo $donneesville['latitude']; ?>,<?php echo $donneesville['longitude']; ?>),
  mapTypeId: 'hybrid'
  };

  map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);

  placeMarker (new google.maps.LatLng(<?php echo $donneesville['latitude']; ?>,<?php echo $donneesville['longitude']; ?>));
});

function placeMarker(location) {

  $('#latitude').val(location.k);
  $('#divLatitude').addClass('has-feedback');
  $('#divLatitude').addClass('has-success').removeClass('has-error') && $('#divLatitude').find('.good').show() && $('#divLatitude').find('.error').hide();
  $('#longitude').val(location.D);
  $('#divLongitude').addClass('has-feedback');
  $('#divLongitude').addClass('has-success').removeClass('has-error') && $('#divLongitude').find('.good').show() && $('#divLongitude').find('.error').hide();

  if(marker){ //on vÃ©rifie si le marqueur existe
    marker.setPosition(location); //on change sa position
  }else{
    marker = new google.maps.Marker({ //on crÃ©Ã© le marqueur
    position: location, 
    map: map
    });
  }
}
$(function () {
				$('#displayTab1').click(function() {
                    $('#tab1').css('display') === 'none' ? $('#tab1').css({'display': 'inline'}) : $('#tab1').css({'display': 'none'});
					$('.legende1').css('display') === 'none' ? $('.legende1').css({'display': 'inline'}) : $('.legende1').css({'display': 'none'});
                });
                $('#displayTab2').click(function() {
                    $('#tab2').css('display') === 'none' ? $('#tab2').css({'display': 'inline'}) : $('#tab2').css({'display': 'none'});
					$('.legende2').css('display') === 'none' ? $('.legende2').css({'display': 'inline'}) : $('.legende2').css({'display': 'none'});
                });
                $('#displayTab3').click(function() {
                    $('#tab3').css('display') === 'none' ? $('#tab3').css({'display': 'inline'}) : $('#tab3').css({'display': 'none'});
					$('.legende3').css('display') === 'none' ? $('.legende3').css({'display': 'inline'}) : $('.legende3').css({'display': 'none'});
                });
                $('#displayTab4').click(function() {
                    $('#tab4').css('display') === 'none' ? $('#tab4').css({'display': 'inline'}) : $('#tab4').css({'display': 'none'});
					$('.legende4').css('display') === 'none' ? $('.legende4').css({'display': 'inline'}) : $('.legende4').css({'display': 'none'});
                });
				$('#displayTab5').click(function() {
                    $('#tab5').css('display') === 'none' ? $('#tab5').css({'display': 'inline'}) : $('#tab5').css({'display': 'none'});
                    $('.legende5').css('display') === 'none' ? $('.legende5').css({'display': 'inline'}) : $('.legende5').css({'display': 'none'});
                });
				$('#displayTab6').click(function() {
                    $('#tab6').css('display') === 'none' ? $('#tab6').css({'display': 'inline'}) : $('#tab6').css({'display': 'none'});
					$('.legende6').css('display') === 'none' ? $('.legende6').css({'display': 'inline'}) : $('.legende6').css({'display': 'none'});
                });
				$('#displayTab7').click(function() {
                    $('#tab7').css('display') === 'none' ? $('#tab7').css({'display': 'inline'}) : $('#tab7').css({'display': 'none'});
					$('.legende7').css('display') === 'none' ? $('.legende7').css({'display': 'inline'}) : $('.legende7').css({'display': 'none'});
                });
				$('#displayTab8').click(function() {
                    $('#tab8').css('display') === 'none' ? $('#tab8').css({'display': 'inline'}) : $('#tab8').css({'display': 'none'});
					$('.legende8').css('display') === 'none' ? $('.legende8').css({'display': 'inline'}) : $('.legende8').css({'display': 'none'});
                });
				$('#displayFormule1').click(function() {
                    $('#formule1').css('display') === 'none' ? $('#formule1').css({'display': 'inline'}) : $('#formule1').css({'display': 'none'});
                });
				$('#displayFormule2').click(function() {
                    $('#formule2').css('display') === 'none' ? $('#formule2').css({'display': 'inline'}) : $('#formule2').css({'display': 'none'});
                });
				$('#displayFormule3').click(function() {
                    $('#formule3').css('display') === 'none' ? $('#formule3').css({'display': 'inline'}) : $('#formule3').css({'display': 'none'});
                });
				$('#displayFormule4').click(function() {
                    $('#formule4').css('display') === 'none' ? $('#formule4').css({'display': 'inline'}) : $('#formule4').css({'display': 'none'});
                });
				$('#displayFormule5').click(function() {
                    $('#formule5').css('display') === 'none' ? $('#formule5').css({'display': 'inline'}) : $('#formule5').css({'display': 'none'});
                });
				$('#displayFormule6').click(function() {
                    $('#formule6').css('display') === 'none' ? $('#formule6').css({'display': 'inline'}) : $('#formule6').css({'display': 'none'});
                });
				$('#displayFormule7').click(function() {
                    $('#formule7').css('display') === 'none' ? $('#formule7').css({'display': 'inline'}) : $('#formule7').css({'display': 'none'});
                });
				$('#displayFormule8').click(function() {
                    $('#formule8').css('display') === 'none' ? $('#formule8').css({'display': 'inline'}) : $('#formule8').css({'display': 'none'});
                });
			
				$('#print').click(function() {window.print()});
                
                 $('#chart1').highcharts({
                    chart: {
                        type: 'spline'
                    },
                    title: {
                        text: 'Rayonnement moyen'
                    },
                    xAxis: {
                        title: {
                            text: 'Heure (h)'
                        },
                        tickInterval: 5,
                        min: 0,
                        max: 23
                    },
                    colors:['#a55c8c', '#4c8da6', '#ffa500', '#ffff66', '#33ff66', '#cc0000', '#ff3399', '#999999', '#cc6600', '#006600', '#663300', '#336633'],
                    yAxis: {
                        title: {
                            text: 'Rayonnement moyen (W/m²)'
                        },
                        gridLineWidth: 1,
                        min: 0
                    },
                    plotOptions: {
                            series: {
                                marker: {
                                    enabled: false
                                }
                            }
                        },
                    series: [{
                                name: 'Janvier',
                                data: [[0,<?php echo $datairramonth[1][0] ?>],[1,<?php echo $datairramonth[1][1] ?>],[2,<?php echo $datairramonth[1][2] ?>],[3,<?php echo $datairramonth[1][3] ?>],[4,<?php echo $datairramonth[1][4] ?>],[5,<?php echo $datairramonth[1][5] ?>],[6,<?php echo $datairramonth[1][6] ?>],[7,<?php echo $datairramonth[1][7] ?>],[8,<?php echo $datairramonth[1][8] ?>],[9,<?php echo $datairramonth[1][9] ?>],[10,<?php echo $datairramonth[1][10] ?>],[11,<?php echo $datairramonth[1][11] ?>],[12,<?php echo $datairramonth[1][12] ?>],[13,<?php echo $datairramonth[1][13] ?>],[14,<?php echo $datairramonth[1][14] ?>],[15,<?php echo $datairramonth[1][15] ?>],[16,<?php echo $datairramonth[1][16] ?>],[17,<?php echo $datairramonth[1][17] ?>],[18,<?php echo $datairramonth[1][18] ?>],[19,<?php echo $datairramonth[1][19] ?>],[20,<?php echo $datairramonth[1][20] ?>],[21,<?php echo $datairramonth[1][21] ?>],[22,<?php echo $datairramonth[1][22] ?>],[23,<?php echo $datairramonth[1][23] ?>],]
							 },{name: 'Fevrier',
                                data: [[0,<?php echo $datairramonth[2][0] ?>],[1,<?php echo $datairramonth[2][1] ?>],[2,<?php echo $datairramonth[2][2] ?>],[3,<?php echo $datairramonth[2][3] ?>],[4,<?php echo $datairramonth[2][4] ?>],[5,<?php echo $datairramonth[2][5] ?>],[6,<?php echo $datairramonth[2][6] ?>],[7,<?php echo $datairramonth[2][7] ?>],[8,<?php echo $datairramonth[2][8] ?>],[9,<?php echo $datairramonth[2][9] ?>],[10,<?php echo $datairramonth[2][10] ?>],[11,<?php echo $datairramonth[2][11] ?>],[12,<?php echo $datairramonth[2][12] ?>],[13,<?php echo $datairramonth[2][13] ?>],[14,<?php echo $datairramonth[2][14] ?>],[15,<?php echo $datairramonth[2][15] ?>],[16,<?php echo $datairramonth[2][16] ?>],[17,<?php echo $datairramonth[2][17] ?>],[18,<?php echo $datairramonth[2][18] ?>],[19,<?php echo $datairramonth[2][19] ?>],[20,<?php echo $datairramonth[2][20] ?>],[21,<?php echo $datairramonth[2][21] ?>],[22,<?php echo $datairramonth[2][22] ?>],[23,<?php echo $datairramonth[2][23] ?>],]
                             },{name: 'Mars',
                                data: [[0,<?php echo $datairramonth[3][0] ?>],[1,<?php echo $datairramonth[3][1] ?>],[2,<?php echo $datairramonth[3][2] ?>],[3,<?php echo $datairramonth[3][3] ?>],[4,<?php echo $datairramonth[3][4] ?>],[5,<?php echo $datairramonth[3][5] ?>],[6,<?php echo $datairramonth[3][6] ?>],[7,<?php echo $datairramonth[3][7] ?>],[8,<?php echo $datairramonth[3][8] ?>],[9,<?php echo $datairramonth[3][9] ?>],[10,<?php echo $datairramonth[3][10] ?>],[11,<?php echo $datairramonth[3][11] ?>],[12,<?php echo $datairramonth[3][12] ?>],[13,<?php echo $datairramonth[3][13] ?>],[14,<?php echo $datairramonth[3][14] ?>],[15,<?php echo $datairramonth[3][15] ?>],[16,<?php echo $datairramonth[3][16] ?>],[17,<?php echo $datairramonth[3][17] ?>],[18,<?php echo $datairramonth[3][18] ?>],[19,<?php echo $datairramonth[3][19] ?>],[20,<?php echo $datairramonth[3][20] ?>],[21,<?php echo $datairramonth[3][21] ?>],[22,<?php echo $datairramonth[3][22] ?>],[23,<?php echo $datairramonth[3][23] ?>],]
                             },{name: 'Avril',
                                data: [[0,<?php echo $datairramonth[4][0] ?>],[1,<?php echo $datairramonth[4][1] ?>],[2,<?php echo $datairramonth[4][2] ?>],[3,<?php echo $datairramonth[4][3] ?>],[4,<?php echo $datairramonth[4][4] ?>],[5,<?php echo $datairramonth[4][5] ?>],[6,<?php echo $datairramonth[4][6] ?>],[7,<?php echo $datairramonth[4][7] ?>],[8,<?php echo $datairramonth[4][8] ?>],[9,<?php echo $datairramonth[4][9] ?>],[10,<?php echo $datairramonth[4][10] ?>],[11,<?php echo $datairramonth[4][11] ?>],[12,<?php echo $datairramonth[4][12] ?>],[13,<?php echo $datairramonth[4][13] ?>],[14,<?php echo $datairramonth[4][14] ?>],[15,<?php echo $datairramonth[4][15] ?>],[16,<?php echo $datairramonth[4][16] ?>],[17,<?php echo $datairramonth[4][17] ?>],[18,<?php echo $datairramonth[4][18] ?>],[19,<?php echo $datairramonth[4][19] ?>],[20,<?php echo $datairramonth[4][20] ?>],[21,<?php echo $datairramonth[4][21] ?>],[22,<?php echo $datairramonth[4][22] ?>],[23,<?php echo $datairramonth[4][23] ?>],]
                             },{name: 'Mai',
                                data: [[0,<?php echo $datairramonth[5][0] ?>],[1,<?php echo $datairramonth[5][1] ?>],[2,<?php echo $datairramonth[5][2] ?>],[3,<?php echo $datairramonth[5][3] ?>],[4,<?php echo $datairramonth[5][4] ?>],[5,<?php echo $datairramonth[5][5] ?>],[6,<?php echo $datairramonth[5][6] ?>],[7,<?php echo $datairramonth[5][7] ?>],[8,<?php echo $datairramonth[5][8] ?>],[9,<?php echo $datairramonth[5][9] ?>],[10,<?php echo $datairramonth[5][10] ?>],[11,<?php echo $datairramonth[5][11] ?>],[12,<?php echo $datairramonth[5][12] ?>],[13,<?php echo $datairramonth[5][13] ?>],[14,<?php echo $datairramonth[5][14] ?>],[15,<?php echo $datairramonth[5][15] ?>],[16,<?php echo $datairramonth[5][16] ?>],[17,<?php echo $datairramonth[5][17] ?>],[18,<?php echo $datairramonth[5][18] ?>],[19,<?php echo $datairramonth[5][19] ?>],[20,<?php echo $datairramonth[5][20] ?>],[21,<?php echo $datairramonth[5][21] ?>],[22,<?php echo $datairramonth[5][22] ?>],[23,<?php echo $datairramonth[5][23] ?>],]
                             },{name: 'Juin',
                                data: [[0,<?php echo $datairramonth[6][0] ?>],[1,<?php echo $datairramonth[6][1] ?>],[2,<?php echo $datairramonth[6][2] ?>],[3,<?php echo $datairramonth[6][3] ?>],[4,<?php echo $datairramonth[6][4] ?>],[5,<?php echo $datairramonth[6][5] ?>],[6,<?php echo $datairramonth[6][6] ?>],[7,<?php echo $datairramonth[6][7] ?>],[8,<?php echo $datairramonth[6][8] ?>],[9,<?php echo $datairramonth[6][9] ?>],[10,<?php echo $datairramonth[6][10] ?>],[11,<?php echo $datairramonth[6][11] ?>],[12,<?php echo $datairramonth[6][12] ?>],[13,<?php echo $datairramonth[6][13] ?>],[14,<?php echo $datairramonth[6][14] ?>],[15,<?php echo $datairramonth[6][15] ?>],[16,<?php echo $datairramonth[6][16] ?>],[17,<?php echo $datairramonth[6][17] ?>],[18,<?php echo $datairramonth[6][18] ?>],[19,<?php echo $datairramonth[6][19] ?>],[20,<?php echo $datairramonth[6][20] ?>],[21,<?php echo $datairramonth[6][21] ?>],[22,<?php echo $datairramonth[6][22] ?>],[23,<?php echo $datairramonth[6][23] ?>],]
                             },{name: 'Juillet',
                                data: [[0,<?php echo $datairramonth[7][0] ?>],[1,<?php echo $datairramonth[7][1] ?>],[2,<?php echo $datairramonth[7][2] ?>],[3,<?php echo $datairramonth[7][3] ?>],[4,<?php echo $datairramonth[7][4] ?>],[5,<?php echo $datairramonth[7][5] ?>],[6,<?php echo $datairramonth[7][6] ?>],[7,<?php echo $datairramonth[7][7] ?>],[8,<?php echo $datairramonth[7][8] ?>],[9,<?php echo $datairramonth[7][9] ?>],[10,<?php echo $datairramonth[7][10] ?>],[11,<?php echo $datairramonth[7][11] ?>],[12,<?php echo $datairramonth[7][12] ?>],[13,<?php echo $datairramonth[7][13] ?>],[14,<?php echo $datairramonth[7][14] ?>],[15,<?php echo $datairramonth[7][15] ?>],[16,<?php echo $datairramonth[7][16] ?>],[17,<?php echo $datairramonth[7][17] ?>],[18,<?php echo $datairramonth[7][18] ?>],[19,<?php echo $datairramonth[7][19] ?>],[20,<?php echo $datairramonth[7][20] ?>],[21,<?php echo $datairramonth[7][21] ?>],[22,<?php echo $datairramonth[7][22] ?>],[23,<?php echo $datairramonth[7][23] ?>],]
                             },{name: 'Aout',
                                data: [[0,<?php echo $datairramonth[8][0] ?>],[1,<?php echo $datairramonth[8][1] ?>],[2,<?php echo $datairramonth[8][2] ?>],[3,<?php echo $datairramonth[8][3] ?>],[4,<?php echo $datairramonth[8][4] ?>],[5,<?php echo $datairramonth[8][5] ?>],[6,<?php echo $datairramonth[8][6] ?>],[7,<?php echo $datairramonth[8][7] ?>],[8,<?php echo $datairramonth[8][8] ?>],[9,<?php echo $datairramonth[8][9] ?>],[10,<?php echo $datairramonth[8][10] ?>],[11,<?php echo $datairramonth[8][11] ?>],[12,<?php echo $datairramonth[8][12] ?>],[13,<?php echo $datairramonth[8][13] ?>],[14,<?php echo $datairramonth[8][14] ?>],[15,<?php echo $datairramonth[8][15] ?>],[16,<?php echo $datairramonth[8][16] ?>],[17,<?php echo $datairramonth[8][17] ?>],[18,<?php echo $datairramonth[8][18] ?>],[19,<?php echo $datairramonth[8][19] ?>],[20,<?php echo $datairramonth[8][20] ?>],[21,<?php echo $datairramonth[8][21] ?>],[22,<?php echo $datairramonth[8][22] ?>],[23,<?php echo $datairramonth[8][23] ?>],]
                             },{name: 'Septembre',
                                data: [[0,<?php echo $datairramonth[9][0] ?>],[1,<?php echo $datairramonth[9][1] ?>],[2,<?php echo $datairramonth[9][2] ?>],[3,<?php echo $datairramonth[9][3] ?>],[4,<?php echo $datairramonth[9][4] ?>],[5,<?php echo $datairramonth[9][5] ?>],[6,<?php echo $datairramonth[9][6] ?>],[7,<?php echo $datairramonth[9][7] ?>],[8,<?php echo $datairramonth[9][8] ?>],[9,<?php echo $datairramonth[9][9] ?>],[10,<?php echo $datairramonth[9][10] ?>],[11,<?php echo $datairramonth[9][11] ?>],[12,<?php echo $datairramonth[9][12] ?>],[13,<?php echo $datairramonth[9][13] ?>],[14,<?php echo $datairramonth[9][14] ?>],[15,<?php echo $datairramonth[9][15] ?>],[16,<?php echo $datairramonth[9][16] ?>],[17,<?php echo $datairramonth[9][17] ?>],[18,<?php echo $datairramonth[9][18] ?>],[19,<?php echo $datairramonth[9][19] ?>],[20,<?php echo $datairramonth[9][20] ?>],[21,<?php echo $datairramonth[9][21] ?>],[22,<?php echo $datairramonth[9][22] ?>],[23,<?php echo $datairramonth[9][23] ?>],]
                             },{name: 'Octobre',
                                data: [[0,<?php echo $datairramonth[10][0] ?>],[1,<?php echo $datairramonth[10][1] ?>],[2,<?php echo $datairramonth[10][2] ?>],[3,<?php echo $datairramonth[10][3] ?>],[4,<?php echo $datairramonth[10][4] ?>],[5,<?php echo $datairramonth[10][5] ?>],[6,<?php echo $datairramonth[10][6] ?>],[7,<?php echo $datairramonth[10][7] ?>],[8,<?php echo $datairramonth[10][8] ?>],[9,<?php echo $datairramonth[10][9] ?>],[10,<?php echo $datairramonth[10][10] ?>],[11,<?php echo $datairramonth[10][11] ?>],[12,<?php echo $datairramonth[10][12] ?>],[13,<?php echo $datairramonth[10][13] ?>],[14,<?php echo $datairramonth[10][14] ?>],[15,<?php echo $datairramonth[10][15] ?>],[16,<?php echo $datairramonth[10][16] ?>],[17,<?php echo $datairramonth[10][17] ?>],[18,<?php echo $datairramonth[10][18] ?>],[19,<?php echo $datairramonth[10][19] ?>],[20,<?php echo $datairramonth[10][20] ?>],[21,<?php echo $datairramonth[10][21] ?>],[22,<?php echo $datairramonth[10][22] ?>],[23,<?php echo $datairramonth[10][23] ?>],]
                             },{name: 'Novembre',
                                data: [[0,<?php echo $datairramonth[11][0] ?>],[1,<?php echo $datairramonth[11][1] ?>],[2,<?php echo $datairramonth[11][2] ?>],[3,<?php echo $datairramonth[11][3] ?>],[4,<?php echo $datairramonth[11][4] ?>],[5,<?php echo $datairramonth[11][5] ?>],[6,<?php echo $datairramonth[11][6] ?>],[7,<?php echo $datairramonth[11][7] ?>],[8,<?php echo $datairramonth[11][8] ?>],[9,<?php echo $datairramonth[11][9] ?>],[10,<?php echo $datairramonth[11][10] ?>],[11,<?php echo $datairramonth[11][11] ?>],[12,<?php echo $datairramonth[11][12] ?>],[13,<?php echo $datairramonth[11][13] ?>],[14,<?php echo $datairramonth[11][14] ?>],[15,<?php echo $datairramonth[11][15] ?>],[16,<?php echo $datairramonth[11][16] ?>],[17,<?php echo $datairramonth[11][17] ?>],[18,<?php echo $datairramonth[11][18] ?>],[19,<?php echo $datairramonth[11][19] ?>],[20,<?php echo $datairramonth[11][20] ?>],[21,<?php echo $datairramonth[11][21] ?>],[22,<?php echo $datairramonth[11][22] ?>],[23,<?php echo $datairramonth[11][23] ?>],]
                             },{name: 'Decembre',
                                data: [[0,<?php echo $datairramonth[12][0] ?>],[1,<?php echo $datairramonth[12][1] ?>],[2,<?php echo $datairramonth[12][2] ?>],[3,<?php echo $datairramonth[12][3] ?>],[4,<?php echo $datairramonth[12][4] ?>],[5,<?php echo $datairramonth[12][5] ?>],[6,<?php echo $datairramonth[12][6] ?>],[7,<?php echo $datairramonth[12][7] ?>],[8,<?php echo $datairramonth[12][8] ?>],[9,<?php echo $datairramonth[12][9] ?>],[10,<?php echo $datairramonth[12][10] ?>],[11,<?php echo $datairramonth[12][11] ?>],[12,<?php echo $datairramonth[12][12] ?>],[13,<?php echo $datairramonth[12][13] ?>],[14,<?php echo $datairramonth[12][14] ?>],[15,<?php echo $datairramonth[12][15] ?>],[16,<?php echo $datairramonth[12][16] ?>],[17,<?php echo $datairramonth[12][17] ?>],[18,<?php echo $datairramonth[12][18] ?>],[19,<?php echo $datairramonth[12][19] ?>],[20,<?php echo $datairramonth[12][20] ?>],[21,<?php echo $datairramonth[12][21] ?>],[22,<?php echo $datairramonth[12][22] ?>],[23,<?php echo $datairramonth[12][23] ?>],]
                            
							}]
                    });
					
					$('#chart2').highcharts({
                        chart: {
                            type: 'pie'
                        },
                        title: {
                            text: "Coût de l'installation: <?php echo number_format(round($pricetotalonduleur+$pricetotalmodule,2) + round($pricestuff * $coutmaindoeuvre,2) + round(($pricetotalonduleur+$pricetotalmodule) * ($marge/100) ,2), 2, ',', ' ') ?> €"
                        },
                        colors: ['#97d17a', '#4c8da6', '#ffa500', '#8A0829'],
                        xAxis: {
                            title: {
                                text: 'prix)'
                            },
                            tickInterval: 5,
                            min: 0,
                            max: 30
                        },
                        yAxis: [{
                            title: {
                                text: 'Puissance (kW)'
                            },
                            gridLineWidth: 1,
                            min: 0
                        },{
                            title: {
                                text: 'Cp'
                            },
                            gridLineWidth: 1,
                            min: 0,
                            opposite: true
                        }],
                        plotOptions: {
                            series: {
                                marker: {
                                    enabled: false
                                }
                            }
                        },
                        series: [{
                                    name: 'Cout',
						data: [['Panneaux', <?php echo $pricetotalmodule ?>],['Onduleurs',<?php echo $pricetotalonduleur ?>], ['Main d\'oeuvre',<?php echo round($pricestuff*$coutmaindoeuvre,2) ?>], ['Marge', <?php echo round(($pricetotalonduleur+$pricetotalmodule) * ($marge/100) ,2) ?>]]
                                }]
                        });
								
                        $('#chart3').highcharts({
                        chart: {
                            type: 'spline'
                        },
                        title: {
                            text: "Température moyenne du module"
                        },
                    colors:['#a55c8c', '#4c8da6', '#ffa500', '#ffff66', '#33ff66', '#cc0000', '#ff3399', '#999999', '#cc6600', '#006600', '#663300', '#336633'],
                        xAxis: {
                            title: {
                                text: 'Heure (h)'
                            },
                            tickInterval: 5,
                            min: 0,
                            max: 23
                        },
                        yAxis: [{
                            title: {
                                text: 'Temperature (°C)'
                            },
                            gridLineWidth: 1,
                            min: 0
                        }],
                        plotOptions: {
                            series: {
                                marker: {
                                    enabled: false
                                }
                            }
                        },
                         series: [{
                                name: 'Janvier',
                                data: [[0,<?php echo $datatempmonth[1][0] ?>],[1,<?php echo $datatempmonth[1][1] ?>],[2,<?php echo $datatempmonth[1][2] ?>],[3,<?php echo $datatempmonth[1][3] ?>],[4,<?php echo $datatempmonth[1][4] ?>],[5,<?php echo $datatempmonth[1][5] ?>],[6,<?php echo $datatempmonth[1][6] ?>],[7,<?php echo $datatempmonth[1][7] ?>],[8,<?php echo $datatempmonth[1][8] ?>],[9,<?php echo $datatempmonth[1][9] ?>],[10,<?php echo $datatempmonth[1][10] ?>],[11,<?php echo $datatempmonth[1][11] ?>],[12,<?php echo $datatempmonth[1][12] ?>],[13,<?php echo $datatempmonth[1][13] ?>],[14,<?php echo $datatempmonth[1][14] ?>],[15,<?php echo $datatempmonth[1][15] ?>],[16,<?php echo $datatempmonth[1][16] ?>],[17,<?php echo $datatempmonth[1][17] ?>],[18,<?php echo $datatempmonth[1][18] ?>],[19,<?php echo $datatempmonth[1][19] ?>],[20,<?php echo $datatempmonth[1][20] ?>],[21,<?php echo $datatempmonth[1][21] ?>],[22,<?php echo $datatempmonth[1][22] ?>],[23,<?php echo $datatempmonth[1][23] ?>],]
							 },{name: 'Fevrier',
                                data: [[0,<?php echo $datatempmonth[2][0] ?>],[1,<?php echo $datatempmonth[2][1] ?>],[2,<?php echo $datatempmonth[2][2] ?>],[3,<?php echo $datatempmonth[2][3] ?>],[4,<?php echo $datatempmonth[2][4] ?>],[5,<?php echo $datatempmonth[2][5] ?>],[6,<?php echo $datatempmonth[2][6] ?>],[7,<?php echo $datatempmonth[2][7] ?>],[8,<?php echo $datatempmonth[2][8] ?>],[9,<?php echo $datatempmonth[2][9] ?>],[10,<?php echo $datatempmonth[2][10] ?>],[11,<?php echo $datatempmonth[2][11] ?>],[12,<?php echo $datatempmonth[2][12] ?>],[13,<?php echo $datatempmonth[2][13] ?>],[14,<?php echo $datatempmonth[2][14] ?>],[15,<?php echo $datatempmonth[2][15] ?>],[16,<?php echo $datatempmonth[2][16] ?>],[17,<?php echo $datatempmonth[2][17] ?>],[18,<?php echo $datatempmonth[2][18] ?>],[19,<?php echo $datatempmonth[2][19] ?>],[20,<?php echo $datatempmonth[2][20] ?>],[21,<?php echo $datatempmonth[2][21] ?>],[22,<?php echo $datatempmonth[2][22] ?>],[23,<?php echo $datatempmonth[2][23] ?>],]
                             },{name: 'Mars',
                                data: [[0,<?php echo $datatempmonth[3][0] ?>],[1,<?php echo $datatempmonth[3][1] ?>],[2,<?php echo $datatempmonth[3][2] ?>],[3,<?php echo $datatempmonth[3][3] ?>],[4,<?php echo $datatempmonth[3][4] ?>],[5,<?php echo $datatempmonth[3][5] ?>],[6,<?php echo $datatempmonth[3][6] ?>],[7,<?php echo $datatempmonth[3][7] ?>],[8,<?php echo $datatempmonth[3][8] ?>],[9,<?php echo $datatempmonth[3][9] ?>],[10,<?php echo $datatempmonth[3][10] ?>],[11,<?php echo $datatempmonth[3][11] ?>],[12,<?php echo $datatempmonth[3][12] ?>],[13,<?php echo $datatempmonth[3][13] ?>],[14,<?php echo $datatempmonth[3][14] ?>],[15,<?php echo $datatempmonth[3][15] ?>],[16,<?php echo $datatempmonth[3][16] ?>],[17,<?php echo $datatempmonth[3][17] ?>],[18,<?php echo $datatempmonth[3][18] ?>],[19,<?php echo $datatempmonth[3][19] ?>],[20,<?php echo $datatempmonth[3][20] ?>],[21,<?php echo $datatempmonth[3][21] ?>],[22,<?php echo $datatempmonth[3][22] ?>],[23,<?php echo $datatempmonth[3][23] ?>],]
                             },{name: 'Avril',
                                data: [[0,<?php echo $datatempmonth[4][0] ?>],[1,<?php echo $datatempmonth[4][1] ?>],[2,<?php echo $datatempmonth[4][2] ?>],[3,<?php echo $datatempmonth[4][3] ?>],[4,<?php echo $datatempmonth[4][4] ?>],[5,<?php echo $datatempmonth[4][5] ?>],[6,<?php echo $datatempmonth[4][6] ?>],[7,<?php echo $datatempmonth[4][7] ?>],[8,<?php echo $datatempmonth[4][8] ?>],[9,<?php echo $datatempmonth[4][9] ?>],[10,<?php echo $datatempmonth[4][10] ?>],[11,<?php echo $datatempmonth[4][11] ?>],[12,<?php echo $datatempmonth[4][12] ?>],[13,<?php echo $datatempmonth[4][13] ?>],[14,<?php echo $datatempmonth[4][14] ?>],[15,<?php echo $datatempmonth[4][15] ?>],[16,<?php echo $datatempmonth[4][16] ?>],[17,<?php echo $datatempmonth[4][17] ?>],[18,<?php echo $datatempmonth[4][18] ?>],[19,<?php echo $datatempmonth[4][19] ?>],[20,<?php echo $datatempmonth[4][20] ?>],[21,<?php echo $datatempmonth[4][21] ?>],[22,<?php echo $datatempmonth[4][22] ?>],[23,<?php echo $datatempmonth[4][23] ?>],]
                             },{name: 'Mai',
                                data: [[0,<?php echo $datatempmonth[5][0] ?>],[1,<?php echo $datatempmonth[5][1] ?>],[2,<?php echo $datatempmonth[5][2] ?>],[3,<?php echo $datatempmonth[5][3] ?>],[4,<?php echo $datatempmonth[5][4] ?>],[5,<?php echo $datatempmonth[5][5] ?>],[6,<?php echo $datatempmonth[5][6] ?>],[7,<?php echo $datatempmonth[5][7] ?>],[8,<?php echo $datatempmonth[5][8] ?>],[9,<?php echo $datatempmonth[5][9] ?>],[10,<?php echo $datatempmonth[5][10] ?>],[11,<?php echo $datatempmonth[5][11] ?>],[12,<?php echo $datatempmonth[5][12] ?>],[13,<?php echo $datatempmonth[5][13] ?>],[14,<?php echo $datatempmonth[5][14] ?>],[15,<?php echo $datatempmonth[5][15] ?>],[16,<?php echo $datatempmonth[5][16] ?>],[17,<?php echo $datatempmonth[5][17] ?>],[18,<?php echo $datatempmonth[5][18] ?>],[19,<?php echo $datatempmonth[5][19] ?>],[20,<?php echo $datatempmonth[5][20] ?>],[21,<?php echo $datatempmonth[5][21] ?>],[22,<?php echo $datatempmonth[5][22] ?>],[23,<?php echo $datatempmonth[5][23] ?>],]
                             },{name: 'Juin',
                                data: [[0,<?php echo $datatempmonth[6][0] ?>],[1,<?php echo $datatempmonth[6][1] ?>],[2,<?php echo $datatempmonth[6][2] ?>],[3,<?php echo $datatempmonth[6][3] ?>],[4,<?php echo $datatempmonth[6][4] ?>],[5,<?php echo $datatempmonth[6][5] ?>],[6,<?php echo $datatempmonth[6][6] ?>],[7,<?php echo $datatempmonth[6][7] ?>],[8,<?php echo $datatempmonth[6][8] ?>],[9,<?php echo $datatempmonth[6][9] ?>],[10,<?php echo $datatempmonth[6][10] ?>],[11,<?php echo $datatempmonth[6][11] ?>],[12,<?php echo $datatempmonth[6][12] ?>],[13,<?php echo $datatempmonth[6][13] ?>],[14,<?php echo $datatempmonth[6][14] ?>],[15,<?php echo $datatempmonth[6][15] ?>],[16,<?php echo $datatempmonth[6][16] ?>],[17,<?php echo $datatempmonth[6][17] ?>],[18,<?php echo $datatempmonth[6][18] ?>],[19,<?php echo $datatempmonth[6][19] ?>],[20,<?php echo $datatempmonth[6][20] ?>],[21,<?php echo $datatempmonth[6][21] ?>],[22,<?php echo $datatempmonth[6][22] ?>],[23,<?php echo $datatempmonth[6][23] ?>],]
                             },{name: 'Juillet',
                                data: [[0,<?php echo $datatempmonth[7][0] ?>],[1,<?php echo $datatempmonth[7][1] ?>],[2,<?php echo $datatempmonth[7][2] ?>],[3,<?php echo $datatempmonth[7][3] ?>],[4,<?php echo $datatempmonth[7][4] ?>],[5,<?php echo $datatempmonth[7][5] ?>],[6,<?php echo $datatempmonth[7][6] ?>],[7,<?php echo $datatempmonth[7][7] ?>],[8,<?php echo $datatempmonth[7][8] ?>],[9,<?php echo $datatempmonth[7][9] ?>],[10,<?php echo $datatempmonth[7][10] ?>],[11,<?php echo $datatempmonth[7][11] ?>],[12,<?php echo $datatempmonth[7][12] ?>],[13,<?php echo $datatempmonth[7][13] ?>],[14,<?php echo $datatempmonth[7][14] ?>],[15,<?php echo $datatempmonth[7][15] ?>],[16,<?php echo $datatempmonth[7][16] ?>],[17,<?php echo $datatempmonth[7][17] ?>],[18,<?php echo $datatempmonth[7][18] ?>],[19,<?php echo $datatempmonth[7][19] ?>],[20,<?php echo $datatempmonth[7][20] ?>],[21,<?php echo $datatempmonth[7][21] ?>],[22,<?php echo $datatempmonth[7][22] ?>],[23,<?php echo $datatempmonth[7][23] ?>],]
                             },{name: 'Aout',
                                data: [[0,<?php echo $datatempmonth[8][0] ?>],[1,<?php echo $datatempmonth[8][1] ?>],[2,<?php echo $datatempmonth[8][2] ?>],[3,<?php echo $datatempmonth[8][3] ?>],[4,<?php echo $datatempmonth[8][4] ?>],[5,<?php echo $datatempmonth[8][5] ?>],[6,<?php echo $datatempmonth[8][6] ?>],[7,<?php echo $datatempmonth[8][7] ?>],[8,<?php echo $datatempmonth[8][8] ?>],[9,<?php echo $datatempmonth[8][9] ?>],[10,<?php echo $datatempmonth[8][10] ?>],[11,<?php echo $datatempmonth[8][11] ?>],[12,<?php echo $datatempmonth[8][12] ?>],[13,<?php echo $datatempmonth[8][13] ?>],[14,<?php echo $datatempmonth[8][14] ?>],[15,<?php echo $datatempmonth[8][15] ?>],[16,<?php echo $datatempmonth[8][16] ?>],[17,<?php echo $datatempmonth[8][17] ?>],[18,<?php echo $datatempmonth[8][18] ?>],[19,<?php echo $datatempmonth[8][19] ?>],[20,<?php echo $datatempmonth[8][20] ?>],[21,<?php echo $datatempmonth[8][21] ?>],[22,<?php echo $datatempmonth[8][22] ?>],[23,<?php echo $datatempmonth[8][23] ?>],]
                             },{name: 'Septembre',
                                data: [[0,<?php echo $datatempmonth[9][0] ?>],[1,<?php echo $datatempmonth[9][1] ?>],[2,<?php echo $datatempmonth[9][2] ?>],[3,<?php echo $datatempmonth[9][3] ?>],[4,<?php echo $datatempmonth[9][4] ?>],[5,<?php echo $datatempmonth[9][5] ?>],[6,<?php echo $datatempmonth[9][6] ?>],[7,<?php echo $datatempmonth[9][7] ?>],[8,<?php echo $datatempmonth[9][8] ?>],[9,<?php echo $datatempmonth[9][9] ?>],[10,<?php echo $datatempmonth[9][10] ?>],[11,<?php echo $datatempmonth[9][11] ?>],[12,<?php echo $datatempmonth[9][12] ?>],[13,<?php echo $datatempmonth[9][13] ?>],[14,<?php echo $datatempmonth[9][14] ?>],[15,<?php echo $datatempmonth[9][15] ?>],[16,<?php echo $datatempmonth[9][16] ?>],[17,<?php echo $datatempmonth[9][17] ?>],[18,<?php echo $datatempmonth[9][18] ?>],[19,<?php echo $datatempmonth[9][19] ?>],[20,<?php echo $datatempmonth[9][20] ?>],[21,<?php echo $datatempmonth[9][21] ?>],[22,<?php echo $datatempmonth[9][22] ?>],[23,<?php echo $datatempmonth[9][23] ?>],]
                             },{name: 'Octobre',
                                data: [[0,<?php echo $datatempmonth[10][0] ?>],[1,<?php echo $datatempmonth[10][1] ?>],[2,<?php echo $datatempmonth[10][2] ?>],[3,<?php echo $datatempmonth[10][3] ?>],[4,<?php echo $datatempmonth[10][4] ?>],[5,<?php echo $datatempmonth[10][5] ?>],[6,<?php echo $datatempmonth[10][6] ?>],[7,<?php echo $datatempmonth[10][7] ?>],[8,<?php echo $datatempmonth[10][8] ?>],[9,<?php echo $datatempmonth[10][9] ?>],[10,<?php echo $datatempmonth[10][10] ?>],[11,<?php echo $datatempmonth[10][11] ?>],[12,<?php echo $datatempmonth[10][12] ?>],[13,<?php echo $datatempmonth[10][13] ?>],[14,<?php echo $datatempmonth[10][14] ?>],[15,<?php echo $datatempmonth[10][15] ?>],[16,<?php echo $datatempmonth[10][16] ?>],[17,<?php echo $datatempmonth[10][17] ?>],[18,<?php echo $datatempmonth[10][18] ?>],[19,<?php echo $datatempmonth[10][19] ?>],[20,<?php echo $datatempmonth[10][20] ?>],[21,<?php echo $datatempmonth[10][21] ?>],[22,<?php echo $datatempmonth[10][22] ?>],[23,<?php echo $datatempmonth[10][23] ?>],]
                             },{name: 'Novembre',
                                data: [[0,<?php echo $datatempmonth[11][0] ?>],[1,<?php echo $datatempmonth[11][1] ?>],[2,<?php echo $datatempmonth[11][2] ?>],[3,<?php echo $datatempmonth[11][3] ?>],[4,<?php echo $datatempmonth[11][4] ?>],[5,<?php echo $datatempmonth[11][5] ?>],[6,<?php echo $datatempmonth[11][6] ?>],[7,<?php echo $datatempmonth[11][7] ?>],[8,<?php echo $datatempmonth[11][8] ?>],[9,<?php echo $datatempmonth[11][9] ?>],[10,<?php echo $datatempmonth[11][10] ?>],[11,<?php echo $datatempmonth[11][11] ?>],[12,<?php echo $datatempmonth[11][12] ?>],[13,<?php echo $datatempmonth[11][13] ?>],[14,<?php echo $datatempmonth[11][14] ?>],[15,<?php echo $datatempmonth[11][15] ?>],[16,<?php echo $datatempmonth[11][16] ?>],[17,<?php echo $datatempmonth[11][17] ?>],[18,<?php echo $datatempmonth[11][18] ?>],[19,<?php echo $datatempmonth[11][19] ?>],[20,<?php echo $datatempmonth[11][20] ?>],[21,<?php echo $datatempmonth[11][21] ?>],[22,<?php echo $datatempmonth[11][22] ?>],[23,<?php echo $datatempmonth[11][23] ?>],]
                             },{name: 'Decembre',
                                data: [[0,<?php echo $datatempmonth[12][0] ?>],[1,<?php echo $datatempmonth[12][1] ?>],[2,<?php echo $datatempmonth[12][2] ?>],[3,<?php echo $datatempmonth[12][3] ?>],[4,<?php echo $datatempmonth[12][4] ?>],[5,<?php echo $datatempmonth[12][5] ?>],[6,<?php echo $datatempmonth[12][6] ?>],[7,<?php echo $datatempmonth[12][7] ?>],[8,<?php echo $datatempmonth[12][8] ?>],[9,<?php echo $datatempmonth[12][9] ?>],[10,<?php echo $datatempmonth[12][10] ?>],[11,<?php echo $datatempmonth[12][11] ?>],[12,<?php echo $datatempmonth[12][12] ?>],[13,<?php echo $datatempmonth[12][13] ?>],[14,<?php echo $datatempmonth[12][14] ?>],[15,<?php echo $datatempmonth[12][15] ?>],[16,<?php echo $datatempmonth[12][16] ?>],[17,<?php echo $datatempmonth[12][17] ?>],[18,<?php echo $datatempmonth[12][18] ?>],[19,<?php echo $datatempmonth[12][19] ?>],[20,<?php echo $datatempmonth[12][20] ?>],[21,<?php echo $datatempmonth[12][21] ?>],[22,<?php echo $datatempmonth[12][22] ?>],[23,<?php echo $datatempmonth[12][23] ?>],]
                            
							}]
                        });
                     
                    $('#chart4').highcharts({
                        chart: {
                        type: 'spline'
                    },
                    title: {
                        text: 'Puissance d\'un panneau en fonction des pertes dues à la température'
                    },
                    xAxis: {
                        title: {
                            text: 'Heure (h)'
                        },
                        tickInterval: 5,
                        min: 0,
                        max: 23
                    },
                    colors:['#a55c8c', '#4c8da6', '#ffa500', '#ffff66', '#33ff66', '#cc0000', '#ff3399', '#999999', '#cc6600', '#006600', '#663300', '#336633'],
                    yAxis: {
                        title: {
                            text: 'Puissance de sortie (Wp)'
                        },
                        gridLineWidth: 1
                        
                    },
                    plotOptions: {
                            series: {
                                marker: {
                                    enabled: false
                                }
                            }
                        },
                        series: [{
                                name: 'Janvier',
                                data: [[0,<?php echo $dataprodmonth[1][0] ?>],[1,<?php echo $dataprodmonth[1][1] ?>],[2,<?php echo $dataprodmonth[1][2] ?>],[3,<?php echo $dataprodmonth[1][3] ?>],[4,<?php echo $dataprodmonth[1][4] ?>],[5,<?php echo $dataprodmonth[1][5] ?>],[6,<?php echo $dataprodmonth[1][6] ?>],[7,<?php echo $dataprodmonth[1][7] ?>],[8,<?php echo $dataprodmonth[1][8] ?>],[9,<?php echo $dataprodmonth[1][9] ?>],[10,<?php echo $dataprodmonth[1][10] ?>],[11,<?php echo $dataprodmonth[1][11] ?>],[12,<?php echo $dataprodmonth[1][12] ?>],[13,<?php echo $dataprodmonth[1][13] ?>],[14,<?php echo $dataprodmonth[1][14] ?>],[15,<?php echo $dataprodmonth[1][15] ?>],[16,<?php echo $dataprodmonth[1][16] ?>],[17,<?php echo $dataprodmonth[1][17] ?>],[18,<?php echo $dataprodmonth[1][18] ?>],[19,<?php echo $dataprodmonth[1][19] ?>],[20,<?php echo $dataprodmonth[1][20] ?>],[21,<?php echo $dataprodmonth[1][21] ?>],[22,<?php echo $dataprodmonth[1][22] ?>],[23,<?php echo $dataprodmonth[1][23] ?>],]
							 },{name: 'Fevrier',
                                data: [[0,<?php echo $dataprodmonth[2][0] ?>],[1,<?php echo $dataprodmonth[2][1] ?>],[2,<?php echo $dataprodmonth[2][2] ?>],[3,<?php echo $dataprodmonth[2][3] ?>],[4,<?php echo $dataprodmonth[2][4] ?>],[5,<?php echo $dataprodmonth[2][5] ?>],[6,<?php echo $dataprodmonth[2][6] ?>],[7,<?php echo $dataprodmonth[2][7] ?>],[8,<?php echo $dataprodmonth[2][8] ?>],[9,<?php echo $dataprodmonth[2][9] ?>],[10,<?php echo $dataprodmonth[2][10] ?>],[11,<?php echo $dataprodmonth[2][11] ?>],[12,<?php echo $dataprodmonth[2][12] ?>],[13,<?php echo $dataprodmonth[2][13] ?>],[14,<?php echo $dataprodmonth[2][14] ?>],[15,<?php echo $dataprodmonth[2][15] ?>],[16,<?php echo $dataprodmonth[2][16] ?>],[17,<?php echo $dataprodmonth[2][17] ?>],[18,<?php echo $dataprodmonth[2][18] ?>],[19,<?php echo $dataprodmonth[2][19] ?>],[20,<?php echo $dataprodmonth[2][20] ?>],[21,<?php echo $dataprodmonth[2][21] ?>],[22,<?php echo $dataprodmonth[2][22] ?>],[23,<?php echo $dataprodmonth[2][23] ?>],]
                             },{name: 'Mars',
                                data: [[0,<?php echo $dataprodmonth[3][0] ?>],[1,<?php echo $dataprodmonth[3][1] ?>],[2,<?php echo $dataprodmonth[3][2] ?>],[3,<?php echo $dataprodmonth[3][3] ?>],[4,<?php echo $dataprodmonth[3][4] ?>],[5,<?php echo $dataprodmonth[3][5] ?>],[6,<?php echo $dataprodmonth[3][6] ?>],[7,<?php echo $dataprodmonth[3][7] ?>],[8,<?php echo $dataprodmonth[3][8] ?>],[9,<?php echo $dataprodmonth[3][9] ?>],[10,<?php echo $dataprodmonth[3][10] ?>],[11,<?php echo $dataprodmonth[3][11] ?>],[12,<?php echo $dataprodmonth[3][12] ?>],[13,<?php echo $dataprodmonth[3][13] ?>],[14,<?php echo $dataprodmonth[3][14] ?>],[15,<?php echo $dataprodmonth[3][15] ?>],[16,<?php echo $dataprodmonth[3][16] ?>],[17,<?php echo $dataprodmonth[3][17] ?>],[18,<?php echo $dataprodmonth[3][18] ?>],[19,<?php echo $dataprodmonth[3][19] ?>],[20,<?php echo $dataprodmonth[3][20] ?>],[21,<?php echo $dataprodmonth[3][21] ?>],[22,<?php echo $dataprodmonth[3][22] ?>],[23,<?php echo $dataprodmonth[3][23] ?>],]
                             },{name: 'Avril',
                                data: [[0,<?php echo $dataprodmonth[4][0] ?>],[1,<?php echo $dataprodmonth[4][1] ?>],[2,<?php echo $dataprodmonth[4][2] ?>],[3,<?php echo $dataprodmonth[4][3] ?>],[4,<?php echo $dataprodmonth[4][4] ?>],[5,<?php echo $dataprodmonth[4][5] ?>],[6,<?php echo $dataprodmonth[4][6] ?>],[7,<?php echo $dataprodmonth[4][7] ?>],[8,<?php echo $dataprodmonth[4][8] ?>],[9,<?php echo $dataprodmonth[4][9] ?>],[10,<?php echo $dataprodmonth[4][10] ?>],[11,<?php echo $dataprodmonth[4][11] ?>],[12,<?php echo $dataprodmonth[4][12] ?>],[13,<?php echo $dataprodmonth[4][13] ?>],[14,<?php echo $dataprodmonth[4][14] ?>],[15,<?php echo $dataprodmonth[4][15] ?>],[16,<?php echo $dataprodmonth[4][16] ?>],[17,<?php echo $dataprodmonth[4][17] ?>],[18,<?php echo $dataprodmonth[4][18] ?>],[19,<?php echo $dataprodmonth[4][19] ?>],[20,<?php echo $dataprodmonth[4][20] ?>],[21,<?php echo $dataprodmonth[4][21] ?>],[22,<?php echo $dataprodmonth[4][22] ?>],[23,<?php echo $dataprodmonth[4][23] ?>],]
                             },{name: 'Mai',
                                data: [[0,<?php echo $dataprodmonth[5][0] ?>],[1,<?php echo $dataprodmonth[5][1] ?>],[2,<?php echo $dataprodmonth[5][2] ?>],[3,<?php echo $dataprodmonth[5][3] ?>],[4,<?php echo $dataprodmonth[5][4] ?>],[5,<?php echo $dataprodmonth[5][5] ?>],[6,<?php echo $dataprodmonth[5][6] ?>],[7,<?php echo $dataprodmonth[5][7] ?>],[8,<?php echo $dataprodmonth[5][8] ?>],[9,<?php echo $dataprodmonth[5][9] ?>],[10,<?php echo $dataprodmonth[5][10] ?>],[11,<?php echo $dataprodmonth[5][11] ?>],[12,<?php echo $dataprodmonth[5][12] ?>],[13,<?php echo $dataprodmonth[5][13] ?>],[14,<?php echo $dataprodmonth[5][14] ?>],[15,<?php echo $dataprodmonth[5][15] ?>],[16,<?php echo $dataprodmonth[5][16] ?>],[17,<?php echo $dataprodmonth[5][17] ?>],[18,<?php echo $dataprodmonth[5][18] ?>],[19,<?php echo $dataprodmonth[5][19] ?>],[20,<?php echo $dataprodmonth[5][20] ?>],[21,<?php echo $dataprodmonth[5][21] ?>],[22,<?php echo $dataprodmonth[5][22] ?>],[23,<?php echo $dataprodmonth[5][23] ?>],]
                             },{name: 'Juin',
                                data: [[0,<?php echo $dataprodmonth[6][0] ?>],[1,<?php echo $dataprodmonth[6][1] ?>],[2,<?php echo $dataprodmonth[6][2] ?>],[3,<?php echo $dataprodmonth[6][3] ?>],[4,<?php echo $dataprodmonth[6][4] ?>],[5,<?php echo $dataprodmonth[6][5] ?>],[6,<?php echo $dataprodmonth[6][6] ?>],[7,<?php echo $dataprodmonth[6][7] ?>],[8,<?php echo $dataprodmonth[6][8] ?>],[9,<?php echo $dataprodmonth[6][9] ?>],[10,<?php echo $dataprodmonth[6][10] ?>],[11,<?php echo $dataprodmonth[6][11] ?>],[12,<?php echo $dataprodmonth[6][12] ?>],[13,<?php echo $dataprodmonth[6][13] ?>],[14,<?php echo $dataprodmonth[6][14] ?>],[15,<?php echo $dataprodmonth[6][15] ?>],[16,<?php echo $dataprodmonth[6][16] ?>],[17,<?php echo $dataprodmonth[6][17] ?>],[18,<?php echo $dataprodmonth[6][18] ?>],[19,<?php echo $dataprodmonth[6][19] ?>],[20,<?php echo $dataprodmonth[6][20] ?>],[21,<?php echo $dataprodmonth[6][21] ?>],[22,<?php echo $dataprodmonth[6][22] ?>],[23,<?php echo $dataprodmonth[6][23] ?>],]
                             },{name: 'Juillet',
                                data: [[0,<?php echo $dataprodmonth[7][0] ?>],[1,<?php echo $dataprodmonth[7][1] ?>],[2,<?php echo $dataprodmonth[7][2] ?>],[3,<?php echo $dataprodmonth[7][3] ?>],[4,<?php echo $dataprodmonth[7][4] ?>],[5,<?php echo $dataprodmonth[7][5] ?>],[6,<?php echo $dataprodmonth[7][6] ?>],[7,<?php echo $dataprodmonth[7][7] ?>],[8,<?php echo $dataprodmonth[7][8] ?>],[9,<?php echo $dataprodmonth[7][9] ?>],[10,<?php echo $dataprodmonth[7][10] ?>],[11,<?php echo $dataprodmonth[7][11] ?>],[12,<?php echo $dataprodmonth[7][12] ?>],[13,<?php echo $dataprodmonth[7][13] ?>],[14,<?php echo $dataprodmonth[7][14] ?>],[15,<?php echo $dataprodmonth[7][15] ?>],[16,<?php echo $dataprodmonth[7][16] ?>],[17,<?php echo $dataprodmonth[7][17] ?>],[18,<?php echo $dataprodmonth[7][18] ?>],[19,<?php echo $dataprodmonth[7][19] ?>],[20,<?php echo $dataprodmonth[7][20] ?>],[21,<?php echo $dataprodmonth[7][21] ?>],[22,<?php echo $dataprodmonth[7][22] ?>],[23,<?php echo $dataprodmonth[7][23] ?>],]
                             },{name: 'Aout',
                                data: [[0,<?php echo $dataprodmonth[8][0] ?>],[1,<?php echo $dataprodmonth[8][1] ?>],[2,<?php echo $dataprodmonth[8][2] ?>],[3,<?php echo $dataprodmonth[8][3] ?>],[4,<?php echo $dataprodmonth[8][4] ?>],[5,<?php echo $dataprodmonth[8][5] ?>],[6,<?php echo $dataprodmonth[8][6] ?>],[7,<?php echo $dataprodmonth[8][7] ?>],[8,<?php echo $dataprodmonth[8][8] ?>],[9,<?php echo $dataprodmonth[8][9] ?>],[10,<?php echo $dataprodmonth[8][10] ?>],[11,<?php echo $dataprodmonth[8][11] ?>],[12,<?php echo $dataprodmonth[8][12] ?>],[13,<?php echo $dataprodmonth[8][13] ?>],[14,<?php echo $dataprodmonth[8][14] ?>],[15,<?php echo $dataprodmonth[8][15] ?>],[16,<?php echo $dataprodmonth[8][16] ?>],[17,<?php echo $dataprodmonth[8][17] ?>],[18,<?php echo $dataprodmonth[8][18] ?>],[19,<?php echo $dataprodmonth[8][19] ?>],[20,<?php echo $dataprodmonth[8][20] ?>],[21,<?php echo $dataprodmonth[8][21] ?>],[22,<?php echo $dataprodmonth[8][22] ?>],[23,<?php echo $dataprodmonth[8][23] ?>],]
                             },{name: 'Septembre',
                                data: [[0,<?php echo $dataprodmonth[9][0] ?>],[1,<?php echo $dataprodmonth[9][1] ?>],[2,<?php echo $dataprodmonth[9][2] ?>],[3,<?php echo $dataprodmonth[9][3] ?>],[4,<?php echo $dataprodmonth[9][4] ?>],[5,<?php echo $dataprodmonth[9][5] ?>],[6,<?php echo $dataprodmonth[9][6] ?>],[7,<?php echo $dataprodmonth[9][7] ?>],[8,<?php echo $dataprodmonth[9][8] ?>],[9,<?php echo $dataprodmonth[9][9] ?>],[10,<?php echo $dataprodmonth[9][10] ?>],[11,<?php echo $dataprodmonth[9][11] ?>],[12,<?php echo $dataprodmonth[9][12] ?>],[13,<?php echo $dataprodmonth[9][13] ?>],[14,<?php echo $dataprodmonth[9][14] ?>],[15,<?php echo $dataprodmonth[9][15] ?>],[16,<?php echo $dataprodmonth[9][16] ?>],[17,<?php echo $dataprodmonth[9][17] ?>],[18,<?php echo $dataprodmonth[9][18] ?>],[19,<?php echo $dataprodmonth[9][19] ?>],[20,<?php echo $dataprodmonth[9][20] ?>],[21,<?php echo $dataprodmonth[9][21] ?>],[22,<?php echo $dataprodmonth[9][22] ?>],[23,<?php echo $dataprodmonth[9][23] ?>],]
                             },{name: 'Octobre',
                                data: [[0,<?php echo $dataprodmonth[10][0] ?>],[1,<?php echo $dataprodmonth[10][1] ?>],[2,<?php echo $dataprodmonth[10][2] ?>],[3,<?php echo $dataprodmonth[10][3] ?>],[4,<?php echo $dataprodmonth[10][4] ?>],[5,<?php echo $dataprodmonth[10][5] ?>],[6,<?php echo $dataprodmonth[10][6] ?>],[7,<?php echo $dataprodmonth[10][7] ?>],[8,<?php echo $dataprodmonth[10][8] ?>],[9,<?php echo $dataprodmonth[10][9] ?>],[10,<?php echo $dataprodmonth[10][10] ?>],[11,<?php echo $dataprodmonth[10][11] ?>],[12,<?php echo $dataprodmonth[10][12] ?>],[13,<?php echo $dataprodmonth[10][13] ?>],[14,<?php echo $dataprodmonth[10][14] ?>],[15,<?php echo $dataprodmonth[10][15] ?>],[16,<?php echo $dataprodmonth[10][16] ?>],[17,<?php echo $dataprodmonth[10][17] ?>],[18,<?php echo $dataprodmonth[10][18] ?>],[19,<?php echo $dataprodmonth[10][19] ?>],[20,<?php echo $dataprodmonth[10][20] ?>],[21,<?php echo $dataprodmonth[10][21] ?>],[22,<?php echo $dataprodmonth[10][22] ?>],[23,<?php echo $dataprodmonth[10][23] ?>],]
                             },{name: 'Novembre',
                                data: [[0,<?php echo $dataprodmonth[11][0] ?>],[1,<?php echo $dataprodmonth[11][1] ?>],[2,<?php echo $dataprodmonth[11][2] ?>],[3,<?php echo $dataprodmonth[11][3] ?>],[4,<?php echo $dataprodmonth[11][4] ?>],[5,<?php echo $dataprodmonth[11][5] ?>],[6,<?php echo $dataprodmonth[11][6] ?>],[7,<?php echo $dataprodmonth[11][7] ?>],[8,<?php echo $dataprodmonth[11][8] ?>],[9,<?php echo $dataprodmonth[11][9] ?>],[10,<?php echo $dataprodmonth[11][10] ?>],[11,<?php echo $dataprodmonth[11][11] ?>],[12,<?php echo $dataprodmonth[11][12] ?>],[13,<?php echo $dataprodmonth[11][13] ?>],[14,<?php echo $dataprodmonth[11][14] ?>],[15,<?php echo $dataprodmonth[11][15] ?>],[16,<?php echo $dataprodmonth[11][16] ?>],[17,<?php echo $dataprodmonth[11][17] ?>],[18,<?php echo $dataprodmonth[11][18] ?>],[19,<?php echo $dataprodmonth[11][19] ?>],[20,<?php echo $dataprodmonth[11][20] ?>],[21,<?php echo $dataprodmonth[11][21] ?>],[22,<?php echo $dataprodmonth[11][22] ?>],[23,<?php echo $dataprodmonth[11][23] ?>],]
                             },{name: 'Decembre',
                                data: [[0,<?php echo $dataprodmonth[12][0] ?>],[1,<?php echo $dataprodmonth[12][1] ?>],[2,<?php echo $dataprodmonth[12][2] ?>],[3,<?php echo $dataprodmonth[12][3] ?>],[4,<?php echo $dataprodmonth[12][4] ?>],[5,<?php echo $dataprodmonth[12][5] ?>],[6,<?php echo $dataprodmonth[12][6] ?>],[7,<?php echo $dataprodmonth[12][7] ?>],[8,<?php echo $dataprodmonth[12][8] ?>],[9,<?php echo $dataprodmonth[12][9] ?>],[10,<?php echo $dataprodmonth[12][10] ?>],[11,<?php echo $dataprodmonth[12][11] ?>],[12,<?php echo $dataprodmonth[12][12] ?>],[13,<?php echo $dataprodmonth[12][13] ?>],[14,<?php echo $dataprodmonth[12][14] ?>],[15,<?php echo $dataprodmonth[12][15] ?>],[16,<?php echo $dataprodmonth[12][16] ?>],[17,<?php echo $dataprodmonth[12][17] ?>],[18,<?php echo $dataprodmonth[12][18] ?>],[19,<?php echo $dataprodmonth[12][19] ?>],[20,<?php echo $dataprodmonth[12][20] ?>],[21,<?php echo $dataprodmonth[12][21] ?>],[22,<?php echo $dataprodmonth[12][22] ?>],[23,<?php echo $dataprodmonth[12][23] ?>],]
                            
							}]
                        });
						
					$('#chart5').highcharts({
                        chart: {
                        type: 'spline'
                    },
                    title: {
                        text: 'Production journalière moyenne d\'un panneau'
                    },
                    xAxis: {
                        title: {
                            text: 'Heure (h)'
                        },
                        tickInterval: 5,
                        min: 0,
                        max: 23
                    },
                    colors:['#a55c8c', '#4c8da6', '#ffa500', '#ffff66', '#33ff66', '#cc0000', '#ff3399', '#999999', '#cc6600', '#006600', '#663300', '#336633'],
                    yAxis: {
                        title: {
                            text: 'Production en sortie (Wh)'
                        },
                        gridLineWidth: 1,
						min: 1
                        
                    },
                    plotOptions: {
                            series: {
                                marker: {
                                    enabled: false
                                }
                            }
                        },
                        series: [{
                                name: 'Janvier',
                                data: [[0,<?php echo $dataoutpmonth[1][0] ?>],[1,<?php echo $dataoutpmonth[1][1] ?>],[2,<?php echo $dataoutpmonth[1][2] ?>],[3,<?php echo $dataoutpmonth[1][3] ?>],[4,<?php echo $dataoutpmonth[1][4] ?>],[5,<?php echo $dataoutpmonth[1][5] ?>],[6,<?php echo $dataoutpmonth[1][6] ?>],[7,<?php echo $dataoutpmonth[1][7] ?>],[8,<?php echo $dataoutpmonth[1][8] ?>],[9,<?php echo $dataoutpmonth[1][9] ?>],[10,<?php echo $dataoutpmonth[1][10] ?>],[11,<?php echo $dataoutpmonth[1][11] ?>],[12,<?php echo $dataoutpmonth[1][12] ?>],[13,<?php echo $dataoutpmonth[1][13] ?>],[14,<?php echo $dataoutpmonth[1][14] ?>],[15,<?php echo $dataoutpmonth[1][15] ?>],[16,<?php echo $dataoutpmonth[1][16] ?>],[17,<?php echo $dataoutpmonth[1][17] ?>],[18,<?php echo $dataoutpmonth[1][18] ?>],[19,<?php echo $dataoutpmonth[1][19] ?>],[20,<?php echo $dataoutpmonth[1][20] ?>],[21,<?php echo $dataoutpmonth[1][21] ?>],[22,<?php echo $dataoutpmonth[1][22] ?>],[23,<?php echo $dataoutpmonth[1][23] ?>],]
							 },{name: 'Fevrier',
                                data: [[0,<?php echo $dataoutpmonth[2][0] ?>],[1,<?php echo $dataoutpmonth[2][1] ?>],[2,<?php echo $dataoutpmonth[2][2] ?>],[3,<?php echo $dataoutpmonth[2][3] ?>],[4,<?php echo $dataoutpmonth[2][4] ?>],[5,<?php echo $dataoutpmonth[2][5] ?>],[6,<?php echo $dataoutpmonth[2][6] ?>],[7,<?php echo $dataoutpmonth[2][7] ?>],[8,<?php echo $dataoutpmonth[2][8] ?>],[9,<?php echo $dataoutpmonth[2][9] ?>],[10,<?php echo $dataoutpmonth[2][10] ?>],[11,<?php echo $dataoutpmonth[2][11] ?>],[12,<?php echo $dataoutpmonth[2][12] ?>],[13,<?php echo $dataoutpmonth[2][13] ?>],[14,<?php echo $dataoutpmonth[2][14] ?>],[15,<?php echo $dataoutpmonth[2][15] ?>],[16,<?php echo $dataoutpmonth[2][16] ?>],[17,<?php echo $dataoutpmonth[2][17] ?>],[18,<?php echo $dataoutpmonth[2][18] ?>],[19,<?php echo $dataoutpmonth[2][19] ?>],[20,<?php echo $dataoutpmonth[2][20] ?>],[21,<?php echo $dataoutpmonth[2][21] ?>],[22,<?php echo $dataoutpmonth[2][22] ?>],[23,<?php echo $dataoutpmonth[2][23] ?>],]
                             },{name: 'Mars',
                                data: [[0,<?php echo $dataoutpmonth[3][0] ?>],[1,<?php echo $dataoutpmonth[3][1] ?>],[2,<?php echo $dataoutpmonth[3][2] ?>],[3,<?php echo $dataoutpmonth[3][3] ?>],[4,<?php echo $dataoutpmonth[3][4] ?>],[5,<?php echo $dataoutpmonth[3][5] ?>],[6,<?php echo $dataoutpmonth[3][6] ?>],[7,<?php echo $dataoutpmonth[3][7] ?>],[8,<?php echo $dataoutpmonth[3][8] ?>],[9,<?php echo $dataoutpmonth[3][9] ?>],[10,<?php echo $dataoutpmonth[3][10] ?>],[11,<?php echo $dataoutpmonth[3][11] ?>],[12,<?php echo $dataoutpmonth[3][12] ?>],[13,<?php echo $dataoutpmonth[3][13] ?>],[14,<?php echo $dataoutpmonth[3][14] ?>],[15,<?php echo $dataoutpmonth[3][15] ?>],[16,<?php echo $dataoutpmonth[3][16] ?>],[17,<?php echo $dataoutpmonth[3][17] ?>],[18,<?php echo $dataoutpmonth[3][18] ?>],[19,<?php echo $dataoutpmonth[3][19] ?>],[20,<?php echo $dataoutpmonth[3][20] ?>],[21,<?php echo $dataoutpmonth[3][21] ?>],[22,<?php echo $dataoutpmonth[3][22] ?>],[23,<?php echo $dataoutpmonth[3][23] ?>],]
                             },{name: 'Avril',
                                data: [[0,<?php echo $dataoutpmonth[4][0] ?>],[1,<?php echo $dataoutpmonth[4][1] ?>],[2,<?php echo $dataoutpmonth[4][2] ?>],[3,<?php echo $dataoutpmonth[4][3] ?>],[4,<?php echo $dataoutpmonth[4][4] ?>],[5,<?php echo $dataoutpmonth[4][5] ?>],[6,<?php echo $dataoutpmonth[4][6] ?>],[7,<?php echo $dataoutpmonth[4][7] ?>],[8,<?php echo $dataoutpmonth[4][8] ?>],[9,<?php echo $dataoutpmonth[4][9] ?>],[10,<?php echo $dataoutpmonth[4][10] ?>],[11,<?php echo $dataoutpmonth[4][11] ?>],[12,<?php echo $dataoutpmonth[4][12] ?>],[13,<?php echo $dataoutpmonth[4][13] ?>],[14,<?php echo $dataoutpmonth[4][14] ?>],[15,<?php echo $dataoutpmonth[4][15] ?>],[16,<?php echo $dataoutpmonth[4][16] ?>],[17,<?php echo $dataoutpmonth[4][17] ?>],[18,<?php echo $dataoutpmonth[4][18] ?>],[19,<?php echo $dataoutpmonth[4][19] ?>],[20,<?php echo $dataoutpmonth[4][20] ?>],[21,<?php echo $dataoutpmonth[4][21] ?>],[22,<?php echo $dataoutpmonth[4][22] ?>],[23,<?php echo $dataoutpmonth[4][23] ?>],]
                             },{name: 'Mai',
                                data: [[0,<?php echo $dataoutpmonth[5][0] ?>],[1,<?php echo $dataoutpmonth[5][1] ?>],[2,<?php echo $dataoutpmonth[5][2] ?>],[3,<?php echo $dataoutpmonth[5][3] ?>],[4,<?php echo $dataoutpmonth[5][4] ?>],[5,<?php echo $dataoutpmonth[5][5] ?>],[6,<?php echo $dataoutpmonth[5][6] ?>],[7,<?php echo $dataoutpmonth[5][7] ?>],[8,<?php echo $dataoutpmonth[5][8] ?>],[9,<?php echo $dataoutpmonth[5][9] ?>],[10,<?php echo $dataoutpmonth[5][10] ?>],[11,<?php echo $dataoutpmonth[5][11] ?>],[12,<?php echo $dataoutpmonth[5][12] ?>],[13,<?php echo $dataoutpmonth[5][13] ?>],[14,<?php echo $dataoutpmonth[5][14] ?>],[15,<?php echo $dataoutpmonth[5][15] ?>],[16,<?php echo $dataoutpmonth[5][16] ?>],[17,<?php echo $dataoutpmonth[5][17] ?>],[18,<?php echo $dataoutpmonth[5][18] ?>],[19,<?php echo $dataoutpmonth[5][19] ?>],[20,<?php echo $dataoutpmonth[5][20] ?>],[21,<?php echo $dataoutpmonth[5][21] ?>],[22,<?php echo $dataoutpmonth[5][22] ?>],[23,<?php echo $dataoutpmonth[5][23] ?>],]
                             },{name: 'Juin',
                                data: [[0,<?php echo $dataoutpmonth[6][0] ?>],[1,<?php echo $dataoutpmonth[6][1] ?>],[2,<?php echo $dataoutpmonth[6][2] ?>],[3,<?php echo $dataoutpmonth[6][3] ?>],[4,<?php echo $dataoutpmonth[6][4] ?>],[5,<?php echo $dataoutpmonth[6][5] ?>],[6,<?php echo $dataoutpmonth[6][6] ?>],[7,<?php echo $dataoutpmonth[6][7] ?>],[8,<?php echo $dataoutpmonth[6][8] ?>],[9,<?php echo $dataoutpmonth[6][9] ?>],[10,<?php echo $dataoutpmonth[6][10] ?>],[11,<?php echo $dataoutpmonth[6][11] ?>],[12,<?php echo $dataoutpmonth[6][12] ?>],[13,<?php echo $dataoutpmonth[6][13] ?>],[14,<?php echo $dataoutpmonth[6][14] ?>],[15,<?php echo $dataoutpmonth[6][15] ?>],[16,<?php echo $dataoutpmonth[6][16] ?>],[17,<?php echo $dataoutpmonth[6][17] ?>],[18,<?php echo $dataoutpmonth[6][18] ?>],[19,<?php echo $dataoutpmonth[6][19] ?>],[20,<?php echo $dataoutpmonth[6][20] ?>],[21,<?php echo $dataoutpmonth[6][21] ?>],[22,<?php echo $dataoutpmonth[6][22] ?>],[23,<?php echo $dataoutpmonth[6][23] ?>],]
                             },{name: 'Juillet',
                                data: [[0,<?php echo $dataoutpmonth[7][0] ?>],[1,<?php echo $dataoutpmonth[7][1] ?>],[2,<?php echo $dataoutpmonth[7][2] ?>],[3,<?php echo $dataoutpmonth[7][3] ?>],[4,<?php echo $dataoutpmonth[7][4] ?>],[5,<?php echo $dataoutpmonth[7][5] ?>],[6,<?php echo $dataoutpmonth[7][6] ?>],[7,<?php echo $dataoutpmonth[7][7] ?>],[8,<?php echo $dataoutpmonth[7][8] ?>],[9,<?php echo $dataoutpmonth[7][9] ?>],[10,<?php echo $dataoutpmonth[7][10] ?>],[11,<?php echo $dataoutpmonth[7][11] ?>],[12,<?php echo $dataoutpmonth[7][12] ?>],[13,<?php echo $dataoutpmonth[7][13] ?>],[14,<?php echo $dataoutpmonth[7][14] ?>],[15,<?php echo $dataoutpmonth[7][15] ?>],[16,<?php echo $dataoutpmonth[7][16] ?>],[17,<?php echo $dataoutpmonth[7][17] ?>],[18,<?php echo $dataoutpmonth[7][18] ?>],[19,<?php echo $dataoutpmonth[7][19] ?>],[20,<?php echo $dataoutpmonth[7][20] ?>],[21,<?php echo $dataoutpmonth[7][21] ?>],[22,<?php echo $dataoutpmonth[7][22] ?>],[23,<?php echo $dataoutpmonth[7][23] ?>],]
                             },{name: 'Aout',
                                data: [[0,<?php echo $dataoutpmonth[8][0] ?>],[1,<?php echo $dataoutpmonth[8][1] ?>],[2,<?php echo $dataoutpmonth[8][2] ?>],[3,<?php echo $dataoutpmonth[8][3] ?>],[4,<?php echo $dataoutpmonth[8][4] ?>],[5,<?php echo $dataoutpmonth[8][5] ?>],[6,<?php echo $dataoutpmonth[8][6] ?>],[7,<?php echo $dataoutpmonth[8][7] ?>],[8,<?php echo $dataoutpmonth[8][8] ?>],[9,<?php echo $dataoutpmonth[8][9] ?>],[10,<?php echo $dataoutpmonth[8][10] ?>],[11,<?php echo $dataoutpmonth[8][11] ?>],[12,<?php echo $dataoutpmonth[8][12] ?>],[13,<?php echo $dataoutpmonth[8][13] ?>],[14,<?php echo $dataoutpmonth[8][14] ?>],[15,<?php echo $dataoutpmonth[8][15] ?>],[16,<?php echo $dataoutpmonth[8][16] ?>],[17,<?php echo $dataoutpmonth[8][17] ?>],[18,<?php echo $dataoutpmonth[8][18] ?>],[19,<?php echo $dataoutpmonth[8][19] ?>],[20,<?php echo $dataoutpmonth[8][20] ?>],[21,<?php echo $dataoutpmonth[8][21] ?>],[22,<?php echo $dataoutpmonth[8][22] ?>],[23,<?php echo $dataoutpmonth[8][23] ?>],]
                             },{name: 'Septembre',
                                data: [[0,<?php echo $dataoutpmonth[9][0] ?>],[1,<?php echo $dataoutpmonth[9][1] ?>],[2,<?php echo $dataoutpmonth[9][2] ?>],[3,<?php echo $dataoutpmonth[9][3] ?>],[4,<?php echo $dataoutpmonth[9][4] ?>],[5,<?php echo $dataoutpmonth[9][5] ?>],[6,<?php echo $dataoutpmonth[9][6] ?>],[7,<?php echo $dataoutpmonth[9][7] ?>],[8,<?php echo $dataoutpmonth[9][8] ?>],[9,<?php echo $dataoutpmonth[9][9] ?>],[10,<?php echo $dataoutpmonth[9][10] ?>],[11,<?php echo $dataoutpmonth[9][11] ?>],[12,<?php echo $dataoutpmonth[9][12] ?>],[13,<?php echo $dataoutpmonth[9][13] ?>],[14,<?php echo $dataoutpmonth[9][14] ?>],[15,<?php echo $dataoutpmonth[9][15] ?>],[16,<?php echo $dataoutpmonth[9][16] ?>],[17,<?php echo $dataoutpmonth[9][17] ?>],[18,<?php echo $dataoutpmonth[9][18] ?>],[19,<?php echo $dataoutpmonth[9][19] ?>],[20,<?php echo $dataoutpmonth[9][20] ?>],[21,<?php echo $dataoutpmonth[9][21] ?>],[22,<?php echo $dataoutpmonth[9][22] ?>],[23,<?php echo $dataoutpmonth[9][23] ?>],]
                             },{name: 'Octobre',
                                data: [[0,<?php echo $dataoutpmonth[10][0] ?>],[1,<?php echo $dataoutpmonth[10][1] ?>],[2,<?php echo $dataoutpmonth[10][2] ?>],[3,<?php echo $dataoutpmonth[10][3] ?>],[4,<?php echo $dataoutpmonth[10][4] ?>],[5,<?php echo $dataoutpmonth[10][5] ?>],[6,<?php echo $dataoutpmonth[10][6] ?>],[7,<?php echo $dataoutpmonth[10][7] ?>],[8,<?php echo $dataoutpmonth[10][8] ?>],[9,<?php echo $dataoutpmonth[10][9] ?>],[10,<?php echo $dataoutpmonth[10][10] ?>],[11,<?php echo $dataoutpmonth[10][11] ?>],[12,<?php echo $dataoutpmonth[10][12] ?>],[13,<?php echo $dataoutpmonth[10][13] ?>],[14,<?php echo $dataoutpmonth[10][14] ?>],[15,<?php echo $dataoutpmonth[10][15] ?>],[16,<?php echo $dataoutpmonth[10][16] ?>],[17,<?php echo $dataoutpmonth[10][17] ?>],[18,<?php echo $dataoutpmonth[10][18] ?>],[19,<?php echo $dataoutpmonth[10][19] ?>],[20,<?php echo $dataoutpmonth[10][20] ?>],[21,<?php echo $dataoutpmonth[10][21] ?>],[22,<?php echo $dataoutpmonth[10][22] ?>],[23,<?php echo $dataoutpmonth[10][23] ?>],]
                             },{name: 'Novembre',
                                data: [[0,<?php echo $dataoutpmonth[11][0] ?>],[1,<?php echo $dataoutpmonth[11][1] ?>],[2,<?php echo $dataoutpmonth[11][2] ?>],[3,<?php echo $dataoutpmonth[11][3] ?>],[4,<?php echo $dataoutpmonth[11][4] ?>],[5,<?php echo $dataoutpmonth[11][5] ?>],[6,<?php echo $dataoutpmonth[11][6] ?>],[7,<?php echo $dataoutpmonth[11][7] ?>],[8,<?php echo $dataoutpmonth[11][8] ?>],[9,<?php echo $dataoutpmonth[11][9] ?>],[10,<?php echo $dataoutpmonth[11][10] ?>],[11,<?php echo $dataoutpmonth[11][11] ?>],[12,<?php echo $dataoutpmonth[11][12] ?>],[13,<?php echo $dataoutpmonth[11][13] ?>],[14,<?php echo $dataoutpmonth[11][14] ?>],[15,<?php echo $dataoutpmonth[11][15] ?>],[16,<?php echo $dataoutpmonth[11][16] ?>],[17,<?php echo $dataoutpmonth[11][17] ?>],[18,<?php echo $dataoutpmonth[11][18] ?>],[19,<?php echo $dataoutpmonth[11][19] ?>],[20,<?php echo $dataoutpmonth[11][20] ?>],[21,<?php echo $dataoutpmonth[11][21] ?>],[22,<?php echo $dataoutpmonth[11][22] ?>],[23,<?php echo $dataoutpmonth[11][23] ?>],]
                             },{name: 'Decembre',
                                data: [[0,<?php echo $dataoutpmonth[12][0] ?>],[1,<?php echo $dataoutpmonth[12][1] ?>],[2,<?php echo $dataoutpmonth[12][2] ?>],[3,<?php echo $dataoutpmonth[12][3] ?>],[4,<?php echo $dataoutpmonth[12][4] ?>],[5,<?php echo $dataoutpmonth[12][5] ?>],[6,<?php echo $dataoutpmonth[12][6] ?>],[7,<?php echo $dataoutpmonth[12][7] ?>],[8,<?php echo $dataoutpmonth[12][8] ?>],[9,<?php echo $dataoutpmonth[12][9] ?>],[10,<?php echo $dataoutpmonth[12][10] ?>],[11,<?php echo $dataoutpmonth[12][11] ?>],[12,<?php echo $dataoutpmonth[12][12] ?>],[13,<?php echo $dataoutpmonth[12][13] ?>],[14,<?php echo $dataoutpmonth[12][14] ?>],[15,<?php echo $dataoutpmonth[12][15] ?>],[16,<?php echo $dataoutpmonth[12][16] ?>],[17,<?php echo $dataoutpmonth[12][17] ?>],[18,<?php echo $dataoutpmonth[12][18] ?>],[19,<?php echo $dataoutpmonth[12][19] ?>],[20,<?php echo $dataoutpmonth[12][20] ?>],[21,<?php echo $dataoutpmonth[12][21] ?>],[22,<?php echo $dataoutpmonth[12][22] ?>],[23,<?php echo $dataoutpmonth[12][23] ?>],]
                            
							}]
                        });
						
						$('#chart6').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: "Production annuelle: <?php echo number_format($totalannuelnograph, 2, ',', ' ') ?> kWh"
                        },
                        
						xAxis: {
                            title: {
                                text: ''
                            },
                            categories : ['Janv', 'Fevr', 'Mars', 'Avri', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Octo', 'Nove', 'Déce']
                        },
                        yAxis: [{
                            title: {
                                text: 'Production (kWh)'
                            },
                            gridLineWidth: 1,
                            min: 0
                        },],
                        plotOptions: {
                            series: {
                                marker: {
                                    enabled: false
                                }
                            }
                        },
                     
                        series: [{
                                    name: 'Production',
                        			data: [{y:<?php echo $totalannuel[1] ?>, color:'#336633'}, 
                        				   {y:<?php echo $totalannuel[2] ?>, color:'#4c8da6'}, 
                        				   {y:<?php echo $totalannuel[3] ?>, color:'#ffa500'}, 
                        				   {y:<?php echo $totalannuel[4] ?>, color:'#ffff66'}, 
                        				   {y:<?php echo $totalannuel[5] ?>, color:'#33ff66'}, 
                        				   {y:<?php echo $totalannuel[6] ?>, color:'#cc0000'}, 
                        				   {y:<?php echo $totalannuel[7] ?>, color:'#ff3399'}, 
                        				   {y:<?php echo $totalannuel[8] ?>, color:'#999999'}, 
                        				   {y:<?php echo $totalannuel[9] ?>, color:'#cc6600'}, 
                        				   {y:<?php echo $totalannuel[10] ?>, color:'#006600'}, 
                        				   {y:<?php echo $totalannuel[11] ?>, color:'#663300'}, 
                        				   {y:<?php echo $totalannuel[12] ?>, color:'#a55c8c'}]
                                }]
                        });
						
						$('#chart7').highcharts({
                        chart: {
                            type: 'spline'
                        },
                        title: {
                            text: "Revenu annuel: <?php echo number_format(round(array_sum($totalannuel)/1000 * $prixrevente, 2), 2, ',', ' ') ?> €"
                        },
                        colors:['#cc0000'],
						xAxis: {
                            title: {
                                text: 'Mois'
                            },
                           categories : ['Janv', 'Fevr', 'Mars', 'Avri', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Octo', 'Nove', 'Déce']
                        },
                        yAxis: [{
                            title: {
                                text: 'Euros (€)'
                            },
                            gridLineWidth: 1,
                            min: 0
                        
                        }],
                        plotOptions: {
                            series: {
                                marker: {
                                    enabled: false
                                }
                            }
                        },
                        series: [{
                                    name: 'Revenu',
						data: [['Janvier', <?php echo round($totalannuel[1]/1000*$prixrevente,2) ?>],['Fevrier', <?php echo	round($totalannuel[2]/1000*$prixrevente,2) ?>],['Mars', <?php echo round($totalannuel[3]/1000*$prixrevente,2) ?>],['Avril', <?php echo round($totalannuel[4]/1000*$prixrevente,2) ?>],['Mai', <?php echo round($totalannuel[5]/1000*$prixrevente,2) ?>],['Juin', <?php echo round($totalannuel[6]/1000*$prixrevente,2) ?>],['Juillet', <?php echo round($totalannuel[7]/1000*$prixrevente,2) ?>],['Aout', <?php echo round($totalannuel[8]/1000*$prixrevente,2) ?>],['Septembre', <?php echo round($totalannuel[9]/1000*$prixrevente,2) ?>],['Octobre', <?php echo round($totalannuel[10]/1000*$prixrevente,2) ?>],['Novembre', <?php echo round($totalannuel[11]/1000*$prixrevente,2) ?>],['Decembre', <?php echo round($totalannuel[12]/1000*$prixrevente,2) ?>]]
                                }]
                        });
						
					$('#chart8').highcharts({
                        chart: {
                        type: 'spline'
                    },
                    title: {
                        text: 'Evolution de la rentabilité du projet'
                    },
                    xAxis: {
                        title: {
                            text: 'Années'
                        },
                        tickInterval: 2,
                        min: 0,
                        max: 25,
						plotLines: [{
										value : 10,
										color: 'blue',
										dashStyle: 'shortdash',
										width: 1,
										label: {
											text : 'Changement Onduleurs'
										}
									}, 
									{
										value : 20,
										color: 'blue',
										dashStyle: 'shortdash',
										width: 1,
										label: {
												text : 'Changement Onduleurs'
												}
							
						}]
                    },
                    colors:['#cc0000', '#33ff66'],
                    yAxis: {
                        title: {
                            text: 'Euros (€)'
                        },
                        gridLineWidth: 1,
						min: 0,
						plotLines: [{
										value : <?php 
										echo $limitepartiesup; ?>,
										color: 'yellow',
										dashStyle: 'shortdash',
										width: 1,
										label: {
											text : 'Cout de l\'installation'
										}
									}]
                        
                    },
                    plotOptions: {
                            series: {
                                marker: {
                                    enabled: false
                                }
                            }
                        },
                        series: [{
                                name: 'Remboursement',
                                data: [<?php $k=0;
											 $cumuleaffichage = 0;
											 while ($k <= $limite)
											 {
												$cumuleaffichage = $cumuleaffichage + round($totalannuelnograph * $tabprixrevente[$k], 2); 
												echo "[" . $k . "," . $cumuleaffichage  . ' ],';
												$k++;
											 }?>]
							 },{name: 'Bénéfice',
                                data: [<?php 
											if ($k != 26)
											{
												echo "[" . ($k-1) . "," . $cumuleaffichage . ' ],';
											}
											while ($k <= 25)
											{
												$cumuleaffichage = $cumuleaffichage + round($totalannuelnograph * $tabprixrevente[$k], 2); 
												echo "[" . $k . "," . $cumuleaffichage . ' ],';
												$k++;
											}
							?>]
                             }]
                        });
						
                        
});

$(function (){
   $(".popb").popover(); 
});
// Contain the popover within the body NOT the element it was called in.
$('[data-toggle="popover"]').popover({
	container: 'body',
	placement: 'right'
});

</script>

<!-- licence + school logo -->
                <footer class="modal-footer">
                    <div  style="margin-bottom: 10px;"><a href="http://www.ece.fr/" target="_blank"><img id="logoECE" class="img-responsive" src="../img/ECE_COUL_CMJN copie.png" alt="" /></a></div>
                    <div class='text-center'>
                        <span id="copyright">
                            &nbsp;Le code source de ce site, ainsi que les données utilisées&nbsp;<br>&nbsp;et les résultats, sont sous licence CC-NY-NC 3.0.&nbsp;<br>
                            <a href="http://creativecommons.org/licenses/by-nc/3.0/" target="_blank"><img id="logoECE" class="img-responsive" src="../img/by-nc.eu_petit.png" alt="" /></a>
                        </span>
                    </div>
                </footer>
</div>
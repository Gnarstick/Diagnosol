<!DOCTYPE html> <!--  -->
<html>
    <head>
        <meta charset="utf-8">
        <title>DiagnoSOL &bull; Simulation</title>
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
<!-- Homepage simu-->

<div class="row">
            <div class="clearness col-sm-12">
                
                <div class="row">
                    <div class="lead col-sm-12">
                        <h1>Simulation</h1>
                    </div>
                </div>
				
				
					<div class="row">
                    <div class="col-sm-offset-3 col-sm-6">
                        <form class="form-horizontal marginLR" method="post" action="simulationresult.php" onsubmit="return validate();">
						
						<div class="form-group">
                                <legend>Choix de l'emplacement géographique du site
                                    <a href="#pop" class="pop pull-right" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto" style="margin-top: 1px"
                                       data-content='Choisir un site parmi la liste ou aller dans le menu "Sites" pour en créer un nouvreau.'
                                       title="<b>AIDE : Choix du site</b>">
                                            <span class="glyphicon glyphicon-question-sign small"></span>
                                    </a>
                                </legend>
                        </div>
						
						<div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <select id="select" name="place_choice" class="form-control" >
                                        <optgroup label="Sites">
													<!---- php pour load la database ici 
													format <option value="24">EA45055001 - Orleans</option> ---->
                                                <?php
												$servername = "localhost";
												$username = "";
												$password = "";
												$dbname = "";
												// Create connection
												$conn = mysqli_connect($servername, $username, $password, $dbname);
												// Check connection
												if (!$conn) 
												{
													die("Connection failed: " . mysqli_connect_error());
												}

												$sql = "SELECT * FROM site_relation WHERE owner='all'";
												
												//test pour voir si les data sont add comme il faut
												$reponse = mysqli_query($conn, $sql);
												while($donnees = mysqli_fetch_array($reponse))
												{
												?>
												<option value="<?php echo $donnees['name'] . "." . $donnees['owner'];?>"><?php echo $donnees['name'];?></option>
												<?php
												} //fin de la boucle, le tableau contient toute la BDD
												$sql2 = "SELECT * FROM site_relation WHERE owner='$userlog'";
												
												//test pour voir si les data sont add comme il faut
												$reponse12 = mysqli_query($conn, $sql2);
												while($donnees = mysqli_fetch_array($reponse12))
												{
												?>
												<option value="<?php echo $donnees['name'] . "." . $donnees['owner'];?>"><?php echo $donnees['name'];?></option>
												<?php
												} //fin de la boucle, le tableau contient toute la BDD
												?>
                                        </optgroup>
                                    </select>
                                </div>
                        </div>
						
						<br><br>
                            
						<div class="form-group">
                                <legend>Choix du panneau solaire
                                    <a href="#pop" class="pop pull-right" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto" style="margin-top: 1px"
                                       data-content='Choisir un panneau parmi la liste ou aller dans le menu "Panneaux" pour en créer un nouveau.'
                                       title="<b>AIDE : Choix du panneau solaire</b>">
                                            <span class="glyphicon glyphicon-question-sign small"></span>
                                    </a>
                                </legend>
                        </div>
						
						<div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <select id="select" name="panneau_choice" class="form-control" >
                                        <optgroup label="Catalogue">
										<!---- php pour load la database ici 
													format <option value="24">EA45055001 - Orleans</option> ---->
													<?php
												$servername = "localhost";
												$username = "";
												$password = "";
												$dbname = "";

												// Create connection
												$conn = mysqli_connect($servername, $username, $password, $dbname);
												// Check connection
												if (!$conn) 
												{
													die("Connection failed: " . mysqli_connect_error());
												}

												$sql = "SELECT * FROM panneaux WHERE owner='all'";
												
												$panneau;
												$cmp = 0;

												//test pour voir si les data sont add comme il faut
												$reponse = mysqli_query($conn, $sql);
												while($donnees = mysqli_fetch_array($reponse))
												{ if(!in_array($donnees['Nom'], $panneau))
													{
														$panneau[$cmp] = $donnees['Nom'];
														$cmp++;
												?>
												<option value="<?php echo $donnees['Nom'] . "." . $donnees['owner']?>"><?php echo $donnees['Nom'];?></option>
												<?php
													}
												} //fin de la boucle, le tableau contient toute la BDD
												$sql2 = "SELECT * FROM panneaux WHERE owner='$userlog'";
												
												//test pour voir si les data sont add comme il faut
												$reponse12 = mysqli_query($conn, $sql2);
												while($donnees = mysqli_fetch_array($reponse12))
												{
												?>
												<option value="<?php echo $donnees['Nom'] . "." . $donnees['owner'];?>"><?php echo $donnees['name'];?></option>
												<?php
												} //fin de la boucle, le tableau contient toute la BDD
												?>
										</optgroup>
                                    </select>
                                </div>
                        </div>
						
						<br><br>
                            
						<div class="form-group">
                                <legend>Choix de l'onduleur
                                    <a href="#pop" class="pop pull-right" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto" style="margin-top: 1px"
                                       data-content='Choisir un onduleur parmi la liste ou aller dans le menu "Onduleurs" pour en créer un nouveau.'
                                       title="<b>AIDE : Choix de l'onduleur</b>">
                                            <span class="glyphicon glyphicon-question-sign small"></span>
                                    </a>
                                </legend>
                        </div>
						
						<div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <select id="select" name="onduleur_choice" class="form-control" >
                                        <optgroup label="Catalogue">
												<option value="Selection automatique.all">Selection Automatique</option>
										<!---- php pour load la database ici 
													format <option value="24">EA45055001 - Orleans</option> ---->
													<?php
												$servername = "localhost";
												$username = "";
												$password = "";
												$dbname = "";

												// Create connection
												$conn = mysqli_connect($servername, $username, $password, $dbname);
												// Check connection
												if (!$conn) 
												{
													die("Connection failed: " . mysqli_connect_error());
												}

												$sql = "SELECT * FROM onduleurs WHERE owner='all'";
												
												$onduleur;
												$cmp = 0;

												//test pour voir si les data sont add comme il faut
												$reponse = mysqli_query($conn, $sql);
												while($donnees = mysqli_fetch_array($reponse))
												{ if(!in_array($donnees['Nom'], $onduleur))
													{
														$onduleur[$cmp] = $donnees['Nom'];
														$cmp++;
												?>
												<option value="<?php echo $donnees['Nom'] . "." . $donnees['owner']?>"><?php echo $donnees['Nom'];?></option>
												<?php
													}
												} //fin de la boucle, le tableau contient toute la BDD
												$sql2 = "SELECT * FROM onduleurs WHERE owner='$userlog'";
												
												//test pour voir si les data sont add comme il faut
												$reponse12 = mysqli_query($conn, $sql2);
												while($donnees = mysqli_fetch_array($reponse12))
												{
												?>
												<option value="<?php echo $donnees['Nom'] . "." . $donnees['owner'];?>"><?php echo $donnees['name'];?></option>
												<?php
												} //fin de la boucle, le tableau contient toute la BDD
												?>
										</optgroup>
                                    </select>
                                </div>
                        </div>
						
						<div class="form-group">
                                <legend>Type d'intégration
                                    <a href="#pop" class="pop pull-right" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto" style="margin-top: 1px"
                                       data-content="<b>IAB:</b> [0-9kWc->25,39 c€/kWh] Les panneaux sont intégrés au bâti et jouent un rôle de couverture. Ils garantissent l'étanchéité des toits. 
													 <br> <b>ISB:</b> [0-36kWc->14,4c€/kWh / 36-100kWc->13,68c€/kWh] Les panneaux solaires sont directement fixés sur la toiture existante en surimposition. 
													 <br> <b>Autre:</b> [0-12MWc->6,12c€/kWh] "
                                       title="<b>AIDE : Choix du type d'intégration</b>">
                                            <span class="glyphicon glyphicon-question-sign small"></span>
                                    </a>
                                </legend>
                        </div>
						
						<div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <select id="select" name="integration_choice" class="form-control" >
                                        <optgroup label="Intégration">
											<option value="IAB"  selected>Intégré Au Bâti (IAB)</option>
											<option value="ISB">Intégré Simplifié au Bâti (ISB)</option>
											<option value="Autre">Autre (Tout type d'installation)</option>
										</optgroup>
									</select>
                                </div>
                        </div>
						
						<div class="form-group">
                                <legend>Orientation et Inclinaison
                                    <a href="#pop" class="pop pull-right" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto" style="margin-top: 1px"
                                       data-content="Choix de l'orientation et de l'inclinaison des panneaux de l'installation"
                                       title="<b>AIDE : Orientation et Inclinaison</b>">
                                            <span class="glyphicon glyphicon-question-sign small"></span>
                                    </a>
                                </legend>
                        </div>
						
						<div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <select id="select" name="orientation_choice" class="form-control" >
                                        <optgroup label="Orientation">
											<option value="Est">Est</option>
											<option value="Sud-Est">Sud-Est</option>
											<option value="Sud" selected>Sud</option>
											<option value="Sud-Ouest">Sud-Ouest</option>
											<option value="Ouest">Ouest</option>
										</optgroup>
									</select>
                                </div>
                        </div>
						
						<div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <select id="select" name="inclinaison_choice" class="form-control" >
                                        <optgroup label="Inclinaison">
											<option value="0">0°</option>
											<option value="30" selected>30°</option>
											<option value="45">45°</option>
											<option value="60">60°</option>
											<option value="90">90°</option>
										</optgroup>
									</select>
                                </div>
                        </div>
						
						
						<div class="form-group">
                                <legend>Coût
                                    <a href="#pop" class="pop pull-right" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto" style="margin-top: 1px"
                                       data-content="Marge: % de marge pratiqué par l'installateur lors de la pose d'une installation"
                                       title="<b>AIDE : Choix financier</b>">
                                            <span class="glyphicon glyphicon-question-sign small"></span>
                                    </a>
                                </legend>
                        </div>
						
						<div id="divfinance" class="form-group" >
                                <div class="col-md-4">
                                    <label for="marge" class="control-label">Marge : </label>
                                    <br>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="marge" type="text" name="marge" value="40" class="form-control"/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good"></span>
										<span class="input-group-addon">%</span>
									</div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer le pourcentage de marge de l'installateur."
                                           title="<b>AIDE : Marge de l'installateur</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                        </div>

						<h3>Entrées utilisateur</h3>
						
						<div id="divsurface" class="form-group" >
                                <div class="col-sm-offset-2 col-sm-10">
                                    <label for="surface" class="control-label">Surface de panneaux en m²: </label>
                                    <br>
                                    <span class="error help-block">Surface voulue</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-7">
                                        <input id="surface" type="text" name="surface" value="" class="form-control"/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good"></span>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer la surface voulue."
                                           title="<b>AIDE : Surface</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>
							
							<div id="divproduction" class="form-group" >
                                <div class="col-sm-offset-2 col-sm-10">
                                    <label for="production" class="control-label">Puissance nominale en W : </label>
                                    <br>
                                    <span class="error help-block">production voulue</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-7">
                                        <input id="production" type="text" name="production" value="" class="form-control"/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good"></span>
										
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer la puissance nominale voulue."
                                           title="<b>AIDE : Puissance nominale</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>
							
							<div id="divprix" class="form-group" >
                                <div class="col-sm-offset-2 col-sm-10">
                                    <label for="prix" class="control-label">Prix en €: </label>
                                    <br>
                                    <span class="error help-block">prix voulu</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-7">
                                        <input id="prix" type="text" name="prix" value="" class="form-control"/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good"></span>
										
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer le prix voulu."
                                           title="<b>AIDE : Prix</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>
						
						<div class="form-group">
                                <button type="submit" class="pull-right btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> &nbsp; Lancer la simulation</button>
                        </div>

                        </form>
                    </div>
                </div>
			</div>
</div>


<!-- script function de popover ici-->

<script type="text/javascript">

function validate()
{
	if(($('#prix').val().length > 0))
	{
		return true;
	}
	else if(($('#surface').val().length > 0))
	{
		return true;
	}
	else if(($('#production').val().length > 0))
	{
		return true;
	}
	else
	{
		return false;
	}
}

//popover
$(function (){
   $(".pop").popover(); 
});
// Contain the popover within the body NOT the element it was called in.
$('[data-toggle="popover"]').popover({
	container: 'body'
});

$(function () {
	$('#surface').keyup(function() 
	{
		document.getElementById("prix").value="";
		document.getElementById("production").value="";
	});
	$('#production').keyup(function() 
	{
		document.getElementById("surface").value="";
		document.getElementById("prix").value="";
	});
	$('#prix').keyup(function() 
	{
		document.getElementById("surface").value="";
		document.getElementById("production").value="";
	});
});


</script>

<!-- licence + school logo -->
                <footer class="modal-footer">
                    <div  style="margin-bottom: 10px;"><a href="http://www.ece.fr/" target="_blank"><img id="logoECE" class="img-responsive" src="../img/ECE_COUL_CMJN copie.png" alt="" /></a></div>
                    <div class='text-center'>
                        <span id="copyright">
                            &nbsp;Le code source de ce site, ainsi que les données utilisées&nbsp;<br>&nbsp;et les résultats, sont sous licence CC-BY-NC 3.0.&nbsp;<br>
                            <a href="http://creativecommons.org/licenses/by-nc/3.0/" target="_blank"><img id="logoECE" class="img-responsive" src="../img/by-nc.eu_petit.png" alt="" /></a>
                        </span>
                    </div>
                </footer>
</div>

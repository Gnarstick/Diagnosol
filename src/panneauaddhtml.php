<!DOCTYPE html> <!--  -->
<html>
    <head>
        <meta charset="utf-8">
        <title>DiagnoSOL &bull; Ajouter un Panneau</title>
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
                        <li><a href="simulation.php">Simulation</a></li>
                        <li><a href="site.php">Sites</a></li>
                        <li  class="active"><a href="panneaux.php">Panneaux</a></li>
                        <li><a href="onduleur.php">Onduleurs</a></li>
                        <li><a href="propos.php">A propos</a></li>
						<li><a href="FAQ.php">F.A.Q</a></li></ul>
                        <ul class="nav navbar-nav navbar-right"><li><a <?php if($userlog == ""){echo "href=\"connexionhtml.php\"";}else{echo "href=\"connexion.php\"";}?> ><?php if($userlog == ""){echo "Connexion";}else{echo "Déconnexion";} ?></a></li>
                    </ul>
                </div><!--/.nav-collapse -->
                
              </div>
        </nav>
        <div class="container" style="padding-top:40px">
<!-- Homepage onduleurs-->
<div class="row">
        <div class="clearness col-sm-12">

            <div class="row">
                <div class="lead col-sm-12">
                    <h1>Ajout d'un panneau solaire</h1>
                </div>
            </div>

	
	    <div class="alert alert-danger" id="alert" role="alert" Style="display: none">
                <ul>
            <li id="champ1" Style="display: none">Le champ 'Puissance nominale Pmpp' (en W) est requis et doit contenir une valeur.</li>
            <li id="champ2" Style="display: none">Le champ 'Tension nominale Vmpp' (en V) est requis et doit contenir une valeur.</li>
            <li id="champ3" Style="display: none">Le champ 'Courant nominal Impp' (en A) est requis et doit contenir une valeur.</li>
            <li id="champ4" Style="display: none">Le champ 'Tension circuit ouvert Voc' (en V) est requis et doit contenir une valeur.</li>
			<li id="champ5" Style="display: none">Le champ 'Courant court-circuit Isc' (en A) est requis et doit contenir une valeur.</li>
			<li id="champ6" Style="display: none">Le champ 'Rendement' est requis et doit contenir une valeur.</li>
			<li id="champ7" Style="display: none">Le champ 'NOCT' (en °C) est requis et doit contenir une valeur.</li>
			<li id="champ8" Style="display: none">Le champ 'Coefficient Temp Pmpp' (en %/°C) est requis et doit contenir une valeur.</li>
			<li id="champ9" Style="display: none">Le champ 'Année' est requis et doit contenir une valeur.</li>
            <li id="champ10" Style="display: none">Le champ 'Longeur' (en mm) est requis et doit contenir une valeur.</li>
			<li id="champ11" Style="display: none">Le champ 'Largeur' (en mm) est requis et doit contenir une valeur.</li>
			<li id="champ12" Style="display: none">Le champ 'Prix' (en €) est requis et doit contenir une valeur.</li>
                    </ul>
            </div>



            <div class="row">
                <div class="col-sm-offset-1 col-sm-10">
                    <form class="form-horizontal marginLR" method="post" action="panneauadd.php" onsubmit="return validateclick();"> 
                        <div class="form-group">
                            <legend>Paramétrage du panneau solaire</legend>
                        </div>

                        <div class="row">
							
                            <div class="col-sm-6">
							
								<div id="divpanName" class="form-group">
                                <div class="col-lg-5">
                                    <label for="PanName" class="control-label">Nom du Panneau : </label>
                                    <br>
                                    <span class="error help-block">De 1 à 50 caractères</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <input id="PanName" type="text" name="panneau_name" value="" class="form-control" placeholder=""/>
                                    <span class="glyphicon glyphicon-remove form-control-feedback error"></span>
                                    <span class="glyphicon glyphicon-ok form-control-feedback good"></span>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer le nom du panneau (entre 1 et 50 caractères)."
                                           title="<b>AIDE : Nom du panneau</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>
							
                                <div id="divpuinomi" class="form-group">
                                <div class="col-lg-5">
                                    <label for="puinomi" class="control-label"style="font-size: 89%;">Puissance nominale Pmpp:</label>
                                    <span class="error help-block">Entre 0 et 500 Wp</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="puinomi" type="text" name="panneau_puinomi" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
                    <span class="input-group-addon">W</span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer Puissance nominale.<br><br>
                                           <i>Puissance maximale du générateur du panneau solaire.</i>"
                                           title="<b>AIDE : Puissance nominale </b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>
                            <div id="divtensnomi" class="form-group">
                                <div class="col-lg-5">
                                    <label for="tensnomi" class="control-label"style="font-size: 95%;">Tension nominale Vmpp:</label>
                                    <span class="error help-block">Entre 0 et 200 V</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="tensnomi" type="text" name="panneau_tensnomi" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
                    <span class="input-group-addon">V</span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer la tension nominale.<br><br>
                                           <i>Tension de fonctionnement du panneau solaire.</i>"
                                           title="<b>AIDE : Tension nominale</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>
                            <div id="divcournomi" class="form-group">
                                <div class="col-lg-5">
                                    <label for="cournomi" class="control-label">Courant nominal Impp:</label>
                                    <span class="error help-block">Entre 0 et 50 A</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="cournomi" type="text" name="panneau_cournomi" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
                    <span class="input-group-addon">A</span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer le courant nominal.<br><br>
                                           <i>Courant de fonctionnement du panneau solaire.</i>"
                                           title="<b>AIDE : Courant nominal</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>
                            <div id="divtensouvert" class="form-group">
                                <div class="col-lg-5">
                                    <label for="tensouvert" class="control-label" style="font-size: 85%;">Tension circuit ouvert Voc:</label>
                                    <span class="error help-block">Entre 0 et 150 V</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="tensouvert" type="text" name="panneau_tensouvert" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
                    <span class="input-group-addon">V</span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer la tension en circuit ouvert.<br><br>
                                           <i>Tension aux bornes du générateur hors tension.</i>"
                                           title="<b>AIDE : Tension circuit ouvert</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>

                            <div id="divcourantIsc" class="form-group">
                                <div class="col-lg-5">
                                    <label for="courantIsc" class="control-label"style="font-size: 95%;">Courant court-circuit Isc:</label>
                                    <span class="error help-block">Entre 0 et 20 A</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="courantIsc" type="text" name="panneau_courantIsc" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
                    <span class="input-group-addon">A</span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer le courant de court-circuit.<br><br>
                                           <i>Courant de court-circuit</i>"
                                           title="<b>AIDE : Courant court-circuit </b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>
                            <div id="divrendement" class="form-group">
                                <div class="col-lg-5">
                                    <label for="rendement" class="control-label">Rendement:</label>
                                    <span class="error help-block">Entre 0 et 100 %</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="rendement" type="text" name="panneau_rendement" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
										<span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer le rendement.<br><br>
                                           <i>Performance réelle du panneau solaire, tenant compte des pertes provoquées par les composants.</i>"
                                           title="<b>AIDE : Rendement</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>
                            <div id="divnoct" class="form-group">
                                <div class="col-lg-5">
                                    <label for="noct" class="control-label">NOCT:</label>
                                    <span class="error help-block">Entre 0 et 100°C</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="noct" type="text" name="panneau_noct" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
                    <span class="input-group-addon">°C</span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer le NOCT.<br><br>
                                           <i>Entrer la température nominale d'utilisation des cellules.</i>"
                                           title="<b>AIDE : NOCT</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>
                            <div id="divcoeftpmpp" class="form-group">
                                <div class="col-lg-5">
                                    <label for="coeftpmpp" class="control-label">Coefficient Temp Pmpp:</label>
                                    <span class="error help-block">Entre -5 et 0</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="coeftpmpp" type="text" name="panneau_coeftpmpp" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5" style="margin-right: 10px;"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5" style="margin-right: 10px;"></span>
										<span class="input-group-addon">%/°C</span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer le coefficient de température Pmpp.<br><br>
                                           <i>Pourcentage de pertes de puissance par degré Celsius.</i>"
                                           title="<b>AIDE : Puissance AC max</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>
                            <div id="divannee" class="form-group">
                                <div class="col-lg-5">
                                    <label for="annee" class="control-label">Année:</label>
                                    <span class="error help-block">ex: 2012</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="annee" type="text" name="panneau_annee" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer l'année .<br><br>
                                           <i>Année de commercialisation des panneaux.</i>"
                                           title="<b>AIDE : Année</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>

                            <div id="divlong" class="form-group">
                                <div class="col-lg-5">
                                    <label for="long" class="control-label">Longueur:</label>
                                    <span class="error help-block">Entre 500 et 3000 mm</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="long" type="text" name="panneau_long" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
                    <span class="input-group-addon">mm</span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer la longueur.<br><br>
                                           <i>Longueur du panneau solaire.</i>"
                                           title="<b>AIDE : Longueur</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>
                            <div id="divlarg" class="form-group">
                                <div class="col-lg-5">
                                    <label for="larg" class="control-label">Largeur:</label>
                                    <span class="error help-block">Entre 300 et 2000 mm</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="larg" type="text" name="panneau_larg" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
                    <span class="input-group-addon">mm</span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer la largeur.<br><br>
                                           <i>Largeur de panneau solaire.</i>"
                                           title="<b>AIDE : Largeur</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>
							
							<div id="divlien" class="form-group">
                                <div class="col-lg-5">
                                    <label for="lien" class="control-label">Lien :</label>
                                    <span class="error help-block">Format : URL</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="lien" type="text" name="onduleur_lien" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer le lien URL vers la fiche technique du panneau.<br><br>"
                                           title="<b>AIDE : Lien </b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>
							
                            <div id="divprix" class="form-group">
                                <div class="col-lg-5">
                                    <label for="prix" class="control-label">Prix:</label>
                                    <span class="error help-block">Entre 1 et 2000 €</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="prix" type="text" name="panneau_prix" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
                    <span class="input-group-addon">€</span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Prix TTC.<br><br>
                                           <i>Prix du panneau solaire.</i>"
                                           title="<b>AIDE : Prix</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>

                          
                      </div>


                          
                      </div>


                                </div>


                </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="pull-right btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> &nbsp; Valider</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
var windSpeed =0;
     
//generation of feedback icons for each input
$(function () {
        
   
//input verification and feedback when the user modifies the puissance nominal
        $('#puinomi').keyup(function() {
            $('#divpuinomi').addClass('has-feedback');
            $('#puinomi').val() >0 && $('#puinomi').val() <= 500 && parseFloat($('#puinomi').val()) === parseInt($('#puinomi').val()) && $('#puinomi').val() !== '' ? $('#divpuinomi').addClass('has-success').removeClass('has-error') && $('#divpuinomi').find('.good').show() && $('#divpuinomi').find('.error').hide() : $('#divpuinomi').addClass('has-error').removeClass('has-success') && $('#divpuinomi').find('.error').show() && $('#divpuinomi').find('.good').hide();       
        });
        
    //input verification and feedback when the user modifies the tension nominal
        $('#tensnomi').keyup(function() {
            $('#divtensnomi').addClass('has-feedback');
            $('#tensnomi').val() > 0 && $('#tensnomi').val() <= 200 && $('#tensnomi').val() !== '' ? $('#divtensnomi').addClass('has-success').removeClass('has-error') && $('#divtensnomi').find('.good').show() && $('#divtensnomi').find('.error').hide() : $('#divtensnomi').addClass('has-error').removeClass('has-success') && $('#divtensnomi').find('.error').show() && $('#divtensnomi').find('.good').hide();       
        });
        
    //input verification and feedback when the user modifies the courant nominal
        $('#cournomi').keyup(function() {
            $('#divcournomi').addClass('has-feedback');
            $('#cournomi').val() > 0 && $('#cournomi').val() <= 50  && $('#cournomi').val() !== '' ? $('#divcournomi').addClass('has-success').removeClass('has-error') && $('#divcournomi').find('.good').show() && $('#divcournomi').find('.error').hide() : $('#divcournomi').addClass('has-error').removeClass('has-success') && $('#divcournomi').find('.error').show() && $('#divcournomi').find('.good').hide();       
        });
        
    //input verification and feedback when the user modifies the open circuit voltage
        $('#tensouvert').keyup(function() {
            $('#divtensouvert').addClass('has-feedback');
            $('#tensouvert').val() > 0 && $('#tensouvert').val() <=150 && $('#tensouvert').val() !== '' ? $('#divtensouvert').addClass('has-success').removeClass('has-error') && $('#divtensouvert').find('.good').show() && $('#divtensouvert').find('.error').hide() : $('#divtensouvert').addClass('has-error').removeClass('has-success') && $('#divtensouvert').find('.error').show() && $('#divtensouvert').find('.good').hide();       
        });
        
    //input verification and feedback when the user modifies the courant isc
        $('#courantIsc').keyup(function() {
            $('#divcourantIsc').addClass('has-feedback');
            $('#courantIsc').val() > 0 && $('#courantIsc').val() <=20 && $('#courantIsc').val() !== '' ? $('#divcourantIsc').addClass('has-success').removeClass('has-error') && $('#divcourantIsc').find('.good').show() && $('#divcourantIsc').find('.error').hide() : $('#divcourantIsc').addClass('has-error').removeClass('has-success') && $('#divcourantIsc').find('.error').show() && $('#divcourantIsc').find('.good').hide();       
        });
        
    //input verification and feedback when the user modifies the rendement
        $('#rendement').keyup(function() {
            $('#divrendement').addClass('has-feedback');
            $('#rendement').val() > 0 && $('#rendement').val() <=100 && $('#rendement').val() !== '' ? $('#divrendement').addClass('has-success').removeClass('has-error') && $('#divrendement').find('.good').show() && $('#divrendement').find('.error').hide() : $('#divrendement').addClass('has-error').removeClass('has-success') && $('#divrendement').find('.error').show() && $('#divrendement').find('.good').hide();       
        });
        
    //input verification and feedback when the user modifies the noct
        $('#noct').keyup(function() {
            $('#divnoct').addClass('has-feedback');
            $('#noct').val() > 0 && $('#noct').val() <= 100 && $('#noct').val() !== '' ? $('#divnoct').addClass('has-success').removeClass('has-error') && $('#divnoct').find('.good').show() && $('#divnoct').find('.error').hide() : $('#divnoct').addClass('has-error').removeClass('has-success') && $('#divnoct').find('.error').show() && $('#divnoct').find('.good').hide();       
        });
        
    //input verification and feedback when the user modifies the coefficient temp pmpp
        $('#coeftpmpp').keyup(function() {
        $('#divcoeftpmpp').addClass('has-feedback');
        $('#coeftpmpp').val() >= -5 && $('#coeftpmpp').val() <= 0 && $('#coeftpmpp').val() !== '' ? $('#divcoeftpmpp').addClass('has-success').removeClass('has-error') && $('#divcoeftpmpp').find('.good').show() && $('#divcoeftpmpp').find('.error').hide() : $('#divcoeftpmpp').addClass('has-error').removeClass('has-success') && $('#divcoeftpmpp').find('.error').show() && $('#divcoeftpmpp').find('.good').hide();       
        });

	//input verification and feedback when the user modifies the year
        $('#annee').keyup(function() {
        $('#divannee').addClass('has-feedback');
        $('#annee').val() >= 1950 && $('#annee').val() <= 3000 && $('#annee').val() !== '' ? $('#divannee').addClass('has-success').removeClass('has-error') && $('#divannee').find('.good').show() && $('#divannee').find('.error').hide() : $('#divannee').addClass('has-error').removeClass('has-success') && $('#divannee').find('.error').show() && $('#divannee').find('.good').hide();       
        });

	//input verification and feedback when the user modifies the long
        $('#long').keyup(function() {
        $('#divlong').addClass('has-feedback');
        $('#long').val() >= 500 && $('#long').val() <= 5000 && $('#long').val() !== '' ? $('#divlong').addClass('has-success').removeClass('has-error') && $('#divlong').find('.good').show() && $('#divlong').find('.error').hide() : $('#divlong').addClass('has-error').removeClass('has-success') && $('#divlong').find('.error').show() && $('#divlong').find('.good').hide();       
        });
        
	//input verification and feedback when the user modifies the larg
        $('#larg').keyup(function() {
        $('#divlarg').addClass('has-feedback');
        $('#larg').val() >= 300 && $('#larg').val() <= 2000 && $('#larg').val() !== '' ? $('#divlarg').addClass('has-success').removeClass('has-error') && $('#divlarg').find('.good').show() && $('#divlarg').find('.error').hide() : $('#divlarg').addClass('has-error').removeClass('has-success') && $('#divlarg').find('.error').show() && $('#divlarg').find('.good').hide();       
        });

	//input verification and feedback when the user modifies the prix
         $('#prix').keyup(function() {
        $('#divprix').addClass('has-feedback');
        $('#prix').val() >= 1 && $('#prix').val() <= 2000 && $('#prix').val() !== '' ? $('#divprix').addClass('has-success').removeClass('has-error') && $('#divprix').find('.good').show() && $('#divprix').find('.error').hide() : $('#divprix').addClass('has-error').removeClass('has-success') && $('#divprix').find('.error').show() && $('#divprix').find('.good').hide();       
        });

    //
});


//popover
$(function (){
   $(".pop").popover(); 
});
// Contain the popover within the body NOT the element it was called in.
$('[data-toggle="popover"]').popover({
    container: 'body'
});


//
function validateclick()
{
	var cmp = 0;
	document.getElementById("alert").style.display = 'block';//
	if (!($('#prix').val() >= 1 && $('#prix').val() <= 2000 && $('#prix').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ12").style.display = 'block';
	}
	else
	{
		document.getElementById("champ12").style.display = 'none';
	}
	if (!($('#larg').val() >= 300 && $('#larg').val() <= 2000 && $('#larg').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ11").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ11").style.display = 'none';
	}
	if (!($('#long').val() >= 500 && $('#long').val() <= 5000 && $('#long').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ10").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ10").style.display = 'none';
	}
	if ((!$('#annee').val() >= 1950 && $('#annee').val() <= 3000 && $('#annee').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ9").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ9").style.display = 'none';
	}
	if (!( $('#coeftpmpp').val() >= -5 && $('#coeftpmpp').val() <= 0 && $('#coeftpmpp').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ8").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ8").style.display = 'none';
	}
	if (!($('#noct').val() > 0 && $('#noct').val() <= 100 && $('#noct').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ7").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ7").style.display = 'none';
	}
	if (!($('#rendement').val() > 0 && $('#rendement').val() <=100 && $('#rendement').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ6").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ6").style.display = 'none';
	}
	if (!($('#courantIsc').val() > 0 && $('#courantIsc').val() <=20 && $('#courantIsc').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ5").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ5").style.display = 'none';
	}
	if (!($('#tensouvert').val() > 0 && $('#tensouvert').val() <=150 && $('#tensouvert').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ4").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ4").style.display = 'none';
	}
	if (!($('#cournomi').val() > 0 && $('#cournomi').val() <= 50  && $('#cournomi').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ3").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ3").style.display = 'none';
	}
	if (!($('#tensnomi').val() > 0 && $('#tensnomi').val() <= 200 && $('#tensnomi').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ2").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ2").style.display = 'none';
	}
	if (!($('#puinomi').val() >0 && $('#puinomi').val() <= 500 && parseFloat($('#puinomi').val()) === parseInt($('#puinomi').val()) && $('#puinomi').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ1").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ1").style.display = 'none';
	}
	if (cmp !== 0)
	{
		return false;
	}
	
	else
	{
		return true;
	}
}


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

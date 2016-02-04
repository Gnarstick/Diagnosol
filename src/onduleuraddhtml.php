<!DOCTYPE html> <!--  -->
<html>
    <head>
        <meta charset="utf-8">
        <title>DiagnoSOL &bull; Ajouter un Onduleur</title>
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
                        <li><a href="panneaux.php">Panneaux</a></li>
                        <li  class="active"><a href="onduleur.php">Onduleurs</a></li>
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
                    <h1>Ajout d'un onduleur</h1>
                </div>
            </div>

 <div class="alert alert-danger" id="alert" role="alert" Style="display: none">
                <ul>
            <li id="champ1" Style="display: none">Le champ 'Constructeur' est requis et doit contenir un nom.</li>
            <li id="champ2" Style="display: none">Le champ 'Pays' est requis et doit contenir un nom.</li>
            <li id="champ3" Style="display: none">Le champ 'Nom de l'onduleur' est requis et doit contenir un nom.</li>
            <li id="champ4" Style="display: none">Le champ 'Puissance entrée max' (en W) est requis et doit contenir une valeur.</li>
			<li id="champ5" Style="display: none">Le champ 'Tension DC max' (en V) est requis et doit contenir une valeur</li>
			<li id="champ6" Style="display: none">Le champ 'Courant entrée max' (en A) est requis et doit contenir une valeur.</li>
			<li id="champ7" Style="display: none">Le champ 'Nombre de MPPT' est requis et doit contenir une valeur.</li>
			<li id="champ8" Style="display: none">Le champ 'Nombre max PV Strings' est requis et doit contenir une valeur.</li>
			<li id="champ9" Style="display: none">Le champ 'Puissance AC nominale' (en W) est requis et doit contenir une valeur.</li>
            <li id="champ10" Style="display: none">Le champ 'Puissance AC max' (en W) est requis et doit contenir une valeur.</li>
			<li id="champ11" Style="display: none">Le champ 'Courant sortie max' (en A) est requis et doit contenir une valeur.</li>
			<li id="champ12" Style="display: none">Le champ 'Rendement' est requis et doit contenir une valeur.</li>
			<li id="champ13" Style="display: none">Le champ 'Année' est requis et doit contenir une valeur.</li>
			<li id="champ14" Style="display: none">Le champ 'Prix' est requis et doit contenir une valeur.</li>
                    </ul>
            </div>


            <div class="row">
                <div class="col-sm-offset-1 col-sm-10">
                    <form class="form-horizontal marginLR" method="post" action="onduleuradd.php" onsubmit="return validateclick();"> 
                        <div class="form-group">
                            <legend>Paramétrage de l'onduleur</legend>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
			    
<!----------------------------------------------------------------------Onduleur parametre------------------------------------------------------------>

 <div>

                            <div id="divonduleurManufacturer" class="form-group" >
                                <div class="col-md-4">
                                    <label for="onduManufacturer" class="control-label">Constructeur : </label>
                                    <br>
                                    <span class="error help-block">1 à 20 caractères</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-7">
                                        <input id="onduManufacturer" type="text" name="onduleur_manufacturer" value="" class="form-control"/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good"></span>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer un nom de constructeur pour cet onduleur (entre 1 et 20 caractères)."
                                           title="<b>AIDE : Constructeur de l'onduleur</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>
                          
                          <div id="divOnduland" class="form-group">
                                <div class="col-md-4">
                                    <label for="OnduLand" class="control-label">Pays : </label>
                                    <br>
                                    <span class="error help-block">1 à 30 caractères</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-7">
                                        <input id="OnduLand" type="text" name="onduleur_land" value="" class="form-control"/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good"></span>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer un pays pour cet onduleur (entre 1 et 30 caractères)."
                                           title="<b>AIDE : Pays de l'onduleur</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>

                            <div id="divOnduName" class="form-group">
                                <div class="col-md-5">
                                    <label for="OnduName" class="control-label">Nom de l'onduleur : </label>
                                    <br>
                                    <span class="error help-block">De 1 à 50 caractères</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <input id="OnduName" type="text" name="onduleur_name" value="" class="form-control" placeholder=""/>
                                    <span class="glyphicon glyphicon-remove form-control-feedback error"></span>
                                    <span class="glyphicon glyphicon-ok form-control-feedback good"></span>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer le nom de l'onduleur (entre 1 et 50 caractères)."
                                           title="<b>AIDE : Nom de l'onduleur</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>
                          
                            <div id="divEnterMaxPower" class="form-group">
                                <div class="col-lg-5">
                                    <label for="entermaxpower" class="control-label">Puissance entrée max : </label>
                                    <br>
                                    <span class="error help-block">De 1 à 1 000 000 000 W</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="entermaxpower" type="text" name="oduleur_entermaxpower" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift4"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift4"></span>
                                        <span class="input-group-addon">W</span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer la puissance max en entrée de l'onduleur (de 1 à 1 000 000 000 W).<br><br>
                                           <i>Puissance maximale en sortie des modules photovoltaïque que peut recevoir l'onduleur.</i><br><br>
                                           <span class='decimalWarning'><span class='glyphicon glyphicon-warning-sign'></span>&nbsp; Entrer un point comme séparateur<br>décimal.</span>"
                                           title="<b>AIDE : Puissance max en entrée de l'onduleur</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>

                            <div id="divTensionmax" class="form-group">
                                <div class="col-lg-5">
                                    <label for="tensionmax" class="control-label">Tension DC max : </label>
                                    <br>
                                    <span class="error help-block">De 1 à 10 000 V</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="tensionmax" type="text" name="onduleur_tension" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift2"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift2"></span>
                                        <span class="input-group-addon">V</span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer la tension DC max (de 1 à 10 000 V).<br><br>
                                           <i>Correspond à la tension en sortie des modules photovoltaïques.</i><br><br>
                                           <span class='decimalWarning'><span class='glyphicon glyphicon-warning-sign'></span>&nbsp; Entrer un point comme séparateur<br>décimal.</span>"
                                           title="<b>AIDE : Tension DC max</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>

                            <div id="divCourantEntreMax" class="form-group">
                                <div class="col-lg-5">
                                    <label for="courantentremax" class="control-label">Courant entrée max :</label>
                                    <br>
                                    <span class="error help-block">De 1 à 10 000 A</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="courantentremax" type="text" name="onduleur_courantentremax" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift2"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift2"></span>
                                        <span class="input-group-addon">A</span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer le courant en entrée max (de 1 à 10 000 A).<br><br>
                                           <i>Courant maximal que peut supporter l'onduleur.</i><br><br>
                                           <span class='decimalWarning'><span class='glyphicon glyphicon-warning-sign'></span>&nbsp; Entrer un point comme séparateur<br>décimal.</span>"
                                           title="<b>AIDE : Courant entrée max</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>

                            <div id="divnbmppt" class="form-group">
                                <div class="col-lg-5">
                                    <label for="nbmppt" class="control-label">Nombre de MPPT : </label>
                                    <span class="error help-block">De 1 à 10</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="nbmppt" type="text" name="turbine_start_speed" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer le nombre de MPPT de l'onduleur (entre 1 et 10).<br><br>
                                           <i>Le nombre maximal de points de puissance d'une installation correspondant au couple courant-tension générant le maximum de puissance électrique.</i><br><br>
                                           <span class='decimalWarning'><span class='glyphicon glyphicon-warning-sign'></span>&nbsp; Entrer un point comme séparateur<br>décimal.</span>"
                                           title="<b>AIDE : nombre de MPPT</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>

                            <div id="divnbpvstring" class="form-group">
                                <div class="col-lg-5">
                                    <label for="nbpvstring" class="control-label" style="font-size:89%;">Nombre max de PV strings :</label>
                                    <span class="error help-block">De 1 à 20</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="nbpvstring" type="text" name="onduleur_nbpvstring" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer le nombre max de PV strings (entre 1 et 20).<br><br>
                                           <i>Nombre maximal de panneaux pouvant être placés en série pour cet onduleur.</i>"
                                           title="<b>AIDE : Nombre maximal de PV strings</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>

			    <div id="divacnominal" class="form-group">
                                <div class="col-lg-5">
                                    <label for="acnominal" class="control-label" style="font-size:90%;">Puissance AC nominale :</label>
                                    <span class="error help-block">De 1 à 1 000 000 000 W</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="acnominal" type="text" name="onduleur_acnominal" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
					<span class="input-group-addon">W</span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer la puissance AC nominale (entre 1 et 1 000 000 000 W).<br><br>
                                           <i>Puissance maximale que peut délivrer l'onduleur.</i>"
                                           title="<b>AIDE : Puissance AC nominale</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>

			    <div id="divacmax" class="form-group">
                                <div class="col-lg-5">
                                    <label for="acmax" class="control-label">Puissance AC max :</label>
                                    <span class="error help-block">De 1 à 1 000 000 000 W</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="acmax" type="text" name="onduleur_acmax" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
					<span class="input-group-addon">W</span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer la puissance AC max (entre 1 et 1 000 000 000 W).<br><br>
                                           <i>Puissance maximale que peut supporter l'onduleur.</i>"
                                           title="<b>AIDE : Puissance AC max</b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>

			<div id="divcourantsortimax" class="form-group">
                                <div class="col-lg-5">
                                    <label for="courantsortiemax" class="control-label">Courant sortie max :</label>
                                    <span class="error help-block">De 0 à 3000 A</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="courantsortiemax" type="text" name="onduleur_courantsortiemax" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
					<span class="input-group-addon">A</span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer le courant maximal en sortie (entre 1 et 10 000 A).<br><br>
                                           <i>Courant maximal délivré par l'onduleur.</i>"
                                           title="<b>AIDE : Courant maximal de sortie </b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>
                          
                      </div>

			<div id="divrendement" class="form-group">
                                <div class="col-lg-5">
                                    <label for="rendement" class="control-label">Rendement :</label>
                                    <span class="error help-block">De 0 à 100%</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="rendement" type="text" name="onduleur_rendement" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
										<span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer le rendement (entre 1 et 100).<br><br>
                                           <i>Performance réelle de l'onduleur.</i>"
                                           title="<b>AIDE : Rendement </b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
            </div>


			<div id="divanne" class="form-group">
                                <div class="col-lg-5">
                                    <label for="annee" class="control-label">Année :</label>
                                    <span class="error help-block">Format : XXXX</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="annee" type="text" name="onduleur_annee" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer l'année.<br><br>
                                           <i>Année de commercialisation de l'onduleur.</i>"
                                           title="<b>AIDE : Année </b>">
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
                                           data-content="Entrer le lien URL vers la fiche technique de l'onduleur.<br><br>"
                                           title="<b>AIDE : Lien </b>">
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>
                                    </div>
                                </div>
                            </div>

			<div id="divprix" class="form-group">
                                <div class="col-lg-5">
                                    <label for="prix" class="control-label">Prix  :</label>
                                    <span class="error help-block">De 1 à 10 000 €</span>
                                    <span class="good help-block"></span>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input id="prix" type="text" name="onduleur_prix" value="" class="form-control" placeholder=""/>
                                        <span class="glyphicon glyphicon-remove form-control-feedback error shift5"></span>
                                        <span class="glyphicon glyphicon-ok form-control-feedback good shift5"></span>
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <div class="pop">
                                        <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                           data-content="Entrer le prix TTC.<br><br>
                                           <i>Prix de l'onduleur.</i>"
                                           title="<b>AIDE : Prix </b>">
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

<!-------------------------------------------------------------------------JavaScript-------------------------------------------------------------->

<script type="text/javascript">

//generation of feedback icons for each input
$(function () {   

//generation of feedback icons for each input

        //input verification and feedback when the user modifies the manufacturer
        $('#onduManufacturer').keyup(function() {
            $('#divonduleurManufacturer').addClass('has-feedback');
            $('#onduManufacturer').val().length > 0 && $('#onduManufacturer').val().length <=20 ? $('#divonduleurManufacturer').addClass('has-success').removeClass('has-error') && $('#divonduleurManufacturer').find('.good').show() && $('#divonduleurManufacturer').find('.error').hide() : $('#divonduleurManufacturer').addClass('has-error').removeClass('has-success') && $('#divonduleurManufacturer').find('.error').show() && $('#divonduleurManufacturer').find('.good').hide();       
        });
	//input verification and feedback when the user modifies the country
        $('#OnduLand').keyup(function() {
            $('#divOnduland').addClass('has-feedback');
            $('#OnduLand').val().length > 0 && $('#OnduLand').val().length <=30 ? $('#divOnduland').addClass('has-success').removeClass('has-error') && $('#divOnduland').find('.good').show() && $('#divOnduland').find('.error').hide() : $('#divOnduland').addClass('has-error').removeClass('has-success') && $('#divOnduland').find('.error').show() && $('#divOnduland').find('.good').hide();       
        });
 //input verification and feedback when the user modifies the onduleur's name
        $('#OnduName').keyup(function() {
            $('#divOnduName').addClass('has-feedback');
            $('#OnduName').val().length > 0 && $('#OnduName').val().length <=30 ? $('#divOnduName').addClass('has-success').removeClass('has-error') && $('#divOnduName').find('.good').show() && $('#divOnduName').find('.error').hide() : $('#divOnduName').addClass('has-error').removeClass('has-success') && $('#divOnduName').find('.error').show() && $('#divOnduName').find('.good').hide();       
        });
        
        //input verification and feedback when the user modifies the max power
        $('#entermaxpower').keyup(function() {
            $('#divEnterMaxPower').addClass('has-feedback');
            $('#entermaxpower').val() > 0 && $('#entermaxpower').val() <=1000000000 && parseFloat($('#entermaxpower').val()) === parseInt($('#entermaxpower').val()) && $('#entermaxpower').val() !== '' ? $('#divEnterMaxPower').addClass('has-success').removeClass('has-error') && $('#divEnterMaxPower').find('.good').show() && $('#divEnterMaxPower').find('.error').hide() : $('#divEnterMaxPower').addClass('has-error').removeClass('has-success') && $('#divEnterMaxPower').find('.error').show() && $('#divEnterMaxPower').find('.good').hide();       
        });
        
        //input verification and feedback when the user modifies the DC max
        $('#tensionmax').keyup(function() {
            $('#divTensionmax').addClass('has-feedback');
            $('#tensionmax').val() > 0 && $('#tensionmax').val() <=10000 && $('#tensionmax').val() !== '' ? $('#divTensionmax').addClass('has-success').removeClass('has-error') && $('#divTensionmax').find('.good').show() && $('#divTensionmax').find('.error').hide() : $('#divTensionmax').addClass('has-error').removeClass('has-success') && $('#divTensionmax').find('.error').show() && $('#divTensionmax').find('.good').hide();       
        });
        
        //input verification and feedback when the user modifies the I max
        $('#courantentremax').keyup(function() {
            $('#divCourantEntreMax').addClass('has-feedback');
            $('#courantentremax').val() > 0 && $('#courantentremax').val() <=10000 && $('#courantentremax').val() !== '' ? $('#divCourantEntreMax').addClass('has-success').removeClass('has-error') && $('#divCourantEntreMax').find('.good').show() && $('#divCourantEntreMax').find('.error').hide() : $('#divCourantEntreMax').addClass('has-error').removeClass('has-success') && $('#divCourantEntreMax').find('.error').show() && $('#divCourantEntreMax').find('.good').hide();       
        });
        
        //input verification and feedback when the user modifies the number of MPPT: 
        $('#nbmppt').keyup(function() {
            $('#divnbmppt').addClass('has-feedback');
            $('#nbmppt').val() > 0 && $('#nbmppt').val() <=10 && $('#nbmppt').val() !== '' ? $('#divnbmppt').addClass('has-success').removeClass('has-error') && $('#divnbmppt').find('.good').show() && $('#divnbmppt').find('.error').hide() : $('#divnbmppt').addClass('has-error').removeClass('has-success') && $('#divnbmppt').find('.error').show() && $('#divnbmppt').find('.good').hide();       
        });
        
        //input verification and feedback when the user modifies the max of PV strings
        $('#nbpvstring').keyup(function() {
            $('#divnbpvstring').addClass('has-feedback');
            $('#nbpvstring').val() > 0 && $('#nbpvstring').val() <=20 && $('#nbpvstring').val() !== '' ? $('#divnbpvstring').addClass('has-success').removeClass('has-error') && $('#divnbpvstring').find('.good').show() && $('#divnbpvstring').find('.error').hide() : $('#divnbpvstring').addClass('has-error').removeClass('has-success') && $('#divnbpvstring').find('.error').show() && $('#divnbpvstring').find('.good').hide();       
        });
        
        //input verification and feedback when the user modifies the nominal AC
        $('#acnominal').keyup(function() {
        $('#divacnominal').addClass('has-feedback');
        $('#acnominal').val() >= 0 && $('#acnominal').val() <=1000000000 && $('#acnominal').val() !== '' ? $('#divacnominal').addClass('has-success').removeClass('has-error') && $('#divacnominal').find('.good').show() && $('#divacnominal').find('.error').hide() : $('#divacnominal').addClass('has-error').removeClass('has-success') && $('#divacnominal').find('.error').show() && $('#divacnominal').find('.good').hide();       
        });

	//input verification and feedback when the user modifies the nominal AC
        $('#acmax').keyup(function() {
        $('#divacmax').addClass('has-feedback');
        $('#acmax').val() >= 0 && $('#acmax').val() <=1000000000 && $('#acmax').val() !== '' ? $('#divacmax').addClass('has-success').removeClass('has-error') && $('#divacmax').find('.good').show() && $('#divacmax').find('.error').hide() : $('#divacmax').addClass('has-error').removeClass('has-success') && $('#divacmax').find('.error').show() && $('#divacmax').find('.good').hide();       
        });
	
	//input verification and feedback when the user modifies the Iout
        $('#courantsortiemax').keyup(function() {
        $('#divcourantsortimax').addClass('has-feedback');
        $('#courantsortiemax').val() >= 0 && $('#courantsortiemax').val() <= 3000 && $('#courantsortiemax').val() !== '' ? $('#divcourantsortimax').addClass('has-success').removeClass('has-error') && $('#divcourantsortimax').find('.good').show() && $('#divcourantsortimax').find('.error').hide() : $('#divcourantsortimax').addClass('has-error').removeClass('has-success') && $('#divcourantsortimax').find('.error').show() && $('#divcourantsortimax').find('.good').hide();       
        });

	//input verification and feedback when the user modifies the Iout
        $('#rendement').keyup(function() {
        $('#divrendement').addClass('has-feedback');
        $('#rendement').val() >= 0 && $('#rendement').val() <= 100 && $('#rendement').val() !== '' ? $('#divrendement').addClass('has-success').removeClass('has-error') && $('#divrendement').find('.good').show() && $('#divrendement').find('.error').hide() : $('#divrendement').addClass('has-error').removeClass('has-success') && $('#divrendement').find('.error').show() && $('#divrendement').find('.good').hide();       
        });
        
	//input verification and feedback when the user modifies the Iout
        $('#annee').keyup(function() {
        $('#divanne').addClass('has-feedback');
        $('#annee').val() >= 1950 && $('#annee').val() <=3000  && $('#annee').val() !== '' ? $('#divanne').addClass('has-success').removeClass('has-error') && $('#divanne').find('.good').show() && $('#divanne').find('.error').hide() : $('#divanne').addClass('has-error').removeClass('has-success') && $('#divanne').find('.error').show() && $('#divanne').find('.good').hide();       
        });
        
	//input verification and feedback when the user modifies the Iout
        $('#prix').keyup(function() {
        $('#divprix').addClass('has-feedback');
        $('#prix').val() >= 0 && $('#prix').val() <=10000  && $('#prix').val() !== '' ? $('#divprix').addClass('has-success').removeClass('has-error') && $('#divprix').find('.good').show() && $('#divprix').find('.error').hide() : $('#divprix').addClass('has-error').removeClass('has-success') && $('#divprix').find('.error').show() && $('#divprix').find('.good').hide();       
        });
        
        //
        $('form').on('focusout', "input[id*='power']", function() {
            $('#displayWindTable').addClass('has-feedback');
            var chart = $('#powerDistributionChart').highcharts();
            chart.series[0].update({
                data: []
            });
            for(var v=0;v < 31;v++){
                if($('#power'+v+'').val() >= 0 && $('#power'+v+'').val() <= parseInt($('#tensionmax').val()) && $('#power'+v+'').val() !== ''){
                    $('#displayWindTable').addClass('has-success').removeClass('has-error') && $('#displayWindTable').find('.good').show() && $('#displayWindTable').find('.error').hide();
                    chart.series[0].addPoint([v,parseFloat($('#power'+v+'').val())]); 
                }
                else {
                    $('#displayWindTable').addClass('has-error').removeClass('has-success') && $('#displayWindTable').find('.error').show() && $('#displayWindTable').find('.good').hide();
                    chart.series[0].update({
                        data: []
                    });
                    break;
                }
            }
        });
        
        
});


//popover
$(function (){
   $(".pop").popover(); 
});
// Contain the popover within the body NOT the element it was called in.
$('[data-toggle="popover"]').popover({
    container: 'body'
});

function validateclick()
{
	var cmp = 0;
	document.getElementById("alert").style.display = 'block';//
	if (!($('#prix').val() >= 0 && $('#prix').val() <=10000  && $('#prix').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ14").style.display = 'block';
	}
	else
	{
		document.getElementById("champ14").style.display = 'none';
	}
	if (!($('#annee').val() >= 1950 && $('#annee').val() <=3000  && $('#annee').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ13").style.display = 'block';
	}
	else
	{
		document.getElementById("champ13").style.display = 'none';
	}
	if (!( $('#rendement').val() >= 0 && $('#rendement').val() <= 100 && $('#rendement').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ12").style.display = 'block';
	}
	else
	{
		document.getElementById("champ12").style.display = 'none';
	}
	if (!($('#courantsortiemax').val() >= 0 && $('#courantsortiemax').val() <= 3000 && $('#courantsortiemax').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ11").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ11").style.display = 'none';
	}
	if (!($('#acmax').val() >= 0 && $('#acmax').val() <=1000000000 && $('#acmax').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ10").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ10").style.display = 'none';
	}
	if (!($('#acnominal').val() >= 0 && $('#acnominal').val() <=1000000000 && $('#acnominal').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ9").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ9").style.display = 'none';
	}
	if (!( $('#nbpvstring').val() > 0 && $('#nbpvstring').val() <=20 && $('#nbpvstring').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ8").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ8").style.display = 'none';
	}
	if (!($('#nbmppt').val() > 0 && $('#nbmppt').val() <=10 && $('#nbmppt').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ7").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ7").style.display = 'none';
	}
	if (!($('#courantentremax').val() > 0 && $('#courantentremax').val() <=10000 && $('#courantentremax').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ6").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ6").style.display = 'none';
	}
	if (!($('#tensionmax').val() > 0 && $('#tensionmax').val() <=10000 && $('#tensionmax').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ5").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ5").style.display = 'none';
	}
	if (!($('#entermaxpower').val() > 0 && $('#entermaxpower').val() <=1000000000 && parseFloat($('#entermaxpower').val()) === parseInt($('#entermaxpower').val()) && $('#entermaxpower').val() !== ''))
	{
		cmp = cmp + 1;
		document.getElementById("champ4").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ4").style.display = 'none';
	}
	if (!($('#OnduName').val().length > 0 && $('#OnduName').val().length <=30))
	{
		cmp = cmp + 1;
		document.getElementById("champ3").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ3").style.display = 'none';
	}
	if (!( $('#OnduLand').val().length > 0 && $('#OnduLand').val().length <=30))
	{
		cmp = cmp + 1;
		document.getElementById("champ2").style.display = 'block';//
	}
	else
	{
		document.getElementById("champ2").style.display = 'none';
	}
	if (!($('#onduManufacturer').val().length > 0 && $('#onduManufacturer').val().length <=20))
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

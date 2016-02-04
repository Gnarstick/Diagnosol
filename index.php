<!DOCTYPE html> <!--  -->
<html>
    <head>
        <meta charset="utf-8">
        <title>DiagnoSOL &bull; Accueil</title>
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
                    
                    <a href="index.php">
                        <img id="logoCALSIMEOL" src="../img/logo.jpg" alt="logo" /></a> 
                </div>
                
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Accueil</a></li>
                        <li><a href="/src/simulation.php">Simulation</a></li>
                        <li><a href="/src/site.php">Sites</a></li>
                        <li><a href="/src/panneaux.php">Panneaux</a></li>
                        <li><a href="/src/onduleur.php">Onduleurs</a></li>
                        <li><a href="/src/propos.php">A propos</a></li>
			<li><a href="/src/FAQ.php">F.A.Q</a></li></ul>
                        <ul class="nav navbar-nav navbar-right"><li><a <?php if($userlog == ""){echo "href=\"/src/connexionhtml.php\"";}else{echo "href=\"/src/connexion.php\"";}?> ><?php if($userlog == ""){echo "Connexion";}else{echo "Déconnexion";} ?></a></li>
                    </ul>
                </div><!--/.nav-collapse -->
                
              </div>
        </nav>
        <div class="container" style="padding-top:40px">
<!-- Homepage -->
<div class="row">
    <div class="clearness col-sm-12">
        <div class="row">
          
        <div class="row">
            <div class="col-sm-12">
                <img id="bigLogoCALSIMEOL" class="img-responsive" src="../img/groslogofondtransparent.png" alt="" />            </div>
        </div>
          
            <div class="col-sm-12 lead"  style="text-align: center; padding: 20px 15px"> 
                <p>DiagnoSOL est un logiciel de dimensionnement d'installation solaire photovoltaïque. Il permet de réaliser une estimation du coût d'installation et du retour sur investissement du projet.</p>
                <p> Il a été conçu pour répondre à un besoin pédagogique. Avec une ergonomie simple et comprenant une aide importante, ce logiciel permet de réaliser une étude tout en ayant toujours la possibilité de comprendre ce qui a été effectué.</p> </div>
        </div>

    </div>   
</div>

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

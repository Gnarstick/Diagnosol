<!DOCTYPE html> <!--  -->
<html>
    <head>
        <meta charset="utf-8">
        <title>DiagnoSOL &bull; &Agrave; propos</title>
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
                        <li><a href="onduleur.php">Onduleurs</a></li>
                        <li  class="active"><a href="propos.php">A propos</a></li>
						<li><a href="FAQ.php">F.A.Q</a></li></ul>
                        <ul class="nav navbar-nav navbar-right"><li><a href="connexionhtml.php"><?php if($userlog == ""){echo "Connexion";}else{echo "Déconnexion";} ?></a></li>
                    </ul>
                </div><!--/.nav-collapse -->
                
              </div>
        </nav>
        <div class="container" style="padding-top:40px">
<!-- Homepage -->
<!-- About page -->


<div class="container marge-top">
    <div class="row">
        <div class="clearness col-sm-12">
            
                <div class="row">
                    <div class="lead col-sm-12">
                        <h1><img src="../img/info.jpg" style="width:30px; margin-left:20px; margin-right: 20px"></img>A propos</h1>
                    </div>
                </div>
                <div class="text text-justify">
                    <p>
                    Le projet a été initialement étudié afin de répondre aux problématiques actuelles en matière d'écologie et de développement durable. Il a pour but de favoriser l'utilisation et la mise en place des énergies renouvelables afin de réduire la production par les énergies fossiles et donc de réduire les émissions de CO2.</p><br>

                    <p>Il est devenu nécessaire de passer à l'exploitation de sources d'énergie inépuisables telles que le vent ou le soleil. L'utilisation de combustibles fossiles pour la production d'énergie, qui sont épuisables et dangereux pour notre environnement, doit être réduite au maximum.</p><br>

                    <p>La production d'électricité par le biais d'énergie renouvelable permet d'augmenter l'efficacité énergétique des bâtiments et de réduire leur impact en termes de Gaz à Effet de Serre. D'après les normes de la réglementation thermique 2012, l'utilisation et la mise en place d'énergie renouvelable est devenu indispensable à la construction ou à la rénovation d'un bâtiment.</p><br>

                    <p> Le logiciel DiagnoSol a été développé afin de répondre aux besoins de dimensionnement et d'étude financière d'installations de production d’énergie solaire photovoltaïque. Pour se différencier des logiciels existants, un gros travail a été effectué afin de rendre notre application ergonomique, simple d'utilisation et lui donner un but pédagogique.</p><br>

		            <p>DiagnoSol s'inscrit dans le cadre du projet de fin d'études du cycle d'ingénieur de l'ECE Paris. Il a pour but de mettre en œuvre l'ensemble des connaissances acquises afin de réaliser un projet innovant en équipe. Notre projet prend la forme d'une contribution au logiciel libre.</p><br>

		            <p>Le logiciel DiagnoSOL a été développé par notre équipe qui se compose de :</p>
                </div>
                <ul>
                    <li>Younes MOUSSALI (<a href='mailto:younes.moussali@edu.ece.fr'>younes.moussali@edu.ece.fr</a>)</li>
                    <li>Damien BATTU (<a href='mailto:damien.battu@edu.ece.fr'>damien.battu@edu.ece.fr</a>)</li>
                    <li>Jean ANDRIEU (<a href='mailto:jean.andrieu@edu.ece.fr'>jean.andrieu@edu.ece.fr</a>)</li>
                    <li>Nicolas DE LOOF (<a href='mailto:nicolas.de-loof@edu.ece.fr'>nicolas.de-loof@edu.ece.fr</a>)</li>
                    <li>Mamoune CHERKAOUI (<a href='mailto:mamoune.cherkaoui@edu.ece.fr'>mamoune.cherkaoui@edu.ece.fr</a>)</li>
                    <li>Thomas MERIEUX (<a href='mailto:thomas.merieux@edu.ece.fr'>thomas.merieux@edu.ece.fr</a>)</li>
                </ul>
                
                <p class="about">
                    
                </p>

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

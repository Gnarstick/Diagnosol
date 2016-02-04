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
		<?php session_start();?>	
    </head>
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
                        <img id="logoCALSIMEOL" src="../img/logo.jpg" alt="logo" /></a> 
                </div>
                
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/">Accueil</a></li>
                        <li><a href="simulation.php">Simulation</a></li>
                        <li><a href="site.php">Sites</a></li>
                        <li><a href="panneaux.php">Panneaux</a></li>
                        <li><a href="onduleur.php">Onduleurs</a></li>
                        <li><a href="propos.php">A propos</a></li>
						<li><a href="FAQ.php">F.A.Q</a></li></ul>
                        <ul class="nav navbar-nav navbar-right"><li class="active"><a href="connexionhtml.php">Connexion</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
                
              </div>
        </nav>
        <div class="container" style="padding-top:40px">
<!-- Homepage -->
<div class="row">
    <div class="clearness col-sm-12">
        <h2><img src="../img/identification.jpg" style="width: 50px;margin-left: 20px;margin-right:20px;" ></img>Connexion utilisateur</h2>
        <div class="row">
			<div class="col-sm-offset-1 col-sm-10">
                <form class="form-horizontal marginLR" method="post" action="connexion.php" onsubmit="">
                    <div class="row">
						<div id="divnom" class="form-group" style="padding-top:20px;">
											<div class="col-md-2 col-md-offset-4">
                                                    <label for="name" class="control-label">Nom d'utilisateur : </label>
                                            </div>
											<div class="col-xs-2 -marginLR">
                                                    <div class="input-group">
                                                            <input id="name" type="text" name="place_name" class="form-control" placeholder=""/>
                                                    </div>
                                            </div>
						</div>
					</div>
					<div class="row">
						<div id="divmdp" class="form-group">
											<div class="col-md-2 col-md-offset-4">
                                                    <label for="mdp" class="control-label">Mot de passe : </label>
                                            </div>
											<div class="col-xs-2 -marginLR">
                                                    <div class="input-group">
                                                            <input id="mdp" type="password" name="place_mdp" class="form-control" placeholder=""/>
                                                    </div>
                                            </div>
						</div>
					</div>
					<div class="col-md-offset-5">
						<a href="inscriptionhtml.php" class="btn btn-primary" style="margin-left:10px;"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Inscription</a>
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Connexion</button>
                    </div>
				</form>
		    </div>   
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

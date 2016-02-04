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
                        <ul class="nav navbar-nav navbar-right"><li class="active"><a href="inscriptionhtml.php">Inscription</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
                
              </div>
        </nav>
        <div class="container" style="padding-top:40px">
<!-- Homepage -->
<div class="row">
    <div class="clearness col-sm-12">
        <h2><img src="../img/inscription.jpg" style="width: 50px;margin-left: 20px;margin-right:20px;" ></img>Inscription</h2>
        <div class="row">
			<div class="col-sm-offset-1 col-sm-10">
                <form class="form-horizontal marginLR" method="post" action="inscription.php" onsubmit="return validateclick();">
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
					<div class="row" style="display:<?php if((isset($_SESSION['Last']))&& ($_SESSION['Last'] == "inscri")){echo "inline"; $_SESSION['Last']="";}else{echo "none";} ?>;">
						<div class="col-md-2 col-md-offset-5">
							<p style="color:red;">Nom indisponible</p>
						</div>
					</div>
					<div class="row">
						<div id="divmail" class="form-group" style="padding-top:20px;">
											<div class="col-md-2 col-md-offset-4">
                                                    <label for="email" class="control-label">Adresse e-mail : </label>
                                            </div>
											<div class="col-xs-2 -marginLR">
                                                    <div class="input-group">
                                                            <input id="mail" type="email" name="place_mail" class="form-control" placeholder=""/>
                                                    </div>
                                            </div>
						</div>
					</div>
					<div class="row">
						<div id="divmdp" class="form-group" style="padding-top:20px;">
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
					<div id="divconfirmdp" class="form-group" style="padding-top:20px;padding-bottom:10px;">
											<div class="col-md-2 col-md-offset-4">
                                                    <label for="confirmdp" class="control-label">Confirmation : </label>
                                            </div>
											<div class="col-xs-2 -marginLR">
                                                    <div class="input-group">
                                                            <input id="confirmdp" type="password" name="place_mdpconfi" class="form-control" placeholder=""/>
                                                    </div>
                                            </div>
						</div>
					</div>
					<div class="col-md-offset-6">
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Inscription </button>
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

<!-------------------------------------------------------------------------JavaScript-------------------------------------------------------------->

<script type="text/javascript">

$(function () {   
	//input verification and feedback when the user modifies the manufacturer
        $('#name').keyup(function() {
            $('#divnom').addClass('has-feedback');
            $('#name').val().length > 0 && $('#name').val().length <=20 ? $('#divnom').addClass('has-success').removeClass('has-error') && $('#divnom').find('.good').show() && $('#divnom').find('.error').hide() : $('#divnom').addClass('has-error').removeClass('has-success') && $('#divnom').find('.error').show() && $('#divnom').find('.good').hide();       
        });
		$('#mail').keyup(function() {
            $('#divmail').addClass('has-feedback');
            $('#mail').val().length > 0 && $('#mail').val().length <=20 ? $('#divmail').addClass('has-success').removeClass('has-error') && $('#divmail').find('.good').show() && $('#divmail').find('.error').hide() : $('#divmail').addClass('has-error').removeClass('has-success') && $('#divmail').find('.error').show() && $('#divmail').find('.good').hide();       
        });
		$('#mdp').keyup(function() {
            $('#divmdp').addClass('has-feedback');
            $('#mdp').val().length > 0 && $('#mdp').val().length <=20 ? $('#divmdp').addClass('has-success').removeClass('has-error') && $('#divmdp').find('.good').show() && $('#divmdp').find('.error').hide() : $('#divmdp').addClass('has-error').removeClass('has-success') && $('#divmdp').find('.error').show() && $('#divmdpd').find('.good').hide();       
        });
		$('#confirmdp').keyup(function() {
            $('#divconfirmdp').addClass('has-feedback');
            $('#confirmdp').val() == $('#mdp').val() ? $('#divconfirmdp').addClass('has-success').removeClass('has-error') && $('#divconfirmdp').find('.good').show() && $('#divconfirmdp').find('.error').hide() : $('#divconfirmdp').addClass('has-error').removeClass('has-success') && $('#divconfirmdp').find('.error').show() && $('#divconfirmdpd').find('.good').hide();       
        });
});	
	
	
function validateclick()
{
	var cmp = 0;
	if (!($('#name').val().length > 0 && $('#name').val().length <=20))
	{
		cmp = cmp + 1;
	}
	if (!($('#mail').val().length > 0 && $('#mail').val().length <=20))
	{
		cmp = cmp + 1;
	}
	if (!($('#name').val().length > 0 && $('#name').val().length <=20))
	{
		cmp = cmp + 1;
	}
	if (!($('#confirmdp').val() == $('#mdp').val()))
	{
		cmp = cmp + 1;
	}
	if (cmp !== 0)
	{
		return false;
	}
	
	else
	{
		return true;
	}
};

</script>

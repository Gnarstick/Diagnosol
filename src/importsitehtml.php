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
                        <li  class="active"><a href="site.php">Sites</a></li>
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
<!-- List place -->

<div class="row">
    <div class="clearness col-sm-12">

        <div class="row">
            <div class="lead col-sm-12">
                <h1>Ajouter un site géographique</h1>
            </div>
        </div>
                
        <div class="row">
            <div class="col-sm-offset-1 col-sm-3">
               <!-- <a href="http://eolatlas.calsimeol.fr/" target="_blank"><img class="img-responsive" src="http://calsimeol.fr/assets/img/EolAtlas.png?1422891592" alt="" /></a> -->
            </div>
        </div>
                

        <div class="row" style="margin-top: 20px">
            <div class="col-sm-offset-1 col-sm-10">
                <form class="form-horizontal marginLR" method="post" action="importsite.php" onsubmit="return validateclick();">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <b>Coordonées géographiques</b>
                                    
                                    <a href="#pop" class="pop pull-right" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto" style="margin-top: 1px" title="<b>AIDE : Coordonées géographiques</b>"
                                       data-content="Veuillez entrer les valeurs de longitude et latitude de l'emplacement géographique du site de l'étude.<br><br>
                                       <i>Si vous n'avez qu'une adresse postale, vous trouverez un lien vers un site permettant la conversion en coordonnées GPS dans le FAQ.</i>"
                                       > 
                                        <span class="glyphicon glyphicon-question-sign"></span>
                                    </a>

                                </div>
                                <div class="panel-body">
                                    <br>
									<div id="divnom" class="form-group">
											<div class="col-md-4">
                                                    <label for="name" class="control-label">Nom : </label>
                                                    <br>
                                                    <span class="error help-block">Nom du site</span>
                                                    <span class="good help-block"></span>
                                            </div>
											<div class="col-xs-7 -marginLR">
                                                    <div class="input-group">
                                                            <input id="name" type="text" name="place_name" class="form-control" placeholder="Nom"/>
                                                            <span class="glyphicon glyphicon-remove form-control-feedback shift error"></span>
                                                            <span class="glyphicon glyphicon-ok form-control-feedback shift good"></span>
                                                    </div>
                                            </div>
											<div class="col-xs-1">
                                                    <div class="pop">
                                                            <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                                               data-content="Entrer la dénomination du site que vous voulez ajouter"
                                                               title="<b>AIDE : Nom du site</b>">
                                                                    <span class="glyphicon glyphicon-question-sign"></span>
                                                            </a>
                                                    </div>
                                            </div>
									</div>
                                    <div id="divLatitude" class="form-group">
                                            <div class="col-md-4">
                                                    <label for="latitude" class="control-label">Latitude : </label>
                                                    <br>
                                                    <span class="error help-block">Entre -90 et 90°</span>
                                                    <span class="good help-block"></span>
                                            </div>
                                            <div class="col-xs-7 -marginLR">
                                                    <div class="input-group">
                                                            <input id="latitude" type="text" name="place_latitude" class="form-control" placeholder="49.51"/>
                                                            <span class="glyphicon glyphicon-remove form-control-feedback shift error"></span>
                                                            <span class="glyphicon glyphicon-ok form-control-feedback shift good"></span>
                                                            <span class="input-group-addon">°</span>
                                                    </div>
                                            </div>
                                            <div class="col-xs-1">
                                                    <div class="pop">
                                                            <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                                               data-content="Entrer une valeur de latitude.
                                                               Elle doit être comprise entre -90° et 90°.<br><br>
                                                               <i>La latitude correspond au positionnement nord/sud d'un point et est représentée par une valeur angulaire. Elle varie entre 0° à l'équateur et +/- 90° aux pôles.</i>
                                                               <br><br><span class='decimalWarning'><span class='glyphicon glyphicon-warning-sign'></span>&nbsp; Entrer un point comme séparateur décimal.</span>"
                                                               title="<b>AIDE : Latitude du site</b>">
                                                                    <span class="glyphicon glyphicon-question-sign"></span>
                                                            </a>
                                                    </div>
                                            </div>
                                    </div>
                                    
                                    <div id="divLongitude" class="form-group">
                                            <div class="col-md-4">
                                                    <label for="longitude" class="control-label">Longitude : </label>
                                                    <br>
                                                    <span class="error help-block">Entre -180 et 180°</span>
                                                    <span class="good help-block"></span>
                                            </div>
                                            <div class="col-xs-7 -marginLR">
                                                    <div class="input-group">
                                                            <input id="longitude" type="text" name="place_longitude" class="form-control" placeholder="123.50"/>
                                                            <span class="glyphicon glyphicon-remove form-control-feedback shift error"></span>
                                                            <span class="glyphicon glyphicon-ok form-control-feedback shift good"></span>
                                                            <span class="input-group-addon">°</span>
                                                    </div>
                                            </div>
                                            <div class="col-xs-1">
                                                    <div class="pop">
                                                            <a href="#pop" class="pop" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="auto"
                                                               data-content="Entrer une valeur de longitude.
                                                               Elle doit être comprise entre -180° et 180°.<br><br>
                                                               <i>La longitude correspond au positionnement est/ouest d'un point et est représentée par une valeur angulaire. Elle varie entre 0° (méridien de Greenwich) et +/- 180°.</i>
                                                               <br><br><span class='decimalWarning'><span class='glyphicon glyphicon-warning-sign'></span>&nbsp; Entrer un point comme séparateur décimal.</span>"
                                                               title="<b>AIDE : Longitude du site</b>">
                                                                    <span class="glyphicon glyphicon-question-sign"></span>
                                                            </a>
                                                    </div>
                                            </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 20px">
                            <div align="center" id="googleMap" style="width:100%;height:400px"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp" type="text/javascript"></script>
    <script type="text/javascript">

var map, marker;

$(function () {
  var mapOptions={
  zoom: 5,
  center: new google.maps.LatLng(46.2276, 2.2137),
  mapTypeId: 'hybrid'
  };

  map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
  google.maps.event.addListener(map, 'click', function(event) {
      placeMarker(event.latLng);
    });
});

function placeMarker(location) {

  $('#latitude').val(location.lat());
  $('#divLatitude').addClass('has-feedback');
  $('#divLatitude').addClass('has-success').removeClass('has-error') && $('#divLatitude').find('.good').show() && $('#divLatitude').find('.error').hide();
  $('#longitude').val(location.lng());
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

function validateclick()
{
	return ($('#name').val().length > 0);
}

$(function () {
            //input verification and feedback when the user modifies the latitude
            $('#latitude').keyup(function() {
                $('#divLatitude').addClass('has-feedback');
                $('#latitude').val() >= -90 && $('#latitude').val() <=90 && $('#latitude').val() !== '' ? $('#divLatitude').addClass('has-success').removeClass('has-error') && $('#divLatitude').find('.good').show() && $('#divLatitude').find('.error').hide()  : $('#divLatitude').addClass('has-error').removeClass('has-success') && $('#divLatitude').find('.error').show() && $('#divLatitude').find('.good').hide();	 
            });
            
            //input verification and feedback when the user modifies the longitude
            $('#longitude').keyup(function() {
                $('#divLongitude').addClass('has-feedback');
                $('#longitude').val() >= -180 && $('#longitude').val() <=180 && $('#longitude').val() !== '' ? $('#divLongitude').addClass('has-success').removeClass('has-error') && $('#divLongitude').find('.good').show() && $('#divLongitude').find('.error').hide()  : $('#divLongitude').addClass('has-error').removeClass('has-success') && $('#divLongitude').find('.error').show() && $('#divLongitude').find('.good').hide();	 
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
    </body>
</html>

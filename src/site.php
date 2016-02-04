<!DOCTYPE html> <!--  -->
<html>
    <head>
        <meta charset="utf-8">
        <title>DiagnoSOL &bull; Site</title>
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

$search = "";

if (isset($_GET['search']) && ($_GET['search'] != ""))
{
	$search = " WHERE name LIKE \"%" . $_GET['search'] . "%\"";
}

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
                        <li class="active"><a href="site.php">Sites</a></li>
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
<!-- Homepage site -->

<div class="row">
    <div class="clearness col-sm-12">

        <div class="row">
            <div class="lead col-sm-12">
                <h1>Liste des sites géographiques</h1>
            </div>
        </div>

	<div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <form class="form-group" role="search">
                    <label for="namePlace" class="control-label">Rechercher un site : </label>
                    <div class="input-group">
					
                            <input id="namePlace" class="form-control" type="text" name="search" placeholder="Saisir un nom"/>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                            </span>
							<span class="input-group-btn">
                                <button class="btn btn-default" href="site.php"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            </span>
                    </div>
					
                </form>
				
            </div>
	</div>
		<div class="row">
          <div class="col-sm-offset-1 col-sm-5">
			<div class="table-responsive">
							<table class="table table-striped table-condensed">
                                    <tr>
                                            <th>Site</th>
                                    </tr>
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

												$sql = "SELECT * FROM site_relation WHERE owner='all'" . $search . "ORDER by name";
												
												if (isset($userlog))
												{
													$sql2 = "SELECT * FROM site_relation WHERE owner='$userlog'" . $search . "ORDER by name";
													$reponse2 = mysqli_query($conn, $sql2);
												}
												
												//test pour voir si les data sont add comme il faut
												$reponse = mysqli_query($conn, $sql);
												while($donnees = mysqli_fetch_array($reponse))
												{
												?>
												<tr style="color: green;">
													<td class="ville"><?php echo $donnees['name'];?></td>
													<td class="latitude" style="display:none;"><?php echo $donnees['latitude'];?></td>
													<td class="longitude" style="display:none;"><?php echo $donnees['longitude'];?></td>
												</tr>
												<?php
												} //fin de la boucle, le tableau contient toute la BDD
												while($donnees = mysqli_fetch_array($reponse2))
												{
												?>
												<tr style="color: orange;">
													<td class="ville"><?php echo $donnees['name'];?></td>
													<td class="latitude" style="display:none;"><?php echo $donnees['latitude'];?></td>
													<td class="longitude" style="display:none;"><?php echo $donnees['longitude'];?></td>
												</tr>
												<?php
												}
												session_write_close();
												?>
							</table>
			</div>
		  </div>
							<div class="col-sm-offset-1 col-sm-5">
								<div align="center" id="googleMap" style="width:100%;height:400px"></div>
							</div>
							</div>
							<div class="row">
            <div class="col-sm-offset-1 col-xs-4">
                    <a <?php if($userlog == ""){echo "href=\"connexionhtml.php\"";}else{echo "href=\"importsitehtml.php\"";}?> class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> &nbsp; Ajouter un site</a>
            </div>          
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

});

function placeMarker(location) 
{

  if(marker)
  { //on vÃ©rifie si le marqueur existe
    marker.setPosition(location); //on change sa position
  }
  else
  {
    marker = new google.maps.Marker({ //on crÃ©Ã© le marqueur
										position: location, 
										map: map
									});
  }
}    

$("tr").hover(function(){placeMarker(new google.maps.LatLng($(this).find(".latitude").html(),$(this).find(".longitude").html()))}, function(){});
   
//popover
$(function (){
   $(".pop").popover(); 
});
// Contain the popover within the body NOT the element it was called in.
$('[data-toggle="popover"]').popover({
    container: 'body'
});


</script>
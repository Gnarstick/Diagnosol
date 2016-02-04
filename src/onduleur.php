<!DOCTYPE html> <!--  -->
<html>
    <head>
        <meta charset="utf-8">
        <title>DiagnoSOL &bull; Liste Onduleurs</title>
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

//search method	
$search = "";

if (isset($_GET['search']) && ($_GET['search'] != ""))
{
	$search = " WHERE Nom LIKE \"%" . $_GET['search'] . "%\"";
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
                <h1>Liste des Onduleurs</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <form class="form-group" role="search">
                    <label for="nameTurbine" class="control-label">Rechercher un onduleur: </label>
                    <div class="input-group">
                            <input id="nameTurbine" class="form-control" type="text" name="search" placeholder="Saisir un nom" type="submit"/>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                            </span>
							<span class="input-group-btn">
                                <button class="btn btn-default" href="onduleur.php"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            </span>
                    </div>
                </form>
            </div>
        </div>
		
<!-- Affichage de la db -->
<?php
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

$sql = "SELECT * FROM onduleurs WHERE owner='all'" . $search;

//test pour voir si les data sont add comme il faut
$reponse = mysqli_query($conn, $sql);

if(isset($userlog))
{
	$sql2 = "SELECT * FROM onduleurs WHERE owner='$userlog'" . $search;
	$reponse2 = mysqli_query($conn, $sql2);
}

?><div class="row">
          <div class="col-sm-12">
<div class="table-responsive">
							<table class="table table-striped table-condensed" style="font-size:90%;">
                                    <tr>
                                            <th>Nom de l'onduleur</th>
                                            <th>Constructeur</th>
											<th>Pays</th>
											<th>Puissance entrée max (W)</th>
											<th>Tension DC max (V)</th>
											<th>Courant entrée max (A)</th>
											<th>Nombre de MPPT</th>
											<th>Nombre de PV Strings</th>
											<th>Puissance AC nominale (W)</th>
											<th>Puissance AC max (W)</th>
											<th>Courant sortie max (A)</th>
											<th>Rendement (%)</th>
											<th>Année</th>
											<th>Prix (€)</th>
											<th>Lien</th>
											<th>Action</th>
                                    </tr>
			<?php //On affiche les lignes du tableau une à une à l'aide d'une boucle
            while($donnees = mysqli_fetch_array($reponse))
            {
			
            ?>
                                    <tr>
										<td><?php echo $donnees['Nom'];?></td>
										<td><?php echo $donnees['Constructeur'];?></td>
										<td><?php echo $donnees['Pays'];?></td>
										<td><?php echo $donnees['Puissance_entree_max'];?></td>
										<td><?php echo $donnees['Tension_DC_max'];?></td>
										<td><?php echo $donnees['Courant_entree_max'];?></td>
										<td><?php echo $donnees['MPPT'];?></td>
										<td><?php echo $donnees['PV_string'];?></td>
										<td><?php echo $donnees['Puissance_AC_nominal'];?></td>
										<td><?php echo $donnees['Puissance_AC_Max'];?></td>
										<td><?php echo $donnees['Courant_sortie_max'];?></td>
										<td><?php echo $donnees['Rendement'];?></td>
										<td><?php echo $donnees['Annee'];?></td>
										<td><?php echo $donnees['Prix'];?></td>
										<td><a href="<?php echo $donnees['Lien'];?>" onclick="window.open(this.href); return false;" class="btn btn-xs btn-success" role="button" <?php if ($donnees['Lien'] == ""){echo "disabled=\"true\"";} ?>><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></td>
										<td><a href="" class="btn btn-xs btn-danger" role="button" disabled="true"><span class="glyphicon glyphicon-trash" aria-hidden="true"></td>
									</tr>
                            
 <?php
            } //fin de la boucle, le tableau contient toute la BDD
			while($donnees = mysqli_fetch_array($reponse2))
            {
			
            ?>
                                    <tr>
										<td><?php echo $donnees['Nom'];?></td>
										<td><?php echo $donnees['Constructeur'];?></td>
										<td><?php echo $donnees['Pays'];?></td>
										<td><?php echo $donnees['Puissance_entree_max'];?></td>
										<td><?php echo $donnees['Tension_DC_max'];?></td>
										<td><?php echo $donnees['Courant_entree_max'];?></td>
										<td><?php echo $donnees['MPPT'];?></td>
										<td><?php echo $donnees['PV_string'];?></td>
										<td><?php echo $donnees['Puissance_AC_nominal'];?></td>
										<td><?php echo $donnees['Puissance_AC_Max'];?></td>
										<td><?php echo $donnees['Courant_sortie_max'];?></td>
										<td><?php echo $donnees['Rendement'];?></td>
										<td><?php echo $donnees['Annee'];?></td>
										<td><?php echo $donnees['Prix'];?></td>
										<td><a href="<?php echo $donnees['Lien'];?>" onclick="window.open(this.href); return false;" class="btn btn-xs btn-success" role="button" <?php if ($donnees['Lien'] == ""){echo "disabled=\"true\"";} ?>><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></td>
										<td><a href="supprimeronduleur.php?Nom=<?php echo $donnees['Nom'];?>&Owner=<?php echo $donnees['owner'];?>" class="btn btn-xs btn-danger" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></td>
									</tr>
<?php
			}
			
			if ($userlog == "diagnosol-master")
			{
				$sql3 = "SELECT * FROM onduleurs WHERE owner!='all'";
				$reponse3 = mysqli_query($conn, $sql3);
				
			while($donnees = mysqli_fetch_array($reponse3))
            {
			
            ?>
                                    <tr>
										<td><?php echo $donnees['Nom'];?></td>
										<td><?php echo $donnees['Constructeur'];?></td>
										<td><?php echo $donnees['Pays'];?></td>
										<td><?php echo $donnees['Puissance_entree_max'];?></td>
										<td><?php echo $donnees['Tension_DC_max'];?></td>
										<td><?php echo $donnees['Courant_entree_max'];?></td>
										<td><?php echo $donnees['MPPT'];?></td>
										<td><?php echo $donnees['PV_string'];?></td>
										<td><?php echo $donnees['Puissance_AC_nominal'];?></td>
										<td><?php echo $donnees['Puissance_AC_Max'];?></td>
										<td><?php echo $donnees['Courant_sortie_max'];?></td>
										<td><?php echo $donnees['Rendement'];?></td>
										<td><?php echo $donnees['Annee'];?></td>
										<td><?php echo $donnees['Prix'];?></td>
										<td><a href="<?php echo $donnees['Lien'];?>" onclick="window.open(this.href); return false;" class="btn btn-xs btn-success" role="button" <?php if ($donnees['Lien'] == ""){echo "disabled=\"true\"";} ?>><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></td>
										<td><a href="updateonduleur.php?Nom=<?php echo $donnees['Nom'];?>&Owner=<?php echo $donnees['owner'];?>" class="btn btn-xs btn-warning" role="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></td>
									</tr>
<?php
			}
			}
            ?>
 </table>
 </div>
           </div>
        </div>
<!-- button and interface -->
 
      <div class="row">
            <div class="col-sm-offset-1 col-xs-4">
                    <a <?php if($userlog == ""){echo "href=\"connexionhtml.php\"";}else{echo "href=\"onduleuraddhtml.php\"";}?> class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> &nbsp; Ajouter un onduleur</a>
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

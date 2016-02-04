<!DOCTYPE html> <!--  -->
<html>
    <head>
        <meta charset="utf-8">
        <title>DiagnoSOL &bull; FAQ</title>
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
                        <li><a href="propos.php">A propos</a></li>
                        <li class="active"><a href="FAQ.php">F.A.Q</a></li></ul>
                        <ul class="nav navbar-nav navbar-right"><li><a href="connexionhtml.php"><?php if($userlog == ""){echo "Connexion";}else{echo "Déconnexion";} ?></a></li>
                    </ul>
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
            <div class="text" style="text-align: center; padding: 20px 15px; color: #BB0B0B;">
                <img src="../img/faqlogo.jpg" class="img-responsive center-block"></img>
                <p style="padding-top: 20px;">Afin de vous aider dans la réalisation de votre projet, vous trouverez ici les réponses aux questions les plus communes. Cliquez sur la partie qui vous intéresse et vous accèderez aux questions. Ensuite, cliquez sur la question pour accéder à la réponse.</p>
        </div>
          
            <div class="text text-justify"  style="color: black; padding: 10px 50px"> 
                
                <div class="index1" style="cursor: pointer; text-align: center;"><p> <b><u>Partie 1:</u> Comment réaliser une simulation ?</b></p></div>
                
                <div class="repindex1" style="display: none;">
                <div class="question1"><p style="cursor: pointer; color: #1E7FCB; padding-top: 20px;"><u><b>Comment choisir un emplacement géographique pour mon projet ?</b></u></p></div>
                <div class="reponse1" style="display: none;"><p>Dans la page "Simulation", vous pouvez <u>selectionner un site</u> dans le menu déroulant. </p>
                    <p>Si le site que vous souhaiter étudier <u>n'est pas dans la liste</u>, vous avez la possibilité de l'ajouter. Pour cela référez vous à la rubrique "ajouter un emplacement géographique d'un site" dans le FAQ.</p></div>

                <div class="question2"><p style="cursor: pointer; color: #1E7FCB;"><u><b>Comment convertir une adresse postale en coordonnées GPS ?</b></u></p></div>
                <div class="reponse2" style="display: none;"><p>Lors de l'ajout d'un emplacement géographique pour votre étude, vous devez entrer <u>les coordonnées GPS</u> du site.</p>
                <p>Si vous ne disposez que de l'adresse postale du site, vous devez les convertir en coordonnées GPS. Pour cela rendez-vous sur le site suivant: <a href="http://www.gpsfrance.net/adresse-vers-coordonnees-gps#" onclick="window.open(this.href); return false;">Convertisseur</a>.</p></div>
                
                <div class="question3"><p style="cursor: pointer; color: #1E7FCB;"><u><b>Comment choisir le panneau solaire photovoltaïque adapté à mon projet ?</b></u></p></div>
                <div class="reponse3" style="display: none;"><p>Pour réaliser une étude de projet personnalisée, il faut tout d’abord choisir <u>le type de panneau solaire photovoltaïque</u> que vous voulez installer.</p>
                <p>Sur la page « Panneaux » vous pouvez observer les <u>caractéristiques des panneaux</u> standards prédéfinis : 
                    <ul><li>puissance nominale</li>
                    <li>tension nominale</li>
                    <li>courant nominal</li> 
                    <li>tension en circuit-ouvert</li> 
                    <li>courant en court-circuit</li> 
                    <li>rendement</li> 
                    <li>NOCT (température nominale d’utilisation des cellules)</li>
                    <li>coefficient de température</li> 
                    <li>année de commercialisation</li>
                    <li>longueur</li> 
                    <li>largeur</li> 
                    <li>prix du module</li></ul></p>
                    <p>En cliquant sur le lien, vous pouvez télécharger la fiche technique du constructeur pour obtenir plus d’informations sur le panneau.</p></div>
                
                <div class="question4"><p style="cursor: pointer; color: #1E7FCB;"><u><b>Le panneau que je souhaite installer n’est pas dans la liste, que dois-je faire ?</b></u></p></div>
                <div class="reponse4" style="display: none;"><p>Si vous avez déjà choisi le modèle de panneau que vous voulez installé et qu’il n’apparaît pas dans la liste prédéfinie, vous avez la possibilité de l’ajouter.
                Pour cela, réferez-vous à <u>la partie 2 du FAQ "ajouter un panneau solaire photovoltaïque"</u>.
                </p></div>

                <div class="question5"><p style="cursor: pointer; color: #1E7FCB;"><u><b>Comment choisir l’onduleur adapté à mon projet ?</b></u></p></div>
                <div class="reponse5" style="display: none;"><p>Le <u>choix de l’onduleur</u> se fait à partir du nombre de panneaux installés et de la puissance de cette installation.</p> 
                <p>Dans le cas où vous ne savez pas quel onduleur choisir, l’option <u>« sélection automatique »</u> vous permet de faire la simulation en estimant le coût des onduleurs à installer.</p></div>

                <div class="question6"><p style="cursor: pointer; color: #1E7FCB;"><u><b>Comment définir l’orientation et l’inclinaison de mes panneaux ?</b></u></p></div>
                <div class="reponse6" style="display: none;"><p>En France, pour obtenir le <u>meilleur rendement possible</u>, l’inclinaison optimale de vos panneaux solaires est de 30° avec une orientation plein sud.</p>
                <p>Dans le cas où vous voulez <u>intégrer vos panneaux solaires au bâti</u> (en toiture), il suffit de mesurer l’inclinaison de votre toiture et d’observer l’orientation de celle-ci.</p></div>

                <div class="question7"><p style="cursor: pointer; color: #1E7FCB;"><u><b>Comment choisir le type d’intégration des panneaux solaires?</b></u></p></div>
                <div class="reponse7" style="display: none;"><p>Il existe <u>3 types d’intégration des panneaux solaires</u> :
                <ul><li>Intégré Au Bâti (IAB)</li>
                <li>Intégré Simplifié au Bâti (ISB)</li>
                <li>Autre (au sol ou en toiture-terrasse)</li></p></ul>
                <p><u>IAB :</u> les modules sont intégrés au bâti et se substituent aux éléments de construction (tuiles, toitures,etc.). Pour des constructions neuves, la rentabilité du projet est accrue du fait que l’on soustrait le coûts des matériaux non-installés.</p>
                <p><u>ISB :</u> Les modules sont incorporés à la toiture du bâtiment mais ne se substituent pas aux éléments de la toiture. L'étanchéité de la toiture est assurée par l'association des panneaux solaires et d'un composant isolant / étanche.</p>
                <p><u>Autres :</u> Les panneaux solaires sont posés au sol. Il faut prendre en compte l’espacement entre les panneaux pour limiter les zones d’ombrages.
                Dans ce cas, si vous entrez une valeur de surface, vous définissez la surface de panneaux que vous voulez installer et non pas la surface au sol.</p></div>

                <div class="question8"><p style="cursor: pointer; color: #1E7FCB;"><u><b>A quoi correspond la « marge » sur le coût ?</b></u></p></div>
                <div class="reponse8" style="display: none;"><p>Lorsque vous effectuez un devis pour l’installation des panneaux solaires phovoltaïques que vous avez choisi d’étudier dans votre projet, les installateurs appliquent <u>un pourcentage de marge</u> pour tout le matériel installé.</p>
                <p>Pour avoir un <u>retour sur investissement plus réaliste</u>, vous pourrez jouer avec cette valeur « marge ».</p></div>

                <div class="question9"><p style="cursor: pointer; color: #1E7FCB;"><u><b>Comment choisir la valeur restrictive de mon projet dans « entrées utilisateur »?</b></u></p></div>
                <div class="reponse9" style="display: none;"><p>Dans cette section, vous disposez de <u>3 choix</u> :
                <ul><li>Surface en m<sup>2</sup></li>
                <li>Puissance nominale en kW</li>
                <li>Prix en €</li></p></ul>
                <p>L’étude se fait à partir de l’un de ces trois critères. Vous devez donc définir la valeur la plus restrictive de votre projet.</p>
                <p>Soit vous disposez d’un terrain d’une surface connue et que vous voulez savoir l’installation maximum en fonction du type de panneau choisi, entrez la valeur de cette surface dans « entrées utilisateur » et cliquez sur « lancer la simulation ».</p>
                <p>Soit vous connaissez la puissance de l’installation que vous voulez réaliser, il vous suffit dans ce cas d’entrer la valeur de cette puissance dans « données utilisateur » et de cliquer sur « lancer la simulation ».</p>
                <p>Soit vous avez un budget limité et il vous suffit donc de d'entrer le prix maximal de l'installation que vous avez défini dans "données utilisateur" puis cliquez sur le bouton "lancer la simulation".</p></div>

                <div class="question10"><p style="cursor: pointer; color: #1E7FCB;"><u><b>Comment savoir à quel prix l’électricité produite par mon installation sera achetée par EDF ?</b></u></p></div>
                <div class="reponse10" style="display: none;"><p>Ce prix varie en fonction du <u>type d’intégration</u> choisi par l’utilisateur mais aussi de la <u>puissance de l’installation</u>. Le Ministère de l'Ecologie, du Développement Durable et de l'Energie a établi le tableau suivant concernant les demandes effectuées en 2015 :</p>
                <p><img src="../img/tarifachat.jpg" class="img-responsive center-block"></p>
                <p>Pour avoir un calcul juste, il faut <u>mettre à jour ce tarif</u> dans le code source ...</p>
                <p>Lien vers la page officielle du <u>tarif d’achat</u> :
                <a href="http://www.developpement-durable.gouv.fr/Quels-sont-les-tarifs-d-achats.html" onclick="window.open(this.href); return false;">http://www.developpement-durable.gouv.fr</a></p></div></div>

                <div class="index2" style="cursor: pointer; text-align: center;"><p> <b><u>Partie 2:</u> Comment ajouter des sites/panneaux/onduleurs ?</b></p></div>
                <div class="repindex2" style="display: none;">

                     <div class="question11"><p style="cursor: pointer; color: #1E7FCB; padding-top: 20px;"><u><b>Connexion / Inscription</b></u></p></div>
                    <div class="reponse11" style="display: none;">
                        <p>Pour effectuer l'étude d'un projet, vous n'êtes pas obligés de vous identifier. Vous ne pourrez alors utiliser que les bases de données qui ont été prédéfinies.</p>
                        <p>Si vous voulez pouvoir ajouter vos propres panneaux, onduleurs et/ou un emplacement géographique, vous êtes obligés de créer un compte et de vous identifier.
                            Pour cela, cliquez sur la page "connexion" dans le menu. Cliquez ensuite sur le bouton "inscription" si cela n'a pas déjà été fait. 
                            Vous devez alors renseigner votre nom d'utilisateur, un mot de passe et une adresse e-mail.</p>
                        <p>Enfin, vous pouvez maintenant vous connecter à votre compte en entrant un nom d'utilisateur et un mot de passe.
                            Vous pouvez maintenant ajouter des panneaux, des onduleurs et des sites géographiques dans les pages correspondantes comme expliqué ci-dessous.
                        </p>
                    </div>

                    <div class="question12"><p style="cursor: pointer; color: #1E7FCB;"><u><b>Ajouter le site géographique du projet</b></u></p></div>
                    <div class="reponse12" style="display: none;"><p>Dans le menu, cliquez sur la page "Sites".
                        <p>Puis cliquez sur le bouton "ajouter un site" en bas de cette page.</p>
                        <p>Vous êtes alors redirigé sur la page "Ajouter un emplacement géographique".</p>
                       <p> Si vous avez les coordonnées GPS (latitude et longitude) du site, il vous suffit de les entrées dans les cases correspondantes et de nommé votre site. </p>
                        <p>Dans le cas contraire, c'est-à-dire si vous ne disposez que de l'adresse postale, vous pourrez la convertir en coordonnées GPS sur le site suivant: <a href="http://www.gpsfrance.net/adresse-vers-coordonnees-gps#" onclick="window.open(this.href); return false;">Convertisseur</a>.</p>
                    </p></div>

                    <div class="question13"><p style="cursor: pointer; color: #1E7FCB;"><u><b>Ajouter un panneau solaire photovoltaïque</b></u></p></div>
                    <div class="reponse13" style="display: none;"><p>Dans le menu, cliquez sur la page "Panneaux".
                        Puis cliquez sur le bouton "ajouter un panneau solaire" en bas de la page.</p>
                        <p>Afin d'ajouter correctement un panneau, il vous faut la fiche technique du constructeur.
                           Entrez les différents paramètres du panneau : 
                           <ul><li>Puissance nominale</li>
                            <li>Tension nominale</li>
                            <li>Courant nominal</li>
                            <li>Tension circuit-ouvert</li>
                            <li>Courant court-circuit</li>
                            <li>Rendement</li>
                            <li>NOCT</li>
                            <li>Coefficient de température</li>
                            <li>Année</li>
                            <li>Longueur</li>
                            <li>Largeur</li>
                            <li>Prix</li></ul>
                           Pour finir, cliquez sur le bouton "valider".</p>
                           <p>Le panneau que vous avez entré s'ajoute en bas de la liste. Il est ajouté à la base de données locale de votre session. Vous pouvez maintenant effectuer une étude avec le nouveau panneau.</p></div>

                    <div class="question14"><p style="cursor: pointer; color: #1E7FCB;"><u><b>Ajouter un onduleur</b></u></p></div>
                    <div class="reponse14" style="display: none;"><p>Dans le menu, cliquez sur la page "Onduleurs".
                        Puis cliquez sur le bouton "ajouter un onduleur" en bas de la page.</p>
                        <p>Afin d'ajouter correctement un onduleur, il vous faut la fiche technique du constructeur.
                        Entrez les différents paramètres de l'onduleur : 
                           <ul><li>Nom du constructeur</li>
                            <li>Pays</li>
                            <li>Désignation de l'onduleur</li>
                            <li>Puissance entrée max</li>
                            <li>Tension max courant continu (DC)</li>
                            <li>Courant entrée max</li>
                            <li>Nombre de MPPT (Maximum Power Point Tracking)</li>
                            <li>Nombre max PV string</li>
                            <li>Puissance nominale courant alternatif (AC)</li>
                            <li>Puissance max courant alternatif (AC)</li>
                            <li>Courant max de sortie</li>
                            <li>Rendement</li>
                            <li>Année</li>
                            <li>Prix</li></ul>
                           Pour finir, cliquez sur le bouton "valider".</p>
                           <p>L'onduleur que vous avez entré s'ajoute en bas de la liste. Il est ajouté à la base de données locale de votre session. Vous pouvez maintenant effectuer une étude avec le nouvel onduleur.</p></div>
                </div>
                
                <div class="index3" style="cursor: pointer; text-align: center;"><p> <b><u>Partie 3:</u> Comment accéder au code source ?</b></p></div>
                <div class="repindex3" style="display: none;"></div>

                <div class="index4" style="cursor: pointer; text-align: center;"><p> <b><u>Partie 4:</u> Guide utilisateur</b></p></div>
                <div class="repindex4" style="display: none; margin-left: 400px"><a href="../userguide.pdf" onclick="window.open(this.href); return false;">>>Télécharger le guide utilisateur ici<<</a></div>
            </div>
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
                            &nbsp;Le code source de ce site, ainsi que les données utilisées&nbsp;<br>&nbsp;et les résultats, sont sous licence CC-NY-NC 3.0.&nbsp;<br>
                            <a href="http://creativecommons.org/licenses/by-nc/3.0/" target="_blank"><img id="logoECE" class="img-responsive" src="../img/by-nc.eu_petit.png" alt="" /></a>
                        </span>
                    </div>
                </footer>
</div>

<script type="text/javascript">
    $(function () {
        $('.index1').click(function() {
                    $('.repindex1').css('display') === 'none' ? $('.repindex1').css({'display': 'inline'}) : $('.repindex1').css({'display': 'none'})});
        $('.index2').click(function() {
                    $('.repindex2').css('display') === 'none' ? $('.repindex2').css({'display': 'inline'}) : $('.repindex2').css({'display': 'none'})});
        $('.index3').click(function() {
                    $('.repindex3').css('display') === 'none' ? $('.repindex3').css({'display': 'inline'}) : $('.repindex3').css({'display': 'none'})});
        $('.index4').click(function() {
                    $('.repindex4').css('display') === 'none' ? $('.repindex4').css({'display': 'inline'}) : $('.repindex4').css({'display': 'none'})});
                    
        $('.question1').click(function() {
                    $('.reponse1').css('display') === 'none' ? $('.reponse1').css({'display': 'inline'}) : $('.reponse1').css({'display': 'none'})});
        $('.question2').click(function() {
                    $('.reponse2').css('display') === 'none' ? $('.reponse2').css({'display': 'inline'}) : $('.reponse2').css({'display': 'none'})});
        $('.question3').click(function() {
                    $('.reponse3').css('display') === 'none' ? $('.reponse3').css({'display': 'inline'}) : $('.reponse3').css({'display': 'none'})});
        $('.question4').click(function() {
                    $('.reponse4').css('display') === 'none' ? $('.reponse4').css({'display': 'inline'}) : $('.reponse4').css({'display': 'none'})});
        $('.question5').click(function() {
                    $('.reponse5').css('display') === 'none' ? $('.reponse5').css({'display': 'inline'}) : $('.reponse5').css({'display': 'none'})});
        $('.question6').click(function() {
                    $('.reponse6').css('display') === 'none' ? $('.reponse6').css({'display': 'inline'}) : $('.reponse6').css({'display': 'none'})});
        $('.question7').click(function() {
                    $('.reponse7').css('display') === 'none' ? $('.reponse7').css({'display': 'inline'}) : $('.reponse7').css({'display': 'none'})});
        $('.question8').click(function() {
                    $('.reponse8').css('display') === 'none' ? $('.reponse8').css({'display': 'inline'}) : $('.reponse8').css({'display': 'none'})});
        $('.question9').click(function() {
                    $('.reponse9').css('display') === 'none' ? $('.reponse9').css({'display': 'inline'}) : $('.reponse9').css({'display': 'none'})});
        $('.question10').click(function() {
                    $('.reponse10').css('display') === 'none' ? $('.reponse10').css({'display': 'inline'}) : $('.reponse10').css({'display': 'none'})});
        $('.question11').click(function() {
                    $('.reponse11').css('display') === 'none' ? $('.reponse11').css({'display': 'inline'}) : $('.reponse11').css({'display': 'none'})});
        $('.question12').click(function() {
                    $('.reponse12').css('display') === 'none' ? $('.reponse12').css({'display': 'inline'}) : $('.reponse12').css({'display': 'none'})});
        $('.question13').click(function() {
                    $('.reponse13').css('display') === 'none' ? $('.reponse13').css({'display': 'inline'}) : $('.reponse13').css({'display': 'none'})});
        $('.question14').click(function() {
                    $('.reponse14').css('display') === 'none' ? $('.reponse14').css({'display': 'inline'}) : $('.reponse14').css({'display': 'none'})});
});

</script>

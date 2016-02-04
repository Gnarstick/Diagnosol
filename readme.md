READ ME GITHUB corrigé

Ce projet a été développé par une équipe d’étudiants de l’école d’ingénieurs ECE Paris.
Nous utilisons bootstrap, Jquery et Hightcharts pour faire fonctionner notre logiciel.

Le site internet renvoie les pages de code suivantes :
•	accueil du site : diagnosol.php
•	page « Simulation » : simulation.php
•	page « Résultat de la simulation » : simulationresult.php
•	page « Sites » : sites.php
•	page « Ajout d’un site » : importsitehtml.php et importsite.php
•	page «  Panneaux » : panneaux.php
•	page « Ajout d’un panneau » : panneauaddhtml.php et panneauadd.php
•	page « Onduleurs » : onduleur.php
•	page « Ajout d’un onduleur » : onduleuraddhtml.php et onduleuradd.php
•	page « A propos » : propos.php
•	page « F.A.Q. » : FAQ.php
•	page « connexion » : connexionhtml.php et connexion.php
•	page « inscription » : inscriptionhtml.php et inscription.php

Nos algorithmes utilisent une base de données contenant les tables suivantes :
•	« Panneaux » -> [ Nom, Puissance_nominale_Pmpp, Tension_nominale_Vmpp, Courant_nominal_Vmpp, Tension_circuit_ouvert_Voc, Courant_court_circuit_Isc, Rendement, NOCT, Coefficient_Temp_Pmpp, Annee, Longueur, Largeur, Prix, Lien ]

•	« Onduleurs » -> [ MPPT, PV_string, Nom, Pays, Constructeur, Puissance_entree_max, Tension_DC_max, Courant_entree_max, Puissance_AC_nominal, Puissance_AC_max, Courant_sortie_max, Rendement, Annee, Prix, Lien ]

•	« site_relation » -> [ name, latitude, longitude, station, owner ]

•	« meteo » -> [ Ville, Year, Month, Day, Time, Irradiation, Temperature ]

•	« station » -> [ Nom, Latitude, Longitude ]

•	« users » -> [ id, username, password, email, profile_fields, group, last_login, login_hash, created_at, updated_at ]

Ce projet est sous la licence GNU suivante : CC-BY-NC 3.0. 
(http://creativecommons.org/licenses/by-nc/3.0/)

Pour tout renseignement complémentaire, veuillez contacter l’administrateur du site : M. Philippe HAIK (haik@ece.fr) 

-----------------------------------------------------------------------------------------------------------------This project was developped by students from ECE Engineering School in Paris.
We have used bootstrap, Jquery and Highcharts to run our software.

The website references the following code pages : 
•	Homepage : diagnosol.php
•	« Simulation » page : simulation.php
•	« Résultat de la simulation » page : simulationresult.php
•	« Sites » page : sites.php
•	« Ajout d’un site » page : importsitehtml.php et importsite.php
•	«  Panneaux » page : panneaux.php
•	« Ajout d’un panneau » page : panneauaddhtml.php et panneauadd.php
•	« Onduleurs » page : onduleur.php
•	« Ajout d’un onduleur » page : onduleuraddhtml.php et onduleuradd.php
•	« A propos » page : propos.php
•	« F.A.Q. » page : FAQ.php
•	« connexion » page : connexionhtml.php et connexion.php
•	« inscription » page : inscriptionhtml.php et inscription.php

Our algorithms uses database which contains the following tables :
•	« Panneaux » -> [ Nom, Puissance_nominale_Pmpp, Tension_nominale_Vmpp, Courant_nominal_Vmpp, Tension_circuit_ouvert_Voc, Courant_court_circuit_Isc, Rendement, NOCT, Coefficient_Temp_Pmpp, Annee, Longueur, Largeur, Prix, Lien ]

•	« Onduleurs » -> [ MPPT, PV_string, Nom, Pays, Constructeur, Puissance_entree_max, Tension_DC_max, Courant_entree_max, Puissance_AC_nominal, Puissance_AC_max, Courant_sortie_max, Rendement, Annee, Prix, Lien ]

•	« site_relation » -> [ name, latitude, longitude, station, owner ]

•	« meteo » -> [ Ville, Year, Month, Day, Time, Irradiation, Temperature ]

•	« station » -> [ Nom, Latitude, Longitude ]

•	« users » -> [ id, username, password, email, profile_fields, group, last_login, login_hash, created_at, updated_at ]

This project falls under the GNU licence CC-BY-NC 3.0. 
(http://creativecommons.org/licenses/by-nc/3.0/)

For more information please contact the administrator of the website : Mr Philippe HAIK (haik@ece.fr)


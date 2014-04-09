
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr_FR" xml:lang="fr_FR">
<head>
<meta name="mssmarttagspreventparsing" content="true" />
		<link rel="stylesheet"  href="/Departement_Gi/css/style.css" />
		<link rel="stylesheet" href="/Departement_Gi/css/index.css" />
        <link rel="stylesheet" type="text/css" href="Slicebox/Slicebox/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="Slicebox/Slicebox/css/slicebox.css" />
		<link rel="stylesheet" type="text/css" href="Slicebox/Slicebox/css/custom.css" />
		<script type="text/javascript" src="js/modernizr.custom.46884.js"></script>
</head>
<body>
<div id="page">
<div id="barre">
<div id="compte_barre">
<div id="mini_barre">
</div>
<div id="menu_compte">
<?php
session_start();
include("fonctions.php");
if(isset($_SESSION["Cne"])){ 
$Nom=GET_USER_INFO($_SESSION["Cne"],"Nom");
$Prenom=GET_USER_INFO($_SESSION["Cne"],"Prenom");
echo "<pre>
                

				
".$Nom."  ".$Prenom;

  echo "<u><a href='/Departement_Gi/account/Espace_Etudiant'><font color='white'>Espace Etudiant</font></a></u> <u><a href='/Departement_Gi/Deconnexion.php'><input type='button' value='Déconnexion' /></a></u></pre>";
 }else if(isset($_SESSION["administrateur"])){
 echo "<pre>
 
 
 ADMINISTRATEUR";
echo "
 <u><a href='/Departement_Gi/account/Espace_admin'><font color='white'>administration</font></a></u>   <u><a href='/Departement_Gi/Deconnexion.php'>Déconnexion</a></u></pre>";
 }
 else{
 ?>
 <form method="post" action="/Departement_Gi/account/">
<pre><input type="text" name="Cne_connexion" placeholder="Cne" class="c1" />
<input type="password" name="Pass_connexion" placeholder="Mot de passe" class="c1"/>
<input class="c2" type="submit" value="Connexion"  /> </pre>

 </form>
 <?php
 }?>
</div>  
</div>
</div>
<form method="GET">
				<pre>                                </pre>
				</form>
<div id="conteneur">
	<div id="photo">
	<a href="http://localhost/Departement_Gi"><img src="LOGO.png" style="height:260px; width:150px;"/></a>
	<div id="objet">
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/ shockwave/cabs/flash/swflash.cab#version=8,0,0,0" height="225px"  width="800px">
	<param name="movie" value="testpfe.swf">
	<param name="bgcolor" value="#ffffff">
	<param name="menu" value="false">
	<param name="quality" value="high">
	<param name="wmode" value="transparent">
	<embed src="testpfe.swf" wmode="transparent" bgcolor="#ffffff" menu="false" quality="high" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" height="260" width="830">
	</object>
	</div>
	</div>
	<div id="menu">
		<ul>
			<li id="menu_top_titre">
				<a>MENU </a>
			</li >
			<li id="Accueil">
				<a href="http://localhost/Departement_Gi" >accueil</a>|
			</li>
			<li id="li_Inscription" name="Inscription">
			 <a href="http://localhost/Departement_Gi/account/inscription.php">Inscription</a>|
			</li>
			<li id="li_DeptGi" name="DptGi">
					<a href="Filiers.php">Génie Informatique</a>|
					<ul>
								<li><a href="Filiers.php?JC">Java C++</a></li>
								<li><a href="Filiers.php?ABD">ABD</a></li>
								<li><a href="Filiers.php?TWCE">TWCE</a></li>
								<li><a href="Filiers.php?GL">GL</a></li>
								<li><a href="Filiers.php?ASR">ASR</a></li>
								<li><a href="Filiers.php?TR">TR</a></li>
					</ul>
			</li>
			<li id="li_Esp_Etudiant" name="EspEtud">
			 <a href="">Espace Etudiant</a>|
			  <ul name="Esp_Etud">
			   <li><a href="/Departement_Gi/Account">Connexion</a></li>
			   <li><a href="/Departement_Gi/Account">Cours</a></li>
			   <li><a href="/Departement_Gi/Account">DS</a></li>
			   <li><a href="/Departement_Gi/Account">Notes</a></li>
			  </ul>
			</li>
			
			<li id="li_Formations" name="Formation">
			 <a href="formation.php">Formations Continues</a>|
			</li>
			<li id="li_contact" name="contact">
		     <a href="contact.php">Contact</a>
			</li>
			
		</ul>
		
	</div>
	

<div id="centre_page">


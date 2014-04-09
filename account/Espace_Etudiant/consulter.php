<?php
include("../../fonctions.php");
include("../../administration.php");
include("container.php");
?>
<style>
body{background-image:url('background.jpg');}
span{margin-top:5px; margin-bottom:30px; background-image:url('../span.png');font-size:16px; color:#707070; display:block; height:30px; width:280px; border-top-right-radius:10px; border-top-right-radius:10px; color:#DADADA; font-size:20px; }
tr{ border-radius:10px;}
#menu{margin-left:150px;}
a{margin:20px; text-decoration:none; font-size:18px;}
</style>
<?php
$Niveau=GET_USER_INFO($_SESSION["Cne"],"Niveau");
$Filiere=GET_USER_INFO($_SESSION["Cne"],"Filiere");
if(isset($_GET["cours"])){
echo "<center><h1>Cours</h1></center>";
connecte_serveur();
$req=mysql_query("SELECT * FROM documents  WHERE Type_doc='Cours' order by Id_doc DESC ");
echo"<center><table border='1'>";echo "<tr><th>Document</th><th>Nom</th><th>Date de l'ajout</th><th></th></tr>";
while($r=mysql_fetch_assoc($req)){

	echo "<tr><td><a href='../../documents/Cours/".$r["Doc_Url"]."'><img src='images/fichiers.png' /></a></td><td>".$r["Doc_Url"]."</td><td>".$r["date"]."</td><td><a href='../../documents/Cours/".$r["Doc_Url"]."'>Télecharger</a></td></tr>";
	}
echo'</tr></table></center>';
}

if(isset($_GET["Avis_etudiant"])){
echo "<center><h1>Cours</h1></center>";
connecte_serveur();
$req=mysql_query("SELECT * FROM documents  WHERE Type_doc='Avis_etudiant' order by Id_doc DESC ");
echo"<center><table border='1'>";echo "<tr><th>Document</th><th>Nom</th><th>Date de l'ajout</th><th></th></tr>";
while($r=mysql_fetch_assoc($req)){

	echo "<tr><td><a href='../../documents/Avis_etudiant/".$r["Doc_Url"]."'><img src='images/fichiers.png' /></a></td><td>".$r["Doc_Url"]."</td><td>".$r["date"]."</td><td><a href='../../documents/Cours/".$r["Doc_Url"]."'>Télecharger</a></td></tr>";
	}
echo'</tr></table></center>';
}
if(isset($_GET["Emploi_temps"])){
echo "<center><h1>Emploi_temps</h1></center>";
connecte_serveur();
$req=mysql_query("SELECT * FROM documents  WHERE Type_doc='Emploi_temps' order by Id_doc DESC ");
echo"<center><table border='1'>";echo "<tr><th>Document</th><th>Nom</th><th>Date de l'ajout</th><th></th></tr>";
while($r=mysql_fetch_assoc($req)){

	echo "<tr><td><a href='../../documents/Emploi_temps/".$r["Doc_Url"]."'><img src='images/fichiers.png' /></a></td><td>".$r["Doc_Url"]."</td><td>".$r["date"]."</td><td><a href='../../documents/Cours/".$r["Doc_Url"]."'>Télecharger</a></td></tr>";
	}
echo'</tr></table></center>';
}

if(isset($_GET["Notes"])){
echo "<center><h1>Notes</h1></center>";
connecte_serveur();
$req=mysql_query("SELECT * FROM documents  WHERE Type_doc='Notes' order by Id_doc DESC ");
echo"<center><table border='1'>";echo "<tr><th>Document</th><th>Nom</th><th>Date de l'ajout</th><th></th></tr>";
while($r=mysql_fetch_assoc($req)){

	echo "<tr><td><a href='../../documents/Notes/".$r["Doc_Url"]."'><img src='images/fichiers.png' /></a></td><td>".$r["Doc_Url"]."</td><td>".$r["date"]."</td><td><a href='../../documents/Cours/".$r["Doc_Url"]."'>Télecharger</a></td></tr>";
	}
echo'</tr></table></center>';
}

if(isset($_GET["Divers"])){
echo "<center><h1>Divers</h1></center>";
connecte_serveur();
$req=mysql_query("SELECT * FROM documents  WHERE Type_doc='Divers' order by Id_doc DESC ");
echo"<center><table border='1'>";echo "<tr><th>Document</th><th>Nom</th><th>Date de l'ajout</th><th></th></tr>";
while($r=mysql_fetch_assoc($req)){

	echo "<tr><td><a href='../../documents/Divers/".$r["Doc_Url"]."'><img src='images/fichiers.png' /></a></td><td>".$r["Doc_Url"]."</td><td>".$r["date"]."</td><td><a href='../../documents/Cours/".$r["Doc_Url"]."'>Télecharger</a></td></tr>";
	}
echo'</tr></table></center>';
}


?>
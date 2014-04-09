<?php

function update_users($Cne){
$table=GET_USER_INFO($Cne,"ALL");
echo'<form method="POST"><table>';
foreach($table as $t=>$p){
echo"<tr><td>".$t."</td><td><input type='text' name='".$t."' value='".$p."'/></td></tr>";
}
echo"
<td><button><a href='user_config.php'>retour</a></button></td><td><input type='submit' name='modifier' value='Modifier'></td>
</table></form>";
}

function update_document($Id){
$table=GET_DOCUMENT_INFO($Id,"ALL","");
echo'<form method="POST" enctype="multipart/form-data" ><table>';
$tab=array("Avis_etudiant","Cours","Divers","Emploi_temps","Notes");
if(!empty($table))
foreach($table as $t=>$p){
if($t=="Type_doc"){
			echo'<tr><td>Type de document :</td>
				<td><select name="Type_doc" >
				<option value="'.$p.'">'.$p.'</option>';
	foreach($tab as $s){
			if($s!=$p)
			echo '<option value="'.$s.'">'.$s.'</option>';
			}
			echo '</select></td></tr>';
	}
else if($t=="Doc_Url"){
echo"<tr>";
if(!empty($p)){echo '<td>'.$table["Doc_Url"].'</td>';}else
echo"<td>Document:</td>";
echo'<td><input type="file" name="document"/></td></tr>';
}
else
echo"<tr><td>".$t."</td><td><input type='text' name='".$t."' value='".$p."'/></td></tr>";
}
echo"
<td><a href='documents.php'>retour</a><a href=?sup=$Id>Supprimer l'article</a></td><td><input type='submit' name='modifier' value='Modifier'></td>
</table></form>";
}



function update_Article($Id){
$table=GET_ARTICLE_INFO($Id,"ALL","");
echo'<form method="POST" enctype="multipart/form-data" ><table>';
$tab=array("Actualité","Annonce","Avis_etudiant","Presentation","Avis_inscription","presentation_filiere","Divers");
foreach($table as $t=>$p){
if($t=="Contenue")echo'<tr><td>Contenue:</td><td><textarea class="tinymce" name="'.$t.'" style="height:120px; width:500px;" >'.$p.'</textarea></td>';
else if($t=="Type_article"){
			echo'<tr><td>Type de l\'article:</td>
				<td><select name="Type_article" >
				<option value="'.$p.'">'.$p.'</option>';
	foreach($tab as $s){
			if($s!=$p)
			echo '<option value="'.$s.'">'.$s.'</option>';
			}
			echo '</select></td></tr>';
	}
else if($t=="Image_Url"){
echo"<tr>";
echo $table["Image_Url"];
if(!empty($p)){echo'<td><img  src="/DEPARTEMENT_GI/articles/'.$table["Type_article"].'/'.$table["Image_Url"].'" style="width:80px; height:80px;"  /></td>';}else
echo"<td>Image:</td>";
echo'<td><input type="file"  name="avatar" /></td></tr>';
}
else
echo"<tr><td>".$t."</td><td><input type='text' name='".$t."' value='".$p."'/></td></tr>";
}
echo"
<td><a href='article_config.php'>retour</a><a href=?sup=$Id>Supprimer l'article</a></td><td><input type='submit' name='modifier' value='Modifier'></td>
</table></form>";
}

function getPageId($type_article,$titre){
connecte_serveur();
$requete=mysql_query("SELECT * FROM pages WHERE Type_article='$type_article' AND Titre='$titre' ");
$get=mysql_fetch_assoc($requete);
return $get["Id_Page"];
deconnecte_serveur();
}

function Supprimer_article($Id){
connecte_serveur();
mysql_query("DELETE  FROM article WHERE Id_Article='$Id'") or die(mysql_error());
deconnecte_serveur();
}

function get_users(){
connecte_serveur();
$requete=mysql_query("SELECT * FROM utilisateurs");
echo'<table border="1" cellspacing="0" width="1000px">
<tr><th></th><th>ID</th><th>Nom</th><th>Prenom</th><th>Date de naissance</th><th>Filiere</th><th>Cne</th><th>Mot de passe</th><th>Email</th><th></th><th></th></tr>';
$requete=mysql_query("select * FROM utilisateurs") or die(mysql_error());
$color="color1";
while($s=mysql_fetch_assoc($requete)){
echo '<tr class='.$color.'>
		<td><input type="checkbox" name="'.$s["Id"].'"></td>
		<td>'.$s["Id"].'</td><td>'.$s["Nom"].'</td>
		<td>'.$s["Prenom"].'</td>
		<td>'.$s["Date_De_Naissance"].'</td>
		<td>'.$s["Filiere"].'</td>
		<td>'.$s["Cne"].'</td>
		<td>'.$s["Mot_de_passe"].'</td>
		<td>'.$s["Email"].'</td>
		<td><a href="?mod='.$s["Cne"].'"><img src="/DEPARTEMENT_GI/icones/mod.png" /></a></td>
		<td><a href="?sup='.$s["Id"].'"><img src="/DEPARTEMENT_GI/icones/delete_user.png" /></a></td>
	  </tr>';
if($color=="color1")$color="color2";else $color="color1";
}
echo '<table>';
deconnecte_serveur();
}
function get_articles($trier){
connecte_serveur();
if($trier==""){$where="";}else {
$where="WHERE Type_article='$trier' ";
}
echo'<table border="1" cellspacing="0" width="1000px">
<tr><th></th><th>ID</th><th>type d\'article</th><th>Titre</th><th>Objet</th><th>Contenue</th><th>Date</th><th></th><th></th></tr>';
$requete=mysql_query("select * FROM article $where ") or die(mysql_error());
$color="color1";
while($s=mysql_fetch_assoc($requete)){
echo '<tr class="'.$color.'">
		<td><input type="checkbox" name="'.$s["Id_Article"].'"></td>
		<td>'.$s["Id_Article"].'</td>
		<td>'.$s["Type_article"].'</td>
		<td>'.$s["Titre"].'</td>
		<td>'.$s["Objet"].'</td>
		<td ><a href="?mod='.$s["Id_Article"].'">voir le contenue</a></td>
		<td>'.$s["Date"].'</td>
		<td><a href="?mod='.$s["Id_Article"].'"><img src="/DEPARTEMENT_GI/icones/article.png" /></a></td>
		<td><a href="?sup='.$s["Id_Article"].' "><img src="/DEPARTEMENT_GI/icones/delete_article.png" /></a></td>
	  </tr>';
if($color=="color1")$color="color2"; else $color="color1";
}
echo '<table>';
deconnecte_serveur();
}

function delete_user($ID){
connecte_serveur();
mysql_query("DELETE FROM utilisateurs WHERE Id='$ID' ") or die(mysql_error());
deconnecte_serveur();
}

function get_documents($trier){
connecte_serveur();
if($trier==""){$where="";}else{
$where="WHERE Type_doc='$trier' ";
}
echo'<table border="1" cellspacing="0" width="900px">
<tr><th></th><th>ID</th><th>type de document</th><th>Titre</th><th>Contenue</th><th>Date</th><th>modifier</th><th>supprimer</th></tr>';
$requete=mysql_query("select * FROM documents $where ") or die(mysql_error());
$color="color1";
while($s=mysql_fetch_assoc($requete)){
echo '<tr class="'.$color.'">
		<td><input type="checkbox" name="'.$s["Id_doc"].'"></td>
		<td>'.$s["Id_doc"].'</td>
		<td>'.$s["Type_doc"].'</td>
		<td>'.$s["Titre"].'</td>
		<td ><a href="../../documents/'.$s["Type_doc"]."/".$s["Doc_Url"].'">voir le contenue</a></td>
		<td>'.$s["date"].'</td>
		<td><a href="?mod='.$s["Id_doc"].'"><img src="/DEPARTEMENT_GI/icones/article.png" /></a></td>
		<td><a href="?sup='.$s["Id_doc"].' "><img src="/DEPARTEMENT_GI/icones/delete_article.png" /></a></td>
	  </tr>';
if($color=="color1")$color="color2"; else $color="color1";
}
echo '<table>';
deconnecte_serveur();
}


function Supprimer_document($Id){
connecte_serveur();
mysql_query("DELETE  FROM documents WHERE Id_doc='$Id'") or die(mysql_error());
deconnecte_serveur();
}
?>
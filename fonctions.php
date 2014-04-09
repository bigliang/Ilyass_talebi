<?php
if(isset($_POST["Email_rec"])){
}
function connecte_serveur(){
$s=mysql_connect("localhost","root","");
mysql_select_db("departement_gi",$s) or  die(mysql_error());
}
function deconnecte_serveur(){
mysql_close() ;
}
function detruire_session($retourn_page){
SESSION_START();
session_destroy();
header("location:$retourn_page");
}

function si_existe($champ,$colonne){
connecte_serveur();
$verification=mysql_query("select * From utilisateurs WHERE ".$colonne."='$champ'  ");
if(mysql_num_rows($verification)!=0)return true;
else return false;
deconnecte_serveur();
}

function connexion($Cne,$Pass,$type_user){
connecte_serveur();
$type_user=(strtolower($type_user));
if($type_user=="admin")$where="administrateur WHERE Pass='$Pass' ";
else  $where=" utilisateurs WHERE Mot_de_passe='$Pass' AND Cne='$Cne' ";
$verification=mysql_query("select * From $where ") or die(mysql_error());
if(mysql_num_rows($verification)!=0)return true;
else return false;
deconnecte_serveur();
}

function  GET_DOCUMENT_INFO($Id_doc,$COLUMN,$Type_doc){
connecte_serveur();
if($Id_doc==""){
$requete=mysql_query("SELECT * FROM documents WHERE Type_doc='$Type_doc' ")or die(mysql_error());
}else if($Id_doc=="nivfil"){
$Niveau=GET_USER_INFO($_SESSION["Cne"],"Niveau");
$Filiere=GET_USER_INFO($_SESSION["Cne"],"Filiere");
$requete=mysql_query("SELECT * FROM documents WHERE Type_doc='$Type_doc' AND Filiere='$Filiere' AND Niveau='$Niveau' ")or die(mysql_error());
}else{
$requete=mysql_query("SELECT * FROM documents WHERE Id_doc='$Id_doc' ") or die(mysql_error());}
if(mysql_num_rows($requete)!=0){
if($COLUMN=="ALL"){
$tab=array();
$tab=mysql_fetch_assoc($requete);
return $tab;
}
else{
while($valeur=mysql_fetch_assoc($requete)){
   }
return $valeur[$COLUMN];
  }
 }
deconnecte_serveur();
}

function GET_USER_INFO($CNE,$COLUMN){
connecte_serveur();
if(!is_numeric($CNE)){
$requete=mysql_query("SELECT * FROM utilisateurs WHERE Email='$CNE' ") or die(mysql_error());
}else
$requete=mysql_query("SELECT * FROM utilisateurs WHERE Cne='$CNE' ") or die(mysql_error());
if(mysql_num_rows($requete)!=0){
if($COLUMN=="ALL"){
$tab=array();
$tab=mysql_fetch_assoc($requete);
return $tab;
}
else{
while($valeur=mysql_fetch_assoc($requete)){
   }
return $valeur[$COLUMN];
  }
 }
deconnecte_serveur();
}

function GET_ARTICLE_INFO($Id_Article,$COLUMN,$Type_article){
connecte_serveur();
if($Id_Article==""){
$requete=mysql_query("SELECT * FROM article WHERE Type_article='$Type_article' ")or die(mysql_error());
}else{
$requete=mysql_query("SELECT * FROM article WHERE Id_Article='$Id_Article' ") or die(mysql_error());}
if(mysql_num_rows($requete)!=0){
if($COLUMN=="ALL"){
$tab=array();
$tab=mysql_fetch_assoc($requete);
return $tab;
}
else{
while($valeur=mysql_fetch_assoc($requete)){
   }
return $valeur[$COLUMN];
  }
 }
deconnecte_serveur();
}
?>
<?php
function update_user($cne,$champ,$colonne){
connecte_serveur();
mysql_query("UPDATE utilisateurs SET $colonne='$champ' WHERE Cne='$cne' ");
deconnecte_serveur();
}



function  formulaire_recuperation_motdepasse(){
echo'
<form method="post">
<font size="4" face="tahoma" >Pour récuperer votre mot de passe , Veuillez remplir les champs ci-dessous pour vérifier vos cordonnée personnelles :
<fieldset>
	<legend>
informations personnelles
	</legend>
<table>';
echo"<tr><td>Email</td><td><input type='email' name='Email' /> </td></tr>";
echo"<tr><td>Date de naissance</td><td><input type='date' name='date' /> </td></tr>";
echo '<tr><td></td><td><input type="submit" value="ok"  name="verifier"/></td></tr>
</table>
</fieldset>
</form>
';
}


function formulaire_editer_compte($cne){
$show=GET_USER_INFO($cne,"ALL");
?>
<form method="POST">
<fieldset>
	<LEGEND>Recuperer mot de passe</legend>
<table>
	<tr>
		<td>Nom</td>
		<td><input type="text" name="Nom_mod" value="<?php echo $show["Nom"]; ?>" /></td>
	</tr>	
	<tr>
		<td>Prenom</td>
		<td><input type="text"  name="Prenom_mod" value="<?php echo $show["Prenom"]; ?>"/></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><input type="Email" name="Email_mod" value="<?php echo $show["Email"]; ?>"/></td>
	</tr>
	<tr>
		<td>Mot de passe:</td>
		<td><input type="password"    name="Pass_mod" value="<?php echo $show["Mot_de_passe"]; ?>"/></td>
	</tr>	
	<tr>
		<td></td>
		<td><input type="submit" value="Modifier"/></td>
	</tr>
</table>
</fieldset>
</form>
<?php
if(isset($_SESSION["administrateur"])) $p="/Espace_Admin/";
else $p="/Espace_Etudiant";
echo '<pre>                                                     <a href="http://localhost/Departement_Gi/">Accueil</a>               <a href="http://localhost/Departement_Gi/account'.$p.' ">Accéder à mon espace</a></pre>';
}


function upload_avatar($avatar_tmp,$width,$height,$chemin){
	if(file_exists($avatar_tmp)){
		$image_size=getimagesize($avatar_tmp);
		if($image_size["mime"]=='image/jpeg'){
		$image_src=imagecreatefromjpeg($avatar_tmp);
		}		
		else if($image_size["mime"]=='image/png'){
		$image_src=imagecreatefrompng($avatar_tmp);
		}		
		else if($image_size["mime"]=='image/gif'){
		$image_src=imagecreatefromgif($avatar_tmp);
		}else{
		echo"<script>alert('Votre image n\'est pas valide. ');</script>";
		$image_src=false;
		}
		if($image_src!==false){
		    $image_width=$width;
			if($image_size[0]<=$image_width&&$image_size[1]<=$height){
			$image_finale=$image_src;
			
			}else{
			$new_width[0]=$image_width;
			$image_finale=imagecreatetruecolor($width,$height);
			imagecopyresampled($image_finale,$image_src,0,0,0,0,$width,$height,$image_size[0],$image_size[1]);
		   }
			 $name=$_FILES["avatar"]["name"];
			imagejpeg($image_finale,$chemin.$name);
		}
	}else echo "<script>alert('No Temporary FILE');</script>";
}


function upload_document($document_tmp,$chemin){
	if(file_exists($document_tmp)){
$target_path = $chemin;
$target_path = $target_path . basename( $_FILES['document']['name']); 
if(move_uploaded_file($document_tmp,$target_path)){
    echo "The file ".  basename( $_FILES['document']['name']). 
    " has been uploaded";
} else{
    echo "There was an error uploading the file, please try again!";
}
		}
	}
 ?>
 
 
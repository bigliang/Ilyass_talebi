<html>
<head>
<title>Configuration des articles</title>
<script type="text/javascript">
function checkedAll(){
for (var i = 0; i < document.getElementById('utilisateurs').elements.length; i++) {
document.getElementById('utilisateurs').elements[i].checked =true;
 }
}
function emptyAll(){
for (var i = 0; i < document.getElementById('utilisateurs').elements.length; i++) {
document.getElementById('utilisateurs').elements[i].checked =false;
 }
}
</script>
</head>
<body>
<a href="http://localhost/Departement_Gi/account/Espace_admin/"  ><img src="../retour.ico" style="height:20PX;"/>retour vers l'administration</a><br><br>

<?php
include("container.php");
if(!isset($_GET["sup"])&&!isset($_GET["mod"])&&!isset($_GET["add"])){
if(isset($_GET["ajout"])&&isset($_GET["ajout"])=="ok"){
echo '<p>Une ligne à été ajoutée<img src="/DEPARTEMENT_GI/icones/ok.png"/></p>';
}
?><form method="POST" id="utilisateurs">
<a  href="javascript:checkedAll();">Tout cocher</a> / <a href="javascript:emptyAll();">Tout décocher</a>
Pour la sélection :<button type="submit" name="del_all" value="del_all" ><img src="/DEPARTEMENT_GI/icones/delete_all.png"/></button>
trier par:
<select name="tri">
<option value="">tout affiché</option>
<option value="Actualité">Actualité</option>
<option value="Annonce">Annonce</option>
<option value="Avis_etudiant">Avis_etudiant</option>
<option value="Presentation">Presentation</option>
<option value="Avis_inscription">Avis_inscription</option>
<option value="presentation_filiere">presentation_filiere</option>
<option value="Divers">Divers</option>
</select><input type='submit' name='trier'  value='trier' />
</select><a href="?add"> ajouter article<img src="/DEPARTEMENT_GI/icones/add.png" /></a>
<?php
if(isset($_POST["trier"])){
get_articles($_POST["tri"]);
}
else
get_articles("");
echo"</form>";
}
if(isset($_GET["sup"])){
Supprimer_article($_GET["sup"]);
header("location:article_config.php");
}
if(isset($_GET["mod"])){
$id=$_GET["mod"];
update_Article($id);
if(isset($_POST['modifier'])){
$table=GET_ARTICLE_INFO($id,"ALL","");
if(count($table)==0)die("l'article n'existe pas");
foreach($table as $a=>$b){
if($a=="Image_Url"){
if($table["Image_Url"]!=""){continue;}
$e=$_FILES["avatar"]["name"];
}
else if(empty($_POST["$a"])){$e=$b;}else{
$e=$_POST["$a"];  
}
$update=mysql_query("update article SET $a='$e' WHERE Id_Article='$id' ") or die(mysql_error());
if($update){
if(!empty($_POST["avatar"])){
$avatar=$_FILES['avatar']['name'];
$avatar_tmp=$_FILES['avatar']['tmp_name'];

if(!empty($avatar_tmp)){
	$image=explode('.',$avatar);
	$image_ext=end($image);
		if(in_array(strtolower($image_ext),array('png','gif','jpeg','jpg'))===false){
		$errors[]="Veuillez saisir une image";
		}
	if(empty($errors)){
	$Type_article=$_POST["Type_article"];
	$chemin="../../articles/".$Type_article."/";
	$x=305;$y=337;	
	upload_avatar($avatar_tmp,$x,$y,$chemin);
	}else{
	foreach($errors as $error){
	echo $error;
		}
	}
  }
   }
   echo"<script>window.location.reload();</script>";
   }
  }
 }
}
if(isset($_GET["add"])){
?>
<form method="POST" enctype="multipart/form-data"  >
<fieldset>
	<legend>
		Nouvel article
	</legend>
	<table>
		<tr>
			<td>Type d'article:</td>
		<td>
			<select name="Type_article">
				<option value="Actualité">Actualité</option>
				<option value="Annonce">Annonce</option>
				<option value="Avis_etudiant">Avis étudiant</option>
				<option value="Presentation">Presentation ecole</option>
				<option value="Avis_inscription">Inscription</option>
				<option value="presentation_filiere">presentation_filiere</option>
				<option value="Divers">Divers</option>
			</select>
		</td>
		</tr>
		<tr>
			<td>Titre:</td><td><input type="text" name="Titre" /></td>
		</tr>
		<tr>
			<td>Objet:</td><td><input type="text" name="Objet" /></td>
		</tr>
		<tr>
			<td>Contenue:</td>
			<td><textarea  name="Contenue" style="height:120px; width:500px;">

			</textarea></td>
		</tr>
		<tr>
			<td>Image:</td>
			<td><input type="file"   value="fichier" name="avatar" /></td>
		</tr>
		<tr>
			<td></td><td><input type="submit"  name="ajouter" value="OK" /></td>
		</tr>
	</table>
</fieldset>
</form>
<?php
}
if(isset($_POST["ajouter"])){
connecte_serveur();
	$insertion = mysql_query(" INSERT INTO article (Type_article,Titre,Objet,Contenue,Image_Url,Date) values('".$_POST["Type_article"]."','".$_POST["Titre"]."','".$_POST["Objet"]."','".$_POST["Contenue"]."','".$_FILES["avatar"]["name"]."',NOW()) ") or die(mysql_error());
	if($insertion){
$avatar=$_FILES['avatar']['name'];
$avatar_tmp=$_FILES['avatar']['tmp_name'];

if(!empty($avatar_tmp)){
	$image=explode('.',$avatar);
	$image_ext=end($image);
		if(in_array(strtolower($image_ext),array('png','gif','jpeg','jpg'))===false){
		$errors[]="Veuillez saisir une image";
		}
	if(empty($errors)){
	$Type_article=$_POST["Type_article"];
	$chemin="../../articles/".$Type_article."/";
	if($Type_article=="Annonce")$x=450;$y=337;
	if($Type_article=="Divers")$x=305;$y=340;
	if($Type_article=="Avis_inscription")$x=505;$y=340;
	if($Type_article=="presentation_filiere")$x=405;$y=140;
	upload_avatar($avatar_tmp,$x,$y,$chemin);
	header("location:article_config.php?ajout");
	}else{
	foreach($errors as $error){
	echo $error;
		}
	}
  }
 }
}
if(isset($_POST['del_all'])){
connecte_serveur();
$lignes=mysql_query("select Id_Article From article ");
$nmbre_ligne=mysql_num_rows($lignes);
while($r=mysql_fetch_assoc($lignes)){
$Id=$r["Id_Article"];
if(isset($_POST["$Id"]))Supprimer_article($Id);
echo '<script>window.location.reload();</script>';
  }
}
?>
</body>
</html>
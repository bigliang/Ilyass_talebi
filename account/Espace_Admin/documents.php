<html>
<head>
<title>Documents</title>
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
<br><br>
<a  href="javascript:checkedAll();">Tout cocher</a> / <a href="javascript:emptyAll();">Tout décocher</a><br>Pour la sélection :<button type="submit" name="del_all" value="del_all" ><img src="/DEPARTEMENT_GI/icones/delete_all.png"/></button>&nbsp;&nbsp;&nbsp;&nbsp;trier par:<select name="tri">
<option value="">tout affiché</option>
<option value="Avis_etudiant">Avis_etudiant</option>
<option value="Cours">Cours</option>
<option value="Emploi_temps">Emploi_temps</option>
<option value="Notes">Notes</option>
<option value="Divers">Divers</option>
</select><input type='submit' name='trier'  value='trier' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?add"> ajouter un document<img src="/DEPARTEMENT_GI/icones/add.png" /></a>
<?php
if(isset($_POST["trier"])){
get_documents($_POST["tri"]);
}
else
get_documents("");
echo"</form>";
}
if(isset($_GET["sup"])){
Supprimer_document($_GET["sup"]);
header("location:article_config.php");
}
if(isset($_GET["mod"])){
$id=$_GET["mod"];
update_document($id);
if(isset($_POST['modifier'])){
$table=GET_DOCUMENT_INFO($id,"ALL","");

if(count($table)==0)die("le document n'existe pas");
if(!empty($table))
foreach($table as $a=>$b){
if($a=="Doc_Url"){
if(!empty($_POST["document"])){continue;}
$e=$_FILES["document"]["name"];
}
else if(empty($_POST["$a"])){$e=$b;}else{
$e=$_POST["$a"];  
}
$update=mysql_query("update documents SET $a='$e' WHERE Id_doc='$id' ") or die(mysql_error());
}
if($update){
if(empty($_POST["document"])){
$document=$_FILES['document']['name'];
$document_tmp=$_FILES['document']['tmp_name'];
	$Type_article=$_POST["Type_doc"];
	$chemin="../../documents/".$Type_article."/";
	upload_document($document_tmp,$chemin);
	}
	//echo"<script>window.location.reload();</script>";
	}
    
  }
 }
if(isset($_GET["add"])){
?>
<form method="POST" enctype="multipart/form-data"  >
<fieldset>
	<legend>
		Nouveau document
	</legend>
	<table>
		<tr>
			<td>Type de document:</td>
		<td>
			<select name="Type_document">
				<option value="Avis_etudiant">Avis_etudiant</option>
				<option value="Cours">Cours</option>
				<option value="Notes">Notes</option>
				<option value="Divers">Divers</option>
			</select>
		</td>
		</tr>
		<tr>
			<td>Titre:</td><td><input type="text" name="Titre" /></td>
		</tr>
		<tr>
		<td>Niveau:</td>
		<td>
			<select name="Niveau">
				<option value="1">1ère année</option>
				<option value="2">2eme année</option>
			</select>
		</td></tr>
		<tr><td>Filiere</td>
		<td>
			<select name="Filiere"  >
				<option value="ASR">ASR</option>
				<option value="ABD">ABD</option>
				<option value="JC++">JC++</option>
				<option value="GL">GL</option>
				<option value="TR">TR</option>
				<option value="TWCE">TWCE</option>
			</select>
		</td></tr>
		<tr>
			<td>Fichier:</td>
			<td><input type="file"   value="fichier" name="document" /></td>
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
	$insertion = mysql_query(" INSERT INTO  documents (Type_doc,Titre,Niveau,Filiere,Doc_Url,Date) values('".$_POST["Type_document"]."','".$_POST["Titre"]."','".$_POST["Niveau"]."','".$_POST["Filiere"]."','".$_FILES["document"]["name"]."',NOW()) ") or die(mysql_error());
	if($insertion){
$document=$_FILES['document']['name'];
$document_tmp=$_FILES['document']['tmp_name'];

if(!empty($document_tmp)){

	$Type_doc=$_POST["Type_document"];
	$chemin="../../documents/".$Type_doc."/";
	upload_document($document_tmp,$chemin);
  }
 }
}
if(isset($_POST['del_all'])){
connecte_serveur();
$lignes=mysql_query("select Id_doc From documents ");
$nmbre_ligne=mysql_num_rows($lignes);
while($r=mysql_fetch_assoc($lignes)){
$Id=$r["Id_doc"];
if(isset($_POST["$Id"]))Supprimer_document($Id);
echo '<script>window.location.reload();</script>';
  }
}
?>
</body>
</html>
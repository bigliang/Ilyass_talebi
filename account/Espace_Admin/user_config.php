<html>
<head>
<title>Configuration des utilisateurs</title>
<script>
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
echo'<p>Une ligne à été ajoutée<img src="/DEPARTEMENT_GI/icones/ok.png"/></p>';
}
echo '<a  href="javascript:checkedAll();">Tout cocher</a> / <a href="javascript:emptyAll();">Tout décocher</a>  <form method="POST" id="utilisateurs">Pour la sélection :<button type="submit" name="del_all" value="del_all" ><img src="/DEPARTEMENT_GI/icones/delete_all.png"/></button><a href="?add"> ajouter utilisateur<img src="/DEPARTEMENT_GI/icones/add_user.png" /></a>';
get_users();
echo"</form>";
}
if(isset($_GET["sup"])){
delete_user($_GET["sup"]);
header("location:user_config.php");
}
if(isset($_GET["mod"])){
$Cne=$_GET["mod"];
update_users($Cne);
if(isset($_POST['modifier'])){
$table=GET_USER_INFO($Cne,"ALL");
foreach($table as $a=>$b){
$e=$_POST["$a"]; 
$update=mysql_query("update utilisateurs SET $a='$e' WHERE Cne='$Cne' ") or die(mysql_error());
if($update){
echo"<script>window.location.reload();</script>";
}
  }
 }
}
if(isset($_GET["add"])){
?>
<form method="POST" >
<fieldset>
	<legend>
		Nouveau Utilisateur
	</legend>
	<table>
		<tr>
			<td>Cne:</td><td><input type="text" name="Cne" /></td>
		</tr>
		<tr>
			<td>Nom:</td><td><input type="text" name="Nom" /></td>
		</tr>
		<tr>
			<td>Prenom:</td><td><input type="text" name="Prenom" /></td>
		</tr>
		<tr>
			<td>Date de naissance</td>
			<td><input type="text" name="jj" placeholder="jj" size="1" /><input type="text" name="mm" placeholder="mm" size="2" /><input type="text" name="aaaa" placeholder="aaaa" size="3" /></td>
		</tr>
		<tr>
			<td>Filiere:</td><td>
			<select name="Filiere"  >
				<option value="ASR">ASR</option>
				<option value="ABD">ABD</option>
				<option value="JC++">JC++</option>
				<option value="GL">GL</option>
				<option value="TR">TR</option>
				<option value="TWCE">TWCE</option>
			</select>
			</td>
		</tr>
		<tr>
			<td>Niveau</td><td>
			<select name="Niveau">
				<option value="1">1ère année</option>
				<option value="2">2ème année</option>
			</select>
			</td>
		</tr>
		<tr>
			<td>Email:</td><td><input type="email" name="Email"/></Td>
		</tr>
		<tr>
			<td>Choissisez un mot de passe:</td><td><input type="password" name="Pass"/></Td>
		</tr>		
		<tr>
			<td></td><td><input type="submit"  name="inscrire" value="OK" /></td>
		</tr>
	</table>
</fieldset>
</form>
<?php
}
if(isset($_POST["inscrire"])){
if(si_existe($_POST["Cne"],"Cne")){echo "<script>alert('Ce Cne déjà existe!');</script>";}else{
$naissance=$_POST["jj"]; 
$naissance+="-".$_POST["mm"]; 
$naissance+="-".$_POST["aaaa"]; 
connecte_serveur();
	$insertion=mysql_query(" INSERT INTO utilisateurs (Nom,Prenom,Filiere,Niveau,Cne,Mot_de_passe,Email) values('".$_POST["Nom"]."','".$_POST["Prenom"]."','".$_POST["Filiere"]."','".$_POST["Niveau"]."','".$_POST['Cne']."','".$_POST["Pass"]."','".$_POST["Email"]."') ") or die(mysql_error());
	if($insertion){
		header("location:user_config.php?ajout=ok");
	}
  }
}
if(isset($_POST['del_all'])){
connecte_serveur();
$lignes=mysql_query("select Id From utilisateurs ");
$nmbre_ligne=mysql_num_rows($lignes);
while($r=mysql_fetch_assoc($lignes)){
$Id=$r["Id"];
if(isset($_POST["$Id"]))delete_user($Id);
echo '<script>window.location.reload();</script>';
  }
}
?>
</body>
</html>
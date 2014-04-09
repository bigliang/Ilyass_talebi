<style>
body{background-image:url("background.jpg");}
legend{ opacity:0.8; background-image:url("../span.png"); color:#DADADA; font-size:25px; height:30px; width:340px; border-radius:10px;}
fieldset{  margin:auto; width:450px; border-radius:10px; margin-top:40px; text-align:center;}
fieldset pre{border-radius:10px; background:#8F9DA3; opacity:0.7;}
fieldset input{border:1PX solid black;margin-bottom:10px; height:30px;  width:200px; border-radius:10px; color:#0B426F; font-size:17px; }
a{color:black;}
</style>
<?php
include("container.php");
session_start();
if(isset($_SESSION["Cne"])&&!isset($_GET["config"])){
header("location:/Departement_Gi/account/ESPACE_ETUDIANT");
}
else if(isset($_SESSION["administrateur"])&&!isset($_GET["config"])){
header("location:/Departement_Gi/account/ESPACE_admin");
}

else if(isset($_GET["config"])&&(isset($_SESSION["Cne"])||isset($_SESSION["administrateur"]))){
$config=$_GET["config"];
if($config=="edite")formulaire_editer_compte($_SESSION["Cne"]);

if(isset($_POST['Nom_mod'])){
update_user($_SESSION["Cne"],$_POST['Nom_mod'],"Nom");
update_user($_SESSION["Cne"],$_POST['Prenom_mod'],"Prenom");
update_user($_SESSION["Cne"],$_POST['Email_mod'],"Email");
update_user($_SESSION["Cne"],$_POST['Pass_mod'],"Mot_de_passe");
echo "<script>history.go(0);</script>";
 }
}else if(isset($_GET["config"])&&!isset($_SESSION["Cne"])&&!isset($_SESSION["administrateur"])){
$config=$_GET["config"];
if($config=="recuper"){
echo"<form method='post'>
Veuillez tapez Votre Cne pour récuperer Votre mot de passe:
";
echo "<input placeholder='Cne' name='Cne' type='text' />";
echo "<input type='submit'  value='ok' name='tape_cne' /></form>";

if(isset($_POST["tape_cne"])&&si_existe($_POST["Cne"],"Cne")){
$_SESSION["Cne_tmp"]=$_POST["Cne"];
formulaire_recuperation_motdepasse();
	}
}
if(isset($_POST["verifier"])){

$table=array();
$table=GET_USER_INFO($_SESSION["Cne_tmp"],"ALL");
if($table["Date_De_Naissance"]==$_POST["date"]&&$table["Email"]==$_POST["Email"]){
echo "
<form method='POST' >
<fieldset>
	<legend>
		Nouveau mot de passe
	</legend>
<table>
<tr><td>Nouveau mot de passe:</td><td><input type='password'name='new_pass' /></Td></tr>
<tr><td>Confirmer:</td><td><input type='password'name='renew_pass' /></td></tr>
<tr><td></td><td><input type='submit' name='sendpass' value='Valider' /></td></tr>
</table>
</fieldset>
</form>
";
}else 
formulaire_recuperation_motdepasse();
}

if(isset($_POST["sendpass"])){
if($_POST["new_pass"]==$_POST["renew_pass"]){
if(empty($_POST["new_pass"])) echo "<font color='red' >Les champs sont obligatoires!</font>";{
update_user($_SESSION["Cne_tmp"],$_POST["renew_pass"],"Mot_de_passe");
$_SESSION["Cne"]=$_SESSION["Cne_tmp"];
echo "Vous avez récuperer votre compte<img src='../icones/ok.png' /> <a href='http://localhost/Departement_Gi/account/Espace_Etudiant'>accéder à L'espace étudiant</a>";

}}else{
echo "
<form method='POST' >
<fieldset>
	<legend>
		Nouveau mot de passe
	</legend>
<table>
<tr><td>Nouveau mot de passe:</td><td><input type='password'name='new_pass' /></td></tr>
<tr><td>Confirmer:</td><td><input type='password'name='renew_pass' /></td></tr>
<tr><td></td><td><input type='submit' name='sendpass' value='Valider' /></td></tr>
</table>
</fieldset>
</form>
";
echo "<font color='red'>Les mots de passes ne sont pas identiques !</font>";
}
}

}
else {
?>
<form method="POST">
<fieldset>
	<legend>
Connexion
	</legend><pre> 
<input type="text" placeholder="Cne" name="Cne_connexion" />
<input type="password" placeholder="Mot de passe" name="Pass_connexion" />
<input type="submit" value="se connecter" />
<a href="http://localhost/Departement_Gi/account/?config=recuper">Mot de passe oublié ?</a>     <a  href="inscription.php">S'inscrire</a>
</pre>
</fieldset>
</form>
<?php
}
if(isset($_POST['Cne_connexion'])&&!empty($_POST['Cne_connexion'])&&!empty($_POST["Pass_connexion"])){

if(connexion($_POST['Cne_connexion'],$_POST["Pass_connexion"],$_POST['Cne_connexion'])){
session_start();
if(strtolower($_POST['Cne_connexion'])=="admin"){ $_SESSION["administrateur"]="Administrateur";
}
else{
$_SESSION["Cne"]=$_POST["Cne_connexion"];
}
if(isset($_SESSION["administrateur"]))
header("location:http://localhost/Departement_Gi/account/Espace_admin");
if(isset($_SESSION["Cne"]))
header("location:http://localhost/Departement_Gi/account/Espace_Etudiant");
  }
}
?>
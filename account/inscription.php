<?php
include("container.php");
if(isset($_SESSION["Cne"]))header("location:/Departement_Gi/account/Espace_Etudiant");
if(isset($_SESSION["administrateur"]))header("location:/Departement_Gi/account/Espace_admin");

?>
<style>
body{background-image:url("background.jpg");}
legend{ opacity:0.8; background-image:url("../span.png"); color:#DADADA; font-size:25px; height:30px; width:340px; border-radius:10px;}
fieldset{ margin:auto; width:650px; border-radius:10px;  text-align:center;}
fieldset pre{border-radius:10px; background:#8F9DA3; opacity:0.7;}
fieldset input{border:1PX solid black;margin-bottom:10px; height:30px;  width:240px; border-radius:5px; color:#0B426F; font-size:19px; }
a{color:black;}
</style>
<FORM method="POST">
<FIELDSET>
	<LEGEND>
		INSCRIPTION
	</LEGEND>
	<pre>
<input type="text" name="Cne_inscription"  placeholder="Cne" size="6px"   />
<input type="submit" value="s'inscrire" />
</pre>
</FIELDSET>
</form>
<?php
session_start();
if(isset($_POST["Cne_inscription"])&&!empty($_POST["Cne_inscription"])&&is_numeric($_POST["Cne_inscription"])){
$_SESSION['Cne__']=$_POST["Cne_inscription"];
$Cne=$_POST["Cne_inscription"];
if(!si_existe($Cne,"Cne")){//Si le Cne de l'utilisateur n'est pas déjà dans la base de donnée , il peut s'inscrire
?>
<form method="POST">
<fieldset>
	<legend>
		Cordoonée personnelles:
	</legend>
	<table>
		<tr>
			<td>Nom:</td><td><input type="text" name="Nom" /></td>
		</tr>
		<tr>
			<td>Prenom:</td><td><input type="text" name="Prenom" /></td>
		</tr>
		<tr>
			<td>Date de naissance</td>
			<td><input type="date" name="DATE" /></td>
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
			<td></td><td><a href="Espace_Etudiant/"><input type="submit" value="OK" /></a></td>
		</tr>
	</table>
</fieldset>
</form>

<?php
}else{//Si l'utilisateur existe déjà dans la base :
	echo"<center>Le Cne que vous venez de saisir existe déjà. <br> <a href='http://localhost/Departement_Gi/account?recuper=".$Cne." '>Récuperez Votre Mot de passe :</a></center>";
  }
}
if(isset($_POST["Filiere"])){

	connecte_serveur();
	$insertion=mysql_query(" INSERT INTO utilisateurs (Nom,Prenom,Date_De_Naissance,Filiere,Niveau,Cne,Mot_de_passe,Email) values('".$_POST["Nom"]."','".$_POST["Prenom"]."','".$_POST["DATE"]."','".$_POST["Filiere"]."','".$_POST["Niveau"]."','".$_SESSION['Cne__']."','".$_POST["Pass"]."','".$_POST["Email"]."') ") or die(mysql_error());
	if($insertion){
	$_SESSION['Cne']=$_SESSION['Cne__'];
	deconnecte_serveur();
	header("location:./Espace_Etudiant");
	}
}

?>

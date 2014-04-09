<?php
include("container.php");
?>
<div id="left_page">
<?php
$array=array();
$array=GET_ARTICLE_INFO("","ALL","Annonce");
 if(!empty($array)){
?>
	<div  id="Annonces" style="background-image:url('./articles/Annonce/<?php echo $array['Image_Url']; ?>'); background-repeat:no-repeat;"  >
	<p> 
	<?php echo '<a href="article.php?Article='.$array['Id_Article'].'">'.$array['Objet'].'</a>'; ?>
	</p>
	</div>
<?php
}
$array2=array();
$array2=GET_ARTICLE_INFO("","ALL","Divers");
 if(!empty($array2)){
?>
<div id="Divers" style="background-image:url('./articles/Divers/<?php echo $array2['Image_Url']; ?>'); background-repeat:no-repeat;" >
	 
	<?php echo '<p><a href="article.php?Article='.$array2['Id_Article'].'">'.$array2['Objet'].'</a></p>'; ?>
	
</div>
<?php }?>
</div>
<div id="menu_right">
<div id="Info_departement">
<img src="articles/Presentation/presentation.png" style="height:120px; width:190px;" /><br>
PARTICULARITÉS DU PROGRAMME:<br>
<font size="3">
<br>
un stage obligatoire rémunéré de  4 mois dans toutes les options.
un projet intégrateur à chaque année, le projet final.
un encadrement accentué dès le début des études.
une formation créditée visant la maîtrise de la communication orale et écrite, et du travail en équipe
un mécanisme de gestion continue de la qualité du programme
des occasions multiples de faire une partie de la formation à l'étranger
</font>
<pre>                             <font size="4"><a href="Filiers.php?presentation">Lire la suite</a></font></pre>
</div>
<div id="presentation_filiere" >
<font size="5" >Options Génie Informatique</font>
<?php include("index4.html"); ?>
</div>
</div>
</div>
</div>
</div>
<?php
include("footer.php");
?>
</body>
</html>
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
PARTICULARIT�S DU PROGRAMME:<br>
<font size="3">
<br>
un stage obligatoire r�mun�r� de  4 mois dans toutes les options.
un projet int�grateur � chaque ann�e, le projet final.
un encadrement accentu� d�s le d�but des �tudes.
une formation cr�dit�e visant la ma�trise de la communication orale et �crite, et du travail en �quipe
un m�canisme de gestion continue de la qualit� du programme
des occasions multiples de faire une partie de la formation � l'�tranger
</font>
<pre>                             <font size="4"><a href="Filiers.php?presentation">Lire la suite</a></font></pre>
</div>
<div id="presentation_filiere" >
<font size="5" >Options G�nie Informatique</font>
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
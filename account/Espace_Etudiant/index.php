<?php
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
<pre><a href="http://localhost/Departement_Gi"  ><img src="../retour.ico" style="height:20PX;"/>retour vers l'accueil</a>                                                              <a href="http://localhost/Departement_Gi/account/?config=edite">modifier mon compte</a> <a href="http://localhost/Departement_Gi/deconnexion.php">Déconnexion</a></pre>
<img src="ea.png" />
<div id="menu">
<fieldset>
<legend><span>Consulter</span></legend>
<table>
	<tr>
		<td><a href="consulter.php?Emploi_temps"><img src="/DEPARTEMENT_GI/account/Espace_Admin/images/emploi_temps.png" ></a></td>
		<td><a href="consulter.php?cours"><img src="/DEPARTEMENT_GI/account/Espace_Admin/images/fichiers.png" ></a></td>
		<td><a href="consulter.php?avisetudiant"><img src="/DEPARTEMENT_GI/account/Espace_Admin/images/user.png" ></a></td>
		<td><a href="consulter.php?moyennes"><img src="/DEPARTEMENT_GI/account/Espace_Admin/images/article.png" ></a></td>
	</tr>
	<tr>
		<td><a href="user_config.php">Emploi du temps</a></td>
		<td><a href="user_config.php?add">Cours</a></td>
		<td><a href="user_config.php?mod">Avis etudiant</a></td>
		<td><a href="user_config.php">Moyennes</a></td>
	</tr>
</table>
</fieldset>

</div>
</div>
</div>
</div>
</body>
</html>
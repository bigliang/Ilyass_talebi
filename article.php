<?php
include("container.php");
?>
<style>#article{background:white;color:black; height:100%; padding:30px;}

</style>
<div id="article">
<?php
if(isset($_GET["Article"])){
$Id_Article=$_GET["Article"];
$array=array();
$array=GET_ARTICLE_INFO($Id_Article,"ALL","");
echo'
<p>
<font size="6">'.$array["Titre"].'</font><br>
<img src="./articles/'.$array["Type_article"].'/'.$array["Image_Url"].'" style="height:250px; width:400px; " /><br>
Date de l\'ajout: '.$array["Date"].'<br><font size="4">'.$array["Objet"].'</font><p>'.
$array["Contenue"]
.'</p>
</p>
';
}
?>
</div>
</div>
</div>
</div>
</body>
</html>
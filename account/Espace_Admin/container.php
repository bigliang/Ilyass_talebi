<?php
include("../../administration.php");
include("../../fonctions.php");
SESSION_START();
if(!isset($_SESSION["administrateur"])){
header("location:http://localhost/Departement_Gi");
}
?>
<html>
<head>
<style type="text/css">
body{background-image:url('background.jpg');}
span{margin-top:5px; margin-bottom:30px; background-image:url('../span.png');font-size:16px; color:#707070; display:block; height:30px; width:300px; border-top-right-radius:10px; border-top-right-radius:10px; color:#DADADA; font-size:20px; }
tr{ border-radius:10px;}
#menu{margin-left:150px;}
a{margin:10px;  font-size:18px;}
</style>
<body>
<?php
session_start();
if(!isset($_SESSION["Cne"])){
header("location:http://localhost/Departement_Gi");
}
?>
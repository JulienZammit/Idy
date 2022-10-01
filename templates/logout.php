<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=logout");
	die("");
}

if(isset($_SESSION['idUtilisateur'])){
	session_destroy();
    $url="../index.php?view=login&success=". urlencode("Déconnexion avec succès !");
    header("Location:$url");
    die("");
}
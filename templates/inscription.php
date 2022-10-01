<?php
// Ce fichier permet de tester les fonctions développées dans le fichier malibforms.php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) == "inscription.php")
{
    header("Location:../index.php?view=inscription");
    die("");
}

if(isset($_SESSION['idUtilisateur'])){
	header("Location:../index.php?view=sondage");
}

include_once("libs/modele.php"); // listes
include_once("libs/maLibUtils.php");// tprint
include_once("libs/maLibForms.php");// mkTable, mkLiens, mkSelect ...

?>
<link rel="stylesheet" href="css/login.css">

<style>
#corps {
	border: 0px solid white;
	border-radius: 20px;
	padding: 20px;
	width:40%;
	text-align: left;
	margin: 0 auto;
}
</style>

<div class="h-100">
<body style="background-color: #F5F5F5;">
	<div id="corps" style="background-color:white;box-shadow:1px 1px 12px #555;">
	<a href="index.php?view=login" style="display: inline-flex;text-decoration: none;outline: none;"><i class="fas fa-arrow-circle-left fa-3x" style="color:#25fde9;"></i><h4 style="color:black;">&nbsp;&nbsp;Retour</h4></a>
	<h1>Inscription</h1></br>

	<?php
	mkForm('controleur.php','POST');
	echo 'Pseudo : </TAB>'; mkInput('text','pseudo','',"form-control");
	echo '</br>';
	echo 'Mail : </TAB>'; mkInput('email','mail','',"form-control");
	echo '</br>';
	echo 'Mot de passe : </TAB>'; mkInput('password','password','',"form-control");
	echo '</br>';
	echo 'Confirmez mot de passe : </TAB>'; mkInput('password','password2','',"form-control");
	echo '</br>';
	echo 'Date de Naissance : </TAB>'; mkInput('date','date','',"form-control");
	echo '</br>';
	echo '</br>';
	mkInput('submit',"action","Inscription","btn","background-color:#25fde9;");
	endForm();
	echo "</div>";
	?>

</body>
</div>
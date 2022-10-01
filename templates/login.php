<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=login");
	die("");
}

if(isset($_SESSION['idUtilisateur'])){
	//session_destroy();
    header("Location:../index.php?view=sondage");
    die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibForms.php");

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
	background-color:white;
	box-shadow: 1px 1px 12px #555;
}
body{
	background-color: #F5F5F5;
}
</style>

<div>
	<div id="corps" style="margin-top: 40px;">

		<h1>Connexion</h1></br>
	    <div id="formLogin">
	        <?php
	        mkForm("controleur.php", "GET");
	        echo "Mail : "; mkInput("text","mail","","form-control");
	        echo "</br>";
	        echo "Passe : "; mkInput("password","passe","","form-control");
	       
	        echo "</br></br>"; mkInput('submit',"action","Connexion","btn","background-color:#25fde9;");
	        echo "</br></br>";
	        endForm();
	        echo "Vous n'avez pas de compte ? ";
	        echo "<a href=\"index.php?view=inscription\" style=\"outline:none;\">S'inscrire</a>";
	        ?>
	    </div>
	</div>
</div>

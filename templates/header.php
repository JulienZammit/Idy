<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}

// Pose qq soucis avec certains serveurs...
echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
include_once("libs/modele.php"); // listes
include_once("libs/maLibUtils.php");// tprint
include_once("libs/maLibForms.php");// mkTable, mkLiens, mkSelect ...

if(valider('idUtilisateur','SESSION')){
	$blacklist=getblacklist($_SESSION['idUtilisateur']);
	if($blacklist==='1'){
		session_destroy();
		$url="../index.php?view=login&error=".urlencode("Vous êtes banni de ce site");
	    header("Location:$url");
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- **** H E A D **** -->
<head>	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" href="ressources/bannieres/logo.ico" />
	<style type="text/css">html,body{margin: 0 !important;padding: 0;}

</style>
	<title>IdY</title>
	<!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->

	<!-- Liaisons aux fichiers css de Bootstrap -->

	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<!--<link href="bootstrap/css/theme.css" rel="stylesheet" />-->
  <link href="css/sticky-footer.css" rel="stylesheet" />
	<!--[if lt IE 9]>
	  <script src="js/html5shiv.js"></script>
	  <script src="js/respond.min.js"></script>
	<![endif]-->

	
<script type="text/javascript">
function initElement()
{
  var p = document.getElementById("avatarClick");
};

function showAlert()
{
  console.log("okkkkkk");
};

</script>
	
	

</head>
<!-- **** F I N **** H E A D **** -->


<!-- **** B O D Y **** -->
<body onload="initElement();" id="hiddenbody">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container-fluid">
  	<a href="index.php?view=sondage">
    <img class="navbar-brand" src="./ressources/logo.jpg" style="width:50px;height:50px;padding:0;"></img></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      	<?php
      	if (valider("connecte", "SESSION")) {
      		echo '<li class="nav-item">';
 		 	echo "<a class=\"nav-link active\" href=\"index.php?view=sondage\">Sondage</a>\n</li>";
      		echo '<li class="nav-item">';
 		 	echo "<a class=\"nav-link active\" href=\"index.php?view=utilisateur\">Mon profil</a>\n</li>";
 		 	if(getadmin($_SESSION['idUtilisateur'])){
				echo '<li class="nav-item">';
 		 		echo "<a class=\"nav-link active\" href=\"index.php?view=admin\">Administration</a>\n</li>";
 		 	}
 		 	echo '<li class="nav-item">';
            echo "<a class=\"nav-link active\" href=\"index.php?view=conversation\">Conversations</a>\n</li>";
 		 	echo "<a class=\"nav-link active\" href=\"index.php?view=logout\">Se deconnecter</a>\n</li>";
			echo "</ul>";
			mkForm("controleur.php","","d-flex");
			mkInput("search","pseudoUser","","form-control me-2");
			mkInput("submit","action","Rechercher un ami","btn btn-outline-success");
			endForm();
      	}
		?>
    </div>
  </div>
</nav>

<?php
if($error = valider("error")){echo"
	<script type=\"text/javascript\">
window.onload = function() {	Swal.fire({
  icon: 'error',
  title: 'Erreur...',
  text: '$error',
  showConfirmButton: false,
  timer: 1500
})}
</script>";
}
if($success = valider("success","GET")){echo"
    <script type=\"text/javascript\">
window.onload = function() {    Swal.fire({
  icon: 'success',
  title: 'Bravo !',
  text: '$success',
  showConfirmButton: false,
  timer: 1500
})}
</script>";
}
?>
<div style="min-height: 100%;">
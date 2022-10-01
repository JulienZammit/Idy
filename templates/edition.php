<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=edition");
	die("");
}

if(!$_SESSION['idUtilisateur']){
    header("Location:../index.php?view=login");
}
?>

<a href="index.php?view=utilisateur" style="display: inline-flex;text-decoration: none;outline: none;"><i class="fas fa-arrow-circle-left fa-3x m-1" style="color:#25fde9;"></i><h4 style="color:black;" class="mt-3">&nbsp;&nbsp;Retour</h4></a>

<div class="container">
<form enctype="multipart/form-data" action="controleur.php" method="POST">
    <label for="photo"><h3>Changer de photo</h3></br></label>
    <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
    <input type="file" id="photo" style = "text-align: center;" name="photo" accept="image/png, image/jpeg" class="form-control">
    </br>
    <input type="submit" name="action" style = "width:48%; float:left;" value="Définir comme Avatar" class="btn btn-dark"/>
    <input type="submit" name="action" style = "width:48%; float:right;" value="Définir comme bannière" class="btn btn-dark"/>
</form></br></br></br>
<?php
mkForm("controleur.php");
echo "<h3> Changer de pseudonyme </h3></br>";
mkInput("text","pseudo","","form-control");
echo "</br>";
mkInput("submit","action","Changer de pseudonyme","btn btn-dark");
endForm();
mkForm("controleur.php");
echo "</br><h3> Changer de mot de passe </h3></br>";
echo '<div> Nouveau mot de passe </div>';
mkInput("text","mdp1","","form-control");
echo "</br><div> Confirmez votre mot de passe </div>";
mkInput("text","mdp2","","form-control");
echo "</br>";
mkInput("submit","action","Changer votre mot de passe","btn btn-dark");
endForm();
?>
</div>
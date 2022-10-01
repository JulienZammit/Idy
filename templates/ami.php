<?php

$idUtilisateur = $_SESSION['idUtilisateur'];
$pseudo = getpseudo($idUtilisateur);

if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=ami");
    die("");
}

if(!$_SESSION['idUtilisateur']){
    header("Location:../index.php?view=login");
}

include_once("libs/modele.php"); // listes
include_once("libs/maLibUtils.php");// tprint
include_once("libs/maLibForms.php");// mkTable, mkLiens, mkSelect ...
?>
    <link rel="stylesheet" href="css/sondages.css">

<div class="container"></br></br>
<?php

	if($ami=valider("idami")){
		mkForm('controleur.php');
		$amipseudo = getpseudo($ami);
        $avatar = getAvatar($ami);
        $liaison = getliaison($idUtilisateur, $ami);

        echo "<div style='display:inline-flex;'>";
        echo "<a href=\"https://web-idy.com/index.php?view=utilisateur&profilde=" . $ami . "\">";
        echo "<div id = \"avatarClick\" style=\"float:left;\">";
        echo "<img src=\"" . $avatar . "\" height=\"50\" style = \"width:50px; clip-path:ellipse(50% 50%); \">";
        echo "</div>";
        echo "<div style='font-size:35px;float:left;color:black;'>&nbsp;&nbsp;@" . $amipseudo;
        echo "&nbsp;</div></a>";
        mkInput("hidden", "idRecherche", $ami);
        if($idUtilisateur!=$ami){
            if($liaison===0) {
                echo '&nbsp;&nbsp; <button class="btn" type="submit" style="background-color:#25fde9;color:black;" name="action" value="abonnement">S\'abonner</button>';
            }else{
                echo '&nbsp;&nbsp; <button class="btn" type="submit" style="background-color:#25fde9;color:black;" name="action" value="desabonner">Se désabonner</button>';
            }
        }
        echo "</div>";
		endForm();
	}
?>
</div>
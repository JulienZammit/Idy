<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=chat&" . $_SERVER["QUERY_STRING"]);
	die("");
}

if(!$_SESSION['idUtilisateur']){
    header("Location:../index.php?view=login");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibForms.php");

$idConv = valider("idConv");
$idUtilisateur = $_SESSION['idUtilisateur'];

if (!verifconv($idUtilisateur,$idConv) || !$idConv){
    header("Location:index.php?view=conversation");
    die("");
}
?>

<style>
.corps {
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
    <div class="modal fade" id="popupsondage" tabindex="-1" aria-labelledby="popupsondage" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupabosLabel">Choisissez le sondage à partager</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align: left;">
                    <?php
                    $idUtilisateur = $_SESSION['idUtilisateur'];
                    $sondage = getsondage($idUtilisateur);
                    mkForm("controleur.php");
                    foreach ($sondage as $sond){
                        echo $sond['Question'] . ' ';
                        mkInput("hidden",'idConv',$idConv);
                        mkInput("checkbox",$sond['idSondage'],$sond['idSondage'],"form-check-input");
                        echo "</br></br>";
                    }
                    mkInput("submit","action","Partager sondage","btn btn-info");
                    endform();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="popupabos" tabindex="-1" aria-labelledby="popupabos" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupabosLabel">Choisissez les membres de la conversation parmis vos abonnements</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align: left;">
                    <?php
                    $abonnement = getabonnement($idUtilisateur);
                    mkForm("controleur.php");
                    foreach ($abonnement as $abo){
                        $pseudo=getuserpseudowithid($abo['idUtilisateur']);
                        $avatar = getAvatar($abo['idUtilisateur']);
                        echo "<div style='display:inline-flex;'>";
                        echo "<label for=\"$abo[pseudo]\"><div id = \"avatarClick\" style=\"float:left;\">";
                        echo "<img src=\"" . $avatar . "\" height=\"40\" style = \"width:40px; clip-path:ellipse(50% 50%); \">";
                        echo "</div>";
                        echo "<div style='font-size:20px;float:left;color:black;'>&nbsp;@" .  $abo['pseudo'] . '&nbsp;';
                        echo "</div></label>";
                        mkInput("checkbox",$abo['pseudo'],$abo['idUtilisateur'],'','margin-top:10px;',"$abo[pseudo]");
                        echo "</div></br>";
                    }
                    mkInput("submit","action","Ajouter","btn btn-info");
                    endform();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <a href="index.php?view=conversation" style="display: inline-flex;text-decoration: none;outline: none;"><i class="fas fa-arrow-circle-left fa-3x" style="color:#25fde9;"></i><h4 style="color:black;">&nbsp;&nbsp;Retour</h4></a>
<?php
$dataConv = getConversation($idConv);
echo '<div class="corps" style="text-align: left; border: 1px solid black;width:65%;">';
echo "<h1 style=\"text-align:center;\">" . $dataConv['theme'] . "</h1>";

$nombremembreConv = getnombreUtilsateur($idConv);
echo "<h4> Nombre participants : " . $nombremembreConv . "</h4>";
if($nombremembreConv>2) {
    mkForm('controleur.php');
    mkInput("hidden", "idConv", $idConv);
    mkInput("submit", "action", "Quitter le groupe","btn btn-info","background-color:#25fde9; color:black;");
    endForm();
    //echo '<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#popupabos" style = "background-color:#25fde9; color:black;">Ajouter membre</button>';
}

echo "<hr>";

echo '<div class="row">';
$messages = listerMessages($idConv);
foreach($messages as $nextMessage) {
	echo '<div class="col-md-12">';
        if($nextMessage["idUtilisateur"]!=$_SESSION["idUtilisateur"]){
            echo '<div class="col" style="background-color:#dfe6e9;width:fit-content;padding:4px 4px 0.5px 4px;border-radius:15px;margin-bottom:5px;float:left;">';
               echo '<p style="width:auto;margin-top:5px;margin-right:5px;"><img src="'. $nextMessage["avatar"] .'" style="clip-path: ellipse(50% 50%);height: 32px;width: 32px;margin-right: 1px;margin-left:7px;"> <b>@'. $nextMessage["auteur"] . '</b> ' . $nextMessage["contenu"] . "</p>";
            echo "</div>";
        }else{
            echo '<div class="col" style="background-color:#25fde9;width:fit-content;padding:4px 4px 0.5px 4px;border-radius:15px;margin-bottom:5px;float:right;">';
               echo '<p style="width:auto;margin-top:5px;margin-right:5px;"><img src="'. $nextMessage["avatar"] .'" style="clip-path: ellipse(50% 50%);height: 32px;width: 32px;margin-right: 1px;margin-left:7px;"> <b>@'. $nextMessage["auteur"] . '</b> ' . $nextMessage["contenu"] . "</p>";
            echo "</div>";
        }
	echo "</div>";
}
echo "</div>";
?>

<?php
$dataConv = getConversation($idConv);
if ($dataConv["active"]==1)
	if (valider("connecte","SESSION")){
			mkForm("controleur.php");
			echo "<div style='display:flex;'>";
                mkInput("text","contenu","","form-control");
                mkInput("hidden","idConv",$idConv);
                mkInput("submit","action","Poster message","btn btn-info","background-color:#25fde9; color:black;");
                echo '<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#popupsondage" style = "background-color:#25fde9; color:black;">Envoyer sondage</button>';
            echo "</div>";
			endForm();
		}
echo '</div>';
echo '</div>';
?>
</div>

<script>
	function recharger(){
		window.location.reload();
	}
	window.setTimeout(recharger,60000);
</script>












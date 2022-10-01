<?php
// Ce fichier permet de tester les fonctions développées dans le fichier malibforms.php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) == "conversations.php")
{
	header("Location:../index.php?view=conversation");
	die("");
}

if(!$_SESSION['idUtilisateur']){
    header("Location:../index.php?view=login");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibForms.php");

$idUtilisateur = $_SESSION['idUtilisateur'];
$admin = isAdmin($idUtilisateur);
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

<div class="corps">
<div class="modal fade" id="popupabos" tabindex="-1" aria-labelledby="popupabos" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="popupabosLabel">Choisissez les membres de la conversation parmi vos abonnements</h5>
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
                        mkInput("checkbox",$abo['pseudo'],$abo['idUtilisateur'],'form-check-input','margin-top:10px;',"$abo[pseudo]");
                    echo "</div></br>";
                }
                echo "<br> Nom conversation : <div style='display:flex'>"; mkInput("text","theme","","form-control");
                mkInput("submit","action","Ajouter","btn btn-info");
                echo "</div>";
                endform();
                ?>
            </div>
        </div>
    </div>
</div>


<div style="text-align: left;">
<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#popupabos" style = "background-color:#25fde9; color:black;">Créer conversation</button>
    </br></br><h2>Liste des conversations</h2></br>


<?php
$conversations = listerConversations("actives", $idUtilisateur);
foreach($conversations as $conv){
    echo '<a style="text-decoration:none;color:black;" href=index.php?view=chat&idConv=' . $conv['id'] .'>';
    echo "<div><img src=\"./ressources/avatar/avatar.jpg\" height=\"50\" style = \"width:50px; clip-path:ellipse(50% 50%); \">&nbsp;";
    echo $conv['theme'] . '</div>';
    echo '</a></br>';
}

echo '</div>';
?>
</div>
</div>
















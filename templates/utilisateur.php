<?php

//C'est la propriété php_self qui nous l'indique :
// Quand on vient de index :
// [PHP_SELF] => /chatISIG/index.php
// Quand on vient directement par le répertoire templates
// [PHP_SELF] => /chatISIG/templates/sondage.php
if(valider("profilde"))
{
    $idUtilisateur =  valider("profilde");
}
else
{
    $idUtilisateur = $_SESSION['idUtilisateur'];
}

$pseudo = getpseudo($idUtilisateur);
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
// Pas de soucis de bufferisation, puisque c'est dans le cas où on appelle directement la page sans son contexte
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=utilisateur");
    die("");
}

if(!$_SESSION['idUtilisateur']){
	header("Location:../index.php?view=login");
}

include_once("libs/modele.php"); // listes
include_once("libs/maLibUtils.php");// tprint
include_once("libs/maLibForms.php");// mkTable, mkLiens, mkSelect ...

?>

<link rel="stylesheet" href="css/espaceutilisateur.css">

<style type="text/css">
	.corps {
    border: 0px solid white;
    border-radius: 20px;
    padding: 20px;
    min-width:30%;
    text-align: left;
    background-color:white;
    box-shadow: 1px 1px 12px #555;
}

#abonnes 
{
    border: 0px solid white;
    border-radius: 20px;
    padding: 20px;
    width:40%;
    text-align: left;
    margin: 0 auto;
}

#popupabos
{
    position :absolute;
    text-align: center;
    top: 15%;
    left: 0; bottom: 0; right: 0;
    margin:  auto;
}

#popuplikes
{
    position :absolute;
    text-align: center;
    top: 15%;
    left: 0; bottom: 0; right: 0;
    margin:  auto;
}

#abonne {
    display:block;
}

#abonnement {
    display:none;
}

#choix1 {
	display:block;
}

#choix2 {
	display:none;
}

#choix3 {
	display:none;
}

#choix4 {
	display:none;
}

#choixn1 {
	background-color: lightgray;
}

#choixn2 {
	background-color: white;
}

#choixn3 {
	background-color: white;
}

#choixn4 {
	background-color: white;
}

.unselectable { 
	-webkit-user-select: none; 
	-webkit-touch-callout: none; 
	-moz-user-select: none; 
	-ms-user-select: none; 
	user-select: none;
}

</style>

<div class="container" style="min-height: 100%;">
    <div class="row align-items-start">
	<div class = "profile">
	        <?php 
	        $banniere = getBanniere($idUtilisateur);
	        echo "<img src=\"" . $banniere . "\" style = \"width : 100%; border-radius: 10px;\">";
	        ?>
	</div>
	<div class="container mt-2">
        <div class="row justify-content-start">
            <div class="col-md-2">
        	       <?php 
        	        $avatar = getAvatar($idUtilisateur);
        	        $rang = rang($idUtilisateur);
        	        echo "<img src=\"" . $avatar . "\" class=\"photo\">";
        	        ?>
            </div>
            <div class="col-auto mt-1">
                <div class="row">
                    <div class="col-auto me-0" style="margin-right: 25px;">
                	    <h1 style='text-align: center'><strong>&nbsp;@<?= $pseudo ?></strong></h1>
                    </div>
                    <div class="col-sm mt-1">
                	    <div style="background-color: #25FDE9;height: 45px;width: 45px;border-radius: 10px;text-align: center;padding-top: 20%;">
                	        <?php   
                            echo '<strong style="text-align:center;">'.$rang.'</strong>';
                	        ?>
                        </div>
                    </div>
        	    </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                        <div class="col-md-6">
                            <?php  
                            $nbCoins = getCoins($idUtilisateur);
                            echo "<span>$nbCoins</span>";
                            ?>  
                            <img src="ressources/piece.png" height="30" style="margin-left: -10px;">
                        </div>
                        <div class="col-md-9">
                        <?php
                        $pourcentage = pourcentageRang($idUtilisateur);
                        if($pourcentage >= 100)
                        {
                            pourcentage0($idUtilisateur);
                            ajoutrang($idUtilisateur);
                        }
                        echo "<div class=\"progress mt-1\" style=\"width: 80%;\">";
                            echo "<div class=\"progress-bar progress-bar-striped progress-bar-animated\" role=\"progressbar\" aria-valuenow=\"" . $pourcentage . "\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:" . $pourcentage . "%\">" . $pourcentage . "%</div>";
                        echo "</div>";
                        echo '</div>';
                        echo '<div class="col-md-9 mt-2">';
                        echo '<div style="display:flex;">';
                        if($idUtilisateur===$_SESSION['idUtilisateur'] || !valider("profilde")) {
                            ?>
                            <a href="https://web-idy.com/index.php?view=edition"><button type="button" class="btn btn-info" style = "background-color:#25fde9;color:black;" href="?view=edition">Edition</button></a>
                            <?php
                        }
                        
                        echo '&nbsp;<button type="button" onclick="abonne();" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#popupabos" style = "background-color:#25fde9; color:black;">Abonnés</button>&nbsp;
                        <button type="button" onclick="abonnement();" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#popupabos" style = "background-color:#25fde9; color:black;">Abonnements</button>&nbsp;'; ?>                  
                        </div>  
        </div>
    </div>
</div>
</div>
</div>

<div class="modal fade" id="popupabos" tabindex="-1" aria-labelledby="popupabos" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <?php
		echo '<a onclick="abonne();"><h5 style="cursor:pointer;" class="modal-title" id="choixnum1">Abonnés</h5></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<a onclick="abonnement();"><h5 style="cursor:pointer;" class="modal-title" id="choixnum2">Abonnements</h5></a>';
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="abonne" style="text-align: left;">
        <?php
        $abonne = getabonne($idUtilisateur);
        foreach ($abonne as $abo){
            $pseudo=getuserpseudowithid($abo['idUtilisateur']);
            $avatar = getAvatar($abo['idUtilisateur']);

            echo "<div style='display:inline-flex;'>";
            echo "<a href=\"https://web-idy.com/index.php?view=utilisateur&profilde=" . $abo['idUtilisateur'] . "\">";
            echo "<div id = \"avatarClick\" style=\"float:left;\">";
            echo "<img src=\"" . $avatar . "\" height=\"50\" style = \"width:50px; clip-path:ellipse(50% 50%); \">";
            echo "</div>";
            echo "<div style='font-size:35px;float:left;color:black;'>&nbsp;@" .  $abo['pseudo'] . '&nbsp;';
            echo "</div></a>";
            echo "</div></br>";
        }
        ?>
      </div>
      <div class="modal-body" id="abonnement" style="text-align: left;">
        <?php
        $abonnement = getabonnement($idUtilisateur);
            foreach ($abonnement as $abo){
                $pseudo=getuserpseudowithid($abo['idUtilisateur']);
                $avatar = getAvatar($abo['idUtilisateur']);

                echo "<div style='display:inline-flex;'>";
                echo "<a href=\"https://web-idy.com/index.php?view=utilisateur&profilde=" . $abo['idUtilisateur'] . "\">";
                echo "<div id = \"avatarClick\" style=\"float:left;\">";
                echo "<img src=\"" . $avatar . "\" height=\"50\" style = \"width:50px; clip-path:ellipse(50% 50%); \">";
                echo "</div>";
                echo "<div style='font-size:35px;float:left;color:black;'>&nbsp;@" .  $abo['pseudo'] . '&nbsp;';
                echo "</div></a>";
                echo "</div></br>";
            }
        ?>
      </div>
    </div>
  </div>
</div>

<?php
if($idSondage=valider("voirresultat")){
$numchoix='0';
$sondage=selectSondagebyIdSOndage($idSondage);
?>
<div class="modal fade" id="popupresult">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <?php	
		echo '<a onclick="choix1(' . $sondage[0]['nbChoix'] .');"><h5 style="cursor:pointer;" class="modal-title" id="choixn1">Choix N°1</h5></a>&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<a onclick="choix2(' . $sondage[0]['nbChoix'] .');"><h5 style="cursor:pointer;" class="modal-title" id="choixn2">Choix N°2</h5></a>&nbsp;&nbsp;&nbsp;&nbsp;';
        if($sondage[0]['nbChoix']>'2'){ 
		echo '<a onclick="choix3('.$sondage[0]['nbChoix'].');"><h5 style="cursor:pointer;" class="modal-title" id="choixn3">Choix N°3</h5></a>&nbsp;&nbsp;&nbsp;&nbsp;';
        } 
        if($sondage[0]['nbChoix']>'3'){
		echo '<a onclick="choix4('.$sondage[0]['nbChoix'].');"><h5 style="cursor:pointer;" class="modal-title" id="choixn4">Choix N°4</h5></a>';
        }?>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?php
      $choix = getChoix($idSondage);
      foreach($choix as $newchoix){
      	  $personne=listepersonnereponse($newchoix["idChoix"]);
      	  $numchoix=$numchoix+1;
	      echo '<div class="modal-body" id="choix'.$numchoix.'" style="text-align: left;">';
	      foreach($personne as $newpersonne){
	      	$idUser=getuserid($newpersonne["pseudo"]);
  	        echo "<a style='text-decoration:none;' href=\"https://web-idy.com/index.php?view=utilisateur&profilde=" . $idUser . "\">";
            echo "<div id = \"avatarClick\" style=\"float:left;\">";
            $avatar = getAvatar($idUser);
            echo "<img src=\"" . $avatar . "\" height=\"50\" style = \"width:50px; clip-path:ellipse(50% 50%); \">";
            echo "</div>";
            echo "<div>";
            echo "<h1 style=\"color: black;font-size:20pt;\">@" . $newpersonne["pseudo"] . "</h1>";
            echo "</div>";
            echo "</a></br>";
	      }
	      echo '</div>';
  	  }
      ?>
    </div>
  </div>
</div>
<?php
}
?>

<hr style="margin-top:10px;margin-bottom:0px;">
<div style="display:flex;justify-content:space-around;">
<p class="p-3 mb-0 unselectable" style="cursor:pointer;border-bottom:5px solid deepskyblue;color:deepskyblue;" onclick="messondages();" id="messondagesbis"><strong>Mes Sondages</strong></p>
<p class="p-3 mb-0 unselectable" style="cursor:pointer;" onclick="sondagesaimes();" id="sondagesaimesbis"><strong>Sondages Aimés</strong></p>
</div>
<hr>


<div class='row' id='sondagesaimes' style='display:none;'>
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h3><strong>Liste de Vos Sondages Aimés</strong></h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="sondages" style="text-align: left;">
    <table class="table">
        <thead class="bg-dark text-light">
            <tr>
                <th scope="col">Question</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sondages = listesondagelikes($idUtilisateur);
        foreach ($sondages as $newSond)
        {
            echo "<div style='display:inline-flex; flex-direction: row; justify-content: space-around;'>";
            $question = getQuestion($newSond['idSondage']);
            echo "<tr><td>". $question ."</td>";
            echo "<td><a href=\" https://web-idy.com/index.php?view=sondage&idSondage=" . $newSond['idSondage'] . " \">";
            echo "<button type=\"button\" class=\"btn btn-info\" data-bs-toggle=\"modal\" style = \"background-color:#25fde9; color:black; float:right;\">Accéder au sondage</button>";
            echo "</a></td></tr>";
            
        }
        ?>
      </tbody>
    </table>
      </div>
    </div>
  </div>
</div>






<?php
echo "<div class='row' id='messondages' style='display:row;'>";
$messondages = getMysondage($idUtilisateur);
$messondages = array_reverse($messondages);
foreach($messondages as $iSondage) {
	$total=0;
	$idSondage = $iSondage["idSondage"];
	$question = getQuestion($idSondage);
	$choix = getChoix($idSondage);
	$total=getnbreponses($idSondage);
	$like=getlike($idSondage);
	echo "<div class='corps col m-3'>";
    echo "<div class='d-flex'><div class='question' style='font-size:25px;'><strong><a href='https://web-idy.com/index.php?view=sondage&idSondage=$idSondage'>" . $iSondage["Question"] . "</a></strong></div>";
    echo "<div class='ms-auto' style='font-size:25px;display:flex;'><strong>" . $like . "</strong><i class='fas fa-heart text-danger'></i></div></div>";
    ?>
    <table class="table">
        <thead class="bg-dark text-light">
            <tr>
                <th scope="col">Reponse</th>
                <th scope="col">Score</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($choix as $newchoix){
            $compteur=0;
            $personne = listepersonnereponse($newchoix["idChoix"]);
            foreach($personne as $ipersonne){
                $compteur = $compteur+1;
            }
            if($total!=0){
                $score = ($compteur / $total) * 100;
                $score = round($score);
            } else{
                $score= '0';
            }
            echo "<a href='https://web-idy.com/index.php?view=utilisateur'><tr><td>". $newchoix["Choix"] ."</td>";
            echo "<td>" . $score . "%</td></tr></a>";
        }
        ?>
        </tbody>
    </table>

    <?php
	$idSondage = $iSondage["idSondage"];
    echo('<form action="controleur.php" method="get" class="" style="
    display: flex;">');
    mkInput("hidden", "idSondage", $idSondage);
    echo "</br>";
    $profil=valider("profilde");
    if($profil===$_SESSION['idUtilisateur'] || !valider("profilde"))
    {
        echo '<button class="glow-on-hover btn btn-dark d-block mr-auto" style="margin-right:auto;" type="submit" name="action" value="Effacer le sondage">Effacer le sondage</button>';
    	echo '<a href="?view=utilisateur&voirresultat='. $idSondage .'"><button type="button" class="btn btn-info" style = "background-color:#25fde9;color:black;">Voir résultats</button></a>';
    }
    endForm();
	echo "</div>";
}
?>
</div>
</div>
</div>

<script>

function abonne(){
    var abonne = document.getElementById('abonne');
    var abonnement = document.getElementById('abonnement');
    var choixnum1 = document.getElementById('choixnum1');
    var choixnum2 = document.getElementById('choixnum2');

    abonne.style.display='block';
    abonnement.style.display='none';
    choixnum1.style.backgroundColor='lightgray';
    choixnum2.style.backgroundColor='white';
}

function abonnement(){
    var abonne = document.getElementById('abonne');
    var abonnement = document.getElementById('abonnement');
    var choixnum1 = document.getElementById('choixnum1');
    var choixnum2 = document.getElementById('choixnum2');

    abonne.style.display='none';
    abonnement.style.display='block';
    choixnum1.style.backgroundColor='white';
    choixnum2.style.backgroundColor='lightgray';
}

function choix1(nb){
    var choix1 = document.getElementById('choix1');
    var choix2 = document.getElementById('choix2');
    var choixn1 = document.getElementById('choixn1');
    var choixn2 = document.getElementById('choixn2');
    if (nb > 2){
        var choixn3 = document.getElementById('choixn3');
        var choix3 = document.getElementById('choix3');
    }
    if (nb > 3){
        var choixn4 = document.getElementById('choixn4');
        var choix4 = document.getElementById('choix4');
    }

    choix1.style.display='block';
    choix2.style.display='none';
    choixn1.style.backgroundColor='lightgray';
    choixn2.style.backgroundColor='white';
    if (nb > 2){
        choixn3.style.backgroundColor='white';
        choix3.style.display='none';
    }
    if (nb > 3){
    choixn4.style.backgroundColor='white';
    choix4.style.display='none';
    }
}

function choix2(nb){
    var choix1 = document.getElementById('choix1');
    var choix2 = document.getElementById('choix2');
    var choixn1 = document.getElementById('choixn1');
    var choixn2 = document.getElementById('choixn2');
    if (nb > 2){
        var choixn3 = document.getElementById('choixn3');
        var choix3 = document.getElementById('choix3');
    }
    if (nb > 3){
        var choixn4 = document.getElementById('choixn4');
        var choix4 = document.getElementById('choix4');
    }

    choix1.style.display='none';
    choix2.style.display='block';
    choixn1.style.backgroundColor='white';
    choixn2.style.backgroundColor='lightgray';
    if (nb > 2){
        choixn3.style.backgroundColor='white';
        choix3.style.display='none';
    }
    if (nb > 3){
    choixn4.style.backgroundColor='white';
    choix4.style.display='none';
    }
}

function choix3(nb){
    var choix1 = document.getElementById('choix1');
    var choix2 = document.getElementById('choix2');
    var choixn1 = document.getElementById('choixn1');
    var choixn2 = document.getElementById('choixn2');
    if (nb > 2){
        var choixn3 = document.getElementById('choixn3');
        var choix3 = document.getElementById('choix3');
    }
    if (nb > 3){
        var choixn4 = document.getElementById('choixn4');
        var choix4 = document.getElementById('choix4');
    }

    choix1.style.display='none';
    choix2.style.display='none';
    choixn1.style.backgroundColor='white';
    choixn2.style.backgroundColor='white';
    if (nb > 2){
        choixn3.style.backgroundColor='lightgray';
        choix3.style.display='block';
    }
    if (nb > 3){
        choixn4.style.backgroundColor='white';
        choix4.style.display='none';
    }
}

function choix4(nb){
    var choix1 = document.getElementById('choix1');
    var choix2 = document.getElementById('choix2');
    var choixn1 = document.getElementById('choixn1');
    var choixn2 = document.getElementById('choixn2');
    if (nb > 2){
        var choixn3 = document.getElementById('choixn3');
        var choix3 = document.getElementById('choix3');
    }
    if (nb > 3){
        var choixn4 = document.getElementById('choixn4');
        var choix4 = document.getElementById('choix4');
    }

    choix1.style.display='none';
    choix2.style.display='none';
    choixn1.style.backgroundColor='white';
    choixn2.style.backgroundColor='white';
    if (nb > 2){
        choixn3.style.backgroundColor='white';
        choix3.style.display='none';
    }
    if (nb > 3){
        choixn4.style.backgroundColor='lightgray';
        choix4.style.display='block';
    }
}

function messondages() {
 	var messondages = document.getElementById('messondages');
 	var messondagesbis = document.getElementById('messondagesbis');
 	var sondagesaimes = document.getElementById('sondagesaimes');
 	var sondagesaimesbis = document.getElementById('sondagesaimesbis');

 	messondages.style.display='flex';
 	sondagesaimes.style.display='none';
 	messondagesbis.style.borderBottom='5px solid black';
 	messondagesbis.style.color='deepskyblue';
 	messondagesbis.style.borderColor='deepskyblue';
 	sondagesaimesbis.style.borderBottom='0px';
 	sondagesaimesbis.style.color='black';
 	sondagesaimesbis.style.borderColor='black';
}

function sondagesaimes() {
	var messondages = document.getElementById('messondages');
 	var messondagesbis = document.getElementById('messondagesbis');
 	var sondagesaimes = document.getElementById('sondagesaimes');
 	var sondagesaimesbis = document.getElementById('sondagesaimesbis');

 	messondages.style.display='none';
 	sondagesaimes.style.display='flex';
 	messondagesbis.style.borderBottom='0px';
 	messondagesbis.style.color='black';
 	messondagesbis.style.borderColor='black';
 	sondagesaimesbis.style.borderBottom='5px solid black';
 	sondagesaimesbis.style.color='deepskyblue';
 	sondagesaimesbis.style.borderColor='deepskyblue';
}

</script>

<?php
if($idSondage=valider("voirresultat")){
?>
	<script>
	    window.onload = function() { 
	        $("#popupresult").modal('show');
	    };
	</script>

<?php
}
?>


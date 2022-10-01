
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=sondage");
	die("");
}

if(!$_SESSION['idUtilisateur']){
    header("Location:../index.php?view=login");
}
$idUtilisateur = $_SESSION["idUtilisateur"];

include_once("libs/modele.php"); // listes
include_once("libs/maLibUtils.php");// tprint
include_once("libs/maLibForms.php");// mkTable, mkLiens, mkSelect ...
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
        #abonne{
            height:100px;
            width:100px;
            padding:5px;
            position:absolute;
            top:50px;
            right:50px;
            display:none;
            background-color:yellow;
        }
    </style>


	<link rel="stylesheet" href="css/sondages.css">
</head>

<div class="container-xxl" style="margin-top: 120px;">
    <div class="row row-cols-3 justify-content-md-center">
    <?php /*
        $idSondage = valider('idSondage');
        $question = getQuestion($idSondage);
        $compteur1 =0;
        $compteur2=0;
        if($idSondage = valider('idSondage')){
            echo '<div id="tv" class="popup";\>';
            echo "<h3 style='text-align: center; padding-top:5px;'>" . $question . "</h3>";

            $personne = listepersonnereponse1($idSondage);

            foreach($personne as $ipersonne){
                $compteur1 = $compteur1+1;
            }
            $personne = listepersonnereponse2($idSondage);

            foreach($personne as $ipersonne) {
                $compteur2 = $compteur2+1;
            }
            $total = $compteur1 + $compteur2;
            $score1 = ($compteur1 / $total) * 100;
            $score2 = ($compteur2 / $total) * 100;
            $score1 = round($score1);
            $score2 = round($score2);
            if($total!==0) {
            	echo "<div class=\"stats\">";
                echo "<ul><li>" . $choix1 . " <span class=\"percent v". ceil($score1/10)*10  . "\">". $score1 ."% </span></li>";
                echo "<li>" . $choix2 . " <span class=\"percent v". ceil($score2/10)*10  . "\">". $score2 ."% </span></li></ul>";
                echo "</div>";
            }
            echo '</div>';
        }
        */
    ?>

<?php
            $idUtilisateur = $_SESSION['idUtilisateur'];
            echo '<div class="col-md-1 mt-5">';
                echo '<a class="plus" href="index.php?view=creationsondage"><i class="fas fa-plus-circle fa-5x" style="color:#25fde9;"></i></a><a href="index.php?view=creationsondage" style="text-decoration:none;"></a>';
            echo "</div>";


            if($idSondage = valider('idSondage', 'GET')){
                $sondage = selectSondagebyIdSOndage($idSondage);
                $sondage = array_reverse($sondage);
                if(!isset($sondage[0])){
                    $newurl = "index.php?view=sondage&error=" . urlencode("Ce sondage n'existe pas !");
                      header("Location: $newurl");      
                }
            }else{
                $sondage = selectSondageUser($idUtilisateur);
                $sondage = array_reverse($sondage);
            }
            if($sondage) 
            {
                foreach ($sondage as $newSondage) 
                {
                    echo "<div class='col-md-8 ms-5 me-5'>";
                    $utilisateur = $newSondage["Utilisateur"];
                    $idSondage = $newSondage["idSondage"];
                    $pseudo = getpseudo($utilisateur);
                    echo "<div class='sondage' id='tv'>";

                    echo "<div class = \"photo\" style=\"position: absolute; margin-top:-55px; margin-left:50px; \">";
                    echo "<img src=\"./ressources/carré.png\" height=\"50\" style = \"width:50px; clip-path:ellipse(50% 50%); \">";
                    echo "<div class = \"ranggg\" style=\"position: relative; margin-top:-45px; \">";
                    $rang = rang($utilisateur);
                    echo "<h4 style=\"color: black;margin-top:4px;\"><strong>" . $rang . "</strong></h4>";
                    echo "</div>";
                    echo "</div>";

                    echo "<a href=\"https://web-idy.com/index.php?view=utilisateur&profilde=" . $utilisateur . "\">";
                    echo "<div id = \"avatarClick\" style=\"margin-top:-55px; float:left;\">";
                    $avatar = getAvatar($utilisateur);
                    echo "<img src=\"" . $avatar . "\" height=\"50\" style = \"width:50px; clip-path:ellipse(50% 50%); \">";
                    echo "</div>";


                    echo "<div  style=\"position: absolute; margin-top:-47px; padding-left:80px; \">";
                    echo "<h1 style=\"color: black; margin-left:20px;font-size:20pt;\">@" . $pseudo . "</h1>";
                    echo "</div>";
                    echo "</a>";

                    if(empty(checkrepondu($idSondage, $idUtilisateur))) {
                        echo "<h3>" . $newSondage["Question"] . "</h3>";
                    }else{
                        $nombreReponseTotal = nombreReponseTotal($idSondage);
                        $question=$sondage[0]["Question"];
                        echo "<h2> $question </h2>";
                    }
                    echo "<div class='choix' style=\"height:225px;\">";
                    $choix = selectChoix($idSondage);
                    $typeSondage = getTypeSondage($idSondage);
                    if(empty(checkrepondu($idSondage, $idUtilisateur)))
                    {
                        if ($typeSondage == 'normal') {
                            foreach ($choix as $newchoix) {
                                //mkForm("controleur.php");
                                echo('<form action="controleur-sondage.php" method="get" class="formchoix">');
                                mkInput('submit', 'choix', $newchoix["Choix"], "inputchoix");
                                mkInput('hidden', 'idchoix', $newchoix["idChoix"]);
                                mkInput("hidden", "action", "RépondreChoix");
                                $idSondage = $newSondage["idSondage"];
                                mkInput("hidden", "idSondage", $idSondage);
                                endForm();
                            }
                        } 
                        else if ($typeSondage == 'image') 
                        {
                            foreach ($choix as $newchoix) 
                            {
                                $lien = getLienImage($newchoix["idChoix"]);
                                echo('<form action="controleur-sondage.php" method="get" class="formchoix">');
                                echo "<div class='choix1' style = \"margin: 5px; width: 100%;  display: flex; flex-direction: column; justify-content: space-around; \"><img src=\"" . $lien . "\" style = \" max-width: 100%; max-height: 100%; margin: 10px; border-radius: 10px; border: 5px solid white; margin-left: auto; margin-right: auto;\">";
                                    echo "<div class='desc' >";
                                        mkInput('submit', 'choix', $newchoix["Choix"], "btn", "background-color:#25fde9;");
                                    echo "</div>";
                                echo "</div>";
                                mkInput('hidden', 'idchoix', $newchoix["idChoix"]);
                                mkInput("hidden", "action", "RépondreChoix");
                                $idSondage = $newSondage["idSondage"];
                                mkInput("hidden", "idSondage", $idSondage);
                                endForm();
                            }
                        }
                        else if ($typeSondage == 'audio') 
                        {
                            foreach ($choix as $newchoix) 
                            {
                                $lien = getLienImage($newchoix["idChoix"]);
                                echo('<form action="controleur-sondage.php" method="get" class="formchoix">');
                                echo "<div class='choix1' style = \"margin: 5px; width: 100%;  display: flex; flex-direction: column; justify-content: space-around; \">";
                                echo "<audio controls src=" . $lien . ">Votre navigateur ne supporte pas les <code>audio</code></audio>";
                                    echo "<div class='desc' >";
                                        mkInput('submit', 'choix', $newchoix["Choix"], "btn", "background-color:#25fde9;");
                                    echo "</div>";
                                    
                                echo "</div>";
                                mkInput('hidden', 'idchoix', $newchoix["idChoix"]);
                                mkInput("hidden", "action", "RépondreChoix");
                                $idSondage = $newSondage["idSondage"];
                                mkInput("hidden", "idSondage", $idSondage);
                                endForm();
                            }
                        }
                    }
                    

                    else{
                        foreach($choix as $i){
                            $nombreReponse = nombreReponse($i['idChoix'],$idSondage);
                            $stat = ($nombreReponse/$nombreReponseTotal)*100;
                            $stat=round($stat);
                            echo "<div style='background-color: #25fde9;display: inline-block;margin-left: 10px;margin-right: 10px;width: -webkit-fill-available;color:white;height:$stat%;width: -moz-available;border-radius:5px;text-shadow: -0.5px 0 black, 0 0.5px black, 0.5px 0 black, 0 -0.5px black;'>";
                            echo "<h5 style=\"margin-bottom:0px;\">" .  $i["Choix"] . "</h5>";
                            echo "<p style=\"font-size:12px;font-weight:bold;\">$stat%</p>";
                            echo '</div>';
                        }
                    }
                    echo "</div>";
                    echo "</div>";
                     echo "</div>";
                    
                
                    // CHANGEMENT DE SONDAGE
                    echo '<div class="col-md-1 mt-4">';
                    echo '';
                    echo "<i class=\"fas fa-arrow-circle-right fa-5x\" style=\"color:#25fde9;margin-bottom:10px;margin-top:-10px;\" id=\"buttonnextsondage\"></i>";
                    echo "<i class=\"fas fa-arrow-circle-left fa-5x\" style=\"color:#25fde9;cursor:pointer;\" id=\"buttonbeforesondage\"></i>";
                    echo '<form action="controleur-sondage.php" method="get" style="display: none;" id="nextsondage">';
                    mkInput("hidden", "idSondage", $idSondage);
                    mkInput("hidden", "action", "sondagesuivant");
                    endForm();
                    echo '<form action="controleur-sondage.php" method="get" style="display: none;" id="beforesondage">';
                    mkInput("hidden", "idSondage", $idSondage);
                    mkInput("hidden", "action", "sondageavant");
                    endForm();
                    echo "</div>";
                    ?>
                    <div class="container" style="width: 66%;">
                      <div class="row g-0">
                        <div class="col-12">
                            <div class="p-3 border bg-light">
                                <div class="header-comment">
                                    <form action="controleur-sondage.php" method="get" style="display: inline;" id="likeform">
                                    <?php if(checklikeverif($idSondage,$idUtilisateur)!=NULL){
                                        echo'<i id="likebutton" class="fas fa-heart fa-2x" style="color: red;" onclick="unlikesondage();"></i></a>';
                                    }else{ echo'<i id="likebutton" class="far fa-heart fa-2x" onclick="likesondage();"></i></a>';}
                                    mkInput("hidden", "idSondage", $idSondage);
                                    if(checklikeverif($idSondage,$idUtilisateur)!=NULL){
                                        mkInput("hidden", "action", "UnLikeSondage");
                                    }else{
                                    mkInput("hidden", "action", "LikeSondage");
                                    }
                                    ?>
                                    </form>
                                    <i id="displaycomment" class="far fa-comment-dots fa-2x" onclick="displaycomment();"></i>
                                    <i class="fas fa-share-alt fa-2x" data-bs-toggle="modal" onclick="copierlien();"></i>
                                    <p><b id="numberlike"><?php echo(getlike($idSondage)); ?></b> personnes ont aimé ce sondage.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 overflow-auto" id="commentaire">
                            <?php /*
                            <div class="col bg-light" style="display: flex;border-left: 1px solid #dee2e6!important;">
                                <form action="controleur.php" method="get" style="display:contents;">
                                    <?php mkInput("hidden", "idSondage", $idSondage); ?>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control form-comment" placeholder="Veuillez taper un mot clé" aria-label="Commentaire">
                                    </div>
                                </form>
                            </div>
                            */ ?>

                            <div class="p-3 border bg-light" style="border-top: none !important;">
                                <div class="content-commentaire">
                                    <?php 

                                    $commentaires=listcommentaire($idSondage);
                                    $i=0;
                                    foreach($commentaires as $commentaire){
                                        $i=$i+1;
                                        $infouser=getinfouser($commentaire["idUtilisateur"]);
                                        echo "<div class=\"col-md-2\" style=\"float: right;\">";
                                        echo "<a href=\"https://web-idy.com/index.php?view=sondage&idSondage=$idSondage&repcom=$commentaire[idcommentaire]&comment=1\"><i class=\"fas fa-reply\" style=\"float:right;margin-top:11px;\"></i></a>";
                                        if(checklikecommentverif($commentaire["idcommentaire"],$idUtilisateur)!=NULL){
                                            echo"<form id=\"unlikecomment-$i\" method=\"get\" action=\"controleur-sondage.php\">";
                                                mkInput("hidden", "idcom", $commentaire["idcommentaire"]);
                                                mkInput("hidden", "idSondage", $idSondage);
                                                mkInput("hidden", "action", "UnLikeComment");
                                            echo "<i id=\"likebuttoncomment\" class=\"fas fa-heart\" style=\"color: red;\" onclick=\"document.getElementById('unlikecomment-$i').submit();\"></i>
                                            </form>";
                                        }else{
                                            echo"<form id=\"likecomment-$i\" method=\"get\" action=\"controleur-sondage.php\">";
                                                mkInput("hidden", "idcom", $commentaire["idcommentaire"]);
                                                mkInput("hidden", "idSondage", $idSondage);
                                                mkInput("hidden", "action", "LikeComment");
                                            echo "<i id=\"likebuttoncomment\" class=\"far fa-heart\" onclick=\"document.getElementById('likecomment-$i').submit();\"></i>
                                            </form>";
                                        }
                                        echo "</div>";

                                        echo"

                                        <p class=\"first-answer\"><a class=\"profilename\" href=\"https://web-idy.com/index.php?view=utilisateur&profilde=$infouser[idUtilisateur]\"><img src=\"$infouser[avatar]\">@$infouser[pseudo]</a> $commentaire[message]</p>

                                        <p style=\"float:right;font-size:9.5px;font-weight:bold;margin-right: 26px;\">$commentaire[nblike]</p>

                                        ";
                                        echo '<hr style="background-color: transparent;margin:0;">'; //correction d'un bug d'affichage
                                        if($commentaire["nbreponse"]!=0){
                                            echo "<div class=\"mainsubcomment\">";
                                            echo "<p class=\"sub-rep buttonsubcomment close\">Voir plus de réponses ($commentaire[nbreponse]) <i class=\"fas fa-chevron-down\"></i></p>";
                                            $subcomments=listsouscommentaire($commentaire["idcommentaire"]);
                                            echo "<div class=\"subcomment\">";
                                            foreach($subcomments as $subcomment){
                                                $infouser=getinfouser($subcomment["idUtilisateur"]);
                                                echo "<p class=\"subrepdisplay\" style=\"margin-left: 40px;\"><a class=\"profilename\" href=\"https://web-idy.com/index.php?view=utilisateur&profilde=$infouser[idUtilisateur]\"><img src=\"$infouser[avatar]\">@$infouser[pseudo]</a> $subcomment[message]</p></a>";
                                            }
                                            echo "</div>";
                                            echo "</div>";
                                        }
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php if($idcom=valider("repcom")){ $repcommentinfo=getcommentbyID($idcom); $infouser=getinfouser($repcommentinfo["idUtilisateur"]) ?>
                        <div class="col bg-light" style="border-left: 1px solid #dee2e6!important;border-bottom: 1px solid #dee2e6!important;padding-bottom: 10px;" id="publiercommentaire">
                            <form action="controleur-sondage.php" method="get" style="display:contents;">
                                <?php mkInput("hidden", "idSondage", $idSondage); ?>
                                <?php mkInput("hidden", "idcom", $idcom); ?>
                                <div class="col-md-3" style="margin-right: -20px;margin-top: 6px;margin-left: 15px;width: auto;margin-bottom: -20px;">
                                    <div class="card" style="height: 65%;background-color: none;">
                                        <div class="card-header" style="height: 104%;">
                                            <p style="margin-top:-3px;">Répondre <b>@<?php echo("$infouser[pseudo]"); ?></b></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9" style="width:45%;">
                                    <input type="text" class="form-control form-comment" placeholder="Ajouter un commentaire..." name="commentairecontent">
                                </div>
                                <div class="col-md-3">
                                    <input type="submit" class="glow-on-hover btn btn-dark d-block mx-auto btncomment" name="action" value="Répondre" style="width: 63%;">
                                </div>
                            </form>
                        </div>
                        <?php }else{ ?>
                        <div class="col bg-light" style="border-left: 1px solid #dee2e6!important;border-bottom: 1px solid #dee2e6!important;padding-bottom: 10px;" id="publiercommentaire">
                            <form action="controleur-sondage.php" method="get" style="display:contents;">
                                <?php mkInput("hidden", "idSondage", $idSondage); ?>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-comment" placeholder="Ajouter un commentaire..." name="commentairecontent">
                                </div>
                                <div class="col-md-3">
                                    <input type="submit" class="glow-on-hover btn btn-dark d-block mx-auto btncomment" name="action" value="Publier">
                                </div>
                            </form>
                        </div>

                    <?php } ?>
                      </div>
                    </div>

                    <div class="modal fade" id="popupshare" tabindex="-1" aria-labelledby="popupshare" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="popupshareLabel">Partager un sondage</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body" style="text-align: left;">
                            <div class="share"><i class="fab fa-facebook fa-2x"></i><p>Partager sur Facebook</p></div>
                            <div class="share"><i class="fab fa-twitter-square fa-2x"></i><p>Partager sur Twitter</p></div>
                            <div class="share"><i class="fab fa-instagram fa-2x"></i><p>Partager sur Instagram</p></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                }
            }else
            {
                echo '<div class="col-md-6">';
                echo "<img src=\"./ressources/logo.jpg\" style = \"text-align: center; clip-path:ellipse(50% 50%); \"> <h1> Vous avez répondu à tous les sondages, idy vous remercie !</h1>";
                echo "</div>";
                echo '<div class="col-md-1 mt-4">';
                echo "<i class=\"fas fa-arrow-circle-right fa-5x\" style=\"display:none;\" id=\"buttonnextsondage\"></i>";
                echo "<i class=\"fas fa-arrow-circle-left fa-5x\" style=\"color:#25fde9;cursor:pointer;\" id=\"buttonbeforesondage\"></i>";
                echo "</div>";
                echo '<form action="controleur-sondage.php" method="get" style="display: none;" id="beforesondage">';
                mkInput("hidden", "action", "sondageavant");
                endForm();
                echo '<form action="controleur-sondage.php" method="get" style="display: none;" id="nextsondage">';
                mkInput("hidden", "idSondage", $idSondage);
                mkInput("hidden", "action", "sondagesuivant");
                endForm();
                echo'<i id="likebutton" style="display:none;" class="fas fa-heart fa-2x" style="color: red;" onclick="unlikesondage();"></i></a>';
            }

           


?>

    <?php
        $xp = valider('xp');
        if($xp == true)
        {
           ?>
           <script>
            $("#xp").show();
            setTimeout(function() { $("#xp").hide(); }, 1000);
            </script>
            <?php
            $xp == false;
        }
    ?>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/JavaScript">

var form = document.getElementById("likeform");

document.getElementById("likebutton").addEventListener("click", function () {
  form.submit();
});

var formnext = document.getElementById("nextsondage");

document.getElementById("buttonnextsondage").addEventListener("click", function () {
  formnext.submit();
});

var formbefore = document.getElementById("beforesondage");

document.getElementById("buttonbeforesondage").addEventListener("click", function () {
  formbefore.submit();
});


function likesondage(){
  var unlikebutton = document.getElementById("likebutton");
  var likebutton = document.createElement("likedbutton");
  likebutton.innerHTML = '<i id="likedbutton" class="fas fa-heart fa-2x" style="color: red;" onclick="unlikesondage();"></i>';
  unlikebutton.parentNode.replaceChild(likebutton, unlikebutton);
}

function unlikesondage(){
  var likedbutton = document.getElementById("likebutton");
  var likebutton = document.createElement("likebutton");
  likebutton.innerHTML = '<i id="likebutton" class="far fa-heart fa-2x" onclick="likesondage();"></i>';
  likedbutton.parentNode.replaceChild(likebutton, likedbutton);
}

// function likecomment(){
//   var unlikebutton = document.getElementById("likebuttoncomment");
//   var likebutton = document.createElement("likedbuttoncomment");
//   likebutton.innerHTML = '<i id="likedbuttoncomment" class="fas fa-heart" style="color: red;" onclick="unlikecomment();"></i>';
//   unlikebutton.parentNode.replaceChild(likebutton, unlikebutton);
// }

// function unlikecomment(){
//   var likedbutton = document.getElementById("likedbuttoncomment");
//   var likebutton = document.createElement("likebuttoncomment");
//   likebutton.innerHTML = '<i id="likebuttoncomment" class="far fa-heart" onclick="likecomment();"></i>';
//   likedbutton.parentNode.replaceChild(likebutton, likedbutton);
// }

function displaycomment(){
  var commentaire = document.getElementById("commentaire");
  commentaire.style.display = "block";

  var publiercommentaire = document.getElementById("publiercommentaire");
  publiercommentaire.style.display = "flex";


  var displaycomment = document.getElementById("displaycomment");
  var hidecomment = document.createElement("hidecomment");
  hidecomment.innerHTML = '<i id="hidecomment" class="far fa-comment-dots fa-2x" onclick="hidecomment();"></i>';
  displaycomment.parentNode.replaceChild(hidecomment, displaycomment);
}

function copierlien()
{
    alert("lien copié !");
  }

function hidecomment(){
  var commentaire = document.getElementById("commentaire");
  commentaire.style.display = "none";

  var publiercommentaire = document.getElementById("publiercommentaire");
  publiercommentaire.style.display = "none";

  var hidecomment = document.getElementById("hidecomment");
  var displaycomment = document.createElement("displaycomment");
  displaycomment.innerHTML = '<i id="displaycomment" class="far fa-comment-dots fa-2x" onclick="displaycomment();"></i>';
  hidecomment.parentNode.replaceChild(displaycomment, hidecomment);
}
</script>
<script>
    $('.mainsubcomment .subcomment').hide(); // on cache les sous commentaires de base
    $('.mainsubcomment .buttonsubcomment').click(function() { //condition du click sur sous commentaire
        var subcomment = $(this).closest('.mainsubcomment');
        if(subcomment.hasClass('open')) {//si le commentaire est déjà ouvert alors on le cache
            subcomment.removeClass('open').addClass('close');
            $(this).siblings('.subcomment').hide();
        }else {//si le commentaire est déjà cache on le montre
            subcomment.removeClass('close').addClass('open');
            $(this).siblings('.subcomment').show();
        }
    });
</script>
<?php

if(valider('comment', 'GET')){
    echo "<script type='text/javascript'> window.onload=displaycomment; </script>";
}

?>
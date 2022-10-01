<?php

//C'est la propriété php_self qui nous l'indique :
// Quand on vient de index :
// [PHP_SELF] => /chatISIG/index.php
// Quand on vient directement par le répertoire templates
// [PHP_SELF] => /chatISIG/templates/sondage.php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
// Pas de soucis de bufferisation, puisque c'est dans le cas où on appelle directement la page sans son contexte
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=reponse");
    die("");
}

if(!$_SESSION['idUtilisateur']){
    header("Location:../index.php?view=login");
}

include_once("libs/modele.php"); // listes
include_once("libs/maLibUtils.php");// tprint
include_once("libs/maLibForms.php");// mkTable, mkLiens, mkSelect ...
?>
	 <link rel="stylesheet" href="css/reponse.css">

<?php
    $idSondage = valider('idSondage');
    $question = getQuestion($idSondage);
    $choix1 = getChoix1($idSondage);
    $choix2 = getChoix2($idSondage);
    $compteur1=0;
    $compteur2=0;
    $total=0;

    echo "<h3 style='text-align: center'> Voici les réponses à la question : " . $question . "</h3>";

    $personne = listepersonnereponse1($idSondage);

    echo "<div class='choix1' style=\"border: 2px solid black; text-align: center; padding: 10px; margin-bottom: 20px \">";
    echo "Voici les personnes qui ont voté pour : " . $choix1 . "</br>";
    foreach($personne as $ipersonne){
        echo $ipersonne["prénom"]. ', ';
        $compteur1 = $compteur1+1;
    }
    echo "</div>";

    $personne = listepersonnereponse2($idSondage);

    echo "<div class='choix2' style=\"border: 2px solid black; text-align: center; padding: 10px; margin-bottom: 20px \">";
    echo "Voici les personnes qui ont voté pour : " . $choix2 . "</br>";
    foreach($personne as $ipersonne){
        echo $ipersonne["prénom"] . ', ';
        $compteur2 = $compteur2+1;
    }
    echo "</div>";
    $total = $compteur1 + $compteur2;
    if($total!==0) {
        echo "<div class='resultat' style=\"border: 2px solid black; text-align: center; padding: 10px; margin-bottom: 20px \">";
        echo "Résultat : " . ($compteur1 / $total) * 100 . "% ont voté $choix1 et " . ($compteur2 / $total) * 100 . "% ont voté $choix2";
    }
    echo "</div>";

?>



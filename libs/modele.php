<?php
include_once("maLibSQL.pdo.php"); 
// définit les fonctions SQLSelect, SQLUpdate...

// function secure_password($user_pwd, $multi) {

// $crypt_options = ['cost' => 11, 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)];
// $hash = password_hash($user_pwd, PASSWORD_BCRYPT, $crypt_options);

// if($multi!==true && $multi!==false) {
//     if (password_verify($user_pwd, $table_pwd = $multi)) {
//         return true; // valid password
//     } else {
//         return false; // invalid password
//     }
// } else return $hash;

// }

///////////////////////////////////// Fonction Utilisateur //////////////////////////////////////////////////////////

function getmdpwithmail($mail){
    $mail = htmlentities($mail);
    $SQL ="SELECT mdp FROM Utilisateurs WHERE mail='$mail'";
    return SQLGetChamp($SQL);
}

function selectall(){
    $SQL = "SELECT * FROM Utilisateurs";
    return parcoursRs(SQLSelect($SQL));
}

function hashmdp($mail){
    $passe = "SELECT mdp FROM Utilisateurs WHERE mail='$mail'";
    $passe = SQLGetChamp($passe);
    $passe = password_hash($passe, PASSWORD_DEFAULT);
    $SQL = "UPDATE Utilisateurs SET mdp='$passe' WHERE mail='$mail'";
    return SQLUpdate($SQL);
}

function getcommentbyID($idcomment){
    $idcomment = htmlentities ($idcomment);
    $SQL="SELECT * FROM Commentaires WHERE idcommentaire='$idcomment'";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp[0];
}

function getabonnement($idUtilisateur){
    $idUtilisateur = htmlentities ($idUtilisateur);
    $SQL="SELECT * FROM ami a, Utilisateurs u WHERE a.idUtilisateur2=u.idUtilisateur AND a.idUtilisateur1='$idUtilisateur'";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp;
}

function getinfouser($idUtilisateur){
    $idUtilisateur = htmlentities ($idUtilisateur);
    $SQL="SELECT idUtilisateur,pseudo,avatar,banniere,admin,blacklist,rang FROM Utilisateurs WHERE idUtilisateur='$idUtilisateur'";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp[0];
}

function getabonne($idUtilisateur){
    $idUtilisateur = htmlentities ($idUtilisateur);
    $SQL="SELECT * FROM ami a, Utilisateurs u WHERE a.idUtilisateur1=u.idUtilisateur AND a.idUtilisateur2='$idUtilisateur'";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp;
}

function getuserpseudo($pseudo){
    $pseudo = htmlentities ($pseudo);
    $SQL="SELECT pseudo FROM Utilisateurs WHERE pseudo='$pseudo'";
    return SQLGetChamp($SQL);
}

function getadmin($idUtilisateur){
    $idUtilisateur = htmlentities ($idUtilisateur);
    $SQL="SELECT admin FROM Utilisateurs WHERE idUtilisateur=\"$idUtilisateur\"";
    return SQLGetChamp($SQL);
}


function blacklist($idUtilisateur){
    $idUtilisateur = htmlentities ($idUtilisateur);
    $SQL="UPDATE Utilisateurs
            SET blacklist = 1
            WHERE idUtilisateur='$idUtilisateur'";
    SQLUpdate($SQL);
}

function deblacklist($idUtilisateur){
    $idUtilisateur = htmlentities ($idUtilisateur);
    $SQL="UPDATE Utilisateurs
            SET blacklist = 0
            WHERE idUtilisateur='$idUtilisateur'";
    SQLUpdate($SQL);
}

function getblacklist($idUtilisateur){
    $idUtilisateur = htmlentities ($idUtilisateur);
    $SQL="SELECT blacklist FROM Utilisateurs WHERE idUtilisateur=\"$idUtilisateur\"";
    return SQLGetChamp($SQL);
}

function getuserid($pseudo){
    $pseudo = htmlentities ($pseudo);
    $SQL="SELECT idUtilisateur FROM Utilisateurs WHERE pseudo='$pseudo'";
    return SQLGetChamp($SQL);
}

function getuserpseudowithid($id){
    $id = htmlentities ($id);
    $SQL="SELECT pseudo FROM Utilisateurs WHERE idUtilisateur='$id'";
    return SQLGetChamp($SQL);
}

function getusermail($mail){
    $mail = htmlentities ($mail);
    $SQL="SELECT mail FROM Utilisateurs WHERE mail='$mail'";
    return SQLGetChamp($SQL);
}

function getinscription($pseudo, $mail, $password, $date){
    $pseudo = htmlentities ($pseudo); $mail = htmlentities ($mail); $password = htmlentities ($password); $telephone = htmlentities ($telephone);
    //$password=secure_password($password, true);
    $SQL = "INSERT INTO Utilisateurs VALUES(NULL ,'$pseudo','$mail','$password','$date','0','0','0','0','./ressources/avatar/avatar.jpg','./ressources/bannieres/idy.jpg','0','0')";
    SQLInsert($SQL);
}

function verifUserBdd($login,$passe){
    $login = htmlentities($login); $passe = htmlentities($passe);
    $SQL="SELECT idUtilisateur FROM Utilisateurs WHERE mail='$login' AND mdp='$passe'";
    return SQLGetChamp($SQL);
}

function getpseudo($utilisateur){
    $utilisateur=htmlentities ($utilisateur);
    $SQL = "SELECT pseudo FROM Utilisateurs u WHERE idUtilisateur='$utilisateur'";
    return SQLGetChamp($SQL);
}

function getChoix($idSondage){
    $idSondage = htmlentities($idSondage);
    $SQL = "SELECT * FROM Choix WHERE Sondage='$idSondage'";
    return SQLSelect($SQL);
}

function getAmi($pseudo){
    $pseudo = htmlentities($pseudo);
    $SQL = "SELECT idUtilisateur FROM Utilisateurs WHERE pseudo='$pseudo'";
    return SQLGetChamp($SQL);
}

function updtAvatar($idUtilisateur,$lien)
{
    $idUtilisateur = htmlentities($idUtilisateur);
    $lien = htmlentities($lien);
    $SQL = "UPDATE Utilisateurs SET avatar = '$lien' WHERE idUtilisateur = '$idUtilisateur'";
    SQLUpdate($SQL);
}

function getAvatar($idUtilisateur)
{
    $idUtilisateur = htmlentities($idUtilisateur);
    $SQL = "SELECT avatar FROM Utilisateurs WHERE idUtilisateur ='$idUtilisateur'";
    return SQLGetChamp($SQL);
}

function updtBanniere($idUtilisateur,$lien)
{
    $idUtilisateur = htmlentities($idUtilisateur);
    $lien = htmlspecialchars ($lien);
    $SQL = "UPDATE Utilisateurs SET banniere = '$lien' WHERE idUtilisateur = '$idUtilisateur'";
    SQLUpdate($SQL);
}

function getBanniere($idUtilisateur)
{
    $idUtilisateur = htmlentities($idUtilisateur);
    $SQL = "SELECT banniere FROM Utilisateurs WHERE idUtilisateur ='$idUtilisateur'";
    return SQLGetChamp($SQL);
}

function afficherUser($idUtilisateur){
    $idUtilisateur = htmlentities($idUtilisateur);
    $SQL = "SELECT * FROM Utilisateurs WHERE idUtilisateur != '$idUtilisateur'";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp;
}

function abonnement($idUtilisateur1, $idUtilisateur2){
    $idUtilisateur1 = htmlentities($idUtilisateur1);
    $idUtilisateur2 = htmlentities($idUtilisateur2);
    $SQL = "INSERT INTO ami value('$idUtilisateur1','$idUtilisateur2','0')";
    SQLInsert($SQL);
}

function desabonner($idUtilisateur1, $idUtilisateur2){
    $idUtilisateur1 = htmlentities($idUtilisateur1);
    $idUtilisateur2 = htmlentities($idUtilisateur2);
    $SQL = "DELETE FROM `ami` WHERE idUtilisateur1='$idUtilisateur1' AND idUtilisateur2='$idUtilisateur2'";
    SQLDelete($SQL);
}

function getliaison($idUtilisateur1, $idUtilisateur2){
    $idUtilisateur1 = htmlentities($idUtilisateur1);
    $idUtilisateur2 = htmlentities($idUtilisateur2);
    $SQL = "SELECT idUtilisateur1 FROM ami WHERE idUtilisateur1 = '$idUtilisateur1' AND idUtilisateur2 = '$idUtilisateur2'";
    $liaison = SQLGetChamp($SQL);
    if($liaison){
        return 1;
    }else{
        return 0;
    }
}

function compterAbonnement($idUtilisateur1){
    $idUtilisateur1 = htmlentities($idUtilisateur1);
    $SQL = "SELECT COUNT(idUtilisateur1) FROM ami WHERE idUtilisateur1 = '$idUtilisateur1'";
    return SQLGetChamp($SQL);
}

function compterAbonne($idUtilisateur1){
    $idUtilisateur1 = htmlentities($idUtilisateur1);
    $SQL = "SELECT COUNT(idUtilisateur2) FROM ami WHERE idUtilisateur2 = '$idUtilisateur1'";
    return SQLGetChamp($SQL);
}

function afficherami($idUtilisateur){
    $idUtilisateur = htmlentities($idUtilisateur);
    $SQL = "SELECT * FROM ami WHERE idUtilisateur2='$idUtilisateur' AND statut = 2";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp;
}

function idcreateurSondage($idSondage){
    $idSondage = htmlentities($idSondage);
    $SQL = "SELECT Utilisateur FROM Sondages WHERE idSondage ='$idSondage'";
    return SQLGetChamp($SQL);
}

function getstatut($idUtilisateur1, $idUtilisateur2){
    $idUtilisateur1 = htmlentities($idUtilisateur1);
    $idUtilisateur2 = htmlentities($idUtilisateur2);
    $SQL = "SELECT statut FROM ami WHERE idUtilisateur1='$idUtilisateur1' AND idUtilisateur2='$idUtilisateur2'";
    return SQLGetChamp($SQL);
}

function isAdmin($idUtilisateur){
    $idUtilisateur = htmlentities($idUtilisateur);
    $SQL = "SELECT admin FROM Utilisateurs WHERE idUtilisateur ='$idUtilisateur'";
    return SQLGetChamp($SQL);
}

function changermdp($id,$mdp){
    $id = htmlentities($id);
    $mdp = htmlentities($mdp);
    $SQL = "UPDATE Utilisateurs SET mdp='$mdp' WHERE idUtilisateur='$id'";
    return SQLUpdate($SQL);
}

function changerpseudo($id,$pseudo){
    $id = htmlentities($id);
    $pseudo = htmlentities($pseudo);
    $SQL = "UPDATE Utilisateurs SET pseudo='$pseudo' WHERE idUtilisateur='$id'";
    return SQLUpdate($SQL);
}

////////////////////////////////////// Fonction Commentaire //////////////////////////////////////////////////////////////

function checkrepondu($idSondage,$idUtilisateur){
    $idSondage = htmlentities ($idSondage);$idUtilisateur = htmlentities ($idUtilisateur);
    $SQL="SELECT idReponse FROM Reponses WHERE sondage='$idSondage' AND utilisateur='$idUtilisateur'";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp;
}

function commenter($idUtilisateur,$message,$idsondage){
    $idUtilisateur = htmlentities ($idUtilisateur); $message = htmlentities ($message); $idsondage = htmlentities ($idsondage);
    //$password=secure_password($password, true);
    $SQL = "INSERT INTO Commentaires VALUES(NULL ,'$idsondage','$idUtilisateur','$message','0','0')";
    SQLInsert($SQL);
}

function checklikecommentverif($idcom,$idUtilisateur){
    $idcom = htmlentities ($idcom); $idUtilisateur = htmlentities ($idUtilisateur);
    $SQL="SELECT idlike FROM Commentairelike WHERE idCommentaire='$idcom' AND idUtilisateur='$idUtilisateur'";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp;
}

function likecommentaire($idCommentaire,$idUtilisateur){
    $idCommentaire = htmlentities ($idCommentaire); $idUtilisateur = htmlentities ($idUtilisateur);
    $SQL="SELECT nblike FROM Commentaires WHERE idcommentaire='$idCommentaire'";
    $nblike=SQLGetChamp($SQL);
    $nblike=$nblike+1;
    $SQL="UPDATE Commentaires
            SET nblike = $nblike
            WHERE idcommentaire='$idCommentaire'";
    SQLUpdate($SQL);
    SQLInsert("INSERT INTO Commentairelike VALUES(NULL,'$idCommentaire','$idUtilisateur')");
}

function unlikecommentaire($idCommentaire,$idUtilisateur){
    $idCommentaire = htmlentities ($idCommentaire); $idUtilisateur = htmlentities ($idUtilisateur);
    $SQL="SELECT nblike FROM Commentaires WHERE idcommentaire='$idCommentaire'";
    $nblike=SQLGetChamp($SQL);
    $nblike=$nblike-1;
    $SQL="UPDATE Commentaires
            SET nblike = $nblike
            WHERE idcommentaire='$idCommentaire'";
    SQLUpdate($SQL);
    $SQL = "DELETE FROM Commentairelike WHERE idCommentaire='$idCommentaire' AND idUtilisateur=$idUtilisateur";
    SQLDelete($SQL);
}

function listcommentaire($idSondage)
{
    $idSondage=htmlentities ($idSondage);
    $SQL = "SELECT * FROM Commentaires WHERE idSondage='$idSondage' ORDER BY nblike DESC";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp;
}

function souscommenter($idUtilisateur,$message,$idcommentaire){
    $idUtilisateur = htmlentities ($idUtilisateur); $message = htmlentities ($message); $idcommentaire = htmlentities ($idcommentaire);
    $SQL="SELECT nbreponse FROM Commentaires WHERE idcommentaire='$idcommentaire'";
    $nbreponse=SQLGetChamp($SQL);
    $nbreponse=$nbreponse+1;
    $SQL="UPDATE Commentaires
            SET nbreponse = $nbreponse
            WHERE idcommentaire='$idcommentaire'";
    SQLUpdate($SQL);

    $idUtilisateur = htmlentities ($idUtilisateur); $message = htmlentities ($message);
    //$password=secure_password($password, true);
    $SQL = "INSERT INTO SousCommentaires VALUES(NULL ,'$idUtilisateur','$idcommentaire','$message')";
    SQLInsert($SQL);
}

function listsouscommentaire($idcommentaire){
    $idcommentaire = htmlentities ($idcommentaire);
    $SQL="SELECT * FROM SousCommentaires WHERE idcommentaire='$idcommentaire'";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp;
}

////////////////////////////////////// Fonction sondage ////////////////////////////////////////////////////////////

function getsondage($idUtilisateur){
    $idUtilisateur = htmlentities($idUtilisateur);
    $SQL = "SELECT * FROM Sondages WHERE Utilisateur='$idUtilisateur'";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp;
}

function sondageprecedant($idUser){
    $idUser = htmlentities ($idUser);
    $SQL="SELECT idSondageSuivant FROM SondageSuivant WHERE idUtilisateur='$idUser' ORDER BY idSondageSuivant DESC LIMIT 1";
    $idsondagepre=SQLGetChamp($SQL);
    $SQL = "DELETE FROM SondageSuivant WHERE idSondageSuivant='$idsondagepre' AND idUtilisateur='$idUser'";
    SQLDelete($SQL);
}

function getlike($idSondage){
    $idSondage = htmlentities ($idSondage);
    $SQL="SELECT nblike FROM Sondages WHERE idSondage='$idSondage'";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp[0]["nblike"];
}

function likesondage($idSondage,$idUtilisateur){
    $idSondage = htmlentities ($idSondage);$idUtilisateur = htmlentities ($idUtilisateur);
    $SQL="SELECT nblike FROM Sondages WHERE idSondage='$idSondage'";
    $nblike=SQLGetChamp($SQL);
    $nblike=$nblike+1;
    $SQL="UPDATE Sondages
            SET nblike = $nblike
            WHERE idSondage='$idSondage'";
    SQLUpdate($SQL);
    SQLInsert("INSERT INTO Sondagelike VALUES(NULL,'$idSondage','$idUtilisateur')");
}

function unlikesondage($idSondage,$idUtilisateur){
    $idSondage = htmlentities ($idSondage);$idUtilisateur = htmlentities ($idUtilisateur);
    $SQL="SELECT nblike FROM Sondages WHERE idSondage='$idSondage'";
    $nblike=SQLGetChamp($SQL);
    $nblike=$nblike-1;
    $SQL="UPDATE Sondages
            SET nblike = $nblike
            WHERE idSondage='$idSondage'";
    SQLUpdate($SQL);
    $SQL = "DELETE FROM Sondagelike WHERE idSondage='$idSondage' AND idUtilisateur=$idUtilisateur";
    SQLDelete($SQL);
}

function listesondagelikes($idUtilisateur){
    $idUtilisateur = htmlentities ($idUtilisateur);
    $SQL="SELECT idSondage FROM Sondagelike WHERE idUtilisateur='$idUtilisateur'";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp;
}

function checklikeverif($idSondage,$idUtilisateur){
    $idSondage = htmlentities ($idSondage);$idUtilisateur = htmlentities ($idUtilisateur);
    $SQL="SELECT idlike FROM Sondagelike WHERE idSondage='$idSondage' AND idUtilisateur='$idUtilisateur'";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp;
}

function checkreponse($idSondage,$idUtilisateur){
    $idSondage = htmlentities ($idSondage);$idUtilisateur = htmlentities ($idUtilisateur);
    $SQL="SELECT idReponse FROM Reponses WHERE sondage='$idSondage' AND utilisateur='$idUtilisateur'";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp[0];
}

function ajoutersondage($idUtilisateur){
    $idUtilisateur = htmlentities($idUtilisateur);
    $SQL = "UPDATE Utilisateurs
	        SET nbSondagesCréés = nbSondagesCréés + 1
	        WHERE idUtilisateur='$idUtilisateur';";
    SQLUpdate($SQL);
}

function creersondage($idUtilisateur,$question,$nbChoix,$premierchoix,$secondchoix,$troisiemechoix="",$quatriemechoix="")
{
    $question = htmlentities ($question); $premierchoix = htmlentities ($premierchoix); $secondchoix = htmlentities ($secondchoix); $troisiemechoix = htmlentities ($troisiemechoix); $quatriemechoix = htmlentities ($quatriemechoix);$idUtilisateur=htmlentities ($idUtilisateur);$nbChoix=htmlentities ($nbChoix);
    $SQL = "INSERT INTO Sondages VALUES(NULL, '$idUtilisateur', '$question', '0','$nbChoix','0','normal')";
    SQLInsert($SQL);
    $SQL = "SELECT idSondage FROM Sondages WHERE Utilisateur = '$idUtilisateur' AND Question = '$question'  order by idSondage desc";
    $SQL_Retour = SQLSelect($SQL);
    $SQLId = $SQL_Retour->fetch();
    SQLInsert("INSERT INTO Choix VALUES('$SQLId[0]', NULL, '$premierchoix')");
    SQLInsert("INSERT INTO Choix VALUES('$SQLId[0]', NULL, '$secondchoix')");
    if($nbChoix=='3'){
        SQLInsert("INSERT INTO Choix VALUES('$SQLId[0]', NULL, '$troisiemechoix')");
    } elseif ($nbChoix=='4'){
        SQLInsert("INSERT INTO Choix VALUES('$SQLId[0]', NULL, '$troisiemechoix')");
        SQLInsert("INSERT INTO Choix VALUES('$SQLId[0]', NULL, '$quatriemechoix')");
    }
}

function creersondageImage($idUtilisateur, $question, $nbChoix, $premierlien, $desc1, $secondlien, $desc2, $troisiemelien="", $desc3="", $quatriemelien="",$desc4="")
{
    $idUtilisateur=htmlentities ($idUtilisateur);$nbChoix=htmlentities ($nbChoix);
    $question = htmlentities ($question);
    $premierlien = htmlentities ($premierlien); $secondlien = htmlentities ($secondlien); $troisiemelien = htmlentities ($troisiemelien); $quatriemelien = htmlentities ($quatriemelien);
    $desc1 = htmlentities ($desc1); $desc2 = htmlentities ($desc2); $desc3 = htmlentities ($desc3); $desc4 = htmlentities ($desc4);

    $SQL = "INSERT INTO Sondages VALUES(NULL, '$idUtilisateur', '$question', '0','$nbChoix','0', 'image')";
    SQLInsert($SQL);
    $SQL = "SELECT idSondage FROM Sondages WHERE Utilisateur = '$idUtilisateur' AND Question = '$question'  order by idSondage desc";
    $SQL_Retour = SQLSelect($SQL);
    $SQLId = $SQL_Retour->fetch();
    SQLInsert("INSERT INTO Choix VALUES('$SQLId[0]', NULL, '$desc1')");

    $SQL = "SELECT idChoix FROM Choix WHERE Sondage = '$SQLId[0]' order by idChoix desc";
    $SQL_Retour = SQLSelect($SQL);
    $SQLIdChoix = $SQL_Retour->fetch();

    SQLInsert("INSERT INTO sondageImage VALUES('$SQLIdChoix[0]',NULL, '$premierlien', '$SQLId[0]')");


    SQLInsert("INSERT INTO Choix VALUES('$SQLId[0]', NULL, '$desc2')");

    $SQL = "SELECT idChoix FROM Choix WHERE Sondage = '$SQLId[0]' order by idChoix desc";
    $SQL_Retour = SQLSelect($SQL);
    $SQLIdChoix = $SQL_Retour->fetch();

    SQLInsert("INSERT INTO sondageImage VALUES('$SQLIdChoix[0]',NULL, '$secondlien', '$SQLId[0]')");
    if($nbChoix=='3')
    {
        SQLInsert("INSERT INTO Choix VALUES('$SQLId[0]', NULL, '$desc3')");

        $SQL = "SELECT idChoix FROM Choix WHERE Sondage = '$SQLId[0]' order by idChoix desc";
        $SQL_Retour = SQLSelect($SQL);
        $SQLIdChoix = $SQL_Retour->fetch();

        SQLInsert("INSERT INTO sondageImage VALUES('$SQLIdChoix[0]', NULL, '$troisiemelien','$SQLId[0]')");
    } else if ($nbChoix=='4'){
        SQLInsert("INSERT INTO Choix VALUES('$SQLId[0]', NULL, '$desc3')");

        $SQL = "SELECT idChoix FROM Choix WHERE Sondage = '$SQLId[0]' order by idChoix desc";
        $SQL_Retour = SQLSelect($SQL);
        $SQLIdChoix = $SQL_Retour->fetch();

        SQLInsert("INSERT INTO sondageImage VALUES('$SQLIdChoix[0]', NULL, '$troisiemelien', '$SQLId[0]')");

        SQLInsert("INSERT INTO Choix VALUES('$SQLId[0]', NULL, '$desc4')");

        $SQL = "SELECT idChoix FROM Choix WHERE Sondage = '$SQLId[0]' order by idChoix desc";
        $SQL_Retour = SQLSelect($SQL);
        $SQLIdChoix = $SQL_Retour->fetch();

        SQLInsert("INSERT INTO sondageImage VALUES('$SQLIdChoix[0]', NULL, '$quatriemelien', '$SQLId[0]')");
    }
}

function creersondageAudio($idUtilisateur, $question, $nbChoix, $premierlien, $desc1, $secondlien, $desc2, $troisiemelien="", $desc3="", $quatriemelien="",$desc4="")
{
    $idUtilisateur=htmlentities ($idUtilisateur);$nbChoix=htmlentities ($nbChoix);
    $question = htmlentities ($question);
    $premierlien = htmlentities ($premierlien); $secondlien = htmlentities ($secondlien); $troisiemelien = htmlentities ($troisiemelien); $quatriemelien = htmlentities ($quatriemelien);
    $desc1 = htmlentities ($desc1); $desc2 = htmlentities ($desc2); $desc3 = htmlentities ($desc3); $desc4 = htmlentities ($desc4);

    $SQL = "INSERT INTO Sondages VALUES(NULL, '$idUtilisateur', '$question', '0','$nbChoix','0', 'audio')";
    SQLInsert($SQL);
    $SQL = "SELECT idSondage FROM Sondages WHERE Utilisateur = '$idUtilisateur' AND Question = '$question'  order by idSondage desc";
    $SQL_Retour = SQLSelect($SQL);
    $SQLId = $SQL_Retour->fetch();
    SQLInsert("INSERT INTO Choix VALUES('$SQLId[0]', NULL, '$desc1')");

    $SQL = "SELECT idChoix FROM Choix WHERE Sondage = '$SQLId[0]' order by idChoix desc";
    $SQL_Retour = SQLSelect($SQL);
    $SQLIdChoix = $SQL_Retour->fetch();

    SQLInsert("INSERT INTO sondageImage VALUES('$SQLIdChoix[0]',NULL, '$premierlien', '$SQLId[0]')");


    SQLInsert("INSERT INTO Choix VALUES('$SQLId[0]', NULL, '$desc2')");

    $SQL = "SELECT idChoix FROM Choix WHERE Sondage = '$SQLId[0]' order by idChoix desc";
    $SQL_Retour = SQLSelect($SQL);
    $SQLIdChoix = $SQL_Retour->fetch();

    SQLInsert("INSERT INTO sondageImage VALUES('$SQLIdChoix[0]',NULL, '$secondlien', '$SQLId[0]')");
    if($nbChoix=='3')
    {
        SQLInsert("INSERT INTO Choix VALUES('$SQLId[0]', NULL, '$desc3')");

        $SQL = "SELECT idChoix FROM Choix WHERE Sondage = '$SQLId[0]' order by idChoix desc";
        $SQL_Retour = SQLSelect($SQL);
        $SQLIdChoix = $SQL_Retour->fetch();

        SQLInsert("INSERT INTO sondageImage VALUES('$SQLIdChoix[0]', NULL, '$troisiemelien', '$SQLId[0]')");
    } else if ($nbChoix=='4'){
        SQLInsert("INSERT INTO Choix VALUES('$SQLId[0]', NULL, '$desc3')");

        $SQL = "SELECT idChoix FROM Choix WHERE Sondage = '$SQLId[0]' order by idChoix desc";
        $SQL_Retour = SQLSelect($SQL);
        $SQLIdChoix = $SQL_Retour->fetch();

        SQLInsert("INSERT INTO sondageImage VALUES('$SQLIdChoix[0]', NULL, '$troisiemelien', '$SQLId[0]')");

        SQLInsert("INSERT INTO Choix VALUES('$SQLId[0]', NULL, '$desc4')");

        $SQL = "SELECT idChoix FROM Choix WHERE Sondage = '$SQLId[0]' order by idChoix desc";
        $SQL_Retour = SQLSelect($SQL);
        $SQLIdChoix = $SQL_Retour->fetch();

        SQLInsert("INSERT INTO sondageImage VALUES('$SQLIdChoix[0]', NULL, '$quatriemelien', '$SQLId[0]')");
    }
}

function getTypeSondage($idSondage){
    $idSondage=htmlentities ($idSondage);
    $SQL = "SELECT typeSondage FROM Sondages WHERE idSondage='$idSondage'";
    return SQLGetChamp($SQL);
}

function getLienImage($idChoix)
{
    $idChoix=htmlentities ($idChoix);
    $SQL = "SELECT lien FROM sondageImage WHERE idChoix = '$idChoix'";
    return SQLGetChamp($SQL);
}


function selectSondage($idUtilisateur)
{
    $idUtilisateur=htmlentities ($idUtilisateur);
    $SQL = "SELECT * FROM Sondages s, Choix c WHERE s.idSondage NOT IN (SELECT sondage FROM Reponses WHERE Utilisateur = '$idUtilisateur') AND s.idSondage=c.Sondage";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp;
}

function selectSondagebyIdSOndage($idSondage)
{
    $idSondage=htmlentities ($idSondage);
    $SQL = "SELECT * FROM Sondages s, Choix c WHERE s.idSondage='$idSondage' AND s.idSondage=c.Sondage LIMIT 1";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp;
}

function selectSondageUser($idUtilisateur)
{
    $idUtilisateur=htmlentities ($idUtilisateur);
    $SQL = "SELECT * FROM Sondages s, Choix c WHERE s.idSondage NOT IN (SELECT idSondage FROM SondageSuivant WHERE idUtilisateur = '$idUtilisateur') AND s.idSondage=c.Sondage ORDER BY s.idSondage ASC LIMIT 1";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp;
}

function selectChoix($idSondage){
    $idSondage=htmlentities ($idSondage);
    $SQL = "SELECT * FROM Choix WHERE Sondage ='$idSondage'";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp;
}

function nombreReponseTotal($idSondage){
    $idSondage=htmlentities ($idSondage);
    $SQL = "SELECT COUNT(idChoix) FROM Reponses WHERE sondage ='$idSondage'";
    return SQLGetChamp($SQL);
}

function nombreReponse($idChoix, $idSondage){
    $idSondage=htmlentities ($idSondage);
    $idChoix=htmlentities ($idChoix);
    $SQL = "SELECT COUNT(idChoix) FROM Reponses WHERE sondage ='$idSondage' AND idChoix='$idChoix'";
    return SQLGetChamp($SQL);
}

function sondagesuivant($idSondage,$idUtilisateur){
    $idSondage=htmlentities ($idSondage);
    $idUtilisateur=htmlentities ($idUtilisateur);
    SQLInsert("INSERT INTO SondageSuivant VALUES(NULL, '$idSondage','$idUtilisateur')");
}

function checksondagesuivant($idSondage,$idUtilisateur){
    $idSondage=htmlentities ($idSondage);
    $idUtilisateur=htmlentities ($idUtilisateur);
    $SQL = "SELECT idSondageSuivant FROM SondageSuivant WHERE idSondage=$idSondage AND idUtilisateur='$idUtilisateur'";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp;
}

function getQuestion($idSondage){
    $idSondage=htmlentities ($idSondage);
    $SQL = "SELECT Question FROM Sondages WHERE idSondage ='$idSondage'";
    return SQLGetChamp($SQL);
}

function getMysondage($idUtilisateur){
    $idUtilisateur=htmlentities ($idUtilisateur);
    $SQL = "SELECT * FROM Sondages s, Choix c WHERE s.Utilisateur ='$idUtilisateur' AND s.idSondage=c.Sondage GROUP BY s.idSondage";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp;
}

function ajoutnombrereponse($idSondage){
    $idSondage=htmlentities ($idSondage);
    $SQL = "UPDATE Sondages SET NbReponses = NbReponses + 1 WHERE idSondage = '$idSondage'";
    SQLUpdate($SQL);
}

function ajoutReponse($idSondage, $idchoix, $idUtilisateur){
    $idSondage=htmlentities ($idSondage);
    $idUtilisateur=htmlentities ($idUtilisateur);
    $idchoix = htmlentities($idchoix);
    $SQL = "INSERT INTO Reponses VALUES(NULL , '$idSondage', '$idchoix', '$idUtilisateur')";
    SQLInsert($SQL);
}

function listepersonnereponse($idChoix){
    $idChoix = htmlentities($idChoix);
    $SQL = "SELECT u.pseudo FROM Reponses r, Utilisateurs u WHERE r.utilisateur=u.idUtilisateur AND r.idChoix='$idChoix'";
    $tabPhp = parcoursRs(SQLSelect($SQL));
    return $tabPhp;
}

function deleteSondage($idSondage){
    $idSondage = htmlentities($idSondage);
    $SQL = "DELETE FROM Reponses WHERE sondage = '$idSondage' ";
    SQLDelete($SQL);
    $SQL = "DELETE FROM sondageImage WHERE idSondage = '$idSondage' ";
    SQLDelete($SQL);
    $SQL = "DELETE FROM Choix WHERE Sondage = '$idSondage' ";
    SQLDelete($SQL);
    $SQL = "DELETE FROM Commentaires WHERE idSondage= '$idSondage' ";
    SQLDelete($SQL);
    $SQL = "DELETE FROM Sondagelike WHERE idSondage = '$idSondage' ";
    SQLDelete($SQL);
    $SQL = "DELETE FROM SondageSuivant WHERE idSondage = '$idSondage' ";
    SQLDelete($SQL);
    $SQL = "DELETE FROM Sondages WHERE idSondage = '$idSondage' ";
    SQLDelete($SQL);
}

function getnbreponses($idSondage){
    $idSondage = htmlentities($idSondage);
    $SQL = "SELECT NbReponses FROM Sondages WHERE idSondage='$idSondage'";
    return SQLGetChamp($SQL);
}

////////////////////////////////////// Rang, XP et Coin ///////////////////////////////////////////////////////////////

function ajoutcoinUser($idUtilisateur){
    $idUtilisateur = htmlentities($idUtilisateur);
    $SQL = "UPDATE Utilisateurs SET nbCoins = nbCoins + 1 WHERE idUtilisateur = '$idUtilisateur'";
    SQLUpdate($SQL);
}
function pourcentageRang($idUtilisateur)
{
    $idUtilisateur = htmlentities($idUtilisateur);
    $SQL = "SELECT Pourcentage_Rang FROM Utilisateurs WHERE idUtilisateur ='$idUtilisateur'";
    return SQLGetChamp($SQL);
}

function ajoutXP($idUtilisateur){
    $idUtilisateur = htmlentities($idUtilisateur);
    $SQL = "UPDATE Utilisateurs SET Pourcentage_rang = Pourcentage_rang + 5 WHERE idUtilisateur = '$idUtilisateur'";
    SQLUpdate($SQL);

}

function ajoutrang($idUtilisateur){
    $idUtilisateur = htmlentities($idUtilisateur);
    $SQL = "UPDATE Utilisateurs SET rang = rang + 1 WHERE idUtilisateur = '$idUtilisateur'";
    SQLUpdate($SQL);
}

function pourcentage0($idUtilisateur){
    $idUtilisateur = htmlentities($idUtilisateur);
    $SQL = "UPDATE Utilisateurs SET Pourcentage_rang = 0 WHERE idUtilisateur = '$idUtilisateur'";
    SQLUpdate($SQL);
}

function rang($idUtilisateur)
{
    $idUtilisateur = htmlentities($idUtilisateur);
    $SQL = "SELECT rang FROM Utilisateurs WHERE idUtilisateur ='$idUtilisateur'";
    return SQLGetChamp($SQL);
}

function getCoins($idUtilisateur)
{
    $idUtilisateur = htmlentities($idUtilisateur);
    $SQL = "SELECT nbCoins FROM Utilisateurs WHERE idUtilisateur ='$idUtilisateur'";
    return SQLGetChamp($SQL);
}

/////////////////////////////////// Fonction Conversation,Message ////////////////////////////////////////////////////////////

function listerConversations($mode="tout", $idUtilisateur){
    // Liste toutes les conversations ($mode="tout")
    // OU uniquement celles actives  ($mode="actives"), ou inactives  ($mode="inactives")
    $idUtilisateur = htmlentities($idUtilisateur);
	$mode = htmlentities($mode);
    $SQL = "SELECT * FROM conversations c, MembreConversation m WHERE c.id=m.idConv AND m.idMembre='$idUtilisateur'";
    if ($mode == "actives") $SQL .= " AND active=1";
    if ($mode == "inactives") $SQL .= " AND active=0";
    return parcoursRs(SQLSelect($SQL));
}

function archiverConversation($idConversation)
{
    $idConversation = htmlentities($idConversation);
    // rend une conversation inactive
    $SQL = "UPDATE conversations SET active=0 WHERE id='$idConversation'";
    SQLUpdate($SQL);
}


function reactiverConversation($idConversation)
{
    $idConversation = htmlentities($idConversation);
    // rend une conversation active
    $SQL = "UPDATE conversations SET active=1 WHERE id='$idConversation'";
    SQLUpdate($SQL);
}

function creerConversation($theme){
    $theme = htmlentities($theme);
    // crée une nouvelle conversation et renvoie son identifiant
    $SQL ="INSERT INTO conversations(theme) VALUES('$theme')";
    return SQLInsert($SQL);
}


function supprimerConversation($idConv)
{
    $idConv = htmlentities($idConv);
    // supprime une conversation et ses messages

    // NB : on aurait pu aussi demander à mysql de supprimer automatiquement
    // les messages lorsqu'une conversation est supprimée,
    // en déclarant idConversation comme clé étrangère vers le champ id de la table
    // des conversations et en définissant un trigger
    // Cf. tutoriel sur moodle "intégrité référentielle"
    $SQL = "DELETE FROM conversations WHERE id='$idConv'";
    SQLDelete($SQL);

    // TODO: utiliser des contraintes de mise à jour en cascade dans le moteur de bdd
    $SQL = "DELETE FROM message WHERE idConversation='$idConv'";
    SQLDelete($SQL);
}

function nomConversation($idConversation){
    $idConversation = htmlentities($idConversation);
    $SQL = "SELECT * FROM conversations WHERE id='$idConversation'";
    $nom = parcoursRs(SQLSelect($SQL));
    return $nom[0]['theme'];
}

function listerMessages($idConv,$format="asso")
{
    $idConv = htmlentities($idConv);
    // Liste les messages de cette conversation, au format JSON ou tableau associatif
    // Champs à extraire : contenu, auteur, couleur
    // en ne renvoyant pas les utilisateurs blacklistés

    $SQL ="SELECT m.contenu, u.pseudo as auteur, u.idUtilisateur, u.avatar FROM message m INNER JOIN Utilisateurs u ON m.idAuteur = u.idUtilisateur WHERE m.idConversation='$idConv' AND u.blacklist=0";
    return parcoursRs(SQLSelect($SQL));

}

function getConversation($idConv)
{
    $idConv = htmlentities($idConv);
    $SQL = "SELECT * FROM conversations WHERE id='$idConv'";
    $tabC = parcoursRs(SQLSelect($SQL));
    if (count($tabC) == 1) return $tabC[0];
    else return array();
}

function ajoutconversation($theme, $idUtilisateur){
    $theme = htmlentities($theme);
    $idUtilisateur = htmlentities($idUtilisateur);
    $SQL = "INSERT INTO conversations VALUES (NULL ,'1','$theme','$idUtilisateur')";
    SQLInsert($SQL);
    $SQL_Id = "SELECT id FROM conversations WHERE idUtilisateur='$idUtilisateur' AND theme='$theme' ORDER BY id DESC";
    return parcoursRs(SQLSelect($SQL_Id));
}

function ajoutMembre($idConv, $idUtilisateur){
    $idUtilisateur = htmlentities($idUtilisateur);
    $idConv = htmlentities($idConv);
    $SQL = "INSERT INTO MembreConversation VALUES ('$idConv' ,'$idUtilisateur')";
    SQLInsert($SQL);
}

function enregistrerMessage($idConversation, $idAuteur, $contenu, $sharesondage){
    $idConversation = htmlentities($idConversation);
    $idAuteur = htmlentities($idAuteur);
    $contenu = htmlentities($contenu);
    if($sharesondage===0) {
        $SQL = "INSERT INTO message(idConversation,idAuteur,contenu) VALUES ('$idConversation', '$idAuteur', '$contenu')";
        SQLInsert($SQL);
    }else{
        $SQL = "INSERT INTO message(idConversation,idAuteur,contenu) VALUES ('$idConversation', '$idAuteur', '<a href=\"$contenu\">Cliquer pour voir le Sondage</a>')";
        SQLInsert($SQL);
    }
}

function getnombreUtilsateur($idConv){
	$idConv=htmlentities($idConv);
	$SQL = "SELECT COUNT(idMembre) FROM MembreConversation WHERE idConv='$idConv'";
	return SQLGetchamp($SQL);
}
function effacerMembre($idConv, $idUtilisateur){
	$idConv=htmlentities($idConv);
	$idUtilisateur=htmlentities($idUtilisateur);
    $SQL = "DELETE FROM MembreConversation WHERE idConv='$idConv' AND idMembre='$idUtilisateur'";
    SQLDelete($SQL);
}

function supprimerconv($idConv){
	$idConv=htmlentities($idConv);
    $SQL = "DELETE FROM MembreConversation WHERE idConv='$idConv'";
    SQLDelete($SQL);
    $SQL = "DELETE FROM message WHERE idConversation='$idConv'";
    SQLDelete($SQL);
    $SQL = "DELETE FROM conversations WHERE id='$idConv'";
    SQLDelete($SQL);
}

function verifconv($idUser,$idConv){
	$idUser=htmlentities($idUser);
	$idConv=htmlentities($idConv);	
	$SQL = "SELECT * FROM MembreConversation WHERE idConv='$idConv' AND idMembre='$idUser'";
	return SQLSelect($SQL);
}
?>

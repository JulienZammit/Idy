<?php
session_start();

	include_once "libs/maLibUtils.php";
	include_once "libs/maLibSQL.pdo.php";
	include_once "libs/maLibSecurisation.php"; 
	include_once "libs/modele.php"; 

	$addArgs = "";

	if ($action = valider("action"))
	{
		ob_start ();
		echo "Action = '$action' <br />";

		switch($action = valider("action")) {

			case 'Connexion' :
				if ($mail = valider("mail")) {
                    if ($passe = valider("passe")) {
                    	if ($hash=getmdpwithmail($mail)){
                    		if (password_verify($passe, $hash)) {
		                        if (verifUser($mail, $hash)) {
		                            if (valider("remember")) {
		                                setcookie("mail", $mail, time() + 60 * 60 * 24 * 30);
		                                setcookie("passe", $hash, time() + 60 * 60 * 24 * 30);
		                                setcookie("remember", true, time() + 60 * 60 * 24 * 30);
		                            } else {
		                                setcookie("mail", "", time() - 3600);
		                                setcookie("passe", "", time() - 3600);
		                                setcookie("remember", false, time() - 3600);
		                            }
		                            $addArgs = "?view=sondage";
		                        }else {
		                            $addArgs = "?view=login&error=" . urlencode("Il faut saisir des identifiants corrects !");
		                        }
		                    }
		                }
                    }
                }
				break;

			case "Inscription" :
                    if($pseudo = valider('pseudo', 'POST')){
                        if($password = valider('password', 'POST')){
                            if($password2 = valider('password2', 'POST')){
                                if($date = valider('date', 'POST')){
                                    if($mail = valider('mail', 'POST')){
                                        if (strpos($_POST['pseudo'], ' ')!==FALSE || strpos($_POST['pseudo'], '&nbsp;')!==FALSE || strpos($_POST['mail'], ' ')!==FALSE || strpos($_POST['mail'], '&nbsp;')!==FALSE)
                                        {
                                            $addArgs = "?view=inscription&error=". urlencode("Certaines données entrées contiennent des espaces, ce qui est interdit !");
                                        }else {
                                            if (strpos($_POST['mail'], '@')!==FALSE && strpos($_POST['mail'], '.')!==FALSE){
                                                if($password===$password2) {
                                                    if(getuserpseudo($pseudo)!==$pseudo){
                                                        if(getusermail($mail)!==$mail){
                                                        	if($hash=password_hash($password, PASSWORD_DEFAULT)){
                                                        		if(password_verify($password, $hash)){
                                                        			if (password_needs_rehash($hash, PASSWORD_DEFAULT, $options)){
                                                        				$hash=password_hash($password, PASSWORD_DEFAULT);
                                                        			}
	                                                                getinscription($pseudo, $mail, $hash, $date);
	                                                                $addArgs = "?view=login&success=". urlencode("Inscription réalisé avec succès !");
			                                                    }else{
			                                                    	$addArgs= "?view=inscription&error=".urlencode("Problème de hachage !");
			                                                    }
		                                                    }else{
		                                                    	$addArgs= "?view=inscription&error=".urlencode("Problème de hachage !");
		                                                    }
                                                        }else{
                                                            $addArgs = "?view=inscription&error=". urlencode("Email déjà utilisé !");
                                                        }
                                                    }else{
                                                        $addArgs = "?view=inscription&error=". urlencode("Pseudo déjà utilisé !");
                                                    }
                                                }else{
                                                    $addArgs = "?view=inscription&error=". urlencode("Le deuxième mot de passe est différent du premier");
                                                }
                                            }else{
                                                $addArgs = "?view=inscription&error=". urlencode("L'email rentré est incorrect !");
                                            }
                                        }
                                    }else{
                                        $addArgs = "?view=inscription&error=". urlencode("Veuillez entrer un mail !");
                                    }
                                }else
                                {
                                    $addArgs = "?view=inscription&error=". urlencode("Veuillez entrer une date de naissance !");
                                }
                            }else{
                                $addArgs = "?view=inscription&error=". urlencode("Veuillez entrer un deuxième mot de passe !");
                            }
                        }else{
                            $addArgs = "?view=inscription&error=". urlencode("Veuillez entrer un mot de passe !");
                        }
                    }else{
                        $addArgs = "?view=inscription&error=". urlencode("Veuillez entrer un pseudo !");
                    }
				break;

            case "Création sondage" :
                if($idUser = valider('idUtilisateur','SESSION')){
                    $addArgs = "?view=login";
                }else{
                    $addArgs = "?view=creationsondage";
                }
                break;

            case "Bannir" :
            	if($idUser = valider('idUtilisateur','SESSION')){
            		if($admin=getadmin($idUser)){
            			if($admin==='1'){
			                if ($id=valider("id")){
			                    blacklist($id);
			                    $addArgs = "?view=admin&id=$id";
			                }
			            }
			        }
	            }
                break;

            case "Débannir" :
            	if($idUser = valider('idUtilisateur','SESSION')){
            		if($admin=getadmin($idUser)){
            			if($admin==='1'){
			                if ($id=valider("id")){
			                    deblacklist($id);
			                    $addArgs = "?view=admin&id=$id";
			                }
			            }
			        }
	            }
                break;

            case "Rechercher un ami" :
                if($pseudo=valider("pseudoUser")){
	                if($idUtilisateur = valider('idUtilisateur','SESSION')) {
	                    if ($ami = getAmi($pseudo)) {
	                        $addArgs = "?view=ami&idami=$ami";
	                    } else {
	                        $addArgs = "?view=sondage&error=" . urlencode("Cet utilisateur n'existe pas !");
	                    }
	                }
	            }
                break;

            case "Rechercher un utilisateur" :
                if($pseudo=valider("pseudoUser")) {
	                if($idUtilisateur = valider('idUtilisateur','SESSION')) {
	                    if ($iduser = getuserid($pseudo)) {
	                        $addArgs = "?view=admin&id=$iduser";
	                    } else {
	                        $addArgs = "?view=admin&error=" . urlencode("Cet utilisateur n'existe pas !");
	                    }
	                }
	            }
                break;

            case "LikeSondage" :
                if($idUser = valider('idUtilisateur','SESSION')){
                    if($idSondage = valider('idSondage')){
                        $test=checklikeverif($idSondage,$idUser);
                        if($test[0]["idlike"]===NULL){
                            likesondage($idSondage,$idUser);
                            $addArgs = "?view=sondage";
                        }else{
                            $addArgs = "?view=sondage&error=". urlencode("Erreur déjà liké !");
                        }
                    }else{
                        $addArgs = "?view=sondage&error=". urlencode("Aucun id de sondage détecté !");
                    }
                }else{
                    $addArgs = "?view=login&error=". urlencode("Vous n'êtes pas connecté !");
                }
                break;

            case "UnLikeSondage" :
                if($idUser = valider('idUtilisateur','SESSION')){
                    if($idSondage = valider('idSondage')){
                        $test=checklikeverif($idSondage,$idUser);
                        if($test[0]["idlike"]!=NULL){
                            unlikesondage($idSondage,$idUser);
                            $addArgs = "?view=sondage";
                        }else{
                            $addArgs = "?view=sondage&error=". urlencode("Erreur déjà unliké !");
                        }
                    }else{
                        $addArgs = "?view=sondage&error=". urlencode("Aucun id de sondage détecté !");
                    }
                }else{
                    $addArgs = "?view=login&error=". urlencode("Vous n'êtes pas connecté !");
                }
                break;

            case "Effacer le sondage" :
            	if($idUser = valider('idUtilisateur','SESSION')){
	                if($idSondage = valider('idSondage')){
	                    deleteSondage($idSondage);
	                    $addArgs = "?view=utilisateur";
	                }
	            }
                break;
		
           case "Définir comme Avatar" :
                if($theme = valider('idUtilisateur','SESSION')){
                    if($_FILES['photo']['type']=='image/jpeg'){
                        $idUtilisateur = $_SESSION['idUtilisateur'];
                        $nom=getuserpseudowithid($_SESSION['idUtilisateur']);
                        $lien = "./ressources/avatar/" . $nom . ".jpg";
                        $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $lien);

                        // resize image 400px par 400px
                        list($width, $height) = getimagesize($lien);
                        $original = imagecreatefromjpeg($lien);
                        $resized = imagecreatetruecolor(400, 400);
                        imagecopyresampled($resized, $original, 0, 0, 0, 0, 400, 400, $width, $height);
                        imagejpeg($resized, "./ressources/avatar/" . $nom . ".jpg");

                        //compression image qualité à 95% imperceptible
                        $liennew=compress_image($lien,$lien,95);

                        updtAvatar($idUtilisateur,$liennew);

                        $addArgs = "?view=utilisateur&success=". urlencode("Avatar défini avec succès !");
                    }
                    else if($_FILES['photo']['type']=='image/png'){
                        $idUtilisateur = $_SESSION['idUtilisateur'];
                        $nom=getuserpseudowithid($_SESSION['idUtilisateur']);
                        $lien = "./ressources/avatar/" . $nom . ".png";
                        $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $lien);

                        // resize image 400px par 400px
                        list($width, $height) = getimagesize($lien);
                        $original = imagecreatefromjpeg($lien);
                        $resized = imagecreatetruecolor(400, 400);
                        imagecopyresampled($resized, $original, 0, 0, 0, 0, 400, 400, $width, $height);
                        imagejpeg($resized, "./ressources/avatar/" . $nom . ".jpg");

                        //compression image qualité à 95% imperceptible
                        $liennew=compress_image($lien,$lien,95);
                        
                        updtAvatar($idUtilisateur,$liennew);

                        $addArgs = "?view=utilisateur&success=". urlencode("Avatar défini avec succès !");
                    }else{
                        $addArgs = "?view=utilisateur&error=". urlencode("L'image envoyé n'est pas de type jpeg ou png !");
                    }
                }
                break;

            case "Définir comme bannière" :
                if($theme = valider('idUtilisateur','SESSION')){
                    if($_FILES['photo']['type']=='image/jpeg'){
                        $idUtilisateur = $_SESSION['idUtilisateur'];
                        $nom=getuserpseudowithid($_SESSION['idUtilisateur']);
                        $lien = "./ressources/bannieres/" . $nom . ".jpg";
                        $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $lien);

                        //compression image qualité à 80% peu perceptible
                        $liennew=compress_image($lien,$lien,80);
                        
                        updtBanniere($idUtilisateur,$liennew);

                        $addArgs = "?view=utilisateur&success=". urlencode("Avatar défini avec succès !");
                    }
                    else if($_FILES['photo']['type']=='image/png'){
                        $idUtilisateur = $_SESSION['idUtilisateur'];
                        $nom=getuserpseudowithid($_SESSION['idUtilisateur']);
                        $lien = "./ressources/bannieres/" . $nom . ".png";
                        $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $lien);

                        //$liennew=compress_image($lien,$lien,95);
                        
                        updtBanniere($idUtilisateur,$lien);

                        $addArgs = "?view=utilisateur&success=". urlencode("Bannière défini avec succès !");
                    }else{
                        $addArgs = "?view=utilisateur&error=". urlencode("L'image envoyé n'est pas de type jpeg ou png !");
                    }
                }
                break;

            case "Publier" :
                if($idUser = valider('idUtilisateur','SESSION')){
                    if($commentairecontent = valider('commentairecontent')){
                        if($idSondage = valider('idSondage')){
                            commenter($idUser,$commentairecontent,$idSondage);
                            $addArgs = "?view=sondage&idSondage=$idSondage";
                        }else{
                            $addArgs = "?view=sondage&error=". urlencode("Aucun id sondage entré !");
                        }
                    }else{
                        $addArgs = "?view=sondage&error=". urlencode("Aucun commentaire n'a été rentré !");
                    }
                }else{
                    $addArgs = "?view=login&error=". urlencode("Veuillez vous connecter !");
                }
                break;

            
             case "Poster" :
                 if($idUtilisateur = valider('idUtilisateur','SESSION')) {
                         if ($question = valider("question")) {
                             if ($premierchoix = valider("premierchoix")) {
                                 if ($secondchoix = valider("secondchoix")) {
                                     if ($quatriemechoix = valider("quatriemechoix")) {
                                         ajoutersondage($idUtilisateur);
                                         creersondage($idUtilisateur, $question, 4, $premierchoix, $secondchoix, valider("troisiemechoix"), $quatriemechoix);
                                         $addArgs = "?view=sondage";
                                     } else if ($troisiemechoix = valider("troisiemechoix")) {
                                         ajoutersondage($idUtilisateur);
                                         creersondage($idUtilisateur, $question, 3, $premierchoix, $secondchoix, $troisiemechoix);
                                         $addArgs = "?view=sondage";
                                     } else {
                                         ajoutersondage($idUtilisateur);
                                         creersondage($idUtilisateur, $question, 2, $premierchoix, $secondchoix);
                                         $addArgs = "?view=sondage";
                                     }
                                 }
                             }
                         }
                 }
                break;


            case "Poster Sondage Images" :
                $nombreDeChoix = 0;
                if($idUtilisateur = valider('idUtilisateur','SESSION')) {
                        if ($question = valider("question")) {
                            ///////////////////////IMAGE 1/////////////////////////
                            $photo1 = valider("photo1");

                            if ($description1 = valider("description1")) {
                                if ($_FILES['photo1']['type'] == 'image/jpeg') {
                                    $nom = $_FILES['photo1']['name'];
                                    $nombre = rand(1, 100000);
                                    $lien1 = "./ressources/imageSondage/" . $nombre . $nom;
                                    move_uploaded_file($_FILES['photo1']['tmp_name'], $lien1);

                                    //compression image qualité à 80% peu perceptible
                                    $lien1 = compress_image($lien1, $lien1, 80);

                                    $addArgs = "?view=sondage&success=" . urlencode("Sondage envoyé avec succès !");
                                } else if ($_FILES['photo1']['type'] == 'image/png') {
                                    $idUtilisateur = $_SESSION['idUtilisateur'];
                                    $nom = $_FILES['photo1']['name'];
                                    $nombre = rand(1, 100000);
                                    $lien1 = "./ressources/imageSondage/" . $nombre . $nom;
                                    move_uploaded_file($_FILES['photo1']['tmp_name'], $lien1);

                                    $addArgs = "?view=sondage&success=" . urlencode("Sondage envoyé avec succès !");
                                
                                } else if ($_FILES['photo1']['type'] == 'image/jpg') 
                                {
                                    $addArgs = "?view=sondage&error=" . urlencode("JPG NON ACCEPTE !");
                                

                                }

                                 else {
                                    $addArgs = "?view=sondage&error=" . urlencode("La première image envoyé n'est pas de type jpeg ou png !");
                                }
                            }

                            ///////////////////////FIN IMAGE 1/////////////////////////

                            ///////////////////////IMAGE 2/////////////////////////
                            $photo2 = valider("photo2");

                            if ($description2 = valider("description2")) {
                                if ($_FILES['photo2']['type'] == 'image/jpeg') {
                                    $nom = $_FILES['photo2']['name'];
                                    $nombre = rand(1, 100000);
                                    $lien2 = "./ressources/imageSondage/" . $nombre . $nom;
                                    move_uploaded_file($_FILES['photo2']['tmp_name'], $lien2);

                                    //compression image qualité à 80% peu perceptible
                                    $lien2 = compress_image($lien2, $lien2, 80);
                                    $nombreDeChoix = 2;

                                    $addArgs = "?view=sondage&success=" . urlencode("Sondage envoyé avec succès !");
                                } else if ($_FILES['photo2']['type'] == 'image/png') {
                                    $idUtilisateur = $_SESSION['idUtilisateur'];
                                    $nom = $_FILES['photo2']['name'];
                                    $nombre = rand(1, 100000);
                                    $lien2 = "./ressources/imageSondage/" . $nombre . $nom;
                                    move_uploaded_file($_FILES['photo2']['tmp_name'], $lien2);

                                    $nombreDeChoix = 2;

                                    $addArgs = "?view=sondage&success=" . urlencode("Sondage envoyé avec succès !");
                                
                                } else if ($_FILES['photo1']['type'] == 'image/jpg') {
                                    $addArgs = "?view=sondage&error=" . urlencode("JPG NON ACCEPTE !");
                                

                                }

                                else {
                                    $addArgs = "?view=sondage&error=" . urlencode("La première image envoyé n'est pas de type jpeg ou png !");
                                }
                            }

                            ///////////////////////FIN IMAGE 2/////////////////////////

                            ///////////////////////IMAGE 3/////////////////////////
                            $photo3 = valider("photo3");

                            if ($description3 = valider("description3")) {
                                if ($_FILES['photo3']['type'] == 'image/jpeg') {
                                    $nom = $_FILES['photo3']['name'];
                                    $nombre = rand(1, 100000);
                                    $lien3 = "./ressources/imageSondage/" . $nombre . $nom;
                                    move_uploaded_file($_FILES['photo3']['tmp_name'], $lien3);

                                    //compression image qualité à 80% peu perceptible
                                    $lien3 = compress_image($lien3, $lien3, 80);
                                    $nombreDeChoix = 3;

                                    $addArgs = "?view=sondage&success=" . urlencode("Sondage envoyé avec succès !");
                                } else if ($_FILES['photo3']['type'] == 'image/png') {
                                    $idUtilisateur = $_SESSION['idUtilisateur'];
                                    $nom = $_FILES['photo3']['name'];
                                    $nombre = rand(1, 100000);
                                    $lien3 = "./ressources/imageSondage/" . $nombre . $nom;
                                    move_uploaded_file($_FILES['photo3']['tmp_name'], $lien3);

                                    $nombreDeChoix = 3;

                                    $addArgs = "?view=sondage&success=" . urlencode("Sondage envoyé avec succès !");
                                } else {
                                    $addArgs = "?view=sondage&error=" . urlencode("La première image envoyé n'est pas de type jpeg ou png !");
                                }
                            }

                            ///////////////////////FIN IMAGE 3/////////////////////////

                            ///////////////////////IMAGE 4/////////////////////////
                            $photo4 = valider("photo4");

                            if ($description4 = valider("description4")) {
                                if ($_FILES['photo4']['type'] == 'image/jpeg') {
                                    $nom = $_FILES['photo4']['name'];
                                    $nombre = rand(1, 100000);
                                    $lien4 = "./ressources/imageSondage/" . $nombre . $nom;
                                    move_uploaded_file($_FILES['photo4']['tmp_name'], $lien4);

                                    //compression image qualité à 80% peu perceptible
                                    $lien4 = compress_image($lien4, $lien4, 80);
                                    $nombreDeChoix = 4;

                                    $addArgs = "?view=sondage&success=" . urlencode("Sondage envoyé avec succès !");
                                } else if ($_FILES['photo4']['type'] == 'image/png') {
                                    $idUtilisateur = $_SESSION['idUtilisateur'];
                                    $nom = $_FILES['photo4']['name'];
                                    $nombre = rand(1, 100000);
                                    $lien3 = "./ressources/imageSondage/" . $nombre . $nom;
                                    move_uploaded_file($_FILES['photo4']['tmp_name'], $lien4);

                                    $nombreDeChoix = 4;

                                    $addArgs = "?view=sondage&success=" . urlencode("Sondage envoyé avec succès !");
                                } else {
                                    $addArgs = "?view=sondage&error=" . urlencode("La première image envoyé n'est pas de type jpeg ou png !");
                                }
                            }
                            ///////////////////////FIN IMAGE 4/////////////////////////

                            if ($nombreDeChoix == 2) {
                                ajoutersondage($idUtilisateur);
                                creersondageImage($idUtilisateur, $question, $nombreDeChoix, $lien1, $description1, $lien2, $description2);
                            } else if ($nombreDeChoix == 3) {
                                ajoutersondage($idUtilisateur);
                                creersondageImage($idUtilisateur, $question, $nombreDeChoix, $lien1, $description1, $lien2, $description2, $lien3, $description3);
                            } else if ($nombreDeChoix == 4) {
                                ajoutersondage($idUtilisateur);
                                creersondageImage($idUtilisateur, $question, $nombreDeChoix, $lien1, $description1, $lien2, $description2, $lien3, $description3, $lien4, $description4);
                            }
                        }
                }
            	
                break;

              case "Poster Sondage Audio" :
                $nombreDeChoix = 0;
                if($idUtilisateur = valider('idUtilisateur','SESSION')) 
                {
                        if ($question = valider("question")) 
                        {
                            ///////////////////////IMAGE 1/////////////////////////
                            $photo1 = valider("photo1");

                            if ($description1 = valider("description1")) 
                            {
                                
                                    $nom = $_FILES['photo1']['name'];
                                    $nombre = rand(1, 100000);
                                    $lien1 = "./ressources/audioSondage/" . $nombre . $nom;
                                    move_uploaded_file($_FILES['photo1']['tmp_name'], $lien1);

                                    $addArgs = "?view=sondage&success=" . urlencode("Sondage envoyé avec succès !");
                                
                            }
                            

                            ///////////////////////FIN IMAGE 1/////////////////////////

                            ///////////////////////IMAGE 2/////////////////////////
                            $photo2 = valider("photo2");

                            if ($description2 = valider("description2")) 
                            {
                                    $nom = $_FILES['photo2']['name'];
                                    $nombre = rand(1, 100000);
                                    $lien2 = "./ressources/audioSondage/" . $nombre . $nom;
                                    move_uploaded_file($_FILES['photo2']['tmp_name'], $lien2);

                                    $nombreDeChoix = 2;

                                    $addArgs = "?view=sondage&success=" . urlencode("Sondage envoyé avec succès !");
                                
                            }

                            ///////////////////////FIN IMAGE 2/////////////////////////

                            ///////////////////////IMAGE 3/////////////////////////
                            $photo3 = valider("photo3");

                            if ($description3 = valider("description3")) 
                            {
                                    $nom = $_FILES['photo3']['name'];
                                    $nombre = rand(1, 100000);
                                    $lien3 = "./ressources/audioSondage/" . $nombre . $nom;
                                    move_uploaded_file($_FILES['photo3']['tmp_name'], $lien3);

                                    $nombreDeChoix = 3;

                                    $addArgs = "?view=sondage&success=" . urlencode("Sondage envoyé avec succès !");
                                
                            }

                            ///////////////////////FIN IMAGE 3/////////////////////////

                            ///////////////////////IMAGE 4/////////////////////////
                            $photo4 = valider("photo4");

                            if ($description4 = valider("description4")) 
                            {
                                    $nom = $_FILES['photo4']['name'];
                                    $nombre = rand(1, 100000);
                                    $lien4 = "./ressources/audioSondage/" . $nombre . $nom;
                                    move_uploaded_file($_FILES['photo4']['tmp_name'], $lien4);

                                    $nombreDeChoix = 4;

                                    $addArgs = "?view=sondage&success=" . urlencode("Sondage envoyé avec succès !");
                            }
                            ///////////////////////FIN IMAGE 4/////////////////////////

                            if ($nombreDeChoix == 2) {
                                ajoutersondage($idUtilisateur);
                                creersondageAudio($idUtilisateur, $question, $nombreDeChoix, $lien1, $description1, $lien2, $description2);
                            } else if ($nombreDeChoix == 3) {
                                ajoutersondage($idUtilisateur);
                                creersondageAudio($idUtilisateur, $question, $nombreDeChoix, $lien1, $description1, $lien2, $description2, $lien3, $description3);
                            } else if ($nombreDeChoix == 4) {
                                ajoutersondage($idUtilisateur);
                                creersondageAudio($idUtilisateur, $question, $nombreDeChoix, $lien1, $description1, $lien2, $description2, $lien3, $description3, $lien4, $description4);
                            }
                        }
                }

            break;

            case "Définir comme image une":
                if($idUtilisateur = valider('idUtilisateur','SESSION')) {
                    $nom = $_FILES['photo']['name'];
                    $lien = "./ressources/imageSondage1/" . $nom;
                    $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $lien);
                    $addArgs = "?view=creationsondage";
                }
                break;

            case "Définir comme image deux":
                if($idUtilisateur = valider('idUtilisateur','SESSION')) {
                    $nom = $_FILES['photo']['name'];
                    $lien = "./ressources/imageSondage2/" . $nom;
                    $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $lien);
                    $addArgs = "?view=creationsondage";
                }
                break;

            case "abonnement":
                if($idUtilisateur = valider('idUtilisateur','SESSION')) {
                    if($idUtilisateur2 = valider("idRecherche")) {
	                    abonnement($idUtilisateur, $idUtilisateur2);
	                    $addArgs = "?view=ami&idami=" . $idUtilisateur2;
	                }
                }
                break;

            case "desabonner":
                if($idUtilisateur = valider('idUtilisateur','SESSION')) {
                    if($idUtilisateur2 = valider("idRecherche")) {
	                    desabonner($idUtilisateur, $idUtilisateur2);
	                    $addArgs = "?view=ami&idami=" . $idUtilisateur2;
	                }
                }
                break;

            case "Supprimer" :
                if($idUtilisateur = valider('idUtilisateur','SESSION')) {
                    if($idUtilisateur2 = valider("idUtilisateur")) {
	                    deleteami($idUtilisateur, $idUtilisateur2);
	                    $addArgs = "?view=utilisateur";
	                }
                }
                break;

            case "Voir le profil" :
                if($idUtilisateur = valider('idUtilisateur','SESSION')) {
                    $addArgs = "?view=utilisateur&profilde=" . $idUtilisateur;
                }
                break;
        
            case "Supprimer le sondage" :
            	if($idUser = valider('idUtilisateur','SESSION')){
	                if ($idSondage = valider("idSondage")) {
		                if($idUser = valider("idUser")) {
			                deleteSondage($idSondage);
			                $addArgs = "?view=admin&id=" . $idUser;
			            }
			        }
			    }
                break;

            case "Voir Abonne":
                if($idUtilisateur = valider('idUtilisateur','SESSION')) {
                    $addArgs = "?view=abonne&id=" . $idUtilisateur;
                }
                break;

            case 'Changer votre mot de passe' :
            	if($idUser = valider('idUtilisateur','SESSION')){
	                if(valider("mdp1")===valider("mdp2") & valider("mdp1")!=""){
	                    changermdp($_SESSION["idUtilisateur"],valider("mdp1"));
	                    $addArgs= "?view=edition&success=". urlencode("Changement de mot de passe réussi");
	                } else{
	                    $addArgs= "?view=edition&error=". urlencode("Les deux mots de passes saisies ne sont pas identiques");
	                }
	            }
                break;

            case "Changer de pseudonyme" :
            	if($idUser = valider('idUtilisateur','SESSION')){
	                if(valider("pseudo")){
	                    changerpseudo($_SESSION["idUtilisateur"],valider("pseudo"));
	                    $addArgs = "?view=edition&success=".urlencode("Changement de pseudonyme réussi");
	                } else{
	                    $addArgs = "?view=edition&error=".urlencode("Changement de pseudonyme impossible");
	                }
	            }
                break;

            case 'Archiver' :
                // QS : idConv
                // NEVER TRUST USER INPUT
                if($idUtilisateur = valider('idUtilisateur','SESSION')) {
                    $admin = isAdmin($idUtilisateur);
                    if ($idConversation = valider("idConv"))
                        if (valider("connecte", "SESSION"))
                            if ($admin == 1)
                                archiverConversation($idConversation);
                    $addArgs = "?view=conversation&lastIdConv=" . $idConversation;
                }
                break;

            case 'Réactiver' :
                if($idUtilisateur = valider('idUtilisateur','SESSION')) {
                    $admin = isAdmin($idUtilisateur);
                    // QS : idConv
                    if ($idConversation = valider("idConv"))
                        if (valider("connecte", "SESSION"))
                            if ($admin == 1)
                                reactiverConversation($idConversation);

                    $addArgs = "?view=conversation&lastIdConv=" . $idConversation;
                }
                break;

            case 'Supprimer Conversation' :
                // QS : idConv
                if($idUtilisateur = valider('idUtilisateur','SESSION')) {
                    $admin = isAdmin($idUtilisateur);
                    if ($idConversation = valider("idConv"))
                        if (valider("connecte", "SESSION"))
                            if ($admin == 1)
                                supprimerConversation($idConversation);
                    $addArgs = "?view=conversation&lastIdConv=" . $idConversation;
                }
                break;

            case 'Nouvelle Conversation' :
                // QS : theme
                if($idUtilisateur = valider('idUtilisateur','SESSION')) {
                    $admin = isAdmin($idUtilisateur);
                    if ($theme = valider("theme"))
                        if (valider("connecte", "SESSION"))
                            if ($admin == 1) {
                                $idConversation = creerConversation($theme);
                            }
                            $addArgs = "?view=conversation&lastIdConv=" . $idConversation;
                }
                break;

            case 'Ajouter' :
                if($theme = valider('theme')) {
                    if($idUtilisateur = valider('idUtilisateur','SESSION')) {
                        $idConv = ajoutconversation($theme, $idUtilisateur);
                        ajoutMembre($idConv['0']['id'], $idUtilisateur);
                        $abonnement = getabonnement($idUtilisateur);
                        foreach ($abonnement as $abo) {
                            if (valider($abo['pseudo'])) {
                                ajoutMembre($idConv['0']['id'], $abo['idUtilisateur']);
                            }
                            $addArgs = "?view=conversation";
                        }
                    }
                }else{
                    $addArgs = "?view=conversation&error=".urlencode("Il manque le thème");
                }
                break;

            case 'Poster message' :
                if($idUtilisateur = valider('idUtilisateur','SESSION')) {
                    if ($idConv = valider("idConv"))
                        if ($contenu = valider("contenu"))
                            if (valider("connecte", "SESSION")) {
                                $dataConv = getConversation($idConv);
                                if ($dataConv["active"] == 1) {
                                    enregistrerMessage($idConv, $idUtilisateur, $contenu, 0);
                                    $addArgs = "?view=chat&idConv=" . $idConv;
                                }
                            } else {
                                $addArgs = "?view=chat&error=" . urlencode("Ecrire un message");
                            }
                }
                break;

            case 'Partager sondage':
                if($idUtilisateur = valider('idUtilisateur','SESSION')) {
                    $sondage = getsondage($idUtilisateur);
                    if ($idConv = valider("idConv")) {
                        foreach ($sondage as $sond) {
                            if (valider($sond['idSondage'])) {
                                $dataConv = getConversation($idConv);
                                if ($dataConv["active"] == 1) {
                                    $contenu = "https://web-idy.com/index.php?view=sondage&idSondage=" . $sond['idSondage'];
                                    enregistrerMessage($idConv, $idUtilisateur, $contenu, 1);
                                    $addArgs = "?view=chat&idConv=" . $idConv;
                                }
                            }
                        }
                    }
                }
                break;

            case 'Supprimer conversation' :
            	if($idUtilisateur = valider('idUtilisateur','SESSION')) {
	            	if ($idConv=valider("idConv")){
	            		if ($idUser=valider("idUser")){
	            			supprimerconv($idConv);
	            			$addArgs = "?view=admin&id=".$idUser;
	            		}
	            	}
	            }
            break;
            
            case "Quitter le groupe":
                if($idUtilisateur = valider('idUtilisateur','SESSION')) {
                    if($idConv = valider('idConv')){
                        effacerMembre($idConv, $idUtilisateur);
                        $addArgs = "?view=conversation";
                    }
                }
            break;

            case "Ajouter membre":
                    if($idConv = valider('idConv')) {
                        $nombremembreConv = getnombreUtilsateur($idConv);
                        if ($idUtilisateur = valider('idUtilisateur', 'SESSION')) {
                            $abonnement = getabonnement($idUtilisateur);
                            foreach ($abonnement as $abo) {
                                if (valider($abo['pseudo'])) {
                                    ajoutMembre($idConv, $abo['idUtilisateur']);
                                }
                                $addArgs = "?view=chat&idConv=" . $idConv;
                            }
                        }
                    }
                    break;
        }
	}
	
    // On redirige toujours vers la page index, mais on ne connait pas le répertoire de base
	// On l'extrait donc du chemin du script courant : $_SERVER["PHP_SELF"]
	// Par exemple, si $_SERVER["PHP_SELF"] vaut /chat/data.php, dirname($_SERVER["PHP_SELF"]) contient /chat
	$urlBase = "/index.php";
	// On redirige vers la page index avec les bons arguments

	header("Location:" . $urlBase . $addArgs);
	// On écrit seulement après cette entête
	ob_end_flush();
	?>
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
		// ATTENTION : le codage des caractères peut poser PB si on utilise des actions comportant des accents... 
		// A EVITER si on ne maitrise pas ce type de problématiques

		/* TODO: A REVOIR !!
		// Dans tous les cas, il faut etre logue... 
		// Sauf si on veut se connecter (action == Connexion)

		if ($action != "Connexion") 
			securiser("login");
		*/

		// Un paramètre action a été soumis, on fait le boulot...
		switch($action = valider("action")) {
			// Publier un commentaire //////////////////////////////////////////////////
            case "Publier" :
                if($idUser = valider('idUtilisateur','SESSION')){
                    if($commentairecontent = valider('commentairecontent')){
                        if($idSondage = valider('idSondage')){
                            commenter($idUser,$commentairecontent,$idSondage);
                            $addArgs = "?view=sondage&idSondage=$idSondage&comment=1";
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

            // Publier réponse à un commentaire //////////////////////////////////////////////////
            case "Répondre" :
                if($idUser = valider('idUtilisateur','SESSION')){
                    if($commentairecontent = valider('commentairecontent')){
                        if($idSondage = valider('idSondage')){
                            if($idcom = valider('idcom')){
                                souscommenter($idUser,$commentairecontent,$idcom);
                                $addArgs = "?view=sondage&idSondage=$idSondage&comment=1";
                            }else{
                                $addArgs = "?view=sondage&idSondage=$idSondage&error=". urlencode("Aucun id commentaire entré !");
                            }
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

            // Choix d'une réponse sur le sondage //////////////////////////////////////////////////
            case "RépondreChoix":
                if($idUtilisateur = valider('idUtilisateur','SESSION')) {
                    $idSondage = valider('idSondage');
                    $createur = idcreateurSondage($idSondage);
                    $xp = valider('xp');
                    if ($idUser = valider('idUtilisateur', 'SESSION')) {
                        if ($idchoix = valider('idchoix')) {
                            $test = checkreponse($idSondage, $idUtilisateur);
                            if ($test === NULL) {
                                ajoutnombrereponse($idSondage);
                                ajoutReponse($idSondage, $idchoix, $idUtilisateur);
                                ajoutcoinUser($idUtilisateur);
                                ajoutXP($idUtilisateur);
                                $addArgs = "?view=sondage&xp=" . $xp . "&idSondage=" . $idSondage;
                            } else {
                                $addArgs = "?view=sondage&xp=" . $xp . "&idSondage=" . "&idChoix=" . $idchoix;
                            }
                        } else {
                            $addArgs = "?view=sondage&error=" . urlencode("Erreur transmission idchoix !");
                        }
                    } else {
                        $addArgs = "?view=login&error=" . urlencode("Veuillez vous contacter !");
                    }
                }
                break;

            // Passer au sondage suivant //////////////////////////////////////////////////
            case "sondagesuivant" :
                if($idUser = valider('idUtilisateur','SESSION')){
                    if($idSondage = valider('idSondage')){
                        if(empty(checksondagesuivant($idSondage, $idUser))){
                            sondagesuivant($idSondage,$idUser);
                            $addArgs = "?view=sondage";
                        }else{
                            $addArgs = "?view=sondage&error=". urlencode("Deja nexté !");
                        }
                    }else{
                        $addArgs = "?view=sondage&error=". urlencode("Aucun id de sondage détecté !");
                    }
                }else{
                    $addArgs = "?view=login&error=". urlencode("Vous n'êtes pas connecté !");
                }
                break;

            // Passer au sondage précédant //////////////////////////////////////////////////
            case "sondageavant" :
                if($idUser = valider('idUtilisateur','SESSION')){
                        sondageprecedant($idUser);
                        $addArgs = "?view=sondage";
                }else{
                    $addArgs = "?view=login&error=". urlencode("Vous n'êtes pas connecté !");
                }
                break;

            case "LikeSondage" :
                if($idUser = valider('idUtilisateur','SESSION')){
                    if($idSondage = valider('idSondage')){
                        $test=checklikeverif($idSondage,$idUser);
                        if($test[0]["idlike"]===NULL){
                            likesondage($idSondage,$idUser);
                            $addArgs = "?view=sondage&idSondage=$idSondage";
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
                            $addArgs = "?view=sondage&idSondage=$idSondage";
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

            case "LikeComment" :
                if($idUser = valider('idUtilisateur','SESSION')){
                    if($idSondage = valider('idSondage')){
                        if($idcom = valider('idcom')){
                            $test=checklikecommentverif($idcom,$idUser);
                            if($test[0]["idlike"]===NULL){
                                likecommentaire($idcom,$idUser);
                                $addArgs = "?view=sondage&idSondage=$idSondage&comment=1";
                            }else{
                                $addArgs = "?view=sondage&error=". urlencode("Erreur déjà liké !");
                            }
                        }else{
                            $addArgs = "?view=sondage&error=". urlencode("Aucun id de commentaire détecté !");
                        }
                    }else{
                        $addArgs = "?view=sondage&error=". urlencode("Aucun id de sondage détecté !");
                    }
                }else{
                    $addArgs = "?view=login&error=". urlencode("Vous n'êtes pas connecté !");
                }
                break;

            case "UnLikeComment" :
                if($idUser = valider('idUtilisateur','SESSION')){
                    if($idSondage = valider('idSondage')){
                        if($idcom = valider('idcom')){
                            $test=checklikecommentverif($idcom,$idUser);
                            if($test[0]["idlike"]!=NULL){
                                unlikecommentaire($idcom,$idUser);
                                $addArgs = "?view=sondage&idSondage=$idSondage=&comment=1";
                            }else{
                                $addArgs = "?view=sondage&error=". urlencode("Erreur déjà unliké !");
                            }
                        }else{
                            $addArgs = "?view=sondage&error=". urlencode("Aucun id de commentaire détecté !");
                        }
                    }else{
                        $addArgs = "?view=sondage&error=". urlencode("Aucun id de sondage détecté !");
                    }
                }else{
                    $addArgs = "?view=login&error=". urlencode("Vous n'êtes pas connecté !");
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
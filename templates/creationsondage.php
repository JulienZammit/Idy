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
    header("Location:../index.php?view=creationsondage");
    die("");
}

if(!$_SESSION['idUtilisateur']){
    header("Location:../index.php?view=login");
}

include_once("libs/modele.php"); // listes
include_once("libs/maLibUtils.php");// tprint
include_once("libs/maLibForms.php");// mkTable, mkLiens, mkSelect ...
?>
<link rel="stylesheet" href="css/creationsondage.css">

<style>
input
{
    color: black;
}

body {background-color: #F5F5F5;}

.tv {
    border: 0px solid white;
    border-radius: 20px;
    padding: 20px;
    width:60%;
    text-align: left;
    margin: 0 auto;
    background-color:white;
    box-shadow: 1px 1px 12px #555;
}

#sondageAudio
{
	display:none;
}

#sondageImage
{
    display:none;
}

#sondageTexte
{
	display:block;
}

#choixTrois
{
	display:none;
}

#choixTroisIm
{
	display:none;
}

#choixTroisAud
{
    display:none;
}

#choixQuatre
{
	display:none;
}

#choixQuatreIm
{
	display:none;
}

#choixQuatreAud
{
    display:none;
}

.centrer
{
	text-align: center;
}

.boutonretour
{
    margin: 10px;
    position: absolute;
}

p {
    color:black;
}
</style>


<body>
    <div class = 'boutonretour'>
	   <a href="index.php?view=sondage" style="display: inline-flex;text-decoration: none;outline: none;"><i class="fas fa-arrow-circle-left fa-4x" style="color:#25fde9;"></i></a>
    </div>

    <br/>

	<div class ='centrer'>
    <label for="boutton">Type de Sondage :</label>
    <input id="boutton" type="submit" name="bouton" class="btn" style = "background-color:#25fde9; color:black;" onclick="changerTypeSimple();" value="🖊️"/>
    <input id="boutton" type="submit" name="bouton" class="btn" style = "background-color:#25fde9; color:black;" onclick="changerTypeImage();" value="🖼️"/>
    <input id="boutton" type="submit" name="bouton" class="btn" style = "background-color:#25fde9; color:black;" onclick="changerTypeAudio();" value="🎙️"/>
   

    <label for="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre de Choix :</label>
    <input id="button" type="submit" class="btn" style = "background-color:#25fde9; color:black;" name="button" onclick="deuxChoix();" value="2"/>
    <input id="button" type="submit" class="btn" style = "background-color:#25fde9; color:black;" name="button" onclick="troisChoix();" value="3"/>
    <input id="button" type="submit" class="btn" style = "background-color:#25fde9; color:black;" name="button" onclick="quatreChoix();" value="4"/>
    </div>

    <br/>

    <?php
    echo "<div id='sondageTexte' class ='tv'>";
    echo '<h2 style="text-align: center">Sondage Texte</h2>';

            mkForm('controleur.php','GET');
                echo '</br>';
                //echo '<p>Indiquer le thème de votre sondage : ';
                //mkInput('texte','theme','',"form-control");
                //echo '</br>';
                
                echo '<p>Entrez votre question : ';
                mkInput('texte','question','',"form-control");
                
                echo '</br>Choix n°1 : ';
                mkInput('texte','premierchoix','',"form-control");
                
				echo '</br>Choix n°2 : ';
                mkInput('texte','secondchoix','',"form-control");
                
                echo "<div id='choixTrois'>";
                echo 'Choix n°3 : ';
                mkInput('texte','troisiemechoix','',"form-control");
                echo "</div>";

                echo "<div id='choixQuatre'>";
                echo '</br>Choix n°4 : ';
                mkInput('texte','quatriemechoix','',"form-control");
                echo "</div>";

                echo '</p></br>';
                echo '<button class="btn" type="submit" name="action" style="background-color:#25fde9;color:black;" value="Poster">Poster</button>';
            endForm();
    echo "</div>";
    ?>

    <div id='sondageImage' class ='tv'>
    	<h2 style="text-align: center">Sondage Image</h2>
        <form enctype="multipart/form-data" action="controleur.php" method="POST">
            </br>
            <!--<p>Indiquer le thème de votre sondage :
            <input type="texte" class="form-control" name="theme" >
            </br>-->
            Entrez votre question :
            <input type="texte" class="form-control" name="question" >
            <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
            </br>
            
            <label for="photo1">Image n°1 :</label>
                <input class="form-control" type="file" id="photo1" style = "text-align: center;" name="photo1" accept="image/png, image/jpeg">
            </br>
            Description n°1 :
            <input type="texte" class="form-control" name="description1" >
            </br>
            
            <label for="photo2">Image n°2 :</label>
            <input class="form-control" type="file" id="photo2" style = "text-align: center;" name="photo2" accept="image/png, image/jpeg">
            </br>
            Description n°2 :
            <input type="texte" class="form-control" name="description2" >
            </br>
            
            <div id='choixTroisIm'>
            <label for="photo3">Image n°3 :</label>
            <input class="form-control" type="file" id="photo3" style = "text-align: center;" name="photo3" accept="image/png, image/jpeg">
            </br>
            Description n°3 :
            <input type="texte" class="form-control" name="description3" >
            </br>
            </div>

            <div id='choixQuatreIm'>
            <label for="photo4">Image n°4 :</label>
            <input class="form-control" type="file" id="photo4" style = "text-align: center;" name="photo4" accept="image/png, image/jpeg">
            </br>
            Description n°4 :
            <input type="texte" class="form-control" name="description4" >
            </br>
            </div>
        	</p>

            <input type="submit" name="action" class="btn" style = "background-color:#25fde9; color:black;" value="Poster Sondage Images"/></br>
        </form>
    </div>  

    <div id='sondageAudio' class ='tv'>
        <h2 style="text-align: center">Sondage Audio</h2>
        <form enctype="multipart/form-data" action="controleur.php" method="POST">
            </br>
            <!--<p>Indiquer le thème de votre sondage :
            <input type="texte" class="form-control" name="theme" >
            </br>-->
            Entrez votre question :
            <input type="texte" class="form-control" name="question" >
            <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
            </br>
            
            <label for="photo1">Audio n°1 :</label>
                <input class="form-control" type="file" id="photo1" style = "text-align: center;" name="photo1" accept="audio/mpeg">
            </br>
            Description n°1 :
            <input type="texte" class="form-control" name="description1" >
            </br>
            
            <label for="photo2">Audio n°2 :</label>
            <input class="form-control" type="file" id="photo2" style = "text-align: center;" name="photo2" accept="audio/mpeg">
            </br>
            Description n°2 :
            <input type="texte" class="form-control" name="description2" >
            </br>
            
            <div id='choixTroisAud'>
            <label for="photo3">Audio n°3 :</label>
            <input class="form-control" type="file" id="photo3" style = "text-align: center;" name="photo3" accept="audio/mpeg">
            </br>
            Description n°3 :
            <input type="texte" class="form-control" name="description3" >
            </br>
            </div>

            <div id='choixQuatreAud'>
            <label for="photo4">Audio n°4 :</label>
            <input class="form-control" type="file" id="photo4" style = "text-align: center;" name="photo4" accept="audio/mpeg">
            </br>
            Description n°4 
            <input type="texte" class="form-control" name="description4" >
            </br>
            </div>
            </p>

            <input type="submit" name="action" class="btn" style = "background-color:#25fde9; color:black;" value="Poster Sondage Audio"/></br>
        </form>
    </div>  
       
</body>

<script>

function changerTypeSimple()
{
	var sondImage = document.getElementById('sondageImage');
	var sondTexte = document.getElementById('sondageTexte');
    var sondAudio = document.getElementById('sondageAudio');
	
		sondImage.style.display = 'none';
		sondTexte.style.display = 'block';
	    sondAudio.style.display = 'none';
};

function changerTypeImage()
{
    var sondImage = document.getElementById('sondageImage');
    var sondTexte = document.getElementById('sondageTexte');
    var sondAudio = document.getElementById('sondageAudio');
    
        sondImage.style.display = 'block';
        sondTexte.style.display = 'none';
        sondAudio.style.display = 'none';
};

function changerTypeAudio()
{
    var sondImage = document.getElementById('sondageImage');
    var sondTexte = document.getElementById('sondageTexte');
    var sondAudio = document.getElementById('sondageAudio');
    
        sondImage.style.display = 'none';
        sondTexte.style.display = 'none';
        sondAudio.style.display = 'block';
};



function deuxChoix()
{
	var choixTrois = document.getElementById('choixTrois');
	var choixQuatre = document.getElementById('choixQuatre');
	var choixTroisIm = document.getElementById('choixTroisIm');
	var choixQuatreIm = document.getElementById('choixQuatreIm');
    var choixTroisAud = document.getElementById('choixTroisAud');
    var choixQuatreAud = document.getElementById('choixQuatreAud');

	choixTrois.style.display = 'none';
	choixQuatre.style.display = 'none';
	choixTroisIm.style.display = 'none';
	choixQuatreIm.style.display = 'none';
    choixTroisAud.style.display = 'none';
    choixQuatreAud.style.display = 'none';
}

function troisChoix()
{
	var choixTrois = document.getElementById('choixTrois');
	var choixQuatre = document.getElementById('choixQuatre');
	var choixTroisIm = document.getElementById('choixTroisIm');
	var choixQuatreIm = document.getElementById('choixQuatreIm');
    var choixTroisAud = document.getElementById('choixTroisAud');
    var choixQuatreAud = document.getElementById('choixQuatreAud');

	choixTrois.style.display = 'block';
	choixQuatre.style.display = 'none';
	choixTroisIm.style.display = 'block';
	choixQuatreIm.style.display = 'none';
    choixTroisAud.style.display = 'block';
    choixQuatreAud.style.display = 'none';
}

function quatreChoix()
{
	var choixTrois = document.getElementById('choixTrois');
	var choixQuatre = document.getElementById('choixQuatre');
	var choixTroisIm = document.getElementById('choixTroisIm');
	var choixQuatreIm = document.getElementById('choixQuatreIm');
    var choixTroisAud = document.getElementById('choixTroisAud');
    var choixQuatreAud = document.getElementById('choixQuatreAud');

	choixTrois.style.display = 'block';
	choixQuatre.style.display = 'block';
	choixTroisIm.style.display = 'block';
	choixQuatreIm.style.display = 'block';
    choixTroisAud.style.display = 'block';
    choixQuatreAud.style.display = 'block';
}
</script>
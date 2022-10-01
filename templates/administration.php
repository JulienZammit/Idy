<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=admin");
	die("");
}

if(!$_SESSION['idUtilisateur'] || !isAdmin($_SESSION['idUtilisateur'])){
    header("Location:../index.php?view=login");
}
?>

<div class="container h-100">
<h1> Page d'administration </h1></br>
<h3> Recherche d'utilisateur </h3></br>
<?php
mkForm("controleur.php");
mkInput("text","pseudoUser","","form-control");
echo "</br></br>";
mkInput('submit',"action","Rechercher un utilisateur","btn","background-color:#25fde9;");
echo "</br></br></br>";
endForm();

if($idUtilisateur=valider("id")){
	$pseudo=getuserpseudowithid($idUtilisateur);
	$sondage=getMysondage($idUtilisateur);
	$admin=getadmin($idUtilisateur);
	$blacklist=getblacklist($idUtilisateur);
 	$avatar = getAvatar($idUtilisateur);

 	echo "<div style='display:inline-flex;'>";
    echo "<a href=\"https://web-idy.com/index.php?view=utilisateur&profilde=" . $idUtilisateur . "\">";
    echo "<div id = \"avatarClick\" style=\"float:left;\">";
    echo "<img src=\"" . $avatar . "\" height=\"50\" style = \"width:50px; clip-path:ellipse(50% 50%); \">";
    echo "</div>";
	echo "<div style='font-size:35px;float:left;color:black;'>&nbsp;&nbsp;@" . $pseudo;
	echo "</div></a>";
	if($admin==0 && $blacklist==0){
		mkForm("controleur.php");
		echo "&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"action\" value=\"Bannir\" class=\"btn\" style=\"background-color:#25fde9;height:45px;\"/>";
		mkInput("hidden","id",$idUtilisateur);
		endForm();
	}
	if($admin==0 && $blacklist==1){
		mkForm("controleur.php");
		echo "&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"action\" value=\"Débannir\" class=\"btn\" style=\"background-color:#25fde9;height:45px;\"/>";
		mkInput("hidden","id",$idUtilisateur);
		endForm();
	}
	echo "</div></br></br>";
	echo '
	<table class="table">
	  	<thead class="bg-dark text-light">
	    	<tr>
	      		<th scope="col">Question</th>
	     		<th scope="col">Choix n°1</th>
	      		<th scope="col">Choix n°2</th>
	     		<th scope="col">Choix n°3</th>
	      		<th scope="col">Choix n°4</th>
	      		<th scope="col">Action</th>
	    	</tr>
	 	</thead>
	 	<tbody>';

	foreach($sondage as $newsondage){
		$choix = getChoix($newsondage["idSondage"]);
		mkForm("controleur.php");
		echo "<tr><td>". $newsondage["Question"] . "</td>";
		foreach($choix as $newchoix){
			echo "<td>". $newchoix["Choix"] . "</td>";
		}
		if($newsondage["nbChoix"]==='2'){
			echo "<td></td><td></td>";
		}
		if ($newsondage["nbChoix"]==='3'){
			echo "<td></td>";
		}
		echo "<td>";
		mkInput("submit", "action" ,"Supprimer le sondage","btn" ,"background-color:#25fde9;");
		echo "</td></tr>";
		mkInput("hidden","idSondage",$newsondage["idSondage"]);
		mkInput("hidden","idUser",$idUtilisateur);
		endForm();
	}

echo "</tbody></table></br>";

	echo '
	<table class="table">
	  	<thead class="bg-dark text-light">
	    	<tr>
	      		<th scope="col">Nom Conversation</th>
	      		<th scope="col">Action</th>
	    	</tr>
	 	</thead>
	 	<tbody>';

	$conversation=listerConversations("",$idUtilisateur);
	foreach($conversation as $newconv){
		mkForm("controleur.php");
		echo "<tr><td>". $newconv['theme'] . "</td>";
		echo "<td>";
		mkInput("submit", "action" ,"Supprimer conversation","btn" ,"background-color:#25fde9;");
		echo "</td></tr>";
		mkInput("hidden","idConv",$newconv["id"]);
		mkInput("hidden","idUser",$idUtilisateur);
		endForm();
	}
}
echo "</tbody></table>";

?>
</div>
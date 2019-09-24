<?php
	session_start();//ouverture ou récupération de session (tableau associatif conservant
					//les données voulues d'une page à l'autre)
					
	require_once("functions.php");

	const PROFONDEUR = 3;//taille de la grille, dans une constante pour qu'on puisse
						//en changer plus tard

	if(!isset($_SESSION['grille']) || isset($_GET['reset'])){
		//si l'entrée "grille" du tableau de session n'a pas été créée
		//ou si on a appuyé sur Reset
		newGame();
	}
	
	if(isset($_GET['case']) && $_SESSION['etatjeu'] == false){
		//si l'entrée "case" des paramètres de requête (GET) est présente dans l'url
		//ex: index.php?case=1-3
		
		//je récupère les coordonnées situées en GET dans un tableau
		//grâce à la fonction explode
		jouerCase(explode("-", $_GET['case']));
		verifierSiGagne();
	}
	
	
?>

<style>

	#grille{
		box-sizing: border-box;
		width: 330px;
		display: flex;
		flex-wrap: wrap;
	}

	.case{
		box-sizing: border-box;
		width: 100px;
		height: 100px;
		border: 1px solid black;
		text-decoration: none;
		text-align: center;
		align-self: center;
		font-size: 5em;
		line-height: 1em;
		border-radius: 20px;
		margin: 5px;
	}
	a.case:hover{
		background-color: #99bff0;
	}


</style>
<a href="?reset">RESET</a>
<p>C'est à <?= $_SESSION['coupjoue']?> de jouer !</p>
<?php
	
	affichageGrille();
	
	echo "<h1>";
	if($_SESSION["etatjeu"] != false){
		echo $_SESSION["etatjeu"];
	}
	echo "</h1>";
	
	var_dump($_SESSION);
?>
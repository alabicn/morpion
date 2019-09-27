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
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no"/>
		<title>Morpion</title>
		<!--link for CSS-->
        <link rel="stylesheet" href="css/style.css">
		<!--logo's icon-->
		<link rel="icon" type="image/x-icon" href="css/img/favicon/favicon.png"/>
	</head>
	<body>
		<main id="page">
			<header>
				<div class="header__content">
                    <div id="logo">
                        <img src="css/img/logo.png" alt="Tic tac toe's logo" />
                        <h1 class="header__logo-txt">Morpion</h1>
					</div>
					<div class="nav">
						<a href="?reset">RESET</a>
					</div>
				</div>
			</header>
				<p class="info">C'est à - <?= $_SESSION['coupjoue']?> - de jouer !</p>
				<?php
					
					affichageGrille();
					
					echo "<h2 class='info'>";
					if($_SESSION["etatjeu"] != false){
						echo $_SESSION["etatjeu"];
					}
					echo "</h2>";
				?>
		<footer>
			<h2 class="signature">&copy; Nemanja ALABIC</h2>
		</footer>
	</main>
	</body>
</html>

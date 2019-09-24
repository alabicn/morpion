<?php
	function affichageGrille(){
		echo "<div id='grille'>";
		for($i = 1; $i <= PROFONDEUR; $i++){//par ligne
			for($j = 1; $j <= PROFONDEUR; $j++){//par colonne
				if($_SESSION['grille'][$i][$j] != ""){
					echo "<span class='case'>".$_SESSION['grille'][$i][$j]."</span>";
				}
				else
					//la case est un lien hypertexte 
					//sous la forme "index.php?case=i-j"
				echo "<a class='case' href='?case=$i-$j'>".$_SESSION['grille'][$i][$j]."</a>";
			}
		}
		echo "</div>";
	}	

	function newGame(){
		$_SESSION['grille'] = array();//on l'initialise à un tableau vide
		$_SESSION["coupjoue"] = (!isset($_SESSION["coupjoue"]) ? "X" : $_SESSION["coupjoue"]);
		$_SESSION['etatjeu'] = false;
		
		for($ligne = 1; $ligne <= PROFONDEUR; $ligne++){//on boucle sur les 3 lignes
			for($colonne = 1; $colonne <= PROFONDEUR; $colonne++){//puis pour une ligne, on boucle sur 3 colonnes
				//[i1][j1] une valeur ""
				//[i1][j2] une valeur ""
				//[i1][j3] une valeur ""
				//fin de la seconde boucle, on repart sur la première boucle
				//[i2][j1] une valeur ""
				//[i2][j2] une valeur ""
				//[i2][j3] une valeur ""
				//fin de la seconde boucle, on repart sur la première boucle
				//[i3][j1] une valeur ""
				//[i3][j2] une valeur ""
				//[i3][j3] une valeur ""
				$_SESSION['grille'][$ligne][$colonne] = "";
			}
			/*array(
				"1" => array("1" => "", "2" => "", "3" => ""),
				"2" => array("1" => "", "2" => "", "3" => ""),
				"3" => array("1" => "", "2" => "", "3" => "")
			)*/
		}
	}
	
	function alternerJoueurs(){
		
		if($_SESSION["coupjoue"] == "X"){
			//si le coup précédent était un X, alors ça devient un O
			$_SESSION["coupjoue"] = "O";
		}
		else{
			//sinon, ça redevient un X
			$_SESSION["coupjoue"] = "X";
		}
	}
	
	function jouerCase($coords){
		//avant = "1-3"
		//après = array("1","3")
		
		//si la grille, aux coordonnées [i1][j3] contient une chaîne vide (jouable)
		if($_SESSION['grille'][$coords[0]][$coords[1]] == ""){
			//je remplis la case correspondante avec le symbole du joueur actuel
			$_SESSION['grille'][$coords[0]][$coords[1]] = $_SESSION["coupjoue"];
			
		}
		
		
	}
	
	function verifierSiGagne(){
		
		for($c = 1; $c <= PROFONDEUR; $c++){
			$matchL = $_SESSION['grille'][$c]["1"].
					  $_SESSION['grille'][$c]["2"].
					  $_SESSION['grille'][$c]["3"];
			$matchC = $_SESSION['grille']["1"][$c].
					  $_SESSION['grille']["2"][$c].
					  $_SESSION['grille']["3"][$c];	
					  
			if($matchL == "XXX" || 
				$matchL == "OOO" || 
				$matchC == "XXX" || 
				$matchC == "OOO"){
				$_SESSION["etatjeu"] = $_SESSION["coupjoue"];
			}
		}
		$c = 1;
		$matchdiag1 = $_SESSION['grille'][$c][$c].
					  $_SESSION['grille'][$c+1][$c+1].
					  $_SESSION['grille'][$c+2][$c+2];
		
		$matchdiag2 = $_SESSION['grille']["1"]["3"].
					  $_SESSION['grille']["2"]["2"].
					  $_SESSION['grille']["3"]["1"];
					  
		if($matchdiag1 == "XXX" || 
			$matchdiag1 == "OOO" || 
			$matchdiag2 == "XXX" || 
			$matchdiag2 == "OOO"){
			$_SESSION["etatjeu"] = $_SESSION["coupjoue"];
		}

		$dispo = false;
		
		for($c = 1; $c <= PROFONDEUR; $c++){
			if(array_search("", $_SESSION['grille'][$c])){
				$dispo = true;

			}
		}
		if($dispo == false){
			$_SESSION["etatjeu"] = "Match nul";
		}
		else{
			alternerJoueurs();
		}
		
	}
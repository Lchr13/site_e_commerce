<!DOCTYPE html>

<html lang="FR">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BEL TI PAYI</title>
	<link rel="stylesheet" type="text/css" href="./styles.css">
</head>

<header>
	<!--Ce qui est censé être au dessus de mon titre sur la meme ligne (1ère banderole)-->
	<div class="titre_haut">
		<div class="placement_T">
			<p>Livraison rapide ✓</p>
			<p>Paiement sécurisé ✓</p>
			<p>Pièce unique ✓</p>
		</div>
		<!-- on va cree dans compte un mini menu un cote se C et se D -->
		<div class="compte_global">
			<!-- sert a cocher la case boutique afin d'aff son menu-->
		   	<input type="checkbox" id="toggleCompte">
	       	<label for="toggleCompte" class="logo_user">
		   	<img src="http://localhost/Site_E_Commerce/utilisateur.png" alt="Utilisateur">
		   	</label>
		   	<!-- FIN de coche case-->
		    <div class="menu_compte">
		      	<p>Bienvenue !</p>
			    <a href="user.php" class="color_1">Se connecter</a><br>
			    <br><a href="deconect.php" class="color_2">Se déconnecter</a>
		    </div>
		</div>    
		<!--FIN-->
   </div>

	<div class="deuxieme_titre_haut">

	<div class="marque">BEL' TI PAYI !</div> <!--coin gauche de la (2eme banderole)-->
  		<nav class="menu">
    		<a href="#" class = "active">ACCUEIL</a>
    		<!-- on va cree dans boutik un mini menu cote F et H -->
    		<div class="boutique_global">
    			<!-- sert a cocher la case boutique afin d'aff son menu-->
    			<nav class="bloc">
    				<input type="checkbox" id="toggleBoutique">
    				<label for="toggleBoutique">BOUTIQUE</label>
				<!-- FIN de coche case-->
    			<div class="menu_boutique">
			    	<a href="femme.php" class="color_1">Bijoux pour femme</a><br>
			    	<br><a href="homme.php" class="color_2">Bijoux pour homme</a> 	
		    	</div>
		    	</nav>
		    </div>	
		    <!-- FIN -->

    		<a href="renseignement.php">À PROPOS DE BEL TI PAYI</a>
    		<a href="panier.php">PANIER</a>
  		</nav>

	</div>

</header>

<body>
	<div >
		<img src="PHOTOWEB1.jpg"style="width: 100%; height: 560px; display: block;">
		<div class="text_sur_img">		
			<h1> Bèl bonjou mo mounian vini wè la bijouterie BEL' TI PAYI !</h1>
		</div>
		<div class="sous_text">
			<h2 style="margin-top: 70px;">Zot ké dékouvri roun collection unique 
			de bijoux artisanaux di nou payi</h2>
		</div>
	
	</div>
	<footer class="pied_page">
	  	<h2>Qui sommes-nous ?</h2>
		<p>
		  	Chez bijoux payi, nous sommes passionnés par la création de bijoux uniques et authentiques, inspirés par la culture et la nature de la Guyane française. Chaque pièce que nous fabriquons est le reflet de notre savoir-faire artisanal et de notre engagement envers la beauté et la qualité.
		</p>
	</footer>
	

</body>

</html>
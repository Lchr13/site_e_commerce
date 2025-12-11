<!DOCTYPE html>
<html>
<?php
session_start();

$portrait_H = [
    ["img" =>"/bijoux1.jpg","nom" => "BAGUE LION EN OR", "prix" => "150€"],
    ["img" =>"/bijoux2.jpg","nom" => "BAGUE OR ET ARGENT", "prix" => "130€"],
    ["img" =>"/bijoux3.jpg","nom" => "BRACELET + BAGUE EN OR", "prix" => "120€"],
    ["img" =>"/bijoux4.jpg","nom" => "BRACELET + BAGUE EN OR", "prix" => "250€"],
    ["img" =>"/bijoux5.jpg","nom" => "PARURE ÉlÉGANT EN OR", "prix" => "300€"],
    ["img" =>"/bijoux6.jpg","nom" => "PARURE ÉlÉGANT EN OR", "prix" => "100€"],
    ["img" =>"/bijoux7.jpg","nom" => "BRACELET + BAGUE EN OR", "prix" => "110€"],
    ["img" =>"/bijoux8.jpg","nom" => "PARURE ÉlÉGANT EN OR", "prix" => "450€"],
    ["img" =>"/bijoux9.jpg","nom" => "PARURE DE MAIN EN OR", "prix" => "201€"],
    ["img" =>"/bijoux10.jpg","nom" => "PARURE DE MAIN EN OR", "prix" => "435€"],
    ["img" =>"/bijoux11.jpg","nom" => "PARURE DE MAIN EN OR", "prix" => "440"],
    ["img" =>"/bijoux12.jpg","nom" => "BRACELET EN PIERRE PRECIEUSE", "prix" => "400€"],
    ["img" =>"/bijoux13.jpg","nom" => "BRACELET EN PIERRE PRECIEUSE", "prix" => "110€"],
    ["img" =>"/bijoux14.jpg","nom" => "MONTRE + BRACELET EN PIERRE PRECIEUSE ", "prix" => "410€"],
    ["img" =>"/bijoux15.jpg","nom" => "BRACELET EN PIERRE PRECIEUSE", "prix" => "370€"],
    ["img" =>"/bijoux16.jpg","nom" => "MONTRE EN ARGENT", "prix" => "480€"],
    ["img" =>"/bijoux17.jpg","nom" => "PARURE DE MAIN EN ARGENT", "prix" => "200€"],
    ["img" =>"/bijoux18.jpg","nom" => "BAGUE EN ARGENT", "prix" => "500€"],
    ["img" =>"/bijoux19.jpg","nom" => "COLLIER EN ARGENT", "prix" => "510€"],
    ["img" =>"/bijoux20.jpg","nom" => "PARURE DE MAIN EN ARGENT", "prix" => "201€"],
    ["img" =>"/bijoux21.jpg","nom" => "PARURE DE MAIN EN ARGENT", "prix" => "520€"],
    ["img" =>"/bijoux22.jpg","nom" => "PARURE DE MAIN EN ARGENT", "prix" => "499€"],
    ["img" =>"/bijoux23.jpg","nom" => "PARURE DE MAIN EN ARGENT", "prix" => "309€"],
    ["img" =>"/bijoux24.jpg","nom" => "PARURE DE MAIN EN ARGENT", "prix" => "215€"],
    // Ajout des images nom prix
];

// Gestion clic coeur (favori)
if (isset($_POST['favori'])) {
    $favoriIndex = $_POST['favori'];
    $_SESSION['favoris'][$favoriIndex] = !($_SESSION['favoris'][$favoriIndex] ?? false);
}

// Gestion ajout panier
if (isset($_POST['ajouter_panier'])) {
    $index = $_POST['ajouter_panier'];
    $_SESSION['panier'][] = $portrait_H[$index];
    header("Location: panier.php");
    exit;
}

?>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="homme.css">
	<title>bijoux homme</title>
</head>

<header>
	<div class="banderole"><h3>BOUTIQUE</h3></div>
	<div >
		<img src="hommes.png"style="width: 100%; height: 540px; display: block;">
		<div class="text_sur_img">		
			<h1> BIJOUX BEL' TI PAYI !</h1>
		</div>	
	</div>
	
</header>

<body>

	<div class="espace_entre_P_et_G"></div> <!--P pour grande photo et G pour gallery-->
	<!-- placer mes photo-->
	<div class="gallery">
		<?php foreach($portrait_H as $index => $bijou): 
	        $favori = $_SESSION['favoris'][$index] ?? false;
	    ?>
    		<div class="photo-container">
	    		<span class="coeur <?= $favori ? 'plein':'' ?>" onclick="toggleFavori(event, <?= $index ?>)">&#9829;</span>
        		<img src="portrait_H/<?= htmlspecialchars($bijou['img']) ?>" alt="<?= htmlspecialchars($bijou['nom']) ?>" class="bloc_photo" onclick="openModel(<?= $index ?>)">
    		</div>
		<?php endforeach; ?>

	</div>

	<!-- Logo panier -->
	<div id="panierLogo" onclick="location.href='panier.php'">
	    <img src="panier.png" alt="Panier">
	</div>

	<!-- Mes fenetres -->
	<div id="monModel" class="base_fenetre">
	    <span class="close" onclick="closeModel()">&times;</span>
	    <img class="fenetre_principale" id="modelPrincipal">
	    <div class="info-legende" id="modelDescriptif"></div>
	</div>
	<!--Mes favories-->
	<form id="formFavori" method="post" style="display:none;">
	    <input type="hidden" name="favori" id="favoriIndexInput">
	</form>
	<!--ajout panier-->
	<form id="formAjouterPanier" method="post" style="display:none;">
	    <input type="hidden" name="ajouter_panier" id="panierIndexInput">
	</form>
		

<script>
    const bijoux = <?php echo json_encode($portrait_H); ?>;

    function toggleFavori(event, index) {
        event.stopPropagation(); // ne pas ouvrir modale à cause du clic coeur

        const coeurElem = event.target;
        const estPlein = coeurElem.classList.toggle('plein');

        // Envoyer la requête POST pour sauvegarder favoris en session
        document.getElementById('favoriIndexInput').value = index;
        document.getElementById('formFavori').submit();
    }

    function openModel(index) {
        let bijou = bijoux[index];

        document.getElementById("monModel").style.display = "block";
        document.getElementById("modelPrincipal").src = "portrait_H/" + bijou.img;
        
        let contenu = `<h1>${bijou.nom}</h1>`;
        contenu += `<h3>Prix : ${bijou.prix}</h3>`;
        contenu += `<button class="btn-ajouter" onclick="ajouterPanier(${index})">Ajouter au panier</button>`;

        document.getElementById("modelDescriptif").innerHTML = contenu;
    }

    function closeModel() {
        document.getElementById("monModel").style.display = "none";
    }

    function ajouterPanier(index) {
        document.getElementById('panierIndexInput').value = index;
        document.getElementById('formAjouterPanier').submit();
    }
</script>

</body>
</html>
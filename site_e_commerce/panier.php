<?php
session_start();
$panier = $_SESSION['panier'] ?? [];

// Suppression du panier si demandé après paiement (exemple)
if (isset($_POST['ajouter_panier'])) {
    $index = $_POST['ajouter_panier'];
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }
    $_SESSION['panier'][] = $portrait_F[$index];
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Panier</title>
    <style>
        body { font-family: Arial, sans-serif; background:#fafafa; color:#333; }
        table { width: 90%; margin: 20px auto; border-collapse: collapse; }
        th, td { border: 1px solid #433; padding: 10px; text-align:left; }
        th { background:#eee; }
        #modelFacture {
            display:none;
            position: fixed;
            top: 5%;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            padding: 25px;
            box-shadow: 0 0 15px rgba(0,0,0,0.5);
            width: 70%;
            max-width: 600px;
            z-index: 10000;
        }
        #modelFacture .close {
            position: absolute;
            right: 10px; top: 10px;
            font-size: 25px;
            cursor: pointer;
            color: #888;
        }
        #modelFacture h2 {
            margin-top: 0;
        }
        #btnPayer {
            margin: 20px auto;
            display: block;
            background-color: #e91e63;
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 1.3em;
            border-radius: 7px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h1>Votre Panier</h1>

<?php if (!empty($panier)) : ?>
<table>
    <thead>
        <tr><th>Bijoux</th><th>Prix</th></tr>
    </thead>
    <tbody>
        <?php foreach ($panier as $produit): ?>
        <tr>
            <td><?= htmlspecialchars($produit['nom']) ?></td>
            <td><?= htmlspecialchars($produit['prix']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Calcul du total DIRECTEMENT après le tableau -->
<?php
$Total = 0;
foreach ($panier as $item) {
    $prix_num = floatval(str_replace(',', '.', preg_replace('/[^0-9,]/', '', $item['prix'])));
    $Total += $prix_num;
}
?>
<h3>Total à payer : <?= number_format($Total, 2, ',', ' ') ?> €</h3>

<button id="btnPayer" onclick="afficherFacture()">Payer</button>
<?php else: ?>
<p>Votre panier est vide.</p>

<?php endif; ?>

<div id="modelFacture">
    <span class="close" onclick="fermerFacture()">&times;</span>
    <h2>Facture imprimable</h2>
    <?php if (!empty($facture)): ?>
        <ul>
        <?php foreach ($facture as $item): ?>
            <li><?= htmlspecialchars($item['nom']) ?> - <?= htmlspecialchars($item['prix']) ?></li>
        <?php endforeach; ?>
        </ul>
        <p><strong>Total :</strong> 
            <?= number_format(array_sum(array_map(function($i){ return floatval(str_replace(',', '.', preg_replace('/[^0-9,]/', '', $i['prix']))); }, $facture)), 2, ',', ' ') ?> €</p>
    <?php else: ?>
        <p>Veuillez payer pour afficher la facture.</p>
    <?php endif; ?>
</div>


<script>
function afficherFacture() {
    document.getElementById("modelFacture").style.display = "block";
}

function fermerFacture() {
    document.getElementById("modelFacture").style.display = "none";
}
</script>

</body>

</html>

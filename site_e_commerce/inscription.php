<!DOCTYPE html>
<html>

<?php

$host = "localhost";
$dbname = "site_e_commerce";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "❌ Erreur de connexion : " . $e->getMessage();
    exit;
}

// Vérifie que le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //creation d'une variable permettant de placer ces messages d'erreur
    $messageErreur = "";

    // Vérifie que tous les champs sont remplis
    if (!empty($_POST['e_mail']) && !empty($_POST['identifiant']) && !empty($_POST['mot_de_passe']) && !empty($_POST['confirmer_mot_de_passe'])) {
        
        $e_mail = $_POST['e_mail'];
        $identifiant = $_POST['identifiant'];
        $mot_de_passe = $_POST['mot_de_passe'];
        $confirmer_mot_de_passe = $_POST['confirmer_mot_de_passe'];

        // Vérifie que les deux mots de passe sont identiques
        if ($mot_de_passe === $confirmer_mot_de_passe) {

            // Vérifier si l'identifiant est déjà utilisé
            $sqlCheck = "SELECT * FROM inscription WHERE identifiant = :identifiant";
            $stmtCheck = $pdo->prepare($sqlCheck);
            $stmtCheck->execute([':identifiant' => $identifiant]);
            $userExists = $stmtCheck->fetch(PDO::FETCH_ASSOC);

            if ($userExists) {
                $messageErreur = "<p>Cet identifiant est déjà utilisé. Veuillez en choisir un autre.</p>";
            } else {
                // Sécurisation du mot de passe
                $mot_de_passe_hash = hash("sha256", $mot_de_passe);
                $confirmer_mot_de_passe_hash = hash("sha256", $confirmer_mot_de_passe);



                // Prépare et exécute la requête
                $sql = "INSERT INTO inscription (e_mail,identifiant, mot_de_passe,confirmer_mot_de_passe) VALUES (:e_mail, :identifiant, :mot_de_passe,:confirmer_mot_de_passe)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':e_mail' => $e_mail,
                    ':identifiant' => $identifiant,
                    ':mot_de_passe' => $mot_de_passe_hash,
                    ':confirmer_mot_de_passe' => $confirmer_mot_de_passe_hash,
                ]);

                // Redirection vers la page de confirmation
                header("Location: confirmation.php?identifiant=" . urlencode($identifiant));
                exit;

                }

        } else {
            // Les mots de passe ne correspondent pas
            $messageErreur ="<p>Les 2 mots de passe pas ne sont pas identique !</p>";
            }

    } 
}

?>



<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="inscription.css">
	<title>Inscription</title>
</head>
<body>
        <div class="bloc_inscription">
            
            <div class="text-align-c">
                <h1 class="text-deco">Créer un compte</h1>              
            </div>

            <form action="./inscription.php" method="post">
            	<label for="e_mail"class="size">e-mail*</label><br>
                	<br><input id="e_mail" class="padding " type="text" name="e_mail" placeholder="e-mail" required>
            
                    <div>
                    	<br><label for="identifiant"class="size">identifiant*</label><br>
                    	<br><input id="identifiant" class="padding " type="text" name="identifiant" placeholder="identifiant" required>
                    </div>
                
                    <div>
                        <br><label for="mot_de_passe"class="size">mot de passe*</label><br>
                        <br><input id="mot_de_passe" class="padding " type="password" name="mot_de_passe" placeholder="mot_de_passe" required>
                    </div>

                    <div>
                        <br><label for="confirmer_mot_de_passe"class="size">confirmer mot de passe*</label><br>
                        <br><input id="confirmer_mot_de_passe" class="padding " type="password" name="confirmer_mot_de_passe" placeholder="mot de passe" required>
                    </div>
                        <br><button class="bouton" type="submit" name="S'inscrire">S'inscrire</button>
                        <!-- Le message s'affichera ici -->
                        <div class="message-erreur">
                            <?php if (isset($messageErreur)) echo $messageErreur; ?>   
                        </div>
            </form>
        </div>

</body>
</html>
<!DOCTYPE html>

<html>

<?php
session_start();

$host ="localhost";
$dbname ="site_e_commerce";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "❌ Erreur de connexion : " . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //creation d'une variable permettant de placer ces messages d'erreur
    $messageErreur = "";

    // Si l'utilisateur est déjà connecté (session active)
    if (isset($_SESSION['auth'])) {
        $messageErreur = "<p>Vous êtes déjà connecté en tant que " . htmlspecialchars($_SESSION['auth']['identifiant']) . "</p>";

    }else if (!empty($_POST['identifiant']) && !empty($_POST['mot_de_passe_hash'])) {
            $identifiant = $_POST['identifiant'];
            $mot_de_passe = $_POST['mot_de_passe_hash'];

            // Requête pour récupérer l'utilisateur avec cet identifiant
            $sql = "SELECT * FROM inscription WHERE identifiant = :identifiant";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':identifiant' => $identifiant]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Hasher le mot de passe envoyé pour comparaison 
                $mot_de_passe_hash = hash("sha256", $mot_de_passe);

                // Vérifier si le mot de passe haché correspond à celui en base
                if ($mot_de_passe_hash === $user['mot_de_passe']) {

                    // Stocker les infos utilisateur en session
                    $_SESSION['auth'] = $user;

                    $sql = "INSERT INTO connexion (identifiant, mot_de_passe) VALUES (:identifiant, :mot_de_passe)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':identifiant' => $identifiant,
                        ':mot_de_passe' => $mot_de_passe_hash,
                    ]);
                

                    //Redirection vers le role
                    if ($user['role'] === 'admin') {
                        header('Location: admin.php'); // redirige l'admin vers la section admin
                        exit;
                    } else {
                        header('Location: index.php'); // autre utilisateur vers accueil normal
                        exit;
                    }

                } else {
                    $messageErreur ="<p>Mot de passe incorrect !</p>";
                }
            } else {
                $messageErreur ="<p >Vous n'êtes pas inscrit !</p>";
            }
    }

}

?>



<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="user.css">
	<title>Connexion</title>
</head>
<body>
        <div class="bloc_connecter" style="display: flex; flex-direction: column;">
            
            <div class="text-align-c">
                <h1>Connexion</h1>
                <h3>Nouveau sur ce site ?&nbsp<a href="inscription.php"class="color">S'inscrire</a></h3>              
            </div>

            <form action="user.php" method="post">
                <label for="identifiant"class="size">identifiant*</label><br>
                    <br><input id="identifiant" class="padding " type="text" name="identifiant" placeholder="identifiant" required>

                    <div>
                        <br><label for="mot_de_passe"class="size">mot de passe*</label><br>
                        <br><input id="mot_de_passe" class="padding " type="password" name="mot_de_passe_hash" placeholder="mot_de_passe" required>
                    </div>
                        <br><button class="bouton" type="submit" name="Se connecter">Se connecter</button>
                        <!-- Le message s'affichera ici -->
                        <div class="message-erreur">
                            <?php if (isset($messageErreur)) echo $messageErreur; ?>   
                        </div>

            </form>
        </div>

</body>
</html>
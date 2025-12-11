<?php
session_start();

// Vérifier si l'utilisateur est connecté et est admin
if (!isset($_SESSION['auth']) || $_SESSION['auth']['role'] !== 'admin') {
    // Accès refusé, rediriger vers la page de connexion
    header('Location: user.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Section Admin</title>
</head>
<body>
    <h1>Bienvenue dans la section Admin</h1>
    <p>Bonjour, <?php echo htmlspecialchars($_SESSION['auth']['identifiant']); ?>.</p>

    <nav>
        <ul>
            <!-- CRUD = Creer Lire MAJ Supprimer -->
            <li><a href="categories_crud.php">Gérer les catégories (CRUD)</a></li>
            <li><a href="users_crud.php">Gérer les utilisateurs (CRUD)</a></li>
        </ul>
    </nav>

    <p><a href="page_deconect.php">Se déconnecter</a></p>
</body>
</html>

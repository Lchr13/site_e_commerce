<?php
$identifiant = isset($_GET['identifiant']) ? htmlspecialchars($_GET['identifiant']) : 'utilisateur';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation</title>
    <style>

        body{

          margin: 0;
          height: 100vh;
          display: flex;
          justify-content: center;
          align-items: center;
          background-color: palegreen;
  
        }

        .bloc_confirmation{
            background-color:white;
            border: 3px solid green;
            padding: 30px;
            border-radius: 10px;
            display: inline-block;
            animation: pop 0.6s ease-out;/*relier a keyframes nom variable pop meme chose*/

        }

        /*annimation effet lorsque la page d'inscription s'ouvre */
        @keyframes pop {
            0% { transform: scale(0.8); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }

        }

        .text-align-c{
            text-align:center;
        }


        .padding{
            padding: 60px 10px;
        }

        .color{
            color: black;
        }

        a {
            display: block;
            margin-top: 50px;
            color: green;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="bloc_confirmation">
        <div class="text-align-c padding color">
            <h1>Inscription réussie✅!</h1>
            <h2>Bienvenue <strong><?php echo $identifiant; ?></strong> !!!</h2>
            <a href="index.php">Retour à l'accueil</a>
        </div>
    </div>
</body>
</html>
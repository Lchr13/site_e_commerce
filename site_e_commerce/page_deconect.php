<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Déconnexion</title>
	<style>

        body{

          margin: 0;
          height: 100vh;
          display: flex;
          justify-content: center;
          align-items: center;
          background-color: #EE9089;
  
        }

        .bloc_déco{
            background-color:white;
            border: 3px solid black;
            padding: 50px;
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
            color: red;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>
	<div class="bloc_déco">
        <div class="text-align-c padding color">
            <h1>Déconnexion reussie !</h1>
            <h1>A Bientôt . </h1>
            <a href="index.php">Retour à l'accueil</a>
        </div>
    </div>

</body>
</html>
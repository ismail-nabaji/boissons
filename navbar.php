<!DOCTYPE html>
<html>
<head>
    <title>Votre titre</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


<nav class="nav">

        <ul>

            <li class="logo">
                <img src="images/cocktail.png" alt="" width="50" height="50">
            </li>
            

            <li>
                <a href="index.php">ACCUEIL</a>
            </li>

            <li>
                <a href="recettes.php">NOS RECETTES</a>
            </li>

            <li>
                <a href="">CONTACT</a>
            </li>

            <li>
                <a class="log" href="inscription.php">LOGIN</a>
            </li>

            <li class="panier">
                <img src='images/panier.png' alt="" width="50" height="50">
            </li>

            <?php

                //session_start(); // Démarrer la session sur chaque page où vous utilisez $_SESSION

                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo "<li class ='user'><img src='images/utilisateur.png' alt='' width='50' height='50'></li>";
                }
            ?>

        </ul>

    </nav>  

    <script>
        document.querySelector('.user').addEventListener('click', function() {
            window.location.href = 'infosUser.php'; // Redirection vers le script de déconnexion
        });

        document.querySelector('.panier').addEventListener('click', function() {
            window.location.href = 'panier.php'; 
        });
    </script>

    
    </body>

</html>


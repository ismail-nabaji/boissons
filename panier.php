<?php 

session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mon Panier</title>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
</head>
<body class="is-preload">

    <div id="wrapper">
        <div id="main">
            <div class="inner">

                <!-- Header -->
                <header id="header">
                    <a href="index.php" class="logo"><strong>Boissons</strong> by Nabaji & Zouari</a>
                
                </header>
                <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        try {
                            $pgDB = new PDO('mysql:host=127.0.0.1;dbname=Cocktails', 'root', '');
                        } catch (Exception $e) {
                            exit($e->getMessage());
                        }
                    
                        $nom_utilisateur = $_SESSION['id'];
                    
                        // Requête SQL pour récupérer les informations des recettes dans le panier de l'utilisateur spécifique
                        $sql = "SELECT Panier.loginP, Cocktail.nomCocktail, Panier.dateAjout
                                FROM Panier
                                INNER JOIN Cocktail ON Panier.nomCocktailP = Cocktail.nomCocktail
                                WHERE Panier.loginP = :loginP";
                        
                        try {
                            $stmt = $pgDB->prepare($sql);
                            $stmt->bindParam(':loginP', $nom_utilisateur, PDO::PARAM_STR);
                            $stmt->execute();
                        
                            // Récupération des résultats
                            $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                            echo "<ul>";
                    
                            // Affichage des informations sur chaque recette dans le panier de l'utilisateur
                            foreach ($resultats as $resultat) {
                                echo "<li>" . $resultat['nomCocktail'] . "</li>";
                            }
                    
                            echo "</ul>";
                    
                        } catch (PDOException $e) {
                            exit("Erreur lors de l'exécution de la requête: " . $e->getMessage());
                        }
                    
                    }
                ?>
               
            </div>
        </div>
        <?php include 'sidebar.php'; ?>
    </div>
    
            <script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

</body>
    

</html>
<?php 

session_start();

include 'navbar.php'; ?>


<?php
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
?>

<!DOCTYPE html>
<html>

<head>
      <title>Inscription</title>
	<meta charset="utf-8" />

      <style>

          
      </style>

</head>

<body>


    
</body>

</html>
<?php
// Connexion à la base de données
// ... (code de connexion à la base de données)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données envoyées par AJAX
    $includedIngredients = $_POST['includedIngredients'];
    $excludedIngredients = $_POST['excludedIngredients'];

    try {
        //echo "<script>console.log('cc');</script>\n";
        $pgDB = new PDO('mysql:host=127.0.0.1;dbname=Cocktails', 'root', '');
    } catch (Exception $e) {
        exit($e->getMessage());
    }

    // Exemple simplifié de requête SQL (vous devrez personnaliser cela en fonction de votre base de données)
    $query = "SELECT * FROM Cocktail WHERE ingredients LIKE '%$includedIngredients%' AND ingredients NOT LIKE '%$excludedIngredients%'";
    $result = $pgDB->query($query);

    // Affichage des résultats
    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            //echo '<p>' . $row['nom_recette'] . '</p>';
            // Afficher d'autres détails de la recette si nécessaire
        }
    } else {
        echo 'Aucune recette trouvée.';
    }
}
?>

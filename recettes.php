<!DOCTYPE html>
<html>
<head>
    <title>Nos recettes</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="">
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>

    body{

        align-items:center;
    }

</style>

<?php

    if(isset($_POST['ajouter_panier'])){

        echo "<script>console.log('cc');</script>\n";

        session_start(); // Démarrer la session sur chaque page où vous utilisez $_SESSION

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            
            $dateAjout = date("Y-m-d H:i:s");

            //echo "<script>console.log('slt');</script>\n";

            try {
                //echo "<script>console.log('cc');</script>\n";
                $pgDB = new PDO('mysql:host=127.0.0.1;dbname=Cocktails', 'root', '');
            } catch (Exception $e) {
                exit($e->getMessage());
            }
            
            //Récupération des données depuis le formulaire
            $titre = $_POST['titreRecette'];
            $id = $_SESSION['id'];
            $dateAjout = date("Y-m-d H:i:s");

            echo "<script>console.log('$titre');</script>\n";

            // Vérification si le cocktail existe dans la table 'Cocktail'
            $checkCocktail = $pgDB->prepare("SELECT nomCocktail FROM Cocktail WHERE nomCocktail = :nomCocktail");
            $checkCocktail->bindParam(':nomCocktail', $titre, PDO::PARAM_STR);
            $checkCocktail->execute();
            $cocktailExists = $checkCocktail->fetch(PDO::FETCH_ASSOC);

            $checkId = $pgDB->prepare("SELECT login FROM Utilisateur WHERE login = :login");
            $checkId->bindParam(':login', $id, PDO::PARAM_STR);
            $checkId->execute();
            $idExists = $checkId->fetch(PDO::FETCH_ASSOC);

            if ($cocktailExists && $idExists) {

                echo "<script>console.log('existe');</script>\n";
                // Le cocktail existe dans la table 'Cocktail', on peut l'insérer dans la table 'Panier'
                $insertQuery = "INSERT INTO Panier (loginP, nomCocktailP, dateAjout) VALUES (:loginP, :nomCocktailP, :dateAjout)";
                $stmt = $pgDB->prepare($insertQuery);
                $stmt->bindParam(':loginP', $_SESSION['id'], PDO::PARAM_STR);
                $stmt->bindParam(':nomCocktailP', $titre, PDO::PARAM_STR);
                $stmt->bindParam(':dateAjout', $dateAjout, PDO::PARAM_STR);

                $stmt->execute();
                
            }
        
        }

    }
?>

<body>

    <?php

        include 'Donnees.inc.php';

        include 'navbar.php';

        $titre;

        //session_start();

        function afficherChemin($element, $hierarchie) {
            if (!isset($hierarchie[$element]['super-categorie'])) {
                echo $element;
            } else {
                $superCategories = $hierarchie[$element]['super-categorie'];
                $superCategorie = reset($superCategories);
                afficherChemin($superCategorie, $hierarchie);
                echo " > $element";
            }
        }
        

        if(isset($_POST['ingredient'])){
            $ingredient = $_POST['ingredient'];
        }else{
       
            $ingredient = "Aliment";
        }

        echo "<h1>Ingrédient actuel: $ingredient</h1>";
 

        if(isset($Hierarchie[$ingredient]['sous-categorie'])){
            $liste_categ = $Hierarchie[$ingredient]['sous-categorie'];
            echo "<h3>Sous catégories : </h3>";
            echo "<form action=\"\" method=\"post\">";
            foreach ($liste_categ as $categ) {
                echo "<input type=\"submit\" name=\"ingredient\" value=\"", $categ ,"\" />";
            }
            echo "</form>";
        }

        afficherChemin($ingredient, $Hierarchie);

        echo "<h1>Nos recettes avec cet ingrédient : <br></h1>";

        foreach($Recettes as $recette){

            if(in_array($ingredient, $recette['index'])){

                $titre = $recette["titre"];

                echo "<h2>$titre</h2>";

                $nomPhoto = str_replace(" ", "_", $titre . ".jpg");

                if(file_exists("Photos/" . $nomPhoto)){

                    echo '<img src="Photos/' . $nomPhoto . '" alt="' . $titre . '">';

                }

                $ingredientsArray = explode("|", $recette["ingredients"]);

                echo "<h4>Voici les ingrédients dans cette recette : <br></h4>";

                foreach($ingredientsArray as $ing){

                    echo "<p>$ing</p>";
                }

                echo "<h4>Voici la préparation pour cette recette : <br></h4>";

                $preparation = $recette["preparation"];

                echo "<p>$preparation</p>";

                echo "<form action='' method='post'>";
                    echo "<input type='hidden' id='titreRecette' name='titreRecette' value='$titre' />";
                    echo "<input type='submit' name='ajouter_panier' value='Ajouter $titre a mon panier'/>";
                echo "</form>";

            }

        }

    ?>
    
</body>

<script>

    const $sousCategorie = document.querySelectorAll("sousCategorie");

    $sousCategorie.forEach(sousCat => {
    
        sousCat.addEventListener('click', function(){

            const nomSousCategorie = this.textContent;


        })

    });

</script>

</html>
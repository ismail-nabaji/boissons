<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Votre titre</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
</head>

<?php 

    try {
        $pgDB = new PDO('mysql:host=127.0.0.1;dbname=Cocktails', 'root', '');
        $pgDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_SESSION['id'];

        // Vérification si l'utilisateur existe déjà
        $stmt = $pgDB->prepare("SELECT * FROM Utilisateur WHERE login = :login");
        $stmt->bindParam(':login', $id, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    if (isset($_POST['enregistrer'])) {
        $id = $_POST['id'];
        $password = $_POST['password'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $sexe = isset($_POST['sexe']) ? $_POST['sexe'] : '';
        $numTel = isset($_POST['numTel']) ? $_POST['numTel'] : '';
        $birthdate = $_POST['birthDate'];
        $mail = $_POST['mail'];
        $adresse = $_POST['adresse'];
        $codePostal = $_POST['codePostal'];
        $ville = $_POST['ville'];
    
        // Vérification si l'utilisateur existe déjà
        $stmt = $pgDB->prepare("SELECT * FROM Utilisateur WHERE login = :login");
        $stmt->bindParam(':login', $id, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // Insérer un nouvel utilisateur
        $sql = "UPDATE Utilisateur SET mdp = :password, nom = :nom, prenom = :prenom, sexe = :sexe, numTel = :numTel, dateNaissance = :birthdate, mail = :mail, adresse = :adresse, codePostal = :codePostal, ville = :ville WHERE login = :login";

        try{

            $stmt = $pgDB->prepare($sql);

            $stmt->bindParam(':login', $id, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
            $stmt->bindParam(':numTel', $numTel, PDO::PARAM_STR);
            $stmt->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $stmt->bindParam(':codePostal', $codePostal, PDO::PARAM_STR);
            $stmt->bindParam(':ville', $ville, PDO::PARAM_STR);

            $stmt->execute();

        }  catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        
    }

?>



<style>

    .boutonDeconnecter{

        display: flex;
        justify-content:center;
    }
    
</style>

<body>


    <div id="wrapper">
            <div id="main">
                <div class="inner">

                    <!-- Header -->
                    <header id="header">
                        <a href="index.php" class="logo"><strong>Boissons</strong> by Nabaji & Zouari</a>
                    
                    </header>

                    <section>
                    <h2>Mes informations</h2>

                    
                        <form id="loginPage" method="post" action="#">
                            <fieldset>
                                <label for="id" class="label" id="labelId">Identifiant*</label>
                                <input type="text" id="id" name="id" value ="<?php echo $user['login']; ?>" required><br>                                

                                <label for="password" class="label" id="labelPwd">Mot de passe*</label>
                                <input type="password" id="password" name="password" value ="<?php echo $user['mdp']; ?>" required><br>

                                <label for="nom" class="label" id="labelNom">Nom</label>
                                <input type="text" id="nom" name="nom" value ="<?php echo $user['nom']; ?>" >

                                <label for="prenom" class="label">Prénom</label>
                                <input type="text" id="prenom" name="prenom" value ="<?php echo $user['prenom']; ?>" ><br>

                                <div class="sexe-labels">
                                    <label for="sexe" class="label">Homme</label>
                                    <input type="radio" id="sexe" name="sexe" value="h">

                                    <label for="sexe" class="label">Femme</label>
                                    <input type="radio" id="sexe" name="sexe" value="f">

                                    <label for="sexe" class="label">Autre</label>
                                    <input type="radio" id="sexe" name="sexe" value="a">
                                </div><br>

                                <label for="numTel" class="label">Numéro de téléphone :</label>
                                <input type="tel" id="numTel" name="numTel" pattern="[0-9]{10}" placeholder="Entrez votre numéro de téléphone" value ="<?php echo $user['numTel']; ?>" ><br>

                                <label for="birthDate" class="label" id="labelBd">Date de naissance</label>
                                <input type="date" id="birthDate" name="birthDate" value ="<?php echo $user['dateNaissance']; ?>" ><br>

                                <label for="mail" class="label" id="labelMail">E-Mail</label>
                                <input type="email" id="mail" name="mail" value ="<?php echo $user['mail']; ?>" ><br>

                                <label for="adresse" class="label">Adresse</label>
                                <input type="text" id="adresse" name="adresse" value ="<?php echo $user['adresse']; ?>" >

                                <label for="codePostal" class="label" id="labelCodePostal">Code Postal</label>
                                <input type="text" id="codePostal" name="codePostal" value ="<?php echo $user['codePostal']; ?>" >

                                <label for="ville" class="label" id="labelVille">Ville</label>
                                <input type="text" id="ville" name="ville" value ="<?php echo $user['ville']; ?>" ><br>

                                <input type="submit" id="enregistrer" name="enregistrer" class="button large" value="Enregistrer">
                            </fieldset>
                        </form>


                
                        
                    </section>

                    <div class="boutonDeconnecter"><button class='bouton'>Se deconnecter</button></div>
                </div>
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    
            <script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

    <script>

        document.querySelector('.bouton').addEventListener('click', function() {
        //$_SESSION['loggedin'] = false;
        window.location.href = 'logout.php';
        });

    </script>



</body>

</html>
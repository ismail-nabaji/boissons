<!DOCTYPE html>
<html>

<head>
      <title>Inscription</title>
	<meta charset="utf-8" />

      <style>

            body{

                  display:block;
                  align-items:center;
                  justify-content: center;
                  background-size: cover; 
                  background-position: center; 
                  background-repeat: no-repeat;
            }

            form{
                  border: none;
                  padding: 0;
               
            }

            #loginPage{

                  height: auto;
                  width: 60%;
                  margin: auto;
                  margin-top: 100px;
                  align-items:center;
                  border-radius: 10px;
                  
            }

            #loginPage legend {

                  text-align: center;
                  font-weight: bold;
                  font-size: 26px;
            }

            input:focus {
                  outline:  none;
            }

            #connexion {

                  font-size: 18px;
                  align-items:center;
                  display:block;
                  margin:auto;
                  border: 2px solid #000; /* Bordure */
                  background-color:#1DD513;
                  margin-bottom:10px;
            }

            label {

                  margin-left: 20px;
                  margin-bottom: 15px;
            }

            input {

                  margin-left: 20px;
                  margin-bottom: 20px;
                  margin-right: 20px;
            }

            .sexe-labels {    
                  
            }

            .sexe-labels label {
                  font-size: 16px;  
            }

             /* Style pour le champ de formulaire en focus */
            input:focus {
                  border: 1px solid black;
            }

            .labelConnexion {

                  display:flex;
                  margin:auto;
                  margin-top:30px;
            }

            p {

                  text-align:center;
                  margin-top:30px;
            }

      </style>

</head>

<?php
try {
    $pgDB = new PDO('mysql:host=127.0.0.1;dbname=Cocktails', 'root', '');
} catch (Exception $e) {
    exit($e->getMessage());
}

if (isset($_POST['connexion'])) {
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

    if ($user) {


    } else {
        // Insérer un nouvel utilisateur
        $stmt = $pgDB->prepare("INSERT INTO Utilisateur (login, mdp, nom, prenom, sexe, numTel, dateNaissance, mail, adresse, codePostal, ville) 
                                VALUES (:login, :mdp, :nom, :prenom, :sexe, :numTel, :birthdate, :mail, :adresse, :codePostal, :ville)");

        $stmt->bindParam(':login', $id, PDO::PARAM_STR);
        $stmt->bindParam(':mdp', $password, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
        $stmt->bindParam(':numTel', $numTel, PDO::PARAM_STR);
        $stmt->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);
        $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $stmt->bindParam(':codePostal', $codePostal, PDO::PARAM_STR);
        $stmt->bindParam(':ville', $ville, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "<p>Inscription effectuée avec succès.</p>";
            header("Location: connexion.php"); // Redirection vers login.php après inscription
            exit;
        } else {
            echo "<p>Erreur lors de l'inscription</p>" . $stmt->errorInfo()[2];
        }
    }
}
?>



<body>

      <?php include 'navbar.php';?>

      <form id="loginPage" method="post" action="#">

            <fieldset>

            <legend>Inscription</legend>

                  <label for="id" id="labelId">Identifiant*</label>
                  <input type="text" id="id" name="id" required> <br>

                  <label for="password" id="labelPwd">Mot de passe*</label>
                  <input type="password" id="password" name="password" required> <br>

            

                  <label for="nom" id="labelNom">Nom</label>
                  <input type="text" id="nom" name="nom" >

                 

                  <label for="prenom">Prénom</label>
                  <input type="text" id="prenom" name="prenom" > <br>

                  <div class="sexe-labels">

                        <label for="sexe">Homme</label>
                        <input type="radio" id="sexe" name="h" value="h">

                        <label for="sexe">Femme</label>
                        <input type="radio" id="sexe" name="f" value="f">

                        <label for="sexe">Autre</label>
                        <input type="radio" id="sexe" name="a" value="a">

                  </div>   <br>

                  <label for="numTel">Numéro de téléphone :</label>
                  <input type="tel" id="numTel" name="numTel" pattern="[0-9]{10}" placeholder="Entrez votre numéro de téléphone"> <br>

          

                  <label for="birthDate" id="labelBd">Date de naissance</label>
                  <input type="date" id="birthDate" name="birthDate"> <br>

              

                  <label for="mail" id="labelMail">E-Mail</label>
                  <input type="email" id="mail" name="mail"> <br>

        

                  <label for="adresse">Adresse</label>
                  <input type="text" id="adresse" name="adresse" >

    

                  <label for="codePostal" id="labelCodePostal">Code Postal</label>
                  <input type="text" id="codePostal" name="codePostal">

            

                  <label for="ville" id="labelVille">Ville</label>
                  <input type="text" id="ville" name="ville"> <br>

                  <input type="submit" id="connexion" name="connexion" value="S'inscrire">

            </fieldset>

      </form>

      <div class="labelConnexion">
            <a href="connexion.php" class="labelConnexion">Vous avez déja un compte ? Cliquez ici pour se connecter.</a>
      </div>

      <?php $stmt = $pgDB->prepare("SELECT * FROM Utilisateur WHERE login = :login");
            $stmt->bindParam(':login', $id, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if($user){

                  echo "<p>Nom d'utilisateur déjà utilisé, veuillez en utiliser un autre.</p>";
            }     
        ?>

</body>

</html>
<!DOCTYPE html>
<html>

<head>
      <title>Connexion</title>
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

            .labelInscription {

                display:flex;
                margin:auto;
                margin-top:30px;
            }

            p {

                text-align:center;
                margin-top:30px;
            }

            a {
            
                display: flex;
                justify-content:center;
                
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

        // Vérification si l'utilisateur existe déjà
        $stmt = $pgDB->prepare("SELECT * FROM Utilisateur WHERE login = :login");
        $stmt->bindParam(':login', $id, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            if($password == $user['mdp']){

                //echo "<p>Bienvenue, $id.</p>";

                session_start();

                //echo "<a href='infosUser.php'>Voir mes informations</a>";
                $_SESSION['loggedin'] = true;
                $_SESSION["id"] = $id;
                header("Location: infosUser.php");
                exit();

            } else {

                echo "<p>Identifiant ou mot de passe incorrect</p>";
            }
        }

    }

?>



<body>

      <?php include 'navbar.php';?>

      <form id="loginPage" method="post" action="#">

            <fieldset>

            <legend>Connexion</legend>

                  <label for="id" id="labelId">Identifiant</label>
                  <input type="text" id="id" name="id" required> <br>

                  <label for="password" id="labelPwd">Mot de passe</label>
                  <input type="password" id="password" name="password" required> <br>

                  <input type="submit" id="connexion" name="connexion" value="Se connecter">

            </fieldset>

      </form>

      <div class="labelInscription">
            <a href="inscription.php" class="labelInscription">Vous n'avez pas de compte ? Cliquez ici pour s'inscrire.</a>
      </div>

      <?php 
      
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

            echo "<a href='infosUser.php'>Voir mes informations</a>";
        }

      ?>

</body>

</html>
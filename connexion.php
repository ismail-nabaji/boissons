<?php 


session_start(); ?>


<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

<!DOCTYPE html>
<html>

<head>
      <title>Connexion</title>
      <link rel="stylesheet" type="text/css" href="assets/css/main.css">

      <style>

            

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

                echo "<h2>Identifiant ou mot de passe incorrect</h2>";
            }
        }

    }

?>



<body class="is-preload">

    <div id="wrapper">
        <div id="main">
            <div class="inner">

                <!-- Header -->
                <header id="header">
                    <a href="index.php" class="logo"><strong>Boissons</strong> by Nabaji & Zouari</a>
                
                </header>

                <section>
                <h2>Connexion</h2>


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

      </div>

      </div>

      <?php include 'sideBar.php';?>

      </div>

      <?php 
      
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

            echo "<a href='infosUser.php'>Voir mes informations</a>";
        }

      ?>

</body>

</html>
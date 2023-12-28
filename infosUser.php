<!DOCTYPE html>
<html>
<head>
    <title>Votre titre</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<style>

    .boutonDeconnecter{

        display: flex;
        justify-content:center;
    }
    
</style>

<body>

    <?php include 'navbar.php'; ?>

    <div class="boutonDeconnecter"><button class='bouton'>Se deconnecter</button></div>

    

    <script>

        document.querySelector('.bouton').addEventListener('click', function() {
        //$_SESSION['loggedin'] = false;
        window.location.href = 'logout.php';
        });

    </script>

</body>

</html>
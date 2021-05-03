<?php 
    if(isset($_POST['deconnexion']))
        {
            session_start();
            $_SESSION = array();
            session_destroy();
        }
?>
<!DOCTYPE html>
<html>
<head>  
    <meta charset = 'utf-8'/>
    <title>TP3</title>
</head>

<body>
    <form method="POST">
        <input type="text" name = "pseudo" placeholder="pseudo" required>
        <input type="password" name="pass" placeholder="mot de passe" required>
        <label for="rememberMe">Rester connecter</label>
        <input type="checkbox" name="rememberMe" id="rememberMe">
        <input type="submit" name = "submit" value="connexion">
    </form>
    
    
    <?php
        if(isset($_POST['submit']))
        {
            try{
                $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch(Exception $e)
            {
                die('Error : '.$e->message);
            }
            $result = $bdd->prepare('SELECT pseudo,pass FROM membre WHERE pseudo = ? ');
            $result->execute(array($_POST['pseudo']));

            if($membre = $result->fetch())
            {
                if(password_verify($_POST['pass'],$membre['pass']))
                {
                    session_start();
                    $_SESSION['pseudo'] = $_POST['pseudo'];
                    header('location : hello.php',true,301);
                }
                else{
                    echo 'mot de passe incorrecte';
                }
            }
            else{
                echo 'pseudo que vous avez entrez n\'existe pas';
            }
        }
    ?>

</body>
</html>
<?php include('file.php');?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>
    <title>blog</title>
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://kit.fontawesome.com/1d881ea511.js" crossorigin="anonymous"></script>
</head>
<body>

    <?php include("header.php");?>

    <section>
    <form method= 'POST' action="sign_up.php">
        <input type="text" name = 'nom' id = 'nom' placeholder="nom" required>
        <input type="text" name = 'prenom' id = 'prenom' placeholder="prenom" required>
        <input type="email" name = 'email' id= 'email' placeholder="email" required>
        <input type="password" name = 'password' id = 'password' placeholder='mot de passe' required>
        <span>
            <input type="password" name = 'confirm_password' id = 'confirm_password' placeholder='confirmer mot de passe' required>
            <?php 
                if(isset($_POST['submit']))
                {
                    if($_POST['password'] != $_POST['confirm_password'])
                    {
                        echo '<p>mot de passe non valide</p>';
                    }
                    else
                    {
                        try{
                            $bdd = new PDO('mysql:host=localhost;dbname=utilisateur;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                        }
                        catch(Exception $e){
                            die('Error : '.$e->message);
                        }
                        $utilisateur = $bdd->prepare('INSERT INTO user(nom,prenom,email,_password) VALUES (?,?,?,?)');
                        $utilisateur->execute(array($_POST['nom'],$_POST['prenom'],$_POST['email'],md5($_POST['password'])));
                    }
                }  
            ?>
        </span>
        <input type="submit" name='submit' value='confirmer'>
    </form>
    </section>
</body>
</html>


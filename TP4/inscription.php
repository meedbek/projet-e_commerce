<!DOCTYPE html>
<html>
<head>  
    <meta charset = 'utf-8'/>
    <title>TP3</title>
</head>

<body>
    <form method = 'POST'>
        <input type="text" name = "pseudo" placeholder="pseudo" required>
        <input type="password" name="pass" placeholder="mot de passe" required>
        <input type="password" name="confirmPass" placeholder="confirmer mot de passe" required>
        <input type="email" name="email" placeholder="email" required>
        <input type="submit" name="submit" value="s'inscrire" required>
    </form>
</body>

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

        $membre_inscrit = $bdd->prepare('SELECT pseudo FROM membre WHERE pseudo = ?');
        $membre_inscrit->execute(array($_POST['pseudo']));

        if( $membre_inscrit->fetch())
            echo 'pseudo que vous avez entrer existe déja essayez une autre fois';
        else if($_POST['pass'] != $_POST['confirmPass'])
            echo 'les deux mot de passe ne sont pas identiques essayez une autre fois';
        else
        {
            echo 'Vous vous êtes inscrit correctement';
            $add_membre = $bdd->prepare('INSERT INTO membre(pseudo,pass,email,date_inscription) VALUES (?,?,?,CURDATE())');
            $add_membre->execute(array($_POST['pseudo'],password_hash($_POST['pass'],PASSWORD_DEFAULT),$_POST['email']));
        }
    }
?>
</html>
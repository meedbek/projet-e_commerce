<?php include('session.php');?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>
    <title>ENSIAS E_commerce</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/style_sign_up.css" />
    <script src="https://kit.fontawesome.com/1d881ea511.js" crossorigin="anonymous"></script>
    
</head>
<body>

    <?php include("header.php");?>

    <section>
    <div id="inscrire">
        <h1 class='ll'><span>E</span>NSIAS</h1> 
        <form method= 'POST' action="sign_up.php">
        <h2>INSCIRPTION</h2>
        
    
            <div class="l1"><i class="fas fa-user-check" style="padding:40px;color:lightgreen;"></i><input type="text" name = 'nom' id = 'nom' placeholder="nom" required></div>
            <div class="l2"><i class="fas fa-user" style='padding:40px;color:lightgreen;'></i><input type="text" name = 'prenom' id = 'prenom' placeholder="prenom" required></div>
            <div class="l1"><i class="fas fa-at" style="box-sizing:border-box;padding:40px;color:#c70067;"></i><input type="email" name = 'email' id= 'email' placeholder="email" required></div>
            <div class="l1"> <i class="fas fa-lock" style="padding:40px;color:green;"></i><input type="password" name = 'password' id = 'password' placeholder='mot de passe' required></div>
            <div class="l1"><i class="fas fa-lock" style="padding:40px;color:green;"></i> <input type="password" name = 'confirm_password' id = 'confirm_password' placeholder='confirmer mot de passe' required></div>
                <input type="submit" name='submit' value='confirmer'>
                <?php 
                    if(isset($_POST['submit']))
                    {
                        if($_POST['password'] != $_POST['confirm_password'])
                        {
                            echo '<script>alert(\'Les deux mots de passes que vous avez entrer ne sont pas identique\') </script>';
                        }
                        else
                        {
                            try{
                                $bdd = new PDO('mysql:host=localhost:3306;dbname=utilisateur;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                            }
                            catch(Exception $e){
                                die('Error : '.$e->message);
                            }
                            $utilisateur = $bdd->prepare('INSERT INTO user(nom,prenom,email,_password) VALUES (?,?,?,?)');
                            try{
                                $utilisateur->execute(array($_POST['nom'],$_POST['prenom'],$_POST['email'],md5($_POST['password'])));
                                echo '<script>
                                        alert(\'Vous vous êtes inscrit avec succes\');
                                        location = "login.php";
                                      </script>';
                            }
                            catch(Exception $e )
                            {
                                echo'<script>alert("L\'email que vous avez entrer existe déja");</script> ';
                            }
                            
                        }
                    }  
                ?>
            
            
        </form>
        </div>
    </section>

    <?php include("footer.php");?>
</body>
</html>


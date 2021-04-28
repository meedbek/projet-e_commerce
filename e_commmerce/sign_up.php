<?php 
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=vole;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch(Exception $e){
            die('Error : '.$e->message);
        }
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>
    <title>blog</title>
    <!--<link rel=stylesheet href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
</head>
<body>
    
    
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
                        
                    }
                }
                
            ?>
        </span>
        <input type="submit" name='submit' value='confirmer'>
    </form>
</body>
</html>


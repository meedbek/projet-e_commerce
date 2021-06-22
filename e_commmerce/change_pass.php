<?php include('session.php');?>

<?php 
    $old=true;
    $new=true;
    if(isset($_SESSION['email']))
    {
            try{
                $bdd = new PDO('mysql:host=localhost:3307;dbname=utilisateur;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }   
            catch(Exception $e)
            {
                die('Error : '.$e->message);
            }

            $prepare = $bdd->prepare('SELECT nom, prenom FROM user WHERE email = ?');
            $prepare->execute(array($_SESSION["email"]));
            
            $result = $prepare->fetch();

            $nom=$result['nom'];
            $prenom = $result['prenom'];

        
    }
    else
    {
        header("Location: login.php");
    }

    if(isset($_POST['modifier']))
    {
        $prepare = $bdd->prepare('SELECT _password FROM user WHERE email = ?');
        $prepare->execute(array($_SESSION["email"]));

        $result = $prepare->fetch();

        if($result["_password"] != md5($_POST["old"]))
        {
            $old = false;
        }
        elseif($_POST["new"] != $_POST["confirm_new"])
        {
            $new = false;
        }
        else
        {
            $prepare = $bdd->prepare("UPDATE user SET _password = ? WHERE email = ?");
            $prepare->execute(array(md5($_POST['new']), $_SESSION["email"]));
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/change_pass.css" />
    <title>E_commerce</title>
    <script src="https://kit.fontawesome.com/1d881ea511.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("header.php")?>
    <section>
        <h2>Modifer mot de passe</h2>
        <form id="FF" method="POST">
            <input class = "text" type="password" name="old" placeholder = "Ancien mot de passe" required>
            <input class = "text" type="password" name="new" placeholder = "Nouveau mot de passe" required>
            <input class = "text" type="password" name="confirm_new" placeholder="Confirmer mot de passe" required>
            <input class = "text" type="submit" name="modifier" value="ENREGISTRER">
        </form>
    </section>

    <?php include("footer.php")?>

    <?php if(!$old) echo "<script>alert('old pass is wrong')</script>";
          elseif(!$new) echo"<script>alert('confirm pass wrong')</script>";
    ?> 

</body>
</html>
<?php include('session.php');?>

<?php 
    if(isset($_SESSION['email']))
    {
            try{
                $bdd = new PDO('mysql:host=localhost:3307;dbname=utilisateur;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }   
            catch(Exception $e)
            {
                die('Error : '.$e->message);
            }

            $prepare = $bdd->prepare('SELECT nom, prenom, profile_img FROM user WHERE email = ?');
            $prepare->execute(array($_SESSION["email"]));
            
            $result = $prepare->fetch();

            $nom=$result['nom'];
            $prenom = $result['prenom'];
            $profile_img = $result['profile_img'];
            
            if(isset($_POST["modify_img"]) && !empty($_FILES["add_img"]["name"]))
            {

                $target_dir = "css/image/profile/";
                $target_file = $target_dir . basename($_FILES["add_img"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["add_img"]["tmp_name"]);
                if($check == false) {
                    echo "<script>alert('Fichier n'est pas une  image').</script>";
                    $uploadOk = 0;
                } elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    echo "<script>alert('Seule les fichers JPG, JPEG, PNG & GIF sont autorisés.')</script>";
                    $uploadOk = 0;
                    
                } else {
                    $uploadOk = 1;
                }

                if($uploadOk == 1)
                {
                    if (move_uploaded_file($_FILES["add_img"]["tmp_name"], $target_file)) {
                        echo "<script>alert('Le fichier ". htmlspecialchars( basename( $_FILES["add_img"]["name"])). " est chargé avec succès.')</script>";
                        $profile_img = $target_file;
                        $prepare = $bdd->prepare('UPDATE user SET profile_img = ? WHERE email = ?');
                        $prepare->execute(array($target_file,$_SESSION["email"]));
                    } 
                    else {
                        echo "<script>alert('Oups une erreur est survenu le fichier n'est pas chargé .')</script>";
                    }
                }    
            }
    }
    else
    {
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/profile.css" />
    <title>E_commerce</title>
    <script src="https://kit.fontawesome.com/1d881ea511.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="body">
        <?php include("header.php")?>
        <section>
            <div id="hii">
                <div id="cadre">
                    <img src="<?php echo $profile_img;?>" alt="">
                    <div id="modify">Modifier</div>
                </div>
                <h2>Bienvenue <?php echo $prenom.' '.$nom?></h2>
            </div>
            
            <div id="choisir">
                <a href="info.php"><div id="info">Mes informations</div></a>
                <a href="change_pass.php"><div id="pass">Modifier mot de passe</div></a>
                <a href="orders.php"><div id="order">Mes achats</div></a>
            </div>
        </section>

        <?php include("footer.php")?>
    </div>
    

    <form id="formulaire" method="POST" enctype="multipart/form-data" >
                <i class="fas fa-times"></i>
                <input id="file"  type="file" name="add_img" > 
                <input id="submit" type="submit" name = "modify_img">
    </form>
</body>



<script>

        var formulaire = document.getElementById('formulaire')
        document.getElementById('modify').addEventListener('click',function(e){
            event.stopPropagation();
            formulaire.style.display = 'flex';
            document.querySelector('#body').style.opacity = "20%";
        });
        document.getElementById('submit').addEventListener('click',function(e){
            event.stopPropagation();
            formulaire.style.display = 'none';
            document.querySelector('#body').style.opacity = "100%";
        });
        document.querySelector('.fa-times').addEventListener('click',function(e){
            event.stopPropagation();
            formulaire.style.display = 'none';
            document.querySelector('#body').style.opacity = "100%";
        });
        document.querySelector("#body").addEventListener('click',function(e){
            event.stopPropagation();
            formulaire.style.display = 'none';
            document.querySelector('#body').style.opacity = "100%";
        });
</script>

</html>
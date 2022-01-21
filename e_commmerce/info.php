<?php include('session.php');?>

<?php 
    
    if(isset($_SESSION['email']))
    {
            try{
                $bdd = new PDO('mysql:host=localhost:3306;dbname=utilisateur;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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
            $email = $_SESSION["email"];
        
    }
    else
    {
        header("Location: login.php");
    }

    if(isset($_POST['enregistrer']))
    {
        $prepare = $bdd->prepare('UPDATE user set nom = ?, prenom = ? ,email = ?  WHERE email = ?');
        $prepare->execute(array($_POST["nom"],$_POST["prenom"],$_POST["email"],$_SESSION["email"]));
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/info.css" />
    <title>ENSIAS E_commerce</title>
    <script src="https://kit.fontawesome.com/1d881ea511.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("header.php")?>
    <section>
        <h2>Informations</h2>
        <div id="FF">
            <i class="fas fa-user-edit "></i>
        
            <form method="POST" id="choisir" >
                <div>
                    <label class="label" for="prenom">Prenom</label>
                    <input class = "text txt" type="text" value=<?php echo $prenom;?> id="prenom" name ="prenom" readonly required>
                </div>

                <div>
                    <label class = "label" for="nom">Nom</label>
                    <input class = "text txt" type="text" value=<?php echo $nom;?> id="nom" name ="nom" readonly required>
                </div>

                <div>
                    <label class = "label" for="email">email</label>
                    <input class = "text txt" type="email" value=<?php echo $email;?> id="email" name ="email" readonly required>
                </div>

                <input type="hidden" value="Enregistrer" name="enregistrer" >
            </form>
        </div>
        
    </section>

    <?php include("footer.php")?>

    <script>
        document.querySelector(".fa-user-edit").addEventListener('click',function(){
            document.querySelectorAll("input").forEach(item => {item.removeAttribute("readonly");})
            document.querySelector("input[type='hidden']").setAttribute('type','submit');
        });
    </script>

</body>
</html>
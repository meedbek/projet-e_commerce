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

            $prepare = $bdd->prepare("SELECT * FROM commande WHERE email = ?");
            $prepare->execute(array($_SESSION['email']));
            
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
    <link rel="stylesheet" href="css/orders.css" />
    <title>ENSIAS E_commerce</title>
    <script src="https://kit.fontawesome.com/1d881ea511.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("header.php")?>
    <section>
        <table id='table'>
            <tr>   
                <caption>Commandes</caption> 
                <th>ID commande</th>
                <th>Montant</th>
                <th>Devise</th>
                <th>Date commande</th>
                <th>choix</th>
            </tr>       
            <?php 
                while($commande = $prepare->fetch())
                {
                    echo'
                    <tr>    
                        <td>'.$commande['id'].'</td>
                        <td>'.$commande['montant'].'</td>
                        <td>'.$commande['devise'].'</td>
                        <td>'.$commande['date_reservation'].'</td>
                        <td>'.$commande['choix'].'</td>
                    </tr>  ';
                }
            ?>
        </table>   
    </section>

    <?php include("footer.php")?>

</body>
</html>
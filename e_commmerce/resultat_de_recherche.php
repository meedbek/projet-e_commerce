<?php include('file.php');?>


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
    <div>   
        <button><a href="index.php">home</a></button>
    </div>
    <div id = resultat_recherche>
    <?php
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=vole;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch(Exception $e){
            die('Error : '.$e->message);
        }
        if(isset($_POST['chercher']) || isset($_POST['deconnexion']) )
        {
            $resultat = $bdd->prepare('SELECT origine, destination,date_depart,heure_depart, date_heure_arrive, nombre, prix_economie,prix_business,prix_première,taux_enfant,taux_bébé
                                       FROM vole_disponible v inner join prix_societe  on v.id = societe_id  WHERE date_depart = ? AND origine = ? AND destination = ? ');
            $resultat->execute(array($_POST['date_depart'],$_POST['origine'],$_POST['destination']));
            $no_result = true;
            while($vole = $resultat->fetch())
            {
                switch($_POST['classe'])
                {
                    case 'economie' : $prix_classe = $vole['prix_economie']; break;
                    case 'business' : $prix_classe = $vole['prix_business']; break;
                    case 'première' : $prix_classe = $vole['prix_première']; break;
                }
                $prix = ($_POST['adulte']+$_POST['enfant']*$vole['taux_enfant']+$_POST['bébé']*$vole['taux_bébé']) * $prix_classe;
                echo'   
                <div class = vole>
                <ul>
                    <li>origine : '.$vole['origine'].'</li>
                    <li>destination : '.$vole['destination'].'</li>
                    <li>date et heure de depart : '.$vole['date_depart'].' '.$vole['heure_depart'].'</li>
                    <li>date et heure d\'arrivée : '.$vole['date_heure_arrive'].'</li>
                    <li>prix: '.$prix.' DH</li>
                </ul>
                </div>
                <div class = \'buy\'><button><a href = "">acheter</button></div>';
                $no_result= false;
            }
            if($no_result)
            {
                echo ' Pas de resultat trouvé';
            }
        }
        
    ?>
    </div>
    <?php
        if(isset($_SESSION['email']))
            echo '  <form  method="POST">
                    <input type = "hidden" name="origine"  value = '.$_POST['origine'].'>
                    <input type = "hidden" name="destination" value = '.$_POST['destination'].'>
                    <input type = "hidden" name="date_depart" value = '.$_POST['date_depart'].'>
                    <input type = "hidden" name="adulte"  value= '.$_POST['adulte'].'>
                    <input type = "hidden" name="enfant" value ='.$_POST['enfant'].'>
                    <input type = "hidden" name="bébé"  value = '.$_POST['bébé'].' >
                    <input type = "hidden" name="classe" value='.$_POST['classe'].'>
                    <input type="submit" name="deconnexion" value = "deconnexion">
                ';
            
        else
            echo '  <form  method="POST" action = "login.php">
                    <input type="submit" name="connexion" value = "connexion">
                    </form>
                ';
    ?>

</body>
</html>
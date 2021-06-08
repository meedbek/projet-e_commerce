<?php include('file.php');?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>
    <link rel="stylesheet" href="css/style.css" />
    <title>E_commerce</title>
    <script src="https://kit.fontawesome.com/1d881ea511.js" crossorigin="anonymous"></script>
</head>

<body>
    
    <header>

    <h1><a href = "index.php"><span>E</span>NSIAS</a></h1>

    <div class="container">
    <ul id="list">
            <li class ="choix" >
                choix
                <ul class="sub">
                    <li><span class = "logo"><i class="fas fa-plane" ></i></span><a href="achat_billets.php">Billets</a></li>
                    <li><a href="">Options2</a></li>
                    <li><a href="">Options3</a></li>
                </ul>
            </li>
            <li class = "choix">contact</li>
            <li class = "choix">Á propos</li>
        </ul>
    </div>
    
    <div id = options>

    <?php
        if(isset($_SESSION['email']))
            echo '  <form  id = signOut method="POST">
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
            echo   '    
                    <div id = sign_up>
                        <a href="sign_up.php"><button>S\'identifier</button></a>
                    </div>

                    <div id = login>
                        <a href="login.php"><button>Connexion</button></a>
                    </div>
                    ';
    ?>
    </div>
    </header>
    
    <section>
    <div id = resultat_recherche>
    <?php
        try{
            $bdd = new PDO('mysql:host=localhost:3307;dbname=vole;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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
                <div class = \'buy\'><button>acheter</button></div>';
                $no_result= false;
            }
            if($no_result)
            {
                echo ' Pas de resultat trouvé';
            }
        }
        
    ?>
    </div>
    </section>
    

</body>
</html>
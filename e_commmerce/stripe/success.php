
<?php

use Stripe\Terminal\Location;

session_start();
  if(isset($_SESSION['data']))
  {
    try{
      $bdd = new PDO('mysql:host=localhost:3307;dbname=utilisateur;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }   
    catch(Exception $e)
    {
        die('Error : '.$e->message);
    }
      $query = $bdd->query('SELECT max(id)+1 as id   FROM commande ');
      $result = $query->fetch();
      if(isset($result['id']))
      {
        $id = $result['id'];
      }
      else
      {
        $id = 0;
      }
      
      $json = json_decode($_SESSION['data'],true);
      $type = $json[0];
      $data = $json[1];
      $email = $json[2];
      if($type == 'billet')
      {
        $prepare = $bdd->prepare('INSERT INTO commande(id,montant,choix,email) values(?,?,"billet",?)');
        $prepare2 = $bdd->prepare('INSERT INTO reservation_billet(id_commande,nb_adulte,nb_enfant,nb_bebe
        ,classe,date_heure_voyage,ville_depart,ville_arrive,airline) VALUES (?,?,?,?,?,?,?,?,?)');
        
        $prepare->execute(array($id,$data['price'],$email));
        $prepare2->execute(array($id,$data['adulte'],$data['enfant'],$data['bebe'],$data['classe'],$data['depart'],$data['origine'],$data['destination'],$data['airline']));
  
      }
      elseif($type = 'hotel'){
        $prepare = $bdd->prepare('INSERT INTO commande(id,montant,devise,choix,email) values(?,?,?,"hotel",?)');
        $prepare2 = $bdd->prepare('INSERT INTO reservation_hotel(id_commande,nb_adulte,nb_chambre,date_arrive,date_depart,ville,id_hotel) VALUES (?,?,?,?,?,?,?)');
        
        $prepare->execute(array($id,$data['price'],$data['currency'],$email));
        $prepare2->execute(array($id,$data['adulte'],$data['chambre'],$data['arrive'],$data['depart'],$data['ville'],$data['hotelId']));
      }
      unset($_SESSION['data']);
  }
  else
  {
    header("Location : http://localhost/e_commmerce/index.php",true,307);
  }
?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>
    <link rel="stylesheet" href="http://localhost/e_commmerce/css/style.css" />
    <title>E_commerce</title>
    <script src="https://kit.fontawesome.com/1d881ea511.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("../header.php")?>
    <section>
        <p id="message">Votre achat a été fait avec succès</p>
    </section>

    <?php include("../footer.php")?>

</body>
</html>
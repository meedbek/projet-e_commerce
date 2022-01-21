
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Stripe\Terminal\Location;

session_start();
  if(isset($_SESSION['data']))
  {
    try{
      $bdd = new PDO('mysql:host=localhost:3306;dbname=utilisateur;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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

        $montant = $data['price']." DH ";
  
      }
      elseif($type = 'hotel'){
        $prepare = $bdd->prepare('INSERT INTO commande(id,montant,devise,choix,email) values(?,?,?,"hotel",?)');
        $prepare2 = $bdd->prepare('INSERT INTO reservation_hotel(id_commande,nb_adulte,nb_chambre,date_arrive,date_depart,ville,id_hotel) VALUES (?,?,?,?,?,?,?)');
        
        $prepare->execute(array($id,$data['price'],$data['currency'],$email));
        $prepare2->execute(array($id,$data['adulte'],$data['chambre'],$data['arrive'],$data['depart'],$data['ville'],$data['hotelId']));

        $montant = $data['price']." ".$data['currency'];
      }

      //send mail
      {
            // Import PHPMailer classes into the global namespace
        
            require '../PHPMailer/Exception.php';
            require '../PHPMailer/PHPMailer.php';
            require '../PHPMailer/SMTP.php';
            
            //recupération du prenom
            $prepare = $bdd->prepare('Select prenom from user where email= ?');
            $prepare->execute(array($email));
            $prenom = $prepare->fetch();

            $Nom_a_envoyer = "ENISAS e_commerce";
            $Email_a_envoyer = "bekraoui34@gmail.com";
            $Subject_a_envoyer = "Recu de paiement";
            $bodyContent  = "<h3>Bonjour ".$prenom['prenom']."</h3><p>Nous vous confirmons le paiement de la commande N :".$id." d'un montant de : ".$montant."</p> <p>ENSIAS E_commerce</p>";



            $mail = new PHPMailer;
            $mail->isSMTP();                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;               // Enable SMTP authentication
            $mail->Username = 'manluc293@gmail.com';   // SMTP username
            $mail->Password = 'GTAV2020';   // SMTP password
            $mail->SMTPSecure = 'ssl';            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                    // TCP port to connect to

            // Sender info
            $mail->setFrom($Email_a_envoyer, $Nom_a_envoyer); // Specify sender name and email
            

            // Add a recipient
            $mail->addAddress($email); // Set recipient email address

            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Add attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz'); // envoyer sans le renomer
            $mail->addAttachment('/tmp/image_original.jpg', 'le_nom_renomer.jpg'); // Optional name ( it's the second parameter )

            // Set email format to HTML
            $mail->isHTML(true);

            // Mail subject
            $mail->Subject = $Subject_a_envoyer;

            // Mail body content,  Set the body content of the email ($mail->Body).

            /*  $bodyContent = '<h1>How to Send Email from Localhost using PHP by SMTP@adnane.com</h1>';
            $bodyContent .= '<p>This HTML email is sent from the localhost server using PHP by <b>SMTP@adnane.com</b></p>';*/
            $mail->Body    = $bodyContent;

            // Send email , Use the send() method of PHPMailer class to send an email.
            $mail->send();
            /*if (!$mail->send()) {
                echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;

                //echo '<script>window.alert("Erreur  !! Votre Message n\'est pas envoyer .$mail->ErrorInfo")';
            } else {
                echo 'Message has been sent.';
                //echo '<script>window.alert(\' Votre Message est Bien Envoyer \')';
            }
            // code...*/
      }

      unset($_SESSION['data']);
      echo'
          <script>
              alert("Votre achat a été fait avec succès\nVous recevrez un email contenant votre comfirmation de paiement");
              location = "http://localhost/e_commmerce/index.php";    
          </script>;
      ';
      
  }
  else
  {
    header("Location : http://localhost/e_commmerce/index.php",true,307);
  }
?>

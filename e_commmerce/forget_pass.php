<?php
    include('session.php');
    // Import PHPMailer classes into the global namespace
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
?>



<?php 
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

if(isset($_POST['recup_pass']))
{
    try{
        $bdd = new PDO('mysql:host=localhost:3307;dbname=utilisateur;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }   
    catch(Exception $e)
    {
        die('Error : '.$e->message);
    }

    $emails = $bdd->query('SELECT email FROM user');

    while($email = $emails->fetch())
    {
        if($_POST['check_email'] == $email['email'])
        {
            //generer code 
            $new_pass = randomPassword();
            $password = $bdd->prepare('UPDATE user SET _password = ?  WHERE email = ?');
            $password->execute(array(md5($new_pass),$_POST['check_email']));
            $wrong_email = false;

            //recupération du prenom
            $prepare = $bdd->prepare('Select prenom from user where email= ?');
            $prepare->execute(array($email['email']));
            $prenom = $prepare->fetch();

            break;
        }
        else
            $wrong_email = true;
    }
    
    if($wrong_email == false)
    {
        
        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';

        if (isset($_POST['recup_pass'])) {
            $Nom_a_envoyer = "ENISAS e_commerce";
            $Email_a_envoyer = "google@google.com";
            $Subject_a_envoyer = "Recuperer mot de passe";
            $bodyContent  = "<h3>Bonjour ".$prenom['prenom']."</h3><p>Voici votre nouveau mot passe pour :<br/><br/> &#8287 &#8287 &#8287 Email :".$_POST['check_email']."<br/> &#8287 &#8287 &#8287 Mot de passe :".$new_pass."</p> <p>ENSIAS E_commerce</p>";



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
            $mail->addAddress($_POST['check_email']); // Set recipient email address

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

            if (!$mail->send()) {
                //echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;

                echo '<script>window.alert("Erreur  !! Votre Message n\'est pas envoyer .$mail->ErrorInfo");window.location = \'login.php\';</script>';
            } else {
                //echo 'Message has been sent.';
                echo '<script>window.alert(\' Votre Message est Bien Envoyer \');window.location = \'login.php\';</script>';
            }
            // code...
        }

    }
    else{
        echo'<script>alert("Cette email n\'existe pas ");</script>';
    }
}                    
        


?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/style_forget.css"/>
    <title>ENSIAS E_commerce</title>
    <script src="https://kit.fontawesome.com/1d881ea511.js" crossorigin="anonymous"></script>
</head>

<body>
    
<?php include('header.php')?>
<?php
    if(isset($_SESSION['email']))
    {
        echo '  <script>
                    alert("Vous êtes déja connecté");
                    location = "index.php";    
                </script>';
    }
    else
    {
?>

<section>
    <form  method = "POST">
        <h2>Entrez votre email :</h2>
        <div id="email">
            <input type="email" placeholder="email" name = "check_email">
            <input type="submit" name = "recup_pass" value = "envoyer">
        </div>
        <p>Vous recevrez un email contenant votre nouveau mot de passe</p>
        
    </form>
</section>


<?php
    }
    include("footer.php");
?>

</body>
</html>
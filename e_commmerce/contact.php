<?php include('session.php')?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/contact.css" />
    <title>ENSIAS E_commerce</title>
    <script src="https://kit.fontawesome.com/1d881ea511.js" crossorigin="anonymous"></script>
</head>

<body style="background-color:#F4F4F4">

    <?php include('header.php');?>

    <div class="contact-form">
        <div class="my-4">
            <hr class="mt-5">
            <p>
            <div class="Titre" style="margin-top:2%;font-size:23px;">
                <center>
                    <span style="font-size:35px;">- N'hesitez pas a nous contactez -</span>
                    <p> Allez-y ! </p>
                </center>
            </div>
            </p>
            <hr class="mb-5" />
        </div>
        <div class="CONTAIN">
            <div class="card1">
                <div class="card-header bg-warning text-white" style='background-color:rgb(201, 78, 21) !important;'><i class="fa fa-envelope"></i> Contactez Nous.
                </div>
                <div class="card-body">
                    <form action="<?php echo  $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="form-group input-group-sm">
                            <label for="name">Name et Prénom :</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Enter votre nom et prénom" required>
                        </div>
                        <div class="form-group input-group-sm">
                            <label for="email">Email address : </label>
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Entrer votre email" required>
                        </div>
                        <div class="form-group input-group-sm">
                            <label for="subject">Subject : </label>
                            <input type="text" class="form-control" name="subject" id="subject"
                                placeholder="Entrer votre subject" required>
                        </div>
                        <div class="form-group input-group-sm">
                            <label for="message">Message : </label>
                            <textarea class="form-control" name="message" rows="6" id="subject" required
                                style="resize: none;"></textarea>
                        </div>
                        <div class="mx-auto">
                            <button type="submit" class="btn btn-primary text-right"
                                name="submit">Envoyer</button>
                            <button type="reset" class="btn btn-danger text-right">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card2">
                <div class="card-header bg-success text-white text-uppercase" style="background-color : green"><i class="fa fa-home"></i> Address
                </div>
                <div class="card-body">
                    <p>Address: Avenue Mohamed Ben Abdellah Regragui, Rabat</p>
                    <p>Email : ensias@ensias.com</p>
                    <p>Tel : 05 37 77 85 79</p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
<?php include('footer.php')?>
</body>

</html>
<?php

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if (isset($_POST['submit'])) {
    extract($_POST);
    $Nom_a_envoyer = $name;
    $Email_a_envoyer = $email;
    $Subject_a_envoyer = $subject;
    $Message_a_envoyer  = $message;



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
    $mail->addAddress('hamza_elhnait@um5.ac.ma'); // Set recipient email address

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
    $bodyContent = '<html><strong>Email du Client  : </strong><br/> ' . $Email_a_envoyer;
    $bodyContent = $bodyContent . '<br/>' . '<strong>Le Message du Client : </strong><br/></html>'.$Message_a_envoyer;
    $mail->Body    = $bodyContent;

    // Send email , Use the send() method of PHPMailer class to send an email.

    if (!$mail->send()) {
        //echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;

        echo '<script>window.alert(\'Erreur  !! Votre Message n\'est pas envoyer .$mail->ErrorInfo\');window.location = \'Contact.php\';</script>';
    } else {
        //echo 'Message has been sent.';
        echo '<script>window.alert(\' Votre Message est Bien Envoyer \');window.location = \'Contact.php\';</script>';
    }
    // code...
}

?>

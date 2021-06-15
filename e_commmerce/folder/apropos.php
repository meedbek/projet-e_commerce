<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Contactez nous</title>
    <link rel="icon" href="images/logo_ensias.png">
    <link rel="stylesheet" href="css/acceuil.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>


</head>

<body style="background-color:#F4F4F4">
   
            <div id="navbarCollapse" class="collapse navbar-collapse justify-content-end mx-auto">
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a href="acceuil.php" class="nav-link ">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a href="cours.php" class="nav-link">Cours</a>
                    </li>
                    <li class="nav-item">
                        <a href="a_propos.php" class="nav-link">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a href="contactez_nous.php" class="nav-link">Contactez Nous</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav ">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Login</a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="admin/login_admin.php" class="dropdown-item">Admin</a>
                            <a href="prof/login_prof.php" class="dropdown-item">Professeur</a>

                            <a href="etudiant/login_etudiant.php" class="dropdown-item">Etudiant</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="contact-form">
        <div class="container my-4">
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
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
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
                                    
                                    <button type="reset" class="btn btn-success text-right"><a href="http://localhost/e_commmerce/index.php" style="text-decoration:none;color:white;">acceuil</a></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card bg-light mb-3">
                        <div class="card-header bg-success text-white text-uppercase"><i class="fa fa-home"></i> Address
                        </div>
                        <div class="card-body">
                            <p>Address: Avenue Mohamed Ben Abdellah Regragui, Rabat</p>
                            <p>Email : ensias@ensias.com</p>
                            <p>Tel : 05 37 77 85 79</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    
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
    $mail->Username = 'xxxx@gmail.com';   // SMTP username
    $mail->Password = 'xxx';   // SMTP password
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

        echo '<script>window.alert(\'Erreur  !! Votre Message n\'est pas envoyer .$mail->ErrorInfo\');window.location = \'apropos.php\';</script>';
    } else {
        //echo 'Message has been sent.';
        echo '<script>window.alert(\' Votre Message est Bien Envoyer \');window.location = \'apropos.php\';</script>';
    }
    // code...
}

?>

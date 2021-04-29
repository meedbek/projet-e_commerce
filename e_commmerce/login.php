
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>
    <title>blog</title>
</head>
<body>
 
<form method='POST'>

    <input type='email' name='email' placeholder="email" id='email'>

    <input type="password" name='password' placeholder="entrer le mot de passe" id='pswd' >
    <input type="checkbox" name='remember me' id='remember me'>
    <input type='submit'  name='submit'>

</form>
<?php
    if(isset($_POST['submit']))
    {
        try{
        $bdd = new PDO('mysql:host=localhost;dbname=utilisateur;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }   
        catch(Exception $e)
        {
            die('Error : '.$e->message);
        }

        $emails = $bdd->query('SELECT email FROM user');

        while($email = $emails->fetch())
        {
            if($_POST['email'] == $email['email'])
            {
                $password = $bdd->prepare('SELECT _password FROM user WHERE email = ?');
                $password->execute(array($_POST['email']));
                $array = $password->fetch(); 
                if(md5($_POST['password']) == $array['_password'])
                {
                    header("Location : achat_billets.php",true,307);
                }
                else
                {
                    echo 'Wrong password';
                }
            }
            else
                echo 'Wrong email';
        }
    }
?>


</body>

</html>
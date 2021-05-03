<?php include('file.php');?>

<?php
    $connected =false;
    if(isset($_SESSION['email']))
        $connected = true;
    else
    {
        $wrong_email = false;
        $wrong_password = false;
        if(isset($_POST['login']))
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
                        session_start();
                        $_SESSION['email'] = $_POST['email'];
                        if(isset($_POST['remember_me']) && $_POST['remember_me'] == 'on')
                        {
                            setcookie('email',$_POST['email'],time() + 3600*24*30);
                            setcookie('password',md5($_POST['password']),time() +3600*24*30);
                        }
                        header("Location : achat_billets.php",true,307);
                    }
                    else
                    {
                        $wrong_password = true;
                    }
                }
                else
                    $wrong_email = true;
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>
    <title>blog</title>
</head>
<body>
<div>   
    <button><a href="index.php">home</a></button>
</div>
<form method='POST'>
<?php 
    if($connected)
    {
        echo'you are already conneted';
        echo '  <form  method="POST">
                    <input type="submit" name="deconnexion" value = "deconnexion">
                    </form>
                ';
    }
    else
    {
?>

    <input type='email' name='email' placeholder="email" id='email'>

    <input type="password" name='password' placeholder="entrer le mot de passe" id='pswd' >
    <input type="checkbox" name='remember_me' id='remember me'>
    <input type='submit'  name='login'>
<?php
        if($wrong_email)
            echo ' wrong email';
        else if($wrong_password)
            echo 'wrong password';
    }
?>

</form>



</body>

</html>
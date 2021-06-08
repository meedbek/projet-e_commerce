<?php
        session_start();
        if(isset($_COOKIE['email']) && isset($_COOKIE['password']) && !isset($_POST['email']))
        {
                try{
                    $bdd = new PDO('mysql:host=localhost:3307;dbname=utilisateur;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    }   
                    catch(Exception $e)
                    {
                        die('Error : '.$e->message);
                    }

                $password = $bdd->prepare('SELECT _password FROM user WHERE email = ?');
                $password->execute(array($_COOKIE['email']));
                $array = $password->fetch(); 
                if($_COOKIE['password'] == $array['_password'])
                    {
                        $_SESSION['email'] = $_COOKIE['email'];
                    }
                
        }

        if(isset($_POST['deconnexion']))
        {
            $_SESSION = array();
            setcookie('email','',time()-3600);
            setcookie('password','',time()-3600);
            session_destroy();
        }
?>
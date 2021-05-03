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
<div id = info_billets>
    <form method = 'POST' action = 'resultat_de_recherche.php'>
        <input type = 'text' name='origine' id='origine' placeholder = 'origine'>
        <input type = 'text' name='destination' id='destination' placeholder = 'destination'>
        <input type = 'date' name='date_depart' id='date_depart'>
        <div id = passagers>
        <h4>passagers</h4>
        <ul>
            <li>adulte<input type = 'number' name='adulte' id='adulte' value=1 required></li>
            <li>enfant<input type = 'number' name='enfant' id='enfant' value =0 required></li>
            <li>bébé<input type = 'number' name='bébé' id='bébé' value =0 required></li>
        </ul>
        </div>
        <label for="classe">classe</label>
        <select name="classe" id='classe'>
            <option value='economie'>economie</option>
            <option value="business">business</option>
            <option value="première">première</option>
        </select>

        <input type="submit" name='chercher' value='chercher un vol'>
    </form>
   
</div>
<?php
        if(isset($_SESSION['email']))
            echo '  <form  method="POST">
                    <input type="submit" name="deconnexion" value = "deconnexion">
                    </form>
                ';
        else
            echo '  <form  method="POST" action = "login.php">
                    <input type="submit" name="connexion" value = "connexion">
                    </form>
                ';
?>
</body>
</html>
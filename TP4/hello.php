<?php
    session_start();
?>


<!DOCTYPE html>
<html>
<head>  
    <meta charset = 'utf-8'/>
    <title>TP3</title>
</head>

<body>
    <?php 
        echo 'hiii '.$_SESSION['pseudo'];
    ?>
    <form method="POST" action="connexion.php" ><input type ="submit" name = "deconnexion" value = "déconnexion"/></form>
</body>
</html>

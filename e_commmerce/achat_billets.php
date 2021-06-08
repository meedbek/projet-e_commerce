<?php include('file.php');?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>
    <title>blog</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/style_achat_billets.css" />
    <script src="https://kit.fontawesome.com/1d881ea511.js" crossorigin="anonymous"></script>
    
</head>

<body>

<?php include('header.php');?>

<section >
    <form method = 'POST' action = 'resultat_de_recherche.php' id = 'info_billets'>
        
        <div id = 'vole' >
            <input type = 'text' name='origine' id='origine' placeholder = 'origine' class = 'zone'>
            <input type = 'text' name='destination' id='destination' placeholder = 'destination' class = 'zone'>
            <input type = 'date' name='date_depart' id='date_depart' class = 'zone'> 
        </div>
        <div id = 'passagers' class = 'zone'>
            passagers
            <ul id='menu' >
                <li><h4>adulte</h4><input type = 'number' name='adulte' id='adulte' value=1 required></li>
                <li><h4>enfant</h4><input type = 'number' name='enfant' id='enfant' value =0 required ></li>
                <li><h4>bébé</h4><input type = 'number' name='bébé' id='bébé' value =0 required></li>
            </ul>
        </div>
        <div id = 'classe'>
            <select name="classe"  class = 'zone' >
                <option value='economie' default>economie</option>
                <option value="business">business</option>
                <option value="première">première</option>
            </select>
        </div>
        <div id = 'chercher un vol'><input type="submit" name='chercher' value='chercher un vol' id='chercher'></div>
        
    </form>
   

</section>

<script>var passager = document.getElementById('passagers');

    var menu = document.getElementById('menu');

    passager.addEventListener("click" , function(){     
        menu.style.display = 'block';
    });
</script>

</body>
</html>
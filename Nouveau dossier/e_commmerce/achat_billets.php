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
            <p>passagers</p>
            <span class = 'triangle'></span>
            <div id="menu">
                <div id="pin"></div>
                <ul >
                    <li><h4>adulte</h4><input type = 'number' name='adulte' id='adulte' value=1 required></li>
                    <li><h4>enfant</h4><input type = 'number' name='enfant' id='enfant' value =0 required ></li>
                    <li><h4>bébé</h4><input type = 'number' name='bébé' id='bébé' value =0 required></li>
                </ul>
            </div>
            
        </div>
        <div id = 'classe' class = 'zone'>
            <select name="classe"   >
                <option value='ECONOMY' default>economie</option>
                <option value="PREMIUM_ECONOMY">premium_economie</option>
                <option value="BUSINESS">business</option>
                <option value="FIRST">première</option>
            </select>
            <span class = 'triangle'></span>
        </div>
        <div id = 'chercher_vol'><input type="submit" name='chercher' value='' id='chercher'></div>
        
    </form>
   

</section>

<script>
    var passager = document.getElementById('passagers');

    var menu = document.getElementById('menu');

    passager.addEventListener("click" , function(event){     
        event.stopPropagation();
        menu.style.visibility = 'visible';
    });

    document.getElementsByTagName('body')[0].addEventListener("click",function(event){
        event.stopPropagation();
        menu.style.visibility = 'hidden';
    });


</script>

</body>
</html>
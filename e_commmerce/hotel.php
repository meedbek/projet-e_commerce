<?php include('session.php');?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>
    <title>blog</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/style_achat_billets.css" />
    <link rel='stylesheet' href="css/style_hotel.css"/>
    <script src="https://kit.fontawesome.com/1d881ea511.js" crossorigin="anonymous"></script>
    
</head>

<body>

<?php include('header.php');?>

<section >
    <form method = 'POST' action = 'resultat_hotel.php' id = 'info_billets'>
        
        <div id = 'vole' >
            <input type = 'text' name='ville' id='origine' placeholder = "ville" class = 'zone'>
            <input type = 'text' name='checkIn' id='destination' placeholder = 'Arrivée' onblur = "if(this.value==''){this.type='text'}" onfocus = "this.type='date' " class = 'zone' required>
            <input type = 'text' name='checkOut' id='date_depart' placeholder= 'Départ' onblur = "if(this.value==''){this.type='text'}" onfocus = "this.type='date' " class = 'zone' required> 
        </div>
        <div id = 'passagers' class = 'zone'>
            <p></p>
            <span class = 'triangle'></span>
            <div id="menu">
                <div id="pin"></div>
                <ul >
                    <li><h4>chambre</h4><input type = 'number' name='chambre' id='chambre' value=1 required></li>
                    <li><h4>adulte</h4><input type = 'number' name='adulte' id='adulte' value =1 required ></li>
                </ul>
            </div>
            
        </div>
        <div id = 'chercher_vol'><input type="submit" name='search' value='' id='chercher'></div>
        
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

    var nbChambre = document.getElementById('chambre').value;
    var nbAdulte = document.getElementById('adulte').value;
    document.querySelector('#passagers p').innerHTML = 'Chambre : '+nbChambre+' - Adulte : '+nbAdulte ;

    document.querySelectorAll('#passagers input').forEach(item =>{ item.addEventListener('input',function(e){
        nbChambre = document.getElementById('chambre').value;
        nbAdulte = document.getElementById('adulte').value;
        document.querySelector('#passagers p').innerHTML = 'Chambre : '+nbChambre+' - Adulte : '+nbAdulte ;
    }) } );
    


</script>

</body>
</html>
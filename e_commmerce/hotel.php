<?php include('session.php');?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>
    <title>ENSIAS E_commerce</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/style_achat_billets.css" />
    <link rel='stylesheet' href="css/style_hotel.css"/>
    <script src="https://kit.fontawesome.com/1d881ea511.js" crossorigin="anonymous"></script>
    
</head>

<body>

<?php include('header.php');?>

<section >
    
    <div id="hotel">
        <h2>Trouvez des offres sur des hôtels, et bien plus encore...</h2>
        <form method = 'POST' action = 'resultat_hotel.php' id = 'info_billets'>
            
            <div id = 'vole' >
                <input type = 'text' name='ville' id='ville' placeholder = "ville" class = 'zone'>
                <input type = 'text' name='checkIn' id='arrive' placeholder = 'Arrivée' onblur = "if(this.value==''){this.type='text'}" onfocus = "this.type='date' " class = 'zone' required>
                <input type = 'text' name='checkOut' id='depart' placeholder= 'Départ' onblur = "if(this.value==''){this.type='text'}" onfocus = "this.type='date' " class = 'zone' required> 
            </div>
            <div id = 'passagers' class = 'zone'>
                <p></p>
                <span class = 'triangle'></span>
                <div id="menu">
                    <div id="pin"></div>
                    <ul >
                        <li><h4>chambre</h4><input type = 'number' name='chambre' id='chambre' value=1 required min = 1 max=9></li>
                        <li><h4>adulte</h4><input type = 'number' name='adulte' id='adulte' value =1 required min = 1 max = 9></li>
                    </ul>
                </div>
                
            </div>
            <div id = 'chercher_vol'><input type="submit" name='search' value='' id='chercher'></div>
            
        </form>
    </div>
    
   

</section>

<?php include("footer.php");?>

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



<script>
    var date_depart = document.getElementById('date_depart');

    var today = new Date();
    var min_date = today.toISOString().split("T")[0];
    today.setMonth(today.getMonth()+11);
    var max_date =  today.toISOString().split("T")[0];

    depart.setAttribute("min",min_date);
    depart.setAttribute("max",max_date);
    arrive.setAttribute("min",min_date);
    arrive.setAttribute("max",max_date);
    
</script>

</body>
</html>
<?php include('session.php');?>

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
    <div id="billet">
        <h2>Bienvenue ! Trouvez un billet d’avion flexible pour votre prochain voyage.</h2>
        <form method = 'POST' action = 'resultat_de_recherche.php' id = 'info_billets'>
            
            <div id = 'vole' >
                <input type = 'text' name='origine' id='origine' placeholder = 'origine' class = 'zone' required>
                <input type = 'text' name='destination' id='destination' placeholder = 'destination' class = 'zone' required>
                <input type = 'date' name='date_depart' id='date_depart' class = 'zone' required > 
            </div>
            <div id = 'passagers' class = 'zone'>
                <p>passagers</p>
                <span class = 'triangle'></span>
                <div id="menu">
                    <div id="pin"></div>
                    <ul >
                        <li><h4>adulte</h4><input type = 'number' name='adulte' id='adulte' value=1 required min=1 max=9></li>
                        <li><h4>enfant</h4><input type = 'number' name='enfant' id='enfant' value =0 required min=0 max=9></li>
                        <li><h4>bébé</h4><input type = 'number' name='bébé' id='bébé' value =0 required min=0 max=9></li>
                    </ul>
                </div>
                
            </div>
            <div id = 'classe' class = 'zone'>
                <select name="classe"  required>
                    <option value='ECONOMY' default>economie</option>
                    <option value="PREMIUM_ECONOMY">premium_economie</option>
                    <option value="BUSINESS">business</option>
                    <option value="FIRST">première</option>
                </select>
                <span class = 'triangle'></span>
            </div>
            <div id = 'chercher_vol'><input type="submit" name='chercher' value='' id='chercher'></div>
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


</script>

<script>
    var adulte = document.getElementById('adulte');
    var bebe = document.getElementById('bébé');

    document.querySelectorAll('#adulte, #bébé').forEach(item => item.addEventListener('input',function(e){
        e.stopPropagation();
        if(adulte.value < bebe.value )
            bebe.value = adulte.value;
    }));
</script>

<script>
    var date_depart = document.getElementById('date_depart');

    var today = new Date();
    var min_date = today.toISOString().split("T")[0];
    today.setMonth(today.getMonth()+11);
    var max_date =  today.toISOString().split("T")[0];

    date_depart.setAttribute("min",min_date);
    date_depart.setAttribute("max",max_date);
    
</script>

</body>
</html>
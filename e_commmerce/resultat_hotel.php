<?php include('session.php');?>
<?php include('amadeus.php');?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/resultat_hotel.css" />
    <title>E_commerce</title>
    <script src="https://kit.fontawesome.com/1d881ea511.js" crossorigin="anonymous"></script>
</head>

<body>
    
    <header>

    <h1><a href = "index.php"><span>E</span>NSIAS</a></h1>

    <div class="container">
    <ul id="list">
            <li class ="choix" >
                choix
                <ul class="sub">
                    <li><span class = "logo"><i class="fas fa-plane" ></i></span><a href="achat_billets.php">Billets</a></li>
                    <li><a href="">Options2</a></li>
                    <li><a href="">Options3</a></li>
                </ul>
            </li>
            <li class = "choix">contact</li>
            <li class = "choix">Á propos</li>
        </ul>
    </div>
    
    <div id = options>

    <?php
        if(isset($_SESSION['email']))
            echo '  <form  id = signOut method="POST">
                    <input type = "hidden" name="origine"  value = '.$_POST['ville'].'>
                    <input type = "hidden" name="destination" value = '.$_POST['checkIn'].'>
                    <input type = "hidden" name="date_depart" value = '.$_POST['checkOut'].'>
                    <input type = "hidden" name="adulte"  value= '.$_POST['chambre'].'>
                    <input type = "hidden" name="enfant" value ='.$_POST['adulte'].'>
                    <input type="submit" name="deconnexion" value = "deconnexion">
                ';
            
        else
            echo   '    
                    <div id = sign_up>
                        <a href="sign_up.php"><button>S\'identifier</button></a>
                    </div>

                    <div id = login>
                        <a href="login.php"><button>Connexion</button></a>
                    </div>
                    ';
    ?>
    </div>
    </header>
    
    <section>
    <div id = resultat_recherche>
    <?php
        if(isset($_POST['search']) || isset($_POST['deconnexion']) )
        {
    
            $hotel = search_hotel($_POST['ville'],$_POST['checkIn'],$_POST['checkOut'],$_POST['chambre'],$_POST['adulte']);
            $N=count($hotel);
            $nuits = date_diff(date_create($_POST['checkIn']),date_create($_POST['checkOut']))->days;
            for($i=0;$i<$N;$i++)
            {
                $S=$hotel[$i]['stars'];
                echo'   
                <div class = "hotel">
                    <div class = "image">
                        <img src="css/image/Architecture_Hotel-15/Architecture_Hotel/hotel1.png"/>
                    </div>      
                    <div class = \'block1\'>
                            <h3>'.$hotel[$i]['nom'].'</h3>
                            <span class = "stars">';
                while($S--)
                    echo'<span class ="star"></span>';
                echo         '</span>
                            <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-4.198 0-8 3.403-8 7.602 0 4.198 3.469 9.21 8 16.398 4.531-7.188 8-12.2 8-16.398 0-4.199-3.801-7.602-8-7.602zm0 14c-3.314 0-6-2.686-6-6s2.686-6 6-6 6 2.686 6 6-2.686 6-6 6z"/></svg>
                            <span>'.$hotel[$i]['adresse'].' &nbsp</span>    
                            <span style = "font-style: italic">'.$hotel[$i]['distance'].' KM du centre </span> 
                            <div class = "hide description"  >'.$hotel[$i]['description'].'</div>
                    </div>
                    <div class = "block2">
                        <div class = "info"><div>'.$nuits.' nuits</div> <div>'.$_POST['adulte'].' adultes,'.$_POST['chambre'].' chambres</div>
                        <h2>'.$hotel[$i]['price'].' '.$hotel[$i]['currency'].'</h2>
                        </div>
                        <div class = \'buy\'><button>Sélectionner</button></div>
                    </div>
                        
                </div>';
            }
            if($N==0)
            {
                echo ' Pas de resultat trouvé';
            }
        }
        
    ?>
    </div>
    </section>
    
    <script>
       function isOverflown(element) {
                return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
                }
            array = document.querySelectorAll('.description');
            for(i=0;i<array.length;i++)
            {
                if( isOverflown(array[i]) )
                    array[i].parentElement.innerHTML += "<span class = 'more'>show more<span>";
            }

            document.querySelectorAll('.more').forEach(item => {item.addEventListener('click',function(){
                    var description = this.previousElementSibling;
                    if( description.classList.contains('hide'))
                    {
                        description.classList.remove('hide');
                        this.innerHTML = 'show less';
                    }
                    else
                    {
                        description.classList.add('hide');
                        this.innerHTML = 'show more';
                    }
                })
            });
    </script>
</body>
</html>
    


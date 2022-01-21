<?php include('session.php');?>
<?php include('amadeus.php');?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/resultat_hotel.css" />
    <title>ENSIAS E_commerce</title>
    <script src="https://kit.fontawesome.com/1d881ea511.js" crossorigin="anonymous"></script>
</head>

<body>
    
    <header>

    <h1><a href = "index.php"><span>E</span>NSIAS</a></h1>

    <div class="container">
    <ul id="list">
            <li class ="choix" >
                <div class = "text">Choix</div> 
                <div class="sub">
                    <a href="achat_billets.php"><div class="option"><div class="pin2"></div><i class="fas fa-plane" ></i><span>Billets</span></div></a>
                    <a href="hotel.php"><div class="option"><i class="fas fa-hotel"></i><span>Hotels</span></div></a>
                    <a href=""><div class="option"><i class="far fa-circle"></i><span>Option3</span></div></a>
                </div>
                
            </li>
            <li class = "choix"><a class="text" href = "contact.php">Contactez-nous</a></li>
            <li class = "choix"><a class = "text" href = "a_propos.php" >Á propos</a></li>
        </ul>
    </div>
    
    <div id = options>

    <?php
        if(isset($_SESSION['email']))
            echo '  
                    <div id= "profile" >
                    <a href="profile.php"><i class="fas fa-user-circle"></i></a>
                        <div class="sub2">
                            <a href="info.php"><div class="option"><div class="pin2"></div><i class="fas fa-info-circle"></i><span>Mes infos</span></div></a>
                            <a href="change_pass.php"><div class="option"><i class="fas fa-key"></i><span>Sécurité</span></div></a>
                            <a href=""><div class="option"><i class="fas fa-book"></i><span>Achats</span></div></a>
                        </div>
                    </div>
                    <form  id = signOut method="POST">
                    <input type = "hidden" name="origine"  value = '.$_POST['ville'].'>
                    <input type = "hidden" name="destination" value = '.$_POST['checkIn'].'>
                    <input type = "hidden" name="date_depart" value = '.$_POST['checkOut'].'>
                    <input type = "hidden" name="adulte"  value= '.$_POST['chambre'].'>
                    <input type = "hidden" name="enfant" value ='.$_POST['adulte'].'>
                    <input type="submit" name="deconnexion" value = "deconnexion">
                    </form>   ';
            
        else
            echo   '    
                    <div id = "sign_up">
                        <a href="sign_up.php"><button>S\'inscrire</button></a>
                    </div>

                    <div id = "login">
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
            if($hotel == -2)
            {
                echo '<script>
                        alert("La ville que vous avez entré n\'existe pas ou n\'entre pas dans notre intervalle de recherche");
                        location = "achat_billets.php";    
                     </script>';
            }
            $N=count($hotel);

            $post_hotel = $hotel;
            for($i=0 ; $i<$N ;$i++)
            {
                unset($post_hotel[$i]['description']);
                unset($post_hotel[$i]['adresse']);
                unset($post_hotel[$i]['nom']);
            }


            $nuits = date_diff(date_create($_POST['checkIn']),date_create($_POST['checkOut']))->days;
            for($i=0;$i<$N;$i++)
            {
                $S=$hotel[$i]['stars'];
                $data = array_merge($post_hotel[$i],array('ville' => $_POST['ville'], 'arrive' => $_POST['checkIn'],"depart" =>$_POST['checkOut'],"chambre" => $_POST['chambre'], "adulte" => $_POST['adulte']));
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
                        </div>';
                        if(isset($_SESSION['email']))
                        {
                            echo '<form method = "POST" action="./stripe/checkout.php" class = "buy">
                                    <input type= "hidden" value = '.json_encode(array('hotel',$data,$_SESSION['email'])).' name = "data">
                                    <input type="submit" value = "Séléctionner" name = "buy" >
                                </form>';
                        }
                        else{
                            echo '<form method = "POST" action="login.php" class = "buy">
                            <input type= "hidden" value = '.json_encode(array('hotel',$data)).' name = "data">
                            <input type="submit" value = "Séléctionner" name = "buy" >
                            </form>';
                        }           
                                    
                        echo'</div>
                    </div>';
                        }
            if($N==0)
            {
                echo '<script>
                        alert("Aucun résultat trouver");
                        location = "achat_billets.php";    
                     </script>';
            }
        }
        
    ?>
    </div>
    </section>
    
    <?php include("footer.php");?>
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
    


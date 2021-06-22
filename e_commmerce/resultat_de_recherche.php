<?php include('session.php');?>
<?php include('amadeus.php');?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/resultat_recherche.css" />
    <title>E_commerce</title>
    <script src="https://kit.fontawesome.com/1d881ea511.js" crossorigin="anonymous"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
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
            <li class = "choix"><a class="text" href = "mail/Contact.php">Contactez-nous</a></li>
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
                    <input type = "hidden" name="origine"  value = '.$_POST['origine'].'>
                    <input type = "hidden" name="destination" value = '.$_POST['destination'].'>
                    <input type = "hidden" name="date_depart" value = '.$_POST['date_depart'].'>
                    <input type = "hidden" name="adulte"  value= '.$_POST['adulte'].'>
                    <input type = "hidden" name="enfant" value ='.$_POST['enfant'].'>
                    <input type = "hidden" name="bébé"  value = '.$_POST['bébé'].' >
                    <input type = "hidden" name="classe" value='.$_POST['classe'].'>
                    <input type="submit" name="deconnexion" value = "deconnexion">
                    </form>
                ';
            
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
        if(isset($_POST['chercher']) || isset($_POST['deconnexion']) )
        {
    
            $vole = search($_POST['origine'],$_POST['destination'],$_POST['date_depart'],$_POST['adulte'],$_POST['enfant'],$_POST['bébé'],$_POST['classe']);
            if($vole == -1)
            {
                echo '<script>
                        alert("Le nombre de bébé de doit pas dépasser le nombre d\'adulte");
                        location = "achat_billets.php";    
                      </script>';
            }
            elseif($vole == -2)
            {
                echo '<script>
                        alert("La ville d\'origine que vous avez entré n\'existe pas");
                        location = "achat_billets.php";    
                      </script>';
            }
            elseif($vole == -4)
            {
                echo '<script>
                        alert("La ville de destination que vous avez entré n\'existe pas");
                        location = "achat_billets.php";    
                     </script>';
            }
            elseif($vole == -3)
            {
                echo '<script>
                        alert("Une erreur est survenu veuillez ressayer");
                        location = "achat_billets.php";    
                     </script>';
            }
            $N=$vole['count'];
            for($i=0;$i<$N;$i++)
            {
                echo'   
                <div class = vole>
                    <div class = "logo">
                        <img src= "https://content.airhex.com/content/logos/airlines_'.$vole['vole'][$i]['airline'].'_80_80_s.png?md5apikey='.md5($vole['vole'][$i]['airline'].'_80_80_s_VDjfGgv8mxiTvvLLwGicD6V2eq').' ")    ">
                    </div>      
                    <div class = \'block1\'>
                            <span>'.$_POST['origine'].' &nbsp</span>
                            <span class = "logo"><i class="fas fa-plane" ></i></span>
                            <span>'.$_POST['destination'].'</span>     
                        </div>
                        <div class = \'block2\'>
                            <div class = "takeoff">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                width="371.656px" height="371.656px" viewBox="0 0 371.656 371.656" style="enable-background:new 0 0 371.656 371.656;"
                                xml:space="preserve">
                                <g>
                                    <g>
                                        <g>
                                            <path d="M37.833,212.348c-0.01,0.006-0.021,0.01-0.032,0.017c-4.027,2.093-5.776,6.929-4.015,11.114
                                                c1.766,4.199,6.465,6.33,10.787,4.892l121.85-40.541l-22.784,37.207c-1.655,2.703-1.305,6.178,0.856,8.497
                                                c2.161,2.318,5.603,2.912,8.417,1.449l23.894-12.416c0.686-0.356,1.309-0.823,1.844-1.383l70.785-73.941l87.358-45.582
                                                c33.085-17.835,29.252-31.545,27.29-35.321c-1.521-2.928-4.922-6.854-12.479-8.93c-7.665-2.106-18.021-1.938-31.653,0.514
                                                c-4.551,0.818-7.063,0.749-9.723,0.676c-9.351-0.256-15.694,0.371-47.188,16.736L90.788,164.851l-66.8-34.668
                                                c-2.519-1.307-5.516-1.306-8.035,0.004l-11.256,5.85c-2.317,1.204-3.972,3.383-4.51,5.938c-0.538,2.556,0.098,5.218,1.732,7.253
                                                l46.364,57.749L37.833,212.348z"/>
                                            <path d="M355.052,282.501H28.948c-9.17,0-16.604,7.436-16.604,16.604s7.434,16.604,16.604,16.604h326.104
                                                c9.17,0,16.604-7.434,16.604-16.604C371.655,289.934,364.222,282.501,355.052,282.501z"/>
                                        </g>
                                    </g>
                                </g>
                                </svg>
                                <div>'.$vole['vole'][$i]['depart'].'</div>
                            </div>
                            <div class = "landing">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                width="361.228px" height="361.228px" viewBox="0 0 361.228 361.228" style="enable-background:new 0 0 361.228 361.228;"
                                xml:space="preserve">
                                <g>
                                    <g>
                                        <g>
                                            <path d="M12.348,132.041c-0.012-0.001-0.023-0.003-0.036-0.005c-4.478-0.737-8.776,2.086-9.873,6.494
                                                c-1.102,4.419,1.384,8.941,5.706,10.379l121.85,40.542l-40.533,16.141c-2.944,1.173-4.746,4.165-4.404,7.314
                                                c0.34,3.151,2.741,5.688,5.87,6.203l26.57,4.373c0.763,0.125,1.541,0.125,2.304-0.002l100.975-16.795l97.254,15.842
                                                c37.176,5.542,42.321-7.729,43.012-11.931c0.537-3.256,0.166-8.438-4.641-14.626c-4.875-6.279-13.269-12.348-25.652-18.553
                                                c-4.135-2.072-6.104-3.632-8.188-5.284c-7.334-5.807-12.791-9.106-47.809-14.871L83.206,125.736L50.492,57.958
                                                c-1.234-2.556-3.634-4.351-6.436-4.812l-12.517-2.061c-2.577-0.424-5.208,0.329-7.168,2.053
                                                c-1.962,1.724-3.048,4.236-2.958,6.845l2.525,74.013L12.348,132.041z"/>
                                            <path d="M342.707,277.051H16.604C7.434,277.051,0,284.484,0,293.654s7.434,16.604,16.604,16.604h326.103
                                                c9.17,0,16.605-7.436,16.605-16.604S351.877,277.051,342.707,277.051z"/>
                                        </g>
                                    </g>
                                </g>
                                </svg>
                                <div> '.$vole['vole'][$i]['arrive'].'</div>
                            </div>
                        </div>
                        <div class = \'block3\'>
                            '.$vole['vole'][$i]['price'].' DH
                        </div>
                        ';
            $data = array_merge($vole['vole'][$i],array('origine' => $_POST['origine'],'destination' => $_POST['destination'],'adulte' => $_POST['adulte'],'enfant' => $_POST['enfant'],'bebe' => $_POST['bébé'],'classe' => $_POST['classe']));
            if(isset($_SESSION['email']))
            {
                echo '<form method = "POST" action="./stripe/checkout.php" class = "buy">
                        <input type= "hidden" value = '.json_encode(array('billet',$data,$_SESSION['email'])).' name = "data">
                        <input type="submit" value = "Séléctionner" name = "buy" >
                    </form>';
            }
            else{
                echo '<form method = "POST" action="login.php" class = "buy">
                <input type= "hidden" value = '.json_encode(array('billet',$data)).' name = "data">
                <input type="submit" value = "Séléctionner" name = "buy" >
                </form>';
            }           
            echo'          
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
    

</body>
</html>
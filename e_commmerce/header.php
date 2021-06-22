<header>


<h1><a href = "http://localhost/e_commmerce/index.php"><span>E</span>NSIAS</a></h1>

<div class="container">
   <ul id="list">
        <li class ="choix" >
            <div class = "text">Choix</div> 
            <div class="sub">
                <a href="http://localhost/e_commmerce/achat_billets.php"><div class="option"><div class="pin2"></div><i class="fas fa-plane" ></i><span>Billets</span></div></a>
                <a href="http://localhost/e_commmerce/hotel.php"><div class="option"><i class="fas fa-hotel"></i><span>Hotels</span></div></a>
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
            echo '  <div id= "profile" >
                        <a href="http://localhost/e_commmerce/profile.php"><i class="fas fa-user-circle"></i></a>
                        <div class="sub2">
                            <a href="http://localhost/e_commmerce/info.php"><div class="option"><div class="pin2"></div><i class="fas fa-info-circle"></i><span>Mes infos</span></div></a>
                            <a href="http://localhost/e_commmerce/change_pass.php"><div class="option"><i class="fas fa-key"></i><span>Sécurité</span></div></a>
                            <a href="http://localhost/e_commmerce/orders.php"><div class="option"><i class="fas fa-book"></i><span>Achats</span></div></a>
                        </div>
                    </div>
                    
                    <form id = signOut method="POST">
                        <input  type="submit" name="deconnexion" value = "deconnexion">
                    </form>
                ';
        else
            echo '  <div id = "sign_up">
                        <a href="http://localhost/e_commmerce/sign_up.php"><button>S\'inscrire</button></a>
                    </div>

                    <div id = "login">
                        <a href="http://localhost/e_commmerce/login.php"><button>Connexion</button></a>
                    </div>
                ';
        ?>
</div>

    
</header>
<header>


    <h1><a href="index.php" style="font-family:cambria"><span style="font-family:cambria">E</span>NSIAS</a></h1>

    <div class="container">
        <ul id="list">
            <li class="choix">
                choix
                <ul class="sub">
                    <li><a href="achat_billets.php">Billets</a></li>
                    <li><a href="">Options2</a></li>
                    <li><a href="">Options3</a></li>
                </ul>
            </li>
            <li class="choix">contact</li>
            <li class="choix">Á propos</li>
        </ul>
    </div>



    <div id=options>


        <?php
        if(isset($_SESSION['email']))
            echo '  <form id = signOut method="POST">
                        <input  type="submit" name="deconnexion" value = "deconnexion">
                    </form>
                ';
        else
            echo '  <div id = sign_up>
                        <a href="sign_up.php"><button>S\'identifier</button></a>
                    </div>

                    <div id = login>
                        <a href="login.php" ><button>Connexion</button></a>
                    </div>
                ';
        ?>
    </div>


</header>
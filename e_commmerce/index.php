<?php include('session.php');?>


<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>

    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/slider.css" />

    <link rel="href" href="css/plane-solid.svg">
    <title>ENSIAS E_commerce</title>
    <script src="https://kit.fontawesome.com/1d881ea511.js" crossorigin="anonymous"></script>
</head>


<body>
    <?php include('header.php');?>
    
    <!-- hna dir shi titre kbir 7it dik DROPDOWN menu dial choix ki tkheba wra slider dakshi lash drt les <br>hna tatdir shi title kbir fih matalan : bienvenu cher client ..-->
    <div>
        <div class="carousel">
            <ul class="slides">
                <input type="radio" name="radio-buttons" id="img-1" checked />
                <li class="slide-container">
                    <div class="slide-image">
                        <img src="css/image/airplane-wallpaper-3.jpg">
                        <a href="achat_billets.php" class = "titre" id="titre1">RÉSERVER UN BILLET D'AVION</a>
                    </div>
                    <div class="carousel-controls">
                        <label for="img-3" class="prev-slide">
                            <span>&lsaquo;</span>
                        </label>
                        <label for="img-2" class="next-slide">
                            <span>&rsaquo;</span>
                        </label>
                    </div>
                </li>
                <input type="radio" name="radio-buttons" id="img-2" />
                <li class="slide-container">
                    <div class="slide-image">
                        <img src="css/image/dfh_pool-33.jpg">
                        <a href="hotel.php" class = "titre" id="titre2">RÉSERVER HOTEL</a>
                    </div>
                    <div class="carousel-controls">
                        <label for="img-1" class="prev-slide">
                            <span>&lsaquo;</span>
                        </label>
                        <label for="img-3" class="next-slide">
                            <span>&rsaquo;</span>
                        </label>
                    </div>
                </li>
                <!--input type="radio" name="radio-buttons" id="img-3" />
                <li class="slide-container">
                    <div class="slide-image">
                        <img src="https://i.pinimg.com/originals/a2/a5/fa/a2a5fa40d773c1d9af8868fe9ff530fe.jpg">
                    </div>
                    <div class="carousel-controls">
                        <label for="img-2" class="prev-slide">
                            <span>&lsaquo;</span>
                        </label>
                        <label for="img-1" class="next-slide">
                            <span>&rsaquo;</span>
                        </label>
                    </div>
                </li-->
                <div class="carousel-dots">
                    <label for="img-1" class="carousel-dot" id="img-dot-1"></label>
                    <label for="img-2" class="carousel-dot" id="img-dot-2"></label>
                    <!--label for="img-3" class="carousel-dot" id="img-dot-3"></label-->
                </div>
            </ul>
        </div>
    </div>
    
    <?php include("footer.php")?>
</body>

</html>
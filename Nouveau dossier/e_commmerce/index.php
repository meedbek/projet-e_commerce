<?php include('file.php');?>


<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>

    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/slider.css" />

    <link rel="href" href="css/plane-solid.svg">
    <title>E_commerce</title>
    <script src="https://kit.fontawesome.com/1d881ea511.js" crossorigin="anonymous"></script>
</head>


<body>
    <?php include('header.php');?>
    <br><br><br><br><br><br>
    <!-- hna dir shi titre kbir 7it dik DROPDOWN menu dial choix ki tkheba wra slider dakshi lash drt les <br>hna tatdir shi title kbir fih matalan : bienvenu cher client ..-->
    <div>
        <div class="carousel">
            <ul class="slides">
                <input type="radio" name="radio-buttons" id="img-1" checked />
                <li class="slide-container">
                    <div class="slide-image">
                        <img src="https://www.teahub.io/photos/full/153-1539292_air-force-at-night.jpg">
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
                        <img src="https://i.pinimg.com/originals/df/bd/e6/dfbde6c2f1a8f5d5b5a47c81fbecd1eb.jpg">
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
                <input type="radio" name="radio-buttons" id="img-3" />
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
                </li>
                <div class="carousel-dots">
                    <label for="img-1" class="carousel-dot" id="img-dot-1"></label>
                    <label for="img-2" class="carousel-dot" id="img-dot-2"></label>
                    <label for="img-3" class="carousel-dot" id="img-dot-3"></label>
                </div>
            </ul>
        </div>
    </div>
    <br><br><br><br><br><br><br>
</body>

</html>
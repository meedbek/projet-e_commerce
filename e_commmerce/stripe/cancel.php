
<?php

use Stripe\Terminal\Location;

session_start();
  if(isset($_SESSION['data']))
  {
      unset($_SESSION['data']);
  }
  else
  {
    header("Location : http://localhost/e_commmerce/index.php",true,307);
  }
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name=viewport content=widthdevice-width, initial-scale=1.0>
    <link rel="stylesheet" href="http://localhost/e_commmerce/css/style.css" />
    <title>E_commerce</title>
    <script src="https://kit.fontawesome.com/1d881ea511.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("../header.php")?>
    <section>
        <p id="message">Achat annulé</p>
    </section>

    <?php include("../footer.php")?>

</body>
</html>
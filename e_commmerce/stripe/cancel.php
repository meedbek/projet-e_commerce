
<?php

use Stripe\Terminal\Location;

session_start();
  if(isset($_SESSION['data']))
  {
      unset($_SESSION['data']);
      echo'
          <script>
              alert("Achat annulé");
              location = "http://localhost/e_commerce/index.php";    
          </script>;
      ';
  }
  else
  {
    header("Location : http://localhost/e_commerce/index.php",true,307);
  }
?>

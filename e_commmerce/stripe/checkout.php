<?php session_start();
  if(isset($_POST['buy']))
    $_SESSION['data'] = $_POST['data'];
  

?>

<?php if(isset($_SESSION['email']) && isset($_POST['buy'])) {?>
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
    
    <script type="text/javascript">
      // Create an instance of the Stripe object with your publishable API key
      var stripe = Stripe("pk_test_51J4PDVFAmzYgltFNwXkScGY1l4h5MYZ9GMOGbynW80unDs1hXJJezGgc4HtMqiMUhVnyj4UaRruCXEQ6P76ORby700ufapyh0p");
      var checkoutButton = document.getElementById("checkout-button");

        fetch("http://localhost/e_commmerce/stripe/create-checkout-session.php", {
          method: "POST",
        })
          .then(function (response) {
            return response.json();
          })
          .then(function (session) {
            return stripe.redirectToCheckout({ sessionId: session.id });
          })
          .then(function (result) {
            // If redirectToCheckout fails due to a browser or network
            // error, you should display the localized error message to your
            // customer using error.message.
            if (result.error) {
              alert(result.error.message);
            }
          })
          .catch(function (error) {
            console.error("Error:", error);
          });

    </script>
<?php } ?>


<!-- 1 -->
<?php
    if(isset($_POST['booking_start'])&&isset($_POST['pass_price'])&&isset($_POST['bookingOption'])&&isset($_POST['fname'])&&isset($_POST['lname'])&&isset($_POST['email'])&&isset($_POST['mobile'])){
      $booking_start =$_POST['booking_start'];
      $price = $_POST['pass_price'];
      $bookingOption = $_POST['bookingOption'];
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $email = $_POST['email'];
      $mobile = $_POST['mobile'];
    }
    session_start();
    echo $_SESSION["listingId"];
    $_SESSION["userId"]=1;

    // $name = $_GET['name'];
    //$listingId = $_GET['listingId'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <script src="./googlepay.js"></script> -->
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>
<style>
    @import url(//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css);
    @import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
</style>
<link rel="stylesheet" href="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/default_thank_you.css">
<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/jquery-1.9.1.min.js"></script>
<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/html5shiv.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>

    <style>
        button{
            width: 750px;
        }
    </style>
</head>
<body>
    <div id="container"></div>
    <script async
      src="https://pay.google.com/gp/p/js/pay.js"
      onload="onGooglePayLoaded()"></script>
    </script>


       <!-- Include the PayPal JavaScript SDK; replace "test" with your own sandbox Business account app client ID -->
       <script src="https://www.paypal.com/sdk/js?client-id=ARB5d7l5e3279N5zU4K51qZfJdIMWTlBvBoJCGf_hLOh76nD3TACB7-mVdQjZnWbqT8nfIEQ48QOpUYj&currency=SGD"></script>

       <!-- Set up a container element for the button -->
       <div id="paypal-button-container"></div>
   
       <script>
           var price = "<?php echo $price?>"; 
         paypal.Buttons({

            style: {
                
                    color:   'white',
               
               
                },
   
           // Sets up the transaction when a payment button is clicked
           createOrder: function(data, actions) {
             return actions.order.create({
                 intent:'CAPTURE',
               
               purchase_units: [{
                 amount: {
                   value: price, // Can reference variables or functions. Example: `value: document.getElementById('...').value`
                   currency_code:"SGD"
                }
               }]
             });
           },
   
           // Finalize the transaction after payer approval
           onApprove: function(data, actions) {
             return actions.order.capture().then(function(orderData) {
               // Successful capture! For dev/demo purposes:
                   console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                   var transaction = orderData.purchase_units[0].payments.captures[0];
                   //alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                   console.log(transaction)
                   //window.location = "completion_page.html?"+transaction;
                   //document.write("<div id='demo'> </div><header class='site-header' id='header'><h1 class='site-header__title' data-lead-id='site-header-title'>THANK YOU!</h1></header> <div class='main-content'><i class='fa fa-check main-content__checkmark' id='checkmark'></i></div><footer class='site-footer' id='footer'><p class='site-footer__fineprint' id='fineprint'>Copyright ©2014 | All Rights Reserved</p></footer>");
                   //document.getElementById("container").innerHTML = "<div id='demo'> </div><header class='site-header' id='header'><h1 class='site-header__title' data-lead-id='site-header-title'>THANK YOU!</h1></header> <div class='main-content'><i class='fa fa-check main-content__checkmark' id='checkmark'></i></div><footer class='site-footer' id='footer'><p class='site-footer__fineprint' id='fineprint'>Copyright ©2014 | All Rights Reserved</p></footer>";
                   // When ready to go live, remove the alert and show a success message within this page. For example:
                   var element1 = document.getElementById('container');
                   element1.style.display = 'none';   
                   var element = document.getElementById('paypal-button-container');

               element.innerHTML = '';
               element.innerHTML = "<div id='demo'> </div><header class='site-header' id='header'><h1 class='site-header__title' data-lead-id='site-header-title'>THANK YOU!</h1></header> <div class='main-content'><i class='fa fa-check main-content__checkmark' id='checkmark'></i></div> <h3> Booking id: "+transaction.id+"</h3><h4><a href='../sean2/home.html'>Go back to main</a></h4><footer class='site-footer' id='footer'><p class='site-footer__fineprint' id='fineprint'>Copyright ©2014 | All Rights Reserved</p></footer>";
               // Or go to another URL:  actions.redirect('thank_you.html');
             })
           }
         }).render('#paypal-button-container');
   
       </script>
</body>
</html>

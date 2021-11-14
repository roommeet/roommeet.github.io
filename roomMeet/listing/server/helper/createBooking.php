<link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>
<style>
    @import url(//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css);
    @import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
</style>
<link rel="stylesheet" href="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/default_thank_you.css">
<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/jquery-1.9.1.min.js"></script>
<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/html5shiv.js"></script>


<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

$upOne = dirname(__DIR__, 1);
require_once $upOne.'/model/BookingDAO.php';
require_once $upOne.'/model/Booking.php';

session_start();
$listingId =  $_SESSION["listingId"];
$userId = $_SESSION["userId"];
$booking_start = $_SESSION["booking_start"];
$bookingOption = $_SESSION["bookingOption"];

$bookingDAO = new BookingDAO();
$status = $bookingDAO->addBooking($userId, $listingId, $booking_start, $bookingOption);

if( $status ) {
       
         

    echo "
    
    <div id='demo'> </div>
    <header class='site-header' id='header'>
        <h1 class='site-header__title' data-lead-id='site-header-title'>You've successfully made a booking!</h1>
    </header>
    

    <div class='main-content'>
        <i class='fa fa-check main-content__checkmark' id='checkmark'></i>
    
    </div>

    <div class='main-content'>
    'Click <a href='../../../sean2/profile.php'>here</a> to return to Main Page'
    </div>

    
    
    ";
}
else {
    echo "<h1>Booking NOT successful!</h1>";
}
?>
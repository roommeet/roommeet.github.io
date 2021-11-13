<?php
$upOne = dirname(__DIR__, 1);
require_once $upOne.'/model/BookingDAO.php';
require_once $upOne.'/model/Booking.php';

$bookingDAO = new BookingDAO();
// print_r($bookingDAO->getBooking(2));
$date = $_GET['date'];
$listingId = $_GET['listingId'];


if(!is_null($bookingDAO->getBooking($listingId))){
        $booking_obj = $bookingDAO->getBooking($listingId);
        $booking_obj_Details = $booking_obj->getBookingDetails();
        $booking_obj_Date = $booking_obj->getBookingDate();
        if($date==$booking_obj_Date){
            if($booking_obj_Details=="Fully"){
                echo "<p class='text-warning'><strong>Not Available for the given date!</strong></p>";
            }else if($booking_obj_Details=="halfAm"){
                echo "<p class='text-success'><strong>Available from 3pm!</strong></p>";
            }else if($booking_obj_Details=="halfPm"){
                echo "<p class='text-success'><strong>Available before 3pm!</strong></p>";
            }
        }else{
            echo "<p class='text-success'><strong>Available for all day!</strong></p>";
        }
}else{
    echo "<p class='text-success'><strong>Available for all day!</strong></p>";
}




// function compareListingArr($arrA, $arrB){
//     $filter_result = array();
//     for($x=0; $x<count($arrA); $x++){
//         $listing_obj1 = $arrA[$x];
//         for($y=0; $y<count($arrB); $y++){
//             $listing_obj2 = $arrB[$y];
//             if($listing_obj1->getID()==$listing_obj2->getID()){
//                 array_push($filter_result, $listing_obj1);
//             }
//         }
//     }
//     return $filter_result;
// }
?>
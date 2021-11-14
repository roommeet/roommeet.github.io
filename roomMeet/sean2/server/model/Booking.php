<?php

class Booking {
    private $bookingId;
    private $userId;
    private $listingId;
    private $bookingDate;
    private $bookingDetails;
    
    public function __construct($bookingId, $userId, $listingId, $bookingDate, $bookingDetails) {
        $this->bookingId = $bookingId;
        $this->userId = $userId;
        $this->listingId = $listingId;
        $this->bookingDate = $bookingDate;
        $this->bookingDetails = $bookingDetails;
    }


    public function getBookingId() {
        return $this->bookingId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getListingId() {
        return $this->listingId;
    }

    public function getBookingDate() {
        return $this->bookingDate;
    }

    public function getBookingDetails() {
        return $this->bookingDetails;
    }

    
}

?>
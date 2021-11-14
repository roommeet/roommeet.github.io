<?php

class Review {
    private $reviewId;
    private $listingId;
    private $userId;
    private $reviewScore;
    private $desciprtion;
    private $dateAttained;
    
    public function __construct($reviewId, $listingId, $userId, $reviewScore, $desciprtion, $dateAttained) {
        $this->reviewId = $reviewId;
        $this->listingId = $listingId;
        $this->userId = $userId;
        $this->reviewScore = $reviewScore;
        $this->desciprtion = $desciprtion;
        $this->dateAttained = $dateAttained;
    }


    public function getListingId() {
        return $this->listingId;
    }

    public function getReviewId() {
        return $this->reviewId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getReviewScore() {
        return $this->reviewScore;
    }

    public function getDescription() {
        return $this->desciprtion;
    }

    public function getDate() {
        return $this->dateAttained;
    }

    
}

?>
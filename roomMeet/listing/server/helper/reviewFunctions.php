<?php
require_once 'server/model/ReviewDAO.php';
require_once 'server/model/Review.php';


$reviewDAO = new ReviewDAO();
                
function getSize($listingId){
    global $reviewDAO;
    $reviews = $reviewDAO->getReviews($listingId);
    
    return sizeof($reviews);
}

function calculateAvg($listingId){
    global $reviewDAO;
    $sum = 0;
    $reviews = $reviewDAO->getReviews($listingId);
    foreach($reviews as $review){
        $sum += $review->getReviewScore();
    }
    return number_format($sum/sizeof($reviews),1,".",".");
}

function countEach($listingId){
    global $reviewDAO;
    $result = array();
    $count1 = 0;
    $count2 = 0;
    $count3 = 0;
    $count4 = 0;
    $count5 = 0;
    $reviews = $reviewDAO->getReviews($listingId);
    foreach($reviews as $review){
        if($review->getReviewScore()==1){
            $count1++;
        }else if($review->getReviewScore()==2){
            $count2++;
        }else if($review->getReviewScore()==3){
            $count3++;
        }else if($review->getReviewScore()==4){
            $count4++;
        }else if($review->getReviewScore()==5){
            $count5++;
        }
    }
    $result['1'] = $count1;
    $result['2'] = $count2;
    $result['3'] = $count3;
    $result['4'] = $count4;
    $result['5'] = $count5;
    $result['Total'] = sizeof($reviews);

    return $result;
}

function printStars($listingId){
    $avg = calculateAvg($listingId);
    if(intval($avg)==0){
        echo '<span class="fa fa-star"></span>';
        echo '<span class="fa fa-star"></span>';
        echo '<span class="fa fa-star"></span>';
        echo '<span class="fa fa-star"></span>';
        echo '<span class="fa fa-star"></span>';
    }else if(intval($avg)==1){
        echo '<span class="fa fa-star checked"></span>';
        echo '<span class="fa fa-star"></span>';
        echo '<span class="fa fa-star"></span>';
        echo '<span class="fa fa-star"></span>';
        echo '<span class="fa fa-star"></span>';
    }else if(intval($avg)==2){
        echo '<span class="fa fa-star checked"></span>';
        echo '<span class="fa fa-star checked"></span>';
        echo '<span class="fa fa-star"></span>';
        echo '<span class="fa fa-star"></span>';
        echo '<span class="fa fa-star"></span>';
    }else if(intval($avg)==3){
        echo '<span class="fa fa-star checked"></span>';
        echo '<span class="fa fa-star checked"></span>';
        echo '<span class="fa fa-star checked"></span>';
        echo '<span class="fa fa-star"></span>';
        echo '<span class="fa fa-star"></span>';
    }else if(intval($avg)==4){
        echo '<span class="fa fa-star checked"></span>';
        echo '<span class="fa fa-star checked"></span>';
        echo '<span class="fa fa-star checked"></span>';
        echo '<span class="fa fa-star checked"></span>';
        echo '<span class="fa fa-star"></span>';
    }else if(intval($avg)==5){
        echo '<span class="fa fa-star checked"></span>';
        echo '<span class="fa fa-star checked"></span>';
        echo '<span class="fa fa-star checked"></span>';
        echo '<span class="fa fa-star checked"></span>';
        echo '<span class="fa fa-star checked"></span>';
    }
}
?>
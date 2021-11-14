<?php
require_once '../model/ReviewDAO.php';
require_once '../model/Review.php';

$region = $_GET['region'];
$roomType = $_GET['roomType'];
$minPrice = intval($_GET['minPrice']);
$maxPrice = intval($_GET['maxPrice']);
$capacity = $_GET['capacity'];
$listingDAO = new ListingDAO();

$arrayA = filterByPrice();
$arrayB = filterByRoomType();
$arrayC = filterByRegion();
$arrayD = filterByCapacity();
$comb1 = compareListingArr($arrayA, $arrayB);
$comb2 = compareListingArr($arrayC, $arrayD);
$final_output = compareListingArr($comb1, $comb2);
//var_dump($final_output);
foreach($final_output as $listing){
    echo '<div class="col-sm-3">';
    echo '<div class="card border border-white" style="width: 18rem;">';
    echo '<img class="card-img-top" src="'.$listing->getUrl().'" alt="Card image cap">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">'.$listing->getName().'</h5>';
    echo '<h6 class="card-title">Full Day S$'.$listing->getPrice().'</h6>';
    echo '<p class="card-text">['.$listing->getAddress().'] ['.$listing->getSize().'sqft] ['.$listing->getType().']</p>';
    echo '<form method="post" action="view-details.php" class="justify-content-center">';
    echo '<input type="hidden" id="listingId" name="listingId" value='.$listing->getID().'>';
    echo '<button type="submit" class="btn btn-primary">Explore more</button>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
    
        
            
            
                


function filterByPrice(){
    global $listingDAO;
    $minPrice = intval($_GET['minPrice']);
    $maxPrice = intval($_GET['maxPrice']);
    $listings = $listingDAO->getAll();
    $filter_result = array();
    foreach($listings as $listing){
        if($listing->getPrice()>$minPrice&&$listing->getPrice()<$maxPrice){
            array_push($filter_result, $listing);
        }
    }
    return $filter_result;
}

function filterByRoomType(){
    global $listingDAO;
    $roomType = $_GET['roomType'];
    $listings = $listingDAO->getAll();
    $filter_result = array();
    if($roomType=="All"){
        return $listings;
    }else{
        foreach($listings as $listing){
            if($listing->getType()==$roomType){
                array_push($filter_result, $listing);
            }
        }
        return $filter_result;
    }
}

function filterByRegion(){
    global $listingDAO;
    $region = $_GET['region'];
    $listings = $listingDAO->getAll();
    $filter_result = array();
    if($region=="All"){
        return $listings;
    }else{
        foreach($listings as $listing){
            if($listing->getRegion()==$region){
                array_push($filter_result, $listing);
            }
        }
        return $filter_result;
    }
}

function filterByCapacity(){
    global $listingDAO;
    $capacity = $_GET['capacity'];
    $listings = $listingDAO->getAll();
    $filter_result = array();
    
    foreach($listings as $listing){
        if($listing->getCapacity()>=$capacity){
            array_push($filter_result, $listing);
        }
    }
    return $filter_result;
    
}


function compareListingArr($arrA, $arrB){
    $filter_result = array();
    for($x=0; $x<count($arrA); $x++){
        $listing_obj1 = $arrA[$x];
        for($y=0; $y<count($arrB); $y++){
            $listing_obj2 = $arrB[$y];
            if($listing_obj1->getID()==$listing_obj2->getID()){
                array_push($filter_result, $listing_obj1);
            }
        }
    }
    return $filter_result;
}
?>
<?php
$upOne = dirname(__DIR__, 1);
 require_once $upOne.'/model/ListingDAO.php';
 require_once $upOne.'/model/Listing.php';

$region = "";
$roomType = "";
$minPrice = "";
$maxPrice = "";
$capacity = "";
if(isset($_GET['region'])){
    $region = $_GET['region'];
}
if(isset($_GET['roomType'])){
    $roomType = $_GET['roomType'];
}
if(isset($_GET['minPrice'])){
    $minPrice = intval($_GET['minPrice']);
}
if(isset($_GET['maxPrice'])){
    $maxPrice = intval($_GET['maxPrice']);
}
if(isset($_GET['capacity'])){
    $capacity = $_GET['capacity'];
}

$listingDAO = new ListingDAO();

$arrayA = filterByPrice($minPrice, $maxPrice);
$arrayB = filterByRoomType($roomType);
$arrayC = filterByRegion($region);
$arrayD = filterByCapacity($capacity);
$comb1 = compareListingArr($arrayA, $arrayB);
$comb2 = compareListingArr($arrayC, $arrayD);
$final_output = compareListingArr($comb1, $comb2);
//var_dump($final_output);

    
        
            
            
                


function filterByPrice($minPrice, $maxPrice){
    global $listingDAO;
    $listings = $listingDAO->getAll();
    $filter_result = array();
    foreach($listings as $listing){
        if($listing->getPrice()>$minPrice&&$listing->getPrice()<$maxPrice){
            array_push($filter_result, $listing);
        }
    }
    return $filter_result;
}

function filterByRoomType($roomType){
    global $listingDAO;
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

function filterByRegion($region){
    global $listingDAO;
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

function filterByCapacity($capacity){
    global $listingDAO;
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
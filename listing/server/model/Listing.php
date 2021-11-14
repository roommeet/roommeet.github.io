<?php

class Listing {
    private $id;
    private $name;
    private $price;
    private $imageUrl;
    private $address;
    private $type;
    private $size;
    private $bedRooms;
    private $bathRooms;
    private $booked;
    private $capacity;
    private $region;
    private $longitude;
    private $latitude;

    public function __construct($id, $name, $price, $imageUrl, $address, $type, $size, $bedRooms, $bathRooms, $booked, $capacity, $region, $longitude, $latitude) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->imageUrl = $imageUrl;
        $this->address = $address;
        $this->type = $type;
        $this->size = $size;
        $this->bedRooms = $bedRooms;
        $this->bathRooms = $bathRooms;
        $this->booked = $booked;
        $this->capacity = $capacity;
        $this->region = $region;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }

    public function getID() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getUrl() {
        return $this->imageUrl;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getType() {
        return $this->type;
    }

    public function getSize() {
        return $this->size;
    }

    public function getBathRooms() {
        return $this->bedRooms;
    }

    public function getBedRooms() {
        return $this->bathRooms;
    }

    public function getBooked() {
        return $this->booked;
    }

    public function getCapacity() {
        return $this->capacity;
    }

    public function getRegion() {
        return $this->region;
    }

    public function getLatitude() {
        return $this->latitude;
    }

    public function getLongitude() {
        return $this->longitude;
    }
}

?>
<?php

class Listing {
    private $id;
    private $name;
    private $price;
    private $imageUrl;
    private $address;
    private $type;
    private $size;

    public function __construct($id, $name, $price, $imageUrl, $address, $type, $size) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->imageUrl = $imageUrl;
        $this->address = $address;
        $this->type = $type;
        $this->size = $size;
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
}

?>
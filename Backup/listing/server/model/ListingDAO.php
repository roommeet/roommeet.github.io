<?php

require_once 'common.php';

class ListingDAO {

    public function getAll() {
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "SELECT
                    *
                FROM listing"; // SELECT * FROM post; // This will also work
        $stmt = $conn->prepare($sql);

        // STEP 3
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // STEP 4
        $listings = []; // Indexed Array of Post objects
        while( $row = $stmt->fetch() ) {
            $listings[] =
                new Listing(
                    $row['listingId'],
                    $row['name'],
                    $row['price'],
                    $row['imageUrl'],
                    $row['address'],
                    $row['type'],
                    $row['size'],
                    $row['bedRooms'],
                    $row['bathRooms'],
                    $row['booked'],
                    $row['capacity'],
                    $row['region'],
                    $row['longitude'],
                    $row['latitude']
                );
        }

        // STEP 5
        $stmt = null;
        $conn = null;

        // STEP 6
        return $listings;
    }

    public function get($id) {
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "SELECT
                    *
                FROM listing
                WHERE 
                listingId = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // STEP 3
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // STEP 4
        $listing_object = null;
        if( $row = $stmt->fetch() ) {
            $listing_object = 
                new Listing(
                    $row['listingId'],
                    $row['name'],
                    $row['price'],
                    $row['imageUrl'],
                    $row['address'],
                    $row['type'],
                    $row['size'],
                    $row['bedRooms'],
                    $row['bathRooms'],
                    $row['booked'],
                    $row['capacity'],
                    $row['region'],
                    $row['longitude'],
                    $row['latitude']
                );
        }

        // STEP 5
        $stmt = null;
        $conn = null;

        // STEP 6
        return $listing_object;
    }

    public function addListing($name, $price, $imageUrl, $address, $type, $size, $bedRooms, $bathRooms, $booked, $capacity, $region, $longitude, $latitude) {
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "INSERT INTO review
                    (
                        name,
                        price,
                        imageUrl,
                        address,
                        type,
                        size,
                        bedRooms,
                        bathRooms,
                        booked,
                        capacity,
                        region,
                        longitude,
                        latitude
                    )
                VALUES
                    (
                        :name,
                        :price,
                        :imageUrl,
                        :address,
                        :type,
                        :size,
                        :bedRooms,
                        :bathRooms,
                        :booked, 
                        :capacity,
                        :region,
                        :longitude,
                        :latitude
                    )";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':imageUrl', $imageUrl, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->bindParam(':size', $size, PDO::PARAM_INT);
        $stmt->bindParam(':bedRooms', $bedRooms, PDO::PARAM_INT);
        $stmt->bindParam(':bathRooms', $bathRooms, PDO::PARAM_INT);
        $stmt->bindParam(':booked', $booked, PDO::PARAM_STR);
        $stmt->bindParam(':capacity', $capacity, PDO::PARAM_INT);
        $stmt->bindParam(':region', $region, PDO::PARAM_INT);
        $stmt->bindParam(':longitude', $longitude, PDO::PARAM_STR);
        $stmt->bindParam(':latitude', $latitude, PDO::PARAM_STR);

        //STEP 3
        $status = $stmt->execute();
        
        // STEP 4
        $stmt = null;
        $conn = null;

        // STEP 5
        return $status;
    }
    /*
    public function update($id, $subject, $entry, $mood) {

        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "UPDATE
                    post
                SET
                    update_timestamp = CURRENT_TIMESTAMP,
                    subject = :subject,
                    entry = :entry,
                    mood = :mood
                WHERE 
                    id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
        $stmt->bindParam(':entry', $entry, PDO::PARAM_STR);
        $stmt->bindParam(':mood', $mood, PDO::PARAM_STR);

        //STEP 3
        $status = $stmt->execute();
        
        // STEP 4
        $stmt = null;
        $conn = null;

        // STEP 5
        return $status;
    }

    public function delete($id) {
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "DELETE FROM
                    post
                WHERE 
                    id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        //STEP 3
        $status = $stmt->execute();
        
        // STEP 4
        $stmt = null;
        $conn = null;

        // STEP 5
        return $status;
    }

    public function add($subject, $entry, $mood) {
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "INSERT INTO post
                    (
                        create_timestamp, 
                        update_timestamp, 
                        subject, 
                        entry, 
                        mood
                    )
                VALUES
                    (
                        CURRENT_TIMESTAMP,
                        CURRENT_TIMESTAMP,
                        :subject,
                        :entry,
                        :mood
                    )";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
        $stmt->bindParam(':entry', $entry, PDO::PARAM_STR);
        $stmt->bindParam(':mood', $mood, PDO::PARAM_STR);

        //STEP 3
        $status = $stmt->execute();
        
        // STEP 4
        $stmt = null;
        $conn = null;

        // STEP 5
        return $status;
    }
    */
}

?>
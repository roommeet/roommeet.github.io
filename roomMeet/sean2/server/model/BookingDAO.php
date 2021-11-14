<?php

//require_once 'common.php';

class BookingDAO {

    public function getAll() {
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "SELECT
                    *
                FROM booking"; // SELECT * FROM post; // This will also work
        $stmt = $conn->prepare($sql);

        // STEP 3
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // STEP 4
        $bookings = []; // Indexed Array of Post objects
        while( $row = $stmt->fetch() ) {
            $bookings[] =
                new Booking(
                    $row['bookingId'],
                    $row['userId'],
                    $row['listingId'],
                    $row['bookingDate'],
                    $row['bookingDetails']
                );
        }

        // STEP 5
        $stmt = null;
        $conn = null;

        // STEP 6
        return $bookings;
    }


    public function getBooking($listingId) {
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "SELECT
                    *
                FROM booking
                WHERE 
                listingId = :listingId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':listingId', $listingId, PDO::PARAM_INT);

        // STEP 3
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // STEP 4
        $listing_object = null;
        if( $row = $stmt->fetch() ) {
            $listing_object = 
                new Booking(
                    $row['bookingId'],
                    $row['userId'],
                    $row['listingId'],
                    $row['bookingDate'],
                    $row['bookingDetails']
                );
        }

        // STEP 5
        $stmt = null;
        $conn = null;

        // STEP 6
        return $listing_object;
    }

    public function getBookings($userId) {
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "SELECT
                    *
                FROM booking
                WHERE userId = :userId"; // SELECT * FROM post; // This will also work
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        // STEP 3
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // STEP 4
        $bookings = []; // Indexed Array of Post objects
        while( $row = $stmt->fetch() ) {
            $bookings[] =
                new Booking(
                    $row['bookingId'],
                    $row['userId'],
                    $row['listingId'],
                    $row['bookingDate'],
                    $row['bookingDetails']
                );
        }

        // STEP 5
        $stmt = null;
        $conn = null;

        // STEP 6
        return $bookings;
    }

    public function addBooking($userId, $listingId, $bookingDate, $bookingDetails) {
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "INSERT INTO booking
                    (
                        userId, 
                        listingId, 
                        bookingDate, 
                        bookingDetails
                    )
                VALUES
                    (
                        :userId,
                        :listingId,
                        :bookingDate,
                        :bookingDetails
                    )";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':listingId', $listingId, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':bookingDate', $bookingDate, PDO::PARAM_STR);
        $stmt->bindParam(':bookingDetails', $bookingDetails, PDO::PARAM_STR);

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
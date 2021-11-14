<?php

//require_once 'common.php';

class ReviewDAO {

    public function getAll() {
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "SELECT
                    *
                FROM review"; // SELECT * FROM post; // This will also work
        $stmt = $conn->prepare($sql);

        // STEP 3
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // STEP 4
        $reviews = []; // Indexed Array of Post objects
        while( $row = $stmt->fetch() ) {
            $reviews[] =
                new Review(
                    $row['reviewId'],
                    $row['listingId'],
                    $row['userId'],
                    $row['reviewScore'],
                    $row['desciprtion'],
                    $row['dateAttained']
                );
        }

        // STEP 5
        $stmt = null;
        $conn = null;

        // STEP 6
        return $reviews;
    }

    public function getReviews($listingId) {
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "SELECT
                    *
                FROM review
                WHERE 
                    listingId = :listingId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':listingId', $listingId, PDO::PARAM_INT);


        // STEP 3
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // STEP 4
        $reviews = []; // Indexed Array of Post objects
        while( $row = $stmt->fetch() ) {
            $reviews[] =
                new Review(
                    $row['reviewId'],
                    $row['listingId'],
                    $row['userId'],
                    $row['reviewScore'],
                    $row['desciprtion'],
                    $row['dateAttained']
                );
        }

        // STEP 5
        $stmt = null;
        $conn = null;

        // STEP 6
        return $reviews;
    }

    public function getReview($reviewId) {
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "SELECT
                    *
                FROM review
                WHERE 
                reviewId = :reviewId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':reviewId', $reviewId, PDO::PARAM_INT);

        // STEP 3
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // STEP 4
        $review_object = null;
        if( $row = $stmt->fetch() ) {
            $review_object = 
                new Review(
                    $row['reviewId'],
                    $row['listingId'],
                    $row['userId'],
                    $row['reviewScore'],
                    $row['desciprtion'],
                    $row['dateAttained']
                );
        }

        // STEP 5
        $stmt = null;
        $conn = null;

        // STEP 6
        return $review_object;
    }

    public function addReview($listingId, $userId, $reviewScore, $desciprtion) {
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->connect();

        // STEP 2
        $sql = "INSERT INTO review
                    (
                        listingId, 
                        userId, 
                        reviewScore, 
                        desciprtion, 
                        dateAttained
                    )
                VALUES
                    (
                        :listingId,
                        :userId,
                        :reviewScore,
                        :desciprtion,
                        CURRENT_TIMESTAMP
                    )";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':listingId', $listingId, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':reviewScore', $reviewScore, PDO::PARAM_INT);
        $stmt->bindParam(':desciprtion', $desciprtion, PDO::PARAM_STR);

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

    
}

 */

}


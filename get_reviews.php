<?php
require 'db.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "SELECT rating, review, rating_date, m.title,  m.movie_image, m.movie_id,m.overview, r.rating_id
                        FROM Rating r 
                        INNER JOIN Movie m ON m.movie_id = r.movie_id 
                        WHERE user_id = :user_id
                        ORDER BY r.rating DESC";
    $user_id = $_POST['user_id'];

    if ($user_id) {
        try {
            $stmt = $db->prepare($query);
            $stmt->execute(['user_id' => $user_id]);
            $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($reviews){
                echo json_encode($reviews);
            } else {
                echo json_encode(['error' => 'Error retrieving reviews: ']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error retrieving reviews: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'Invalid user ID']);
    }
}
?><?php

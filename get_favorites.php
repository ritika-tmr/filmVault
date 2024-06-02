<?php
require 'db.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query_movie = "SELECT m.title, m.movie_image, m.movie_id, m.overview, AVG(r.rating) AS avg_rating
                    FROM movie m
                    LEFT JOIN rating r ON r.movie_id = m.movie_id
                    INNER JOIN watchlist w ON m.movie_id = w.movie_id
                    WHERE w.user_id = :user_id";
    $user_id = $_POST['user_id'];

    if ($user_id) {
        try {
            $stmt = $db->prepare($query_movie);
            $stmt->execute(['user_id' => $user_id]);
            $favorites = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($favorites);
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error retrieving favorites: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'Invalid user ID']);
    }
}
?><?php

<?php
require 'db.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query_movie = "SELECT m.title,  m.movie_image, m.movie_id,m.overview,COALESCE(AVG(r.rating), 0) AS avg_rating
                    FROM Movie m
                    LEFT JOIN watchlist w ON m.movie_id = w.movie_id
                    LEFT JOIN Rating r ON r.movie_id = m.movie_id
                    WHERE  w.user_id = :user_id
                    GROUP BY m.movie_id, m.title, m.movie_image, m.overview";
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

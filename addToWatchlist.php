<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = htmlspecialchars($_POST['user_id']);
    $movie_id =  htmlspecialchars($_POST['movie_id']);
    if ($user_id && $movie_id) {
        try {
            $stmt = $db->prepare('INSERT INTO watchlist (movie_id, user_id) VALUES (?, ?)');
            if ($stmt -> execute([$movie_id, $user_id])){
//                echo '<div class="alert alert-success" role="alert">';
                echo 'Successfully added to Watchlist!';
//                echo '</div>';
            } else {
//                echo '<div class="alert alert-danger" role="alert">';
                echo 'Error: Could not add review!';
            }
        } catch (Exception $e) {
//            echo '<div class="alert alert-danger" role="alert">';
            echo 'Error Adding' . $e->getMessage() ;
//            echo '</div>';
        }
    } else {
//        echo '<div class="alert alert-danger" role="alert">';
        echo 'Invalid review or rating!';
//        echo '</div>';
    }
}
?>

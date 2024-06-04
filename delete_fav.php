<?php
require 'db.php'; // Your database connection file


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "DELETE FROM watchlist WHERE watchlist_id =:watchlist_id";
    $watchlist_id = $_POST['watchlist_id'];

    if ($watchlist_id) {
        try {
            $stmt = $db->prepare($query);
            if ($stmt->execute(['watchlist_id' => $watchlist_id])) {
                echo json_encode(['success' => 'Successfully Deleted']);
            } else {
                echo json_encode(['error' => 'Error deleting. Try again!']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error deleting favorites: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'Invalid user ID']);
    }
}
?>

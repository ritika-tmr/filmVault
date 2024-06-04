<?php
require 'db.php'; // Your database connection file


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "DELETE FROM Rating WHERE rating_id =:rating_id";
    $rating_id = $_POST['rating_id'];

    if ($rating_id) {
        try {
            $stmt = $db->prepare($query);
            if ($stmt->execute(['rating_id' => $rating_id])) {
                echo json_encode(['success' => 'Successfully Deleted']);
            } else {
                echo json_encode(['error' => 'Error deleting. Try again!']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error deleting rating: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'Invalid user ID']);
    }
}
?>

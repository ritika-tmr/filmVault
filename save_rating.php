<?php
// Check if movie_id is set in the URL
if (isset($_GET['movie_id'])) {
    $movie_id = intval($_GET['movie_id']); // Get movie_id from URL and ensure it's an integer

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include your database connection file
        include "db.php";

        // Validate and sanitize inputs
        $rating = ($_POST['rating'] >= 1 && $_POST['rating'] <= 5) ? intval($_POST['rating']) : null; // Validate rating
        $review = htmlspecialchars($_POST['review']); // Sanitize review

        // Check if rating is valid
        if ($rating !== null) {
            // Prepare and execute the SQL statement
            $stmt = $conn->prepare("INSERT INTO Rating (movie_id, rating, review) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $movie_id, $rating, $review);
            
            if ($stmt->execute()) {
                // Rating and review saved successfully
                echo "Rating and review saved successfully!";
            } else {
                // Error occurred while saving
                echo "Error: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Invalid rating value.";
        }

        // Close database connection
        $conn->close();
    }
} else {
    echo "No movie ID provided.";
}
?>

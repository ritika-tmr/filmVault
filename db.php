<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=db_22075125', '22075125', 'mydb22075125');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
?>


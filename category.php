<?php
require 'db.php';

$query_genre = "SELECT * FROM Genre";
$query_country = "SELECT * FROM Country";
$query_language = "SELECT * FROM Language";

$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

// Construct the main query
$query_movie = "SELECT m.movie_id, m.title, m.overview, m.movie_image,
                AVG(r.rating) AS avg_rating, GROUP_CONCAT(g.genre_name) AS genre_name
                FROM movie m
                LEFT JOIN rating r ON r.movie_id = m.movie_id
                LEFT JOIN movie_genre mg ON mg.movie_id = m.movie_id
                LEFT JOIN genre g ON g.genre_id = mg.genre_id
                LEFT JOIN movie_language ml ON ml.movie_id = m.movie_id
                LEFT JOIN language l ON l.language_id = ml.language_id
                LEFT JOIN production_country pc ON pc.movie_id = m.movie_id
                LEFT JOIN country c ON c.country_id = pc.country_id";

// Add filtering conditions
$whereClause = "";
if (!empty($search_query)) {
    $whereClause .= " AND m.title LIKE '%$search_query%'";
}
if (isset($_GET['genre']) && $_GET['genre'] != '') {
    $genre_id = $_GET['genre'];
    $whereClause .= " AND g.genre_id = '$genre_id'";
}
if (isset($_GET['countries']) && $_GET['countries'] != '') {
    $country_id = $_GET['countries'];
    $whereClause .= " AND c.country_id = '$country_id'";
}
if (isset($_GET['languages']) && $_GET['languages'] != '') {
    $language_id = $_GET['languages'];
    $whereClause .= " AND l.language_id = '$language_id'";
}

// Append the WHERE clause if necessary
if (!empty($whereClause)) {
    $query_movie .= " WHERE " . ltrim($whereClause, ' AND');
}

// Group by and order
$query_movie .= " GROUP BY m.movie_id, m.title, m.overview, m.movie_image
                  ORDER BY avg_rating DESC";

// Execute the main query
$stmt1 = $db->prepare($query_movie);
$stmt1->execute();
$actionMovies = $stmt1->fetchAll(PDO::FETCH_ASSOC);

// Execute other queries
$stmt2 = $db->prepare($query_country);
$stmt2->execute();
$countries = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$stmt3 = $db->prepare($query_language);
$stmt3->execute();
$languages = $stmt3->fetchAll(PDO::FETCH_ASSOC);

$stmt4 = $db->prepare($query_genre);
$stmt4->execute();
$genre = $stmt4->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FilmVault</title>
    <link rel="stylesheet" href="category.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>
<!--Header-->
<nav class="navbar navbar-expand-lg header">
    <div class="container">
        <a class="navbar-brand" href="./index.php">
            <img src="./assets/Logo/FilmVault_purple2-removebg-preview.png" alt="Logo" width="70" height="55" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex me-3 w-100" role="search" method="GET" action="">
                <div class="input-group">
                    <span class="input-group-text rounded-start-pill"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search by movie name" aria-label="Search Movies" name="search_query">
                    <span class="input-group-text rounded-end-circle"><i class="fa fa-sliders"></i></span>
                </div>
            </form>
        </div>
        <ul class="navbar-nav flex-row">
            <li class="nav-item border border-white rounded-circle mx-1 px-1">
                <a class="nav-link text-light" href="/index.html"><i class="fa fa-heart"></i></a>
            </li>
            <li class="nav-item border border-white rounded-circle mx-1 px-1">
                <a class="nav-link text-light" href="/index.html"><i class="fa fa-bell"></i></a>
            </li>
            <li class="nav-item border border-white rounded-circle mx-1 px-1">
                <a class="nav-link text-light" href="/index.html"><i class="fa fa-user"></i></a>
            </li>
        </ul>




    </div>
</nav>

<!--Category Lists-->
<div class="container py-3 my-3">
    <div class="row g-5">
        <div class="col-sm-4">
            <form>
                
                <!-- New filter dropdowns for genres, languages, and countries -->
                <select class="form-select mt-2" name="genre">
                    <option value="">Select Genre</option>
                    <?php foreach ($genre as $g) { ?>
                        <option value="<?php echo $g['genre_id']; ?>"><?php echo $g['genre_name']; ?></option>
                    <?php } ?>
                </select>
                <select class="form-select mt-2" name="countries">
                    <option value="">Select Country</option>
                    <?php foreach ($countries as $c) { ?>
                        <option value="<?php echo $c['country_id']; ?>"><?php echo $c['country_name']; ?></option>
                    <?php } ?>
                </select>
                <select class="form-select mt-2" name="languages">
                    <option value="">Select Language</option>
                    <?php foreach ($languages as $l) { ?>
                        <option value="<?php echo $l['language_id']; ?>"><?php echo $l['language_name']; ?></option>
                    <?php } ?>
                </select>

            </form>
        </div>
        <div class="col-sm-8 row g-3">
        <?php

            if (count($actionMovies) > 0) {
                foreach ($actionMovies as $index => $row) {
                    echo '<div class="card">';
                    echo '<div class="row g-3">';
                    echo '<div class="col-md-4">';
                    echo '<img src="' . htmlspecialchars($row['movie_image']) . '" class="img-fluid rounded-start" alt="' . htmlspecialchars($row['title']) . '">';
                    echo '</div>';
                    echo '<div class="col-md-8">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">'.($index+1). ". " . htmlspecialchars($row['title']) . '</h5>';
                    echo '<span>';
                    for ($i = 1; $i <= 5; $i++) {
                        if($row['avg_rating'] >= $i) {
                            echo '<i class="fa fa-star checked"></i>';
                        } else {
                            echo '<i class="fa fa-star"></i>';
                        }
                    }
                    echo '<p class="card-text truncated-text">'. $row['overview'] .'</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<div>No data found</div>";
            }
            ?>
</div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('select').change(function(){
            $('form').submit();
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

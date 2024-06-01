<?php
require 'db.php';
$query_movie = "SELECT m.movie_id, m.title, m.overview, m.movie_image,
              AVG(r.rating) AS avg_rating, GROUP_CONCAT(g.genre_name) AS genre_name
              FROM movie m
              LEFT JOIN rating r on r.movie_id = m.movie_id
              LEFT JOIN movie_genre mg on mg.movie_id = m.movie_id
              LEFT JOIN genre g on g.genre_id = mg.genre_id
              GROUP BY m.movie_id, m.title, m.overview, m.movie_image
              ORDER BY avg_rating DESC";

$query_genre = "SELECT * FROM Genre";
$query_country = "SELECT * FROM Country";
$query_language = "SELECT * FROM Language";

$stmt1 = $db->prepare($query_movie);
$stmt1->execute();
$actionMovies = $stmt1->fetchAll(PDO::FETCH_ASSOC);
if (!$actionMovies) {
    echo "Error";
}

$stmt2 = $db->prepare($query_country);
$stmt2->execute();
$countries = $stmt2->fetchAll(PDO::FETCH_ASSOC);
if (!$countries) {
    echo "Error";
}

$stmt3 = $db->prepare($query_language);
$stmt3->execute();
$languages = $stmt3->fetchAll(PDO::FETCH_ASSOC);
if (!$languages) {
    echo "Error";
}

$stmt4 = $db->prepare($query_genre);
$stmt4->execute();
$genre = $stmt4->fetchAll(PDO::FETCH_ASSOC);
if (!$genre) {
    echo "Error";
}

$whereClause = "";
if (isset($_GET['genre'])  && $_GET['genre'] != '') {
    $genre_id = $_GET['genre'];
    $whereClause .= " g.genre_id = '$genre_id'";
}
if (isset($_GET['countries'])  && $_GET['countries'] != '') {
    $countryId = $_GET['countries'];
    $whereClause .= ($whereClause == '') ? " WHERE" : " AND";
    $whereClause .= "country.countryId = '$countryId'";
}
if (isset($_GET['languages'])  && $_GET['languages'] != '') {
    $languagesId = $_GET['languages'];
    $whereClause .= ($whereClause == '') ? " WHERE" : " AND";
    $whereClause .= "language.languageId = '$languagesId'";
}

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
            <form class="d-flex me-3 w-100" role="search">
                <div class="input-group">
                    <span class="input-group-text rounded-start-pill"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search by movie name" aria-label="Search Movies">
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
<!-- Search Bar -->

<!--Category Lists-->
<div class="container py-3 my-3">
<h3>All Movies</h3>
<form class="d-flex py-3 my-3" role="search">
    <div class="input-group">
        <span class="input-group-text rounded-start-pill"><i class="fa fa-search"></i></span>
        <input type="text" class="form-control" placeholder="Search by movie name" aria-label="Search Movies">
        <span class="input-group-text rounded-end-circle"><i class="fa fa-sliders"></i></span>
    </div>
</form>
    <div class="row g-5">
        <div class="col-sm-4">
            <form id="filterForm" method="GET" action="">
                <div class="d-flex justify-content-between">
                    <h3>Filter By</h3>
                    <button class=" btn-dark btn" onclick="filter()"> Apply Filter</button>
                </div>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" disabled data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Language
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapsed" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <?php
                            if (count($genre) > 0) {
                                foreach ($genre as $row) {
                                    echo '<div class="form-check">';
                                    echo '<input class="form-check-input" type="checkbox" name="genres[]" value="'. $row['genre_id'] .'" id="flexCheckDefault">';
                                    echo '<label class="form-check-label" for="flexCheckDefault">';
                                    echo $row['genre_name'];
                                    echo '</label>';
                                    echo '</div>';
                                }
                            } else {
                                echo "<div>No data found</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed " disabled type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Country
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapsed" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <?php
                            if (count($countries) > 0) {
                                foreach ($countries as $row) {
                                echo '<div class="form-check">';
                                echo '<input class="form-check-input" type="checkbox" value="'. $row['country_id'] .'" name="countries[]" id="flexCheckDefault">';
                                echo '<label class="form-check-label" for="flexCheckDefault">';
                                echo $row['country_name'];
                                echo '</label>';
                                echo '</div>';
                                }
                            } else {
                                echo "<div>No data found</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" disabled data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Language
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapsed" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <?php
                            if (count($languages) > 0) {
                                foreach ($languages as $row) {
                                    echo '<div class="form-check">';
                                    echo '<input class="form-check-input" type="checkbox" name="languages[]" value="'. $row['language_id'] .'" id="flexCheckDefault">';
                                    echo '<label class="form-check-label" for="flexCheckDefault">';
                                    echo $row['language_name'];
                                    echo '</label>';
                                    echo '</div>';
                                }
                            } else {
                                echo "<div>No data found</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
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
<!--Footer-->
<div class="footer">
    <div class="container">
        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5">
            <div class="col mb-3">
                <a href="/" class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none">
                    <img src="./assets/Logo/FilmVault_purple2-removebg-preview.png" alt="Logo" width="100" height="78" class="bi me-2">
                </a>
                <p class="text-light">Your Ultimate Cinematic Companion. Discover, organize, and explore your favorite films with ease. Create personalized watchlists, leave insightful reviews, and connect with fellow movie enthusiasts. Dive into a world of cinema with FilmVault.</p>
                <p class="text-light">&copy; 2024 FilmVault</p>
            </div>

            <div class="col mb-3">

            </div>

            <div class="col mb-3">
                <h5>Section</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Home</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Features</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Pricing</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">About</a></li>
                </ul>
            </div>

            <div class="col mb-3">
                <h5>Section</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Home</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Features</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Pricing</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">About</a></li>
                </ul>
            </div>

            <div class="col mb-3">
                <h5>Section</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Home</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Features</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Pricing</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">About</a></li>
                </ul>
            </div>
        </footer>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

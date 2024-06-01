<?php
require 'db.php';

$query_top = "SELECT m.movie_id, m.title, m.overview, m.movie_image, AVG(r.rating) AS avg_rating
              FROM movie m
              LEFT JOIN rating r on r.movie_id = m.movie_id
              GROUP BY m.movie_id, m.title, m.overview, m.movie_image
              ORDER BY avg_rating DESC
              LIMIT 4;";
$query_action = "SELECT m.movie_id, m.title, m.overview, m.movie_image,
              AVG(r.rating) AS avg_rating, GROUP_CONCAT(g.genre_name) AS genre_name
              FROM movie m
              LEFT JOIN rating r on r.movie_id = m.movie_id
              LEFT JOIN movie_genre mg on mg.movie_id = m.movie_id
              LEFT JOIN genre g on g.genre_id = mg.genre_id
              WHERE g.genre_name = 'Action'
              GROUP BY m.movie_id, m.title, m.overview, m.movie_image
              ORDER BY avg_rating DESC
              LIMIT 4;";
$query_romance = "SELECT m.movie_id, m.title, m.overview, m.movie_image,
              AVG(r.rating) AS avg_rating, GROUP_CONCAT(g.genre_name) AS genre_name
              FROM movie m
              LEFT JOIN rating r on r.movie_id = m.movie_id
              LEFT JOIN movie_genre mg on mg.movie_id = m.movie_id
              LEFT JOIN genre g on g.genre_id = mg.genre_id
              WHERE g.genre_name = 'Romance'
              GROUP BY m.movie_id, m.title, m.overview, m.movie_image
              ORDER BY avg_rating DESC
              LIMIT 4;";
$query_comedy = "SELECT m.movie_id, m.title, m.overview, m.movie_image,
              AVG(r.rating) AS avg_rating, GROUP_CONCAT(g.genre_name) AS genre_name
              FROM movie m
              LEFT JOIN rating r on r.movie_id = m.movie_id
              LEFT JOIN movie_genre mg on mg.movie_id = m.movie_id
              LEFT JOIN genre g on g.genre_id = mg.genre_id
              WHERE g.genre_name = 'Comedy'
              GROUP BY m.movie_id, m.title, m.overview, m.movie_image
              ORDER BY avg_rating DESC
              LIMIT 4;";

$stmt = $db->prepare($query_top);
$stmt->execute();
$topMovies = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!$topMovies) {
    echo "Error";
}
$stmt1 = $db->prepare($query_action);
$stmt1->execute();
$actionMovies = $stmt1->fetchAll(PDO::FETCH_ASSOC);
if (!$actionMovies) {
    echo "Error";
}
$stmt2 = $db->prepare($query_romance);
$stmt2->execute();
$romanceMovies = $stmt2->fetchAll(PDO::FETCH_ASSOC);
if (!$romanceMovies) {
    echo "Error";
}
$stmt3 = $db->prepare($query_comedy);
$stmt3->execute();
$comedyMovies = $stmt3->fetchAll(PDO::FETCH_ASSOC);
if (!$comedyMovies) {
    echo "Error";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FilmVault</title>
    <link rel="stylesheet" href="homepage.css">
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
<!-- Carousel -->
<div id="demo" class="container carousel slide py-3 my-3" data-bs-ride="carousel">

    <!-- Indicators/dots -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    </div>

    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="ratio ratio-16x9">
                <iframe src="https://www.youtube.com/embed/LEjhY15eCx0?rel=0" title="YouTube video" allowfullscreen></iframe>
            </div>
            <div class="carousel-caption">
                <h3>Inside Out 2</h3>
                <p>Disney Pixar</p>
            </div>
        </div>
        <div class="carousel-item embed-responsive embed-responsive-16by9">
            <div class="ratio ratio-16x9">
                <iframe src="https://www.youtube.com/embed/TCwmXY_f-e0?rel=0" title="YouTube video" allowfullscreen></iframe>
            </div>
            <div class="carousel-caption">
                <h3>Lord of the Rings</h3>
                <p>Prime</p>
            </div>
        </div>
        <div class="carousel-item">
            <div class="ratio ratio-16x9">
                <iframe src="https://www.youtube.com/embed/mb2187ZQtBE?rel=0" title="YouTube video" allowfullscreen></iframe>
            </div>
            <div class="carousel-caption">
                <h3>IF</h3>
                <p>HBO</p>
            </div>
        </div>
    </div>

    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
<!--Category Lists-->
<div class="container py-3 my-3">
    <div class="row g-5">
        <div class="col-sm-6 col-md-4 col-lg-2">
            <h3>Top Movies This Week</h3>
            <p class="lead">
                Check out this week’s most popular movies and find out where to watch them.
            </p>
        </div>
        <!--Card-->
        <div class="row col-sm-6 col-md-8 col-lg-10 g-3">
        <?php
            if (count($topMovies) > 0) {
                foreach ($topMovies as $row) {
                    echo '<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">';
                    echo '<div class="card" onclick="redirectToMovieDetail(' . htmlspecialchars($row['movie_id']) . ')">';
                    echo '<img src="' . htmlspecialchars($row['movie_image']) . '" class="card-img-top" alt="' . htmlspecialchars($row['title']) . '">';
                    echo '<div class="card-body">';
                    echo '<div class="d-flex justify-content-between">';
                    echo '<span>';
                    for ($i = 1; $i <= 5; $i++) {
                        if($row['avg_rating'] >= $i) {
                            echo '<i class="fa fa-star checked"></i>';
                        } else {
                            echo '<i class="fa fa-star"></i>';
                        }
                    }
                    echo '</span>';
                    echo '<span> <i class="fa fa-heart"></i></span>';
                    echo '</div>';
                    echo '<h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>';
                    echo '<p class="card-text truncated-text">'. $row['overview'] .'</p>';
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
<!--Category romance movie Lists-->
<div class="container py-3 my-3">
    <div class="row g-5">
        <div class="col-sm-6 col-md-4 col-lg-2">
            <h3>Top Romantic Movies This Week</h3>
            <p class="lead">
                Check out this week’s most popular romantic movies and find out where to watch them.
            </p>
        </div>
        <!--Card-->
        <div class="row col-sm-6 col-md-8 col-lg-10 g-3">
        <?php
            if (count($romanceMovies) > 0) {
                foreach ($romanceMovies as $row) {
                    echo '<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">';
                    echo '<div class="card" onclick="redirectToMovieDetail(' . htmlspecialchars($row['movie_id']) . ')">';
                    echo '<img src="' . htmlspecialchars($row['movie_image']) . '" class="card-img-top" alt="' . htmlspecialchars($row['title']) . '">';
                    echo '<div class="card-body">';
                    echo '<div class="d-flex justify-content-between">';
                    echo '<span>';
                    for ($i = 1; $i <= 5; $i++) {
                        if($row['avg_rating'] >= $i) {
                            echo '<i class="fa fa-star checked"></i>';
                        } else {
                            echo '<i class="fa fa-star"></i>';
                        }
                    }
                    echo '</span>';
                    echo '<span> <i class="fa fa-heart"></i></span>';
                    echo '</div>';
                    echo '<h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>';
                    echo '<p class="card-text truncated-text">'. $row['overview'] .'</p>';
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
<!--Category action movie lists-->
<div class="container py-3 my-3">
    <div class="row g-5">
        <div class="col-sm-6 col-md-4 col-lg-2">
            <h3>Top Action Movies This Week</h3>
            <p class="lead">
                Check out this week’s most popular action movies and find out where to watch them.
            </p>
        </div>
        <!--Card-->
        <div class="row col-sm-6 col-md-8 col-lg-10 g-3">
        <?php
            if (count($actionMovies) > 0) {
                foreach ($actionMovies as $row) {
                    echo '<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">';
                    echo '<div class="card" onclick="redirectToMovieDetail(' . htmlspecialchars($row['movie_id']) . ')">';
                    echo '<img src="' . htmlspecialchars($row['movie_image']) . '" class="card-img-top" alt="' . htmlspecialchars($row['title']) . '">';
                    echo '<div class="card-body">';
                    echo '<div class="d-flex justify-content-between">';
                    echo '<span>';
                    for ($i = 1; $i <= 5; $i++) {
                        if($row['avg_rating'] >= $i) {
                            echo '<i class="fa fa-star checked"></i>';
                        } else {
                            echo '<i class="fa fa-star"></i>';
                        }
                    }
                    echo '</span>';
                    echo '<span> <i class="fa fa-heart"></i></span>';
                    echo '</div>';
                    echo '<h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>';
                    echo '<p class="card-text truncated-text">'. $row['overview'] .'</p>';
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
<!--Category comedy movie lists-->
<div class="container py-3 my-3">
    <div class="row g-5">
        <div class="col-sm-6 col-md-4 col-lg-2">
            <h3>Top Comedy Movies This Week</h3>
            <p class="lead">
                Check out this week’s most popular comedy movies and find out where to watch them.
            </p>
        </div>
        <!--Card-->
        <div class="row col-sm-6 col-md-8 col-lg-10 g-3">
        <?php
            if (count($comedyMovies) > 0) {
                foreach ($comedyMovies as $row) {
                    echo '<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">';
                    echo '<div class="card" onclick="redirectToMovieDetail(' . htmlspecialchars($row['movie_id']) . ')">';
                    echo '<img src="' . htmlspecialchars($row['movie_image']) . '" class="card-img-top" alt="' . htmlspecialchars($row['title']) . '">';
                    echo '<div class="card-body">';
                    echo '<div class="d-flex justify-content-between">';
                    echo '<span>';
                    for ($i = 1; $i <= 5; $i++) {
                        if($row['avg_rating'] >= $i) {
                            echo '<i class="fa fa-star checked"></i>';
                        } else {
                            echo '<i class="fa fa-star"></i>';
                        }
                    }
                    echo '</span>';
                    echo '<span> <i class="fa fa-heart"></i></span>';
                    echo '</div>';
                    echo '<h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>';
                    echo '<p class="card-text truncated-text">'. $row['overview'] .'</p>';
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
function redirectToMovieDetail(movie_id) {
    window.location.href = 'movie-detail.php?movie_id=' + movie_id;
}
</script>

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

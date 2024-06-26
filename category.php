<?php
require 'db.php';

$query_genre = "SELECT * FROM Genre";
$query_country = "SELECT * FROM Country";
$query_language = "SELECT * FROM Language";

$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

// Construct the main query
$query_movie = "SELECT m.movie_id, m.title, m.overview, m.movie_image,
                AVG(r.rating) AS avg_rating, GROUP_CONCAT(g.genre_name) AS genre_name
                FROM Movie m
                LEFT JOIN Rating r ON r.movie_id = m.movie_id
                LEFT JOIN Movie_Genre mg ON mg.movie_id = m.movie_id
                LEFT JOIN Genre g ON g.genre_id = mg.genre_id
                LEFT JOIN Movie_Language ml ON ml.movie_id = m.movie_id
                LEFT JOIN Language l ON l.language_id = ml.language_id
                LEFT JOIN Production_Country pc ON pc.movie_id = m.movie_id
                LEFT JOIN Country c ON c.country_id = pc.country_id";

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
    <link rel="icon" href="./assets/Logo/FilmVault_purple2-removebg-preview.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                <form class="d-flex me-3 w-100" role="search" action="" method="GET">
                    <div class="input-group">
                        <span class="input-group-text rounded-start-pill"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search by movie name" aria-label="Search Movies" name="search_query">
                        <span class="input-group-text rounded-end-circle"><a href="./category.php"><i class="fa fa-filter" style="color: #9173E5" aria-hidden="true"></i></a></span>
                    </div>
                </form>
            </div>
            <ul class="navbar-nav flex-row">
                <li class="nav-item border border-white rounded-circle mx-1 px-1">
                    <a class="nav-link text-light" href="./watchlist.php"><i class="fa fa-heart"></i></a>
                </li>

                <li class="nav-item dropdown border border-white rounded-circle mx-1 px-1">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink" style="left: 50% !important; transform: translateX(-50%) !important;">
                        <a class="dropdown-item" id="reviewedMoviesLink" href="./reviewed.php">Reviewed Movies</a>
                        <div class="dropdown-divider" id="divider"></div>
                        <a class="dropdown-item" id="loginLogoutLink" href="#"></a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

<!--Category Lists-->
<div class="container py-3 my-3">
    <div class="row g-5">
        <div class="col-sm-4">
            <form>
                <div class="d-flex justify-content-between">
                     <h5>Filter By</h5>
                    <button class="btn btn-secondary purple-button" type="submit"">Apply Filters</button>
                </div>
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
                    echo '<div class="col-md-4 py-2">';
                    echo '<img src="' . htmlspecialchars($row['movie_image']) . '" class="img-fluid rounded-start" alt="' . htmlspecialchars($row['title']) . '" onclick="redirectToMovieDetail(' . $row['movie_id'] . ')">';
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
                    echo '</span>';
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
    function redirectToMovieDetail(movie_id) {
        window.location.href = 'movie-detail.php?movie_id=' + movie_id;
    };
    document.addEventListener("DOMContentLoaded", function() {
        const loginLogoutLink = document.getElementById('loginLogoutLink');
        const reviewedMoviesLink = document.getElementById('reviewedMoviesLink');
        const divider = document.getElementById('divider');
        const userData = localStorage.getItem('userData');

        if (userData) {
            loginLogoutLink.textContent = 'Logout';
            loginLogoutLink.href = './logout.html';
            reviewedMoviesLink.href = './reviewed.php'
        } else {
            loginLogoutLink.textContent = 'Login';
            loginLogoutLink.href = './login.php';
            reviewedMoviesLink.style.display = 'none';
            divider.style.display = 'none';
        }
    });
    function removeUserData () {
        const userData = localStorage.getItem('userData');
        if (userData) {
            localStorage.removeItem('userData');
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!--Footer-->
<div class="footer">
  <div class="container">
    <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5">
      <div class="col mb-3">
        <a href="./index.php" class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none">
          <img src="./assets/Logo/FilmVault_purple2-removebg-preview.png" alt="Logo" width="100" height="78" class="bi me-2">
        </a>
        <p class="text-light">Your Ultimate Cinematic Companion. Discover, organize, and explore your favorite films with ease. Create personalized watchlists, leave insightful reviews, and connect with fellow movie enthusiasts. Dive into a world of cinema with FilmVault.</p>
        <p class="text-light">&copy; 2024 FilmVault</p>
      </div>

      <div class="col mb-3">

      </div>

      <div class="col mb-3">
        <h5>Contact</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light"><i class= "fa fa-envelope-o"></i> contact@filmvault.com</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light"><i class= "fa fa-phone"></i> 02 9999 9999</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">About Us</a></li>
        </ul>
      </div>

      <div class="col mb-3">
        <h5>Information</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Terms of Service</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Privacy Policy</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Cookie Policy</a></li>
          
        </ul>
      </div>

      <div class="col mb-3">
        <h5>Support</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Help Center</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">FAQs</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Feedback</a></li>
          
        </ul>
      </div>
    </footer>
  </div>
</div>
</body>
</html>

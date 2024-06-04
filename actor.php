<?php
include 'db.php';

// Get movie_id from query parameter
$person_id = isset($_GET['person_id']) ? intval($_GET['person_id']) : 0;

if ($person_id == 0) {
    die("Invalid person ID.");
}

try {
    // Fetch actor details
    $stmt = $db->prepare("SELECT * FROM Person WHERE person_id = :person_id");
    $stmt->execute(['person_id' => $person_id]);
    $person = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$person) {
        die("Person not found.");
    }



    // Fetch movie cast
    $stmt = $db->prepare("SELECT m.title, mc.character_name, m.movie_image, m.movie_id
                                FROM Movie m
                                INNER JOIN Movie_Cast mc ON m.movie_id = mc.movie_id
                                WHERE mc.person_id = :person_id;");
    $stmt->execute(['person_id' => $person_id]);
    $movieList = $stmt->fetchAll(PDO::FETCH_ASSOC);


} catch (PDOException $e) {
    die('Query failed: ' . $e->getMessage());
}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FilmVault</title>
        <link rel="stylesheet" href="extra.css">
        <link rel="icon" href="./assets/Logo/FilmVault_purple2-removebg-preview.png" type="image/png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <form class="d-flex me-3 w-100" role="search" action="category.php" method="GET">
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

    <!--Description-->

    <div class="container mt-3">

        <div class="row g-3">
            <div class="col-3 d-flex flex-column">
                <!--Poster-->
                <div class="my-3">
                    <img src="<?php echo htmlspecialchars($person['person_image']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($person['person_name']); ?>">
                    <h2><?php echo $person['person_name']; ?></h2>
                </div>
            </div>
            <div class="col-9">
                <h5>Description</h5>
                <p><?php echo $person['person_description']; ?></p>
                <hr class="my-4">
                <h5>Gender</h5>
                <p>
                    <?php echo  $person['gender']; ?>
                </p>
                <hr class="my-4">
                <!--User Reviews-->
                <h5>Known For </h5>
                <div class="my-3">
                    <?php
                    if (count($movieList) > 0) {
                        foreach ($movieList as $row) {
                            echo '<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">';
                            echo '<div class="card" onclick="redirectToMovieDetail(' . htmlspecialchars($row['movie_id']) . ')">';
                            echo '<img src="' . htmlspecialchars($row['movie_image']) . '" class="card-img-top" alt="' . htmlspecialchars($row['title']) . '">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>';
                            echo '<p class="card-text truncated-text">'. $row['character_name'] .'</p>';
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

    </div>

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
    </body>
    </html>
<?php

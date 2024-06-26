<?php
include 'db.php';
// Get movie_id from query parameter
$movie_id = isset($_GET['movie_id']) ? intval($_GET['movie_id']) : 0;

if ($movie_id == 0) {
    die("Invalid movie ID.");
}
$error = '';
$success = '';
try {
    // Fetch movie details
    $stmt = $db->prepare("SELECT * FROM Movie WHERE movie_id = :movie_id");
    $stmt->execute(['movie_id' => $movie_id]);
    $movie = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$movie) {
        die("Movie not found.");
    }

} catch (PDOException $e) {
    die('Query failed: ' . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FilmVault: Rating</title>
    <link rel="stylesheet" href="common.css">
    <link rel="icon" href="./assets/Logo/FilmVault_purple2-removebg-preview.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<!-- Header -->
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
                    <a class="dropdown-item" id="loginLogoutLink" href="#" onclick="removeUserData()"></a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!--Javascript function to post -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#submitBtn').click(function() {
            // Get data from input fields
            let userId = JSON.parse(localStorage.getItem('userData')).user_id;
            let rating = $('#rating').val();
            let review = $('#review').val();
            let movieId = $('#movie_id').val();
            // Send data to server using AJAX
            $.ajax({
                type: 'POST',
                url: 'addRating.php',
                data: {
                    user_id: userId,
                    rating: rating,
                    review: review,
                    movie_id: movieId,
                },
                success: function(response) {
                    // Handle response
                    console.log("success data", response);
                    if (response) {
                        alert(response);
                        window.location.href = 'movie-detail.php?movie_id='+ movieId;
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr, status, error);
                }
            });

        });
    });
</script>
<!-- Rate -->
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center">
        <div class="col-md-4">
            <img src="<?php echo htmlspecialchars($movie['movie_image']); ?>" class="img-fluid rounded-start" alt="<?php echo $movie['title']; ?>">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="display-4 fw-bold lh-1 mb-3">Review <?php echo $movie['title']; ?> </h5>

                <div class="p-4 p-md-5 rounded-0">
                    <input type="hidden" id="movie_id"  value="<?php echo $movie['movie_id']; ?>">
                <div class="card-text mb-3">
                    <label>Rating</label>
                    <select class="form-select" aria-label=" select rating" id="rating" required>
                        <option selected disabled>Select a rating</option>
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                </div>
                <div class="card-text mb-3">
                    <label for="review" class="form-label">Review</label>
                    <textarea class="form-control" id="review"  placeholder="Write your review" rows="10"></textarea>
                </div>
                <button class="w-100 btn btn-lg btn-secondary purple-button" id="submitBtn">Submit</button>
            </div>
            </div>
        </div>
    </div>
</div>
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
</body>
</html>

<?php
require 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $db->prepare('SELECT * FROM Users WHERE user_email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['user_pwd'])) {
        $userData = json_encode([
            'user_id' => $user['user_id'],
            'username' => $user['username']
        ]);

        // Set user data in localStorage using JavaScript
        echo "<script>";
        echo "localStorage.setItem('userData', '$userData');";
        echo "window.location.href = 'index.php';";
        echo "</script>";
    } else {
        $error = "Invalid email or password.";
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FilmVault: Login</title>
  <link rel="icon" href="./assets/Logo/FilmVault_purple2-removebg-preview.png" type="image/png">
  <link rel="stylesheet" href="common.css">
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

<!-- Login -->
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
  <div class="row align-items-center g-lg-5 py-5">
    <div class="col-lg-7 text-center text-lg-start">
      <h1 class="display-4 fw-bold lh-1 mb-3">Login</h1>
      <p class="col-lg-10 fs-4">Log in to FilmVault to enjoy creating your favorites list, write and share reviews, and engage with our vibrant community of film enthusiasts. Join us now for an enhanced movie-watching experience!!</p>
    </div>
    <div class="col-md-10 mx-auto col-lg-5">
      <form method="POST" class="p-4 p-md-5 login-card shadow">
          <?php if($error): ?>
          <div class="error-msg">
              <span>
                 <?php echo $error ?>
              </span>
          </div>
          <?php endif; ?>
        <div class="mb-3">
          <label for="floatingEmail">Email address</label>
          <input type="email" class="form-control" id="floatingEmail" name="email" placeholder="name@example.com" required>
        </div>
        <div class="mb-3">
          <label for="floatingPassword">Password</label>
          <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
        </div>
        <button class="w-100 btn btn-lg purple-button" type="submit">Login</button>
        <hr class="my-4">
        <p class="fw-light">Don't have an account? <a href="signup.php">Sign Up here</a></p>
      </form>
    </div>
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

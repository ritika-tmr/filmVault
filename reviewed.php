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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
$(document).ready(function() {
    if (localStorage.getItem('userData')) {
        let userId = JSON.parse(localStorage.getItem('userData')).user_id;
                $.ajax({
                    type: 'POST',
                    url: 'get_reviews.php',
                    data: { user_id: userId },
                    success: function(response) {
            let reviwed = JSON.parse(response);
                        // Handle the response to display favorite movies
                        console.log(reviwed);
                        renderMovies(reviwed)
                    },
                    error: function(xhr, status, error) {
            console.error(xhr, status, error);
        }
                });
            } else {
        window.location.href = 'login.php';
    }

});
        function renderMovies(movies) {
            const container = document.getElementById('fav-list');
            container.innerHTML = '';

            if (movies.length > 0 && movies[0].title) {
                movies.forEach((movie, index) => {
                    const card = document.createElement('div');
                    card.className = 'card';

                    const row = document.createElement('div');
                    row.className = 'row g-3';

                    const colImage = document.createElement('div');
                    colImage.className = 'col-md-4 py-2';
                    colImage.addEventListener('click', function () {
                        window.location.href = 'movie-detail.php?movie_id=' + movie.movie_id;
                    });

                    const img = document.createElement('img');
                    img.src = movie.movie_image;
                    img.className = 'img-fluid rounded-start';
                    img.alt = movie.title;

                    colImage.appendChild(img);

                    const colContent = document.createElement('div');
                    colContent.className = 'col-md-8';

                    const cardBody = document.createElement('div');
                    cardBody.className = 'card-body';

                    const title = document.createElement('h5');
                    title.className = 'card-title';
                    title.textContent = `${index + 1}. ${movie.title}`;

                    const starSpan = document.createElement('span');
                    for (let i = 1; i <= 5; i++) {
                        const star = document.createElement('i');
                        star.className = 'fa fa-star';
                        if (movie.rating >= i) {
                            star.classList.add('checked');
                        }
                        starSpan.appendChild(star);
                    }

                    const overview = document.createElement('p');
                    overview.className = 'card-text truncated-text';
                    overview.textContent = movie.review;

                    cardBody.appendChild(title);
                    cardBody.appendChild(starSpan);
                    cardBody.appendChild(overview);

                    colContent.appendChild(cardBody);
                    row.appendChild(colImage);
                    row.appendChild(colContent);
                    card.appendChild(row);
                    container.appendChild(card);
                });
            } else {
                container.innerHTML = '<div>No data found</div>';
            }
        }
    </script>
    </script>
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
                    <a class="dropdown-item" id="loginLogoutLink" href="#" onclick="removeUserData()"></a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!--Category Lists-->
<div class="container py-3 my-3">
    <h2>Your Reviewed List</h2>
    <div class="row g-3" id="fav-list">
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

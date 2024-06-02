<?php
include 'db.php';

// Get movie_id from query parameter
$movie_id = isset($_GET['movie_id']) ? intval($_GET['movie_id']) : 0;

if ($movie_id == 0) {
    die("Invalid movie ID.");
}

try {
    // Fetch movie details
    $stmt = $db->prepare("SELECT * FROM Movie WHERE movie_id = :movie_id");
    $stmt->execute(['movie_id' => $movie_id]);
    $movie = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$movie) {
        die("Movie not found.");
    }

    // Fetch genres
    $stmt = $db->prepare("SELECT g.genre_name FROM Genre g
                          JOIN Movie_Genre mg ON g.genre_id = mg.genre_id
                          WHERE mg.movie_id = :movie_id");
    $stmt->execute(['movie_id' => $movie_id]);
    $genres = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Fetch languages
    $stmt = $db->prepare("SELECT l.language_name FROM Language l
                          JOIN Movie_Language ml ON l.language_id = ml.language_id
                          WHERE ml.movie_id = :movie_id");
    $stmt->execute(['movie_id' => $movie_id]);
    $languages = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Fetch directors
    $stmt = $db->prepare("SELECT d.director_name FROM Director d
                          JOIN Movie_Director md ON d.director_id = md.director_id
                          WHERE md.movie_id = :movie_id");
    $stmt->execute(['movie_id' => $movie_id]);
    $directors = $stmt->fetchAll(PDO::FETCH_COLUMN);

     // Fetch cast
     $stmt = $db->prepare("SELECT p.person_name, mc.character_name, p.person_id FROM Person p
     JOIN Movie_Cast mc ON p.person_id = mc.person_id
     WHERE mc.movie_id = :movie_id");
    $stmt->execute(['movie_id' => $movie_id]);
    $cast = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch production countries
    $stmt = $db->prepare("SELECT c.country_name FROM Country c
                          JOIN Production_Country pc ON c.country_id = pc.country_id
                          WHERE pc.movie_id = :movie_id");
    $stmt->execute(['movie_id' => $movie_id]);
    $countries = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Fetch Average ratings
    $stmt = $db->prepare("SELECT AVG(rating) AS avg_rating FROM Rating WHERE movie_id = :movie_id");
    $stmt->execute(['movie_id' => $movie_id]);
    // Fetch the average rating from the result set
    $ratingRow = $stmt->fetch(PDO::FETCH_ASSOC);

    //Fetch trailer
    $stmt = $db->prepare("SELECT trailer FROM Movie WHERE movie_id = :movie_id");
    $stmt->execute(['movie_id' => $movie_id]);
    $trailerRow = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch All ratings
    $stmt = $db->prepare("SELECT rating, review, rating_date, u.username 
                        FROM Rating r 
                        INNER JOIN users u ON u.user_id = r.user_id 
                        WHERE movie_id = :movie_id");
    $stmt->execute(['movie_id' => $movie_id]);
    $allRating = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<!--Header-->
<nav class="navbar navbar-expand-lg header">
  <div class="container">
    <a class="navbar-brand" href="./index.php">
      <img src="./assets/Logo/FilmVaultNew-removebg-preview.png" alt="Logo" width="70" height="55" class="d-inline-block align-text-top">
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
      <li class="nav-item border-purple rounded-circle mx-1 px-1">
        <a class="nav-link text-light" href="/index.html"><i class="fa fa-heart"></i></a>
      </li>
      <li class="nav-item border-purple rounded-circle mx-1 px-1">
        <a class="nav-link text-light" href="/index.html"><i class="fa fa-bell"></i></a>
      </li>
      <li class="nav-item border-purple rounded-circle mx-1 px-1">
        <a class="nav-link text-light" href="/index.html"><i class="fa fa-user"></i></a>
      </li>
    </ul>
  </div>
</nav>

<!--Title-->
<div class="container my-3">
    <h2><?php echo $movie['title']; ?></h2>
    <div class="d-flex justify-content-between">
        <div>
            <span><?php echo $movie['release_date']; ?> ‧
            </span><span><?php echo implode(', ', $genres); ?> ‧
            </span><span><?php echo $movie['runtime']; ?></span>
        </div>
        <div>
            <span>
              <?php
              for ($i = 1; $i <= 5; $i++) {
                  if($ratingRow && $ratingRow['avg_rating']>= $i) {
                      echo '<i class="fa fa-star checked"></i>';
                  } else {
                      echo '<i class="fa fa-star"></i>';
                  }
              }
              ?>
            </span>
        </div>
    </div>

</div>
<!-- Check if a trailer link is found -->
<div class="container">
    <div class="ratio ratio-16x9">
        <?php
        // Check if a trailer link is found
        if ($trailerRow) {
            // Access the trailer link
            $trailerLink = $trailerRow['trailer'];

            // Embed the trailer link in an iframe
            echo '<iframe src="' . $trailerLink . '" title="YouTube video" allowfullscreen></iframe>';
        } else {
            // If no trailer link is found, display a message
            echo '<p>No trailer available for this movie.</p>';
        }
        ?>
    </div>
</div>

<!--Description-->

<div class="container mt-3">

    <div class="row g-3">
        <div class="col-3 d-flex flex-column">
            <!--Poster-->
            <div class="my-3">
                <img src="<?php echo htmlspecialchars($movie['movie_image']); ?>" class="img-fluid" alt="Movie Image">
            </div>
            <div class="d-grid gap-2" style="max-width: 14rem">
                <button class="btn btn-secondary purple-button" onclick="addToWatchlist('<?php echo $movie['movie_id'] ?> '); ">Add To WatchList <i class="fa fa-heart"></i></button>
                <button class="btn btn-secondary yellow-button" onclick="redirectToRating('<?php echo $movie['movie_id'] ?> '); ">Rate this Movie <i class="fa fa-star"></i></button>
            </div>
        </div>
        <div class="col-9">
            <h5>Description</h5>
            <p><?php echo $movie['overview']; ?></p>
            <hr class="my-4">
            <h5>Director</h5>
            <p>
                <?php echo implode(', ', $directors); ?>
            </p>
            <hr class="my-4">
            <h5>Top Cast</h5>
            <p>
                <?php foreach ($cast as $member): ?>
                    <u class="person-name"  onclick="redirectToActorDetail(<?php echo $member['person_id']  ?>)"><?php echo $member['person_name']  ?></u>
                    <span> as <?php echo $member['character_name'] ;  ?></span>
                    <span class="dot"></span>
                <?php endforeach; ?>

            </p>
            <hr class="my-4">
            <h5>Language</h5>
            <p><?php echo implode(', ', $languages); ?>
            </p>
            <hr class="my-4">
            <h5>Country</h5>
            <p><?php echo implode(', ', $countries); ?></p>
            <hr class="my-4">
<!--User Reviews-->
            <h5>User Reviews </h5>
            <div class="review-list p-3">
                <?php
                if (count($allRating) > 0) {
                    foreach ($allRating as $row) {
                        echo '<div class="review-card p-3 my-3">';
                        echo ' <div class="d-flex justify-content-between">';
                        echo '<h6>' . $row['username'] . '</h6> ';
                        echo ' <div class="d-flex flex-column">';
                        echo ' <span>';
                        echo '<span>' . $row['rating'] . ' - </span> ';
                        for ($i = 1; $i <= 5; $i++) {
                            if ($row >= $i) {
                                echo '<i class="fa fa-star checked"></i>';
                            } else {
                                echo '<i class="fa fa-star"></i>';
                            }
                        };
                        echo '</span>';
                        echo ' <small>'. date("jS F Y", strtotime($row['rating_date'])) .'</small>';
                        echo '</div> ';
                        echo ' </div>';;
                        echo ' <p class="lead">';
                        echo $row['review'];
                        echo ' </p>';
                        echo '</div>';
                    }
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
<script>
    function redirectToRating(movie_id) {
        if (localStorage.getItem('userData')) {
            window.location.href = 'rating.php?movie_id=' + movie_id;
        } else {
            window.location.href = 'login.php';
        }
    }
    function redirectToActorDetail(person_id) {
        window.location.href = 'actor.php?person_id=' + person_id;
    }
    function addToWatchlist(movie_id) {
        if (localStorage.getItem('userData')) {
            let userId = JSON.parse(localStorage.getItem('userData')).user_id;
            $.ajax({
                type: 'POST',
                url: 'addToWatchlist.php',
                data: {
                    user_id: userId,
                    movie_id: movie_id
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
        } else {
            window.location.href = 'login.php';
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

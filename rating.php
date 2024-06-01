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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    if ($rating && $review) {

        try {
            $stmt = $db->prepare('INSERT INTO Rating (movie_id,rating, review) VALUES (?, ?, ?)');
            if ($stmt -> execute([$movie_id, $rating, $review])){
                $success = "<script>alert('Rating successful!'); window.location = 'index.php';</script>";
            } else {
                $error = 'Error: Could add review.';
            }
        } catch (Exception $e) {
            $error = 'Error Uploading' . $e->getMessage();
        }
    } else {
        $error = "Invalid Rating or Review";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FilmVault: Rating</title>
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<!-- Header -->
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

<!-- Rate -->
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center">
        <div class="col-md-4">
            <img src="<?php echo htmlspecialchars($movie['movie_image']); ?>" class="img-fluid rounded-start" alt="<?php echo $movie['title']; ?>">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="display-4 fw-bold lh-1 mb-3">Review <?php echo $movie['title']; ?> </h5>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($success)): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>
                <form method="POST" class="p-4 p-md-5 rounded-0">
                <div class="card-text mb-3">
                    <label>Rating</label>
                    <select class="form-select" aria-label=" select rating" name="rating" required>
                        <option selected disabled>Select a rating</option>
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>

                </div>
                <div class="card-text mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Review</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" required name="review" placeholder="Write your review" rows="10"></textarea>
                </div>
                <button class="w-100 btn btn-lg btn-secondary purple-button" type="submit">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>
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
</body>
</html>

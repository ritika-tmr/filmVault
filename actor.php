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
    $stmt = $db->prepare("SELECT m.title, mc.character_name, m.movie_image
                                FROM movie m
                                INNER JOIN movie_cast mc ON m.movie_id = mc.movie_id
                                WHERE mc.person_id = :person_id;");
    $stmt->execute(['person_id' => $person_id]);
    $cast = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
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

    <!--Description-->

    <div class="container mt-3">

        <div class="row g-3">
            <div class="col-3 d-flex flex-column">
                <!--Poster-->
                <div class="my-3">
                    <img src="<?php echo htmlspecialchars($person['person_image']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($person['person_name']); ?>">
                </div>
            </div>
            <div class="col-9">
                <h5>Description</h5>
                <p><?php echo $person['person_description']; ?></p>
                <hr class="my-4">
                <h5>Gender</h5>
                <p>
                    <?php echo implode(', ', $person['gender']); ?>
                </p>
                <hr class="my-4">
                <!--User Reviews-->
                <h5>User Reviews </h5>
                <div class="review-list p-3">
<!--                    --><?php
//                    if (count($allRating) > 0) {
//                        foreach ($allRating as $row) {
//                            echo '<div class="review-card p-3 my-3">';
//                            echo ' <div class="d-flex justify-content-between">';
//                            echo '<h6>' . $row['username'] . '</h6> ';
//                            echo ' <div class="d-flex flex-column">';
//                            echo ' <span>';
//                            echo '<span>' . $row['rating'] . ' - </span> ';
//                            for ($i = 1; $i <= 5; $i++) {
//                                if ($row >= $i) {
//                                    echo '<i class="fa fa-star checked"></i>';
//                                } else {
//                                    echo '<i class="fa fa-star"></i>';
//                                }
//                            };
//                            echo '</span>';
//                            echo ' <small>'. date("jS F Y", strtotime($row['rating_date'])) .'</small>';
//                            echo '</div> ';
//                            echo ' </div>';;
//                            echo ' <p class="lead">';
//                            echo $row['review'];
//                            echo ' </p>';
//                            echo '</div>';
//                        }
//                    }
//                    ?>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
    </html>
<?php
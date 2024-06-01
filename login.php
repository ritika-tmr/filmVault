<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $db->prepare('SELECT * FROM Users WHERE user_email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['user_pwd'])) {
        // Start the session (if not already started)
        session_start();
    
        // Store user data in session for later use
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
    
        // Redirect the user to index.html
        header("Location: index.html");
        exit(); // Make sure to exit to prevent further execution
    } else {
        echo "Invalid email or password.";
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FilmVault: Login</title>
  <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<!-- Header -->
<nav class="navbar navbar-expand-lg header">
  <div class="container">
    <a class="navbar-brand" href="./index.php">
      <img src="./assets/Logo/FilmVault_purple-removebg-preview.png" alt="Logo" width="70" height="55" class="d-inline-block align-text-top">
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
      <ul class="navbar-nav">
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
  </div>
</nav>

<!-- Login -->
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
  <div class="row align-items-center g-lg-5 py-5">
    <div class="col-lg-7 text-center text-lg-start">
      <h1 class="display-4 fw-bold lh-1 mb-3">Login to FilmVault</h1>
      <p class="col-lg-10 fs-4">Access your account and explore the world of cinema!</p>
    </div>
    <div class="col-md-10 mx-auto col-lg-5">
      <form method="POST" class="p-4 p-md-5 login-card shadow">
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
</body>
</html>

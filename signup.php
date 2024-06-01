<?php
require 'db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Simple validation
    if (empty($username) || empty($email) || empty($password)) {
        $error = 'Please fill all fields.';
    } else {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        // Check if email already exists
        $stmt = $db->prepare('SELECT * FROM Users WHERE user_email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = 'Email already exists.';
        } else {
            // Insert new user
            try {
                $stmt = $db->prepare('INSERT INTO Users (username, user_email, user_pwd) VALUES (?, ?, ?)');
                if ($stmt->execute([$username, $email, $passwordHash])) {
                    $userId = $db->lastInsertId();
                    $success = "<script>alert('Signup successful! You can now login.'); window.location = 'login.php';</script>";
                } else {
                    $error = 'Error: Could not sign up.';
                }
            } catch (Exception $e) {
                $error = 'Error: ' . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FilmVault: Sign Up</title>
  <link rel="stylesheet" href="main.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<!-- Header -->
<nav class="navbar navbar-expand-lg header">
  <div class="container">
    <a class="navbar-brand" href="./index.html">
      <img src="./assets/Logo/FilmVault_purple-removebg-preview.png" alt="Logo" width="70" height="55" class="d-inline-block align-text-top">
    </a>
    <!-- Other nav elements -->
  </div>
</nav>

<!-- Sign Up -->
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
  <div class="row align-items-center g-lg-5 py-5">
    <div class="col-lg-7 text-center text-lg-start">
      <h1 class="display-4 fw-bold lh-1 mb-3">Sign Up for FilmVault</h1>
      <p class="col-lg-10 fs-4">Join us and explore the world of cinema!</p>
    </div>
    <div class="col-md-10 mx-auto col-lg-5">
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
      <form method="POST" class="p-4 p-md-5 login-card shadow rounded-0">
        <div class="form-floating mb-3">
          <input type="text" class="form-control rounded-0" id="floatingUsername" name="username" placeholder="Username" required>
          <label for="floatingUsername">Username</label>
        </div>
        <div class="form-floating mb-3">
          <input type="email" class="form-control rounded-0" id="floatingEmail" name="email" placeholder="name@example.com" required>
          <label for="floatingEmail">Email address</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control rounded-0" id="floatingPassword" name="password" placeholder="Password" required>
          <label for="floatingPassword">Password</label>
        </div>
        <button class="w-100 btn btn-lg rounded-0" type="submit">Sign Up</button>
        <hr class="my-4">
        <p class="fw-light">Already have an account? <a href="login.html">Login here</a></p>
      </form>
    </div>
  </div>
</div>
<!-- Add this div at the end of your body -->
<div id="signupSuccessPopup" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Success!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Signup successful! You can now <a href="login.php">login</a>.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>

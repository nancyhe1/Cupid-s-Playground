<?php
session_start(); // Start the session to store data

// Include MongoDB client setup
require_once __DIR__ . '/vendor/autoload.php';
use MongoDB\Client;

try {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    
    // MongoDB connection
    $client = new Client(
        "mongodb+srv://" . $_ENV['USER_MONGO'] . ":" . $_ENV['PASSWORD_MONGO'] . "@cart351.9sl6w.mongodb.net/?retryWrites=true&w=majority&appName=CART351"
    );
    $collection = $client->CART351->cupidLogin;
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and save to session
    $fName = $_POST['fName'] ?? '';
    $lName = $_POST['lName'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Store registration data in session
    $_SESSION['fName'] = $fName;
    $_SESSION['lName'] = $lName;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;

    // Hash the password before storing
    $_SESSION['hashedPassword'] = password_hash($password, PASSWORD_DEFAULT);

    // Redirect to details page
    header("Location: details.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cupid Playground</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container" id="signup">
    <div class="logo-container">
      <img src="images/cupidLogo.png" alt="Cupid Playground Logo" class="logo">
    </div>
    <h1 class="form-title">Welcome!</h1>
    <form method="post" action="">
      <div class="input-group">
         <i class="fas fa-user"></i>
         <input type="text" name="fName" id="fName" placeholder="First Name" required>
         <label for="fname">First Name</label>
      </div>
      <div class="input-group">
          <i class="fas fa-user"></i>
          <input type="text" name="lName" id="lName" placeholder="Last Name" required>
          <label for="lName">Last Name</label>
      </div>
      <div class="input-group">
          <i class="fas fa-envelope"></i>
          <input type="email" name="email" id="email" placeholder="Email" required>
          <label for="email">Email</label>
      </div>
      <div class="input-group">
        <i class="fas fa-phone"></i>
        <select name="dummyPhoneNumber" id="dummyPhoneNumber" required>
          <option value="" disabled selected>Select a Phone Number</option>
          <option value="123-456-7890">123-456-7890</option>
          <option value="800-555-0199">800-555-0199</option>
        </select>
        <label for="dummyPhoneNumber">Phone Number</label>
      </div>
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <label for="password">Password</label>
    </div>
   <input type="submit" class="btn" value="Sign Up & Continue" name="signUp">
  </form>

  <script>
  document.getElementById("fName").addEventListener("input", function () {
    this.value = this.value.replace(/\b\w/g, function (char) {
      return char.toUpperCase();
    });
  });

  document.getElementById("lName").addEventListener("input", function () {
    this.value = this.value.replace(/\b\w/g, function (char) {
      return char.toUpperCase();
    });
  });
</script>

</body>

</html>

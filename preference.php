<?php
// Start session to access the data from register.php and details.php
session_start();

// Include MongoDB client
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
        // Retrieve the data from previous pages (session data)
        $fName = $_SESSION['fName'];
        $lName = $_SESSION['lName'];
        $email = $_SESSION['email'];
        $occupation = $_SESSION['occupation'];  // Make sure these are set in session
        $interests = $_SESSION['interests'];
        $age = $_SESSION['age'];

        // Get relationship preferences
        $lookingFor = $_POST['lookingFor'];
        $attractedTo = $_POST['attractedTo'];

        // Create the document to insert into the database
        $document = [
            'fName' => $fName,
            'lName' => $lName,
            'email' => $email,
            'occupation' => $occupation,
            'interests' => $interests,
            'age' => $age,
            'lookingFor' => $lookingFor,
            'attractedTo' => $attractedTo,
        ];

        // Insert into the MongoDB collection
        $collection->insertOne($document);

        // Redirect to a final page (e.g., dashboard.html)
        header("Location: dashboard.html");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Relationship Preferences</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1 class="form-title">Tell Us More About Your Preferences</h1>
    <form method="post" action="preferences.php">
      <!-- What are you looking for? -->
      <div class="input-group">
        <i class="fas fa-heartbeat"></i>
        <select name="lookingFor" id="lookingFor" required>
          <option value="" disabled selected>What are you looking for?</option>
          <option value="casual">Casual</option>
          <option value="serious">Serious</option>
        </select>
        <label for="lookingFor">What are you looking for?</label>
      </div>

      <!-- Who are you attracted to? -->
      <div class="input-group">
        <i class="fas fa-genderless"></i> 
        <select name="attractedTo" id="attractedTo" required>
          <option value="" disabled selected>Who are you attracted to?</option>
          <option value="female">Female</option>
          <option value="male">Male</option>
          <option value="both">Both</option>
          <option value="doesntCare">Doesn't care</option>
        </select>
        <label for="attractedTo">Who are you attracted to?</label>
      </div>

      <input type="submit" class="btn" value="Next" name="submitPreferences">
    </form>
  </div>
</body>
</html>

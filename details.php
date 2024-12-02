<?php
session_start(); // Start session to access previous data

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
    // Retrieve the registration data from session
    $fName = $_SESSION['fName'];
    $lName = $_SESSION['lName'];
    $email = $_SESSION['email'];
    $password = $_SESSION['hashedPassword'];

    // Get additional details from the form
    $occupation = $_POST['occupation'];
    $interests = $_POST['interests']; // an array of selected interests
    $age = $_POST['age'];
    $gender = $_POST['gender']; // Get the selected gender

    // Combine all the data into one document
    $document = [
        'fName' => $fName,
        'lName' => $lName,
        'email' => $email,
        'password' => $password, // Store the hashed password
        'occupation' => $occupation,
        'interests' => $interests, // Store interests as an array
        'age' => $age,
        'gender' => $gender, // Save the gender
    ];

    // Insert the document into MongoDB
    try {
        $collection->insertOne($document);
        echo "Details saved successfully!";
        header("Location: preference.php"); // Redirect to the dashboard or another page
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Additional Details</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1 class="form-title">Tell Us More</h1>
    <form method="post" action="details.php">
      <div class="input-group">
        <i class="fas fa-briefcase"></i>
        <input type="text" name="occupation" id="occupation" placeholder="Occupation" required>
        <label for="occupation">Occupation</label>
      </div>
      <div class="input-group">
  <label for="interests">Select Your Interests</label>
  <div class="checkbox-grid">
    <label><input type="checkbox" name="interests[]" value="music"> Music</label>
    <label><input type="checkbox" name="interests[]" value="sports"> Sports</label>
    <label><input type="checkbox" name="interests[]" value="travel"> Travel</label>
    <label><input type="checkbox" name="interests[]" value="movies"> Movies</label>
    <label><input type="checkbox" name="interests[]" value="books"> Books</label>
    <label><input type="checkbox" name="interests[]" value="photography"> Photography</label>
    <label><input type="checkbox" name="interests[]" value="gaming"> Gaming</label>
    <label><input type="checkbox" name="interests[]" value="cooking"> Cooking</label>
    <label><input type="checkbox" name="interests[]" value="art"> Art</label>
  </div>
</div>

      <div class="input-group">
        <i class="fas fa-calendar"></i>
        <input type="number" name="age" id="age" placeholder="Age" min="18" required>
        <label for="age">Age</label>
      </div>
      <div class="input-group">
        <i class="fas fa-venus-mars"></i>
        
        <select name="gender" id="gender" required>
          <option value="" disabled selected>Select your gender</option>
          <option value="female">Female</option>
          <option value="male">Male</option>
          <option value="non-binary">Non-binary</option>
          <option value="other">Other</option>
          <option value="prefer not to say">Prefer not to say</option>
        </select>
        <label for="gender">Gender</label>
      </div>
      <input type="submit" class="btn" value="Next" name="submitDetails">
    </form>
  </div>
</body>
</html>

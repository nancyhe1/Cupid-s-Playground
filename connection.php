<?php
// include the composer library
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

//put into try catch clause
try {
//invisible file, wont be uploaded to github - anything with 
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

//echo($_ENV['USER_MONGO']); like so the password and the username are invisible
 
    //1: connect to mongodb atlas
    $client = 
    new MongoDB\Client(
        uri:"mongodb+srv://".$_ENV['USER_MONGO'].":".$_ENV['PASSWORD_MONGO']."@cart351.9sl6w.mongodb.net/?retryWrites=true&w=majority&appName=CART351"
     
    );
    echo("valid connection");
    echo("<br>");
     
    //2: connect to collection (that exists):
    $collection = $client->CART351->cupidLogin;
}
catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
    ?>
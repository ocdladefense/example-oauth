<?php

define("BASE_PATH", __DIR__);

require BASE_PATH . "/vendor/autoload.php";
require BASE_PATH . "/src/webserver.php";
//require BASE_PATH . "/src/userpass.php";
include BASE_PATH . "/config/config.php";


// Testing the webserver flow authorization flow.

requireAuth();

?>

<h1>Protected Content</h1>
<?php var_dump($_SESSION); ?>
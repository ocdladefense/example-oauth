<?php

define("BASE_PATH", __DIR__);

require "src/webserver.php";


// Testing the webserver flow authorization flow.

requireAuth();

?>

<h1>Protected Content</h1>
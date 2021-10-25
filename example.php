<?php

define("BASE_PATH", __DIR__);

require BASE_PATH . "/src/functions.php";


requireAuth();

?>

<h1>Protected Content</h1>
<?php var_dump($_SESSION); ?>
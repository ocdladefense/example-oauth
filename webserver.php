<?php

define("BASE_PATH", __DIR__);

require __DIR__ . "/src/functions.php";


use Salesforce\OAuthConfig;


if(identityProviderCredentialsAccepted()){

    $_SESSION["authorized"] = true;

    session_write_close();

    header("Location: " . $_SESSION["redirect"]);
}

<?php

session_start();

require "../vendor/autoload.php";
include "../config/config.php";

use Salesforce\OAuthConfig;
use Salesforce\OAuth;
use Salesforce\OAuthRequest;


if(isDoingWebserverFlow()){

    $_SESSION["authorized"] = True;

    $config = new OAuthConfig($oauth_config);
    $array = getAccessToken($config);

    session_write_close();

    header("Location: " . $_SESSION["redirect"]);
}


function requireAuth($name = "default"){

    global $oauth_config;
    // You would have to get a config of type "OAuthConfig".
    $config = new OAuthConfig($oauth_config);

    $flow = "webserver";

    $_SESSION["redirect"] = $_SERVER["PHP_SELF"];

    session_write_close();

    if(!userIsAuthorized()){

        redirectToLogin($config, $flow);
    
    }
}


// Normally we determine whether the user has logged in by checking the session.
function isDoingWebserverFlow(){

    return !empty($_GET["code"]);
}

function userIsAuthorized(){

    return $_SESSION["authorized"] == True;
}


function redirectToLogin($config, $flow) {

    // If we have a webserver flow we are going to send a redirect response to the user's web browser.  The web browser redirects the user makes a request to the salesforce login page. This causes the user to be redirected to the login page.
    $response = OAuth::newOAuthResponse($config, $flow);

    // Get the url from the location header in the response
    $url = $response->getHeader("Location")->getValue();

    // Redirect to the salesforce login page.
    header("Location: $url");
}

function getAccessToken($config) {

    // User enters username and password then salesforce redirects the user to the endpoint specified in the "redirect_uri" 


    // The request comes from salesforce.  We extract the authorization code and the state from the request.
    $info = json_decode($_GET["state"], true);
    $connectedApp = $info["connected_app_name"];
    $flow = $info["flow"];

    // Set the authorization code using the value in $_GET super
    $config->setAuthorizationCode($_GET["code"]);

    // Build the request and send the authorization code returned in the previous step.
    $oauth = OAuthRequest::newAccessTokenRequest($config, "webserver");

    // Send the request
    $resp = $oauth->authorize();

    // The response contains the access token and instance url.
    $token = $resp->getAccessToken();
    $url = $resp->getInstanceUrl();

    return array("instance_url" => $url, "access_token" => $token);
}
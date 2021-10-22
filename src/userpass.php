<?php

define("BASE_PATH", __DIR__);

require BASE_PATH . "vendor/autoload.php";
include BASE_PATH . "config/config.php";

use Salesforce\OAuthConfig;
use Salesforce\OAuth;
use Salesforce\OAuthRequest;



// You would have to get a config of type "OAuthConfig".
$config = new OAuthConfig($oauth_config);

// Provide a flow ("usernamepassword" or "webserver")

$flow = "usernamepassword";

// If we have a usernamepassword flow we are going to make a request for an access token from salesforce.
$request = OAuthRequest::newAccessTokenRequest($config, $flow);


// If oauth start returns a request object, call "authorize" on the object which returns a oauth response with the access token and instance url.
$oauthResp = $request->authorize();

if(!$oauthResp->isSuccess()) throw new OAuthException($oauthResp->getErrorMessage());

// Set the session with the values in the response.
$name = $config->getName();
$url = $oauthResp->getInstanceUrl();
$token = $oauthResp->getAccessToken();

var_dump($name, $url, $token); exit;
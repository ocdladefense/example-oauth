<?php

$oauth_config = array(
    "name"    => "",
    "default" => true,
    "sandbox" => true, // Might be used to determine domain for urls
    "client_id" => "",
    "client_secret" => "",
    "auth" => array(
        "saml" => array(),
        "oauth" => array(
            "usernamepassword" => array(
                "token_url" => "https://test.salesforce.com/services/oauth2/token",
                "username" => "",
                "password" => "",
                "security_token" => ""
            ),
            "webserver" => array(
                "token_url" => "",
                "auth_url" => "",
                "redirect_url" => "",
                "callback_url" => ""
            )
        )
    )
);

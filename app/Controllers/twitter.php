<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('444339106683-9n10h1ec88b2hmq5s1mqqct0n7uuvc05.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('ousXzZJ9hF0NmR3CSVT1O6c6');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost:8080/home');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
session_start();
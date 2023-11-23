<?php
  require_once 'vendor/autoload.php';

  $clientID = '1072094765286-on62jmncc8gnlbaeol444ffcclfe0rkq.apps.googleusercontent.com';
  $clientSecret = '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';
  $redirectUri = "https://" . $_SERVER['HTTP_HOST'] . "/html/index.php";

  // create Client Request to access Google API
  $client = new Google_Client();
  $client->setClientId($clientID);
  $client->setClientSecret($clientSecret);
  $client->setRedirectUri($redirectUri);
  $client->addScope("email");
  $client->addScope("profile");

 
?>
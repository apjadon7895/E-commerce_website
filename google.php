<?php
require_once 'vendor/autoload.php';

// init configuration
$clientID = getenv('693198646996-e1c1e69k9p7hpod4ibqlbrmja0p3tgd6.apps.googleusercontent.com');
$clientSecret = getenv('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');
$redirectUri = 'https://astrictechnology.tech/index.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (isset($token['error'])) {
        $showError = 'Error fetching token: ' . $token['error'];
    } else {
        $client->setAccessToken($token['access_token']);
        $oauth2 = new Google_Service_Oauth2($client);
        $userInfo = $oauth2->userinfo->get();
        // Process user info, e.g., store in session or database
        echo '<p>Logged in as ' . htmlspecialchars($userInfo->email) . '</p>';
    }
}

?>



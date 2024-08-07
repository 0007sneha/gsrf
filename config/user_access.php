<?php

$domainName = $_SERVER['HTTP_HOST'];
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
// set default
$protocol = "https://";

$host = $domainName.'/';
$hostUrl = $protocol."".$host;

// test ngrok setting----start------------------
if ($domainName == "localhost") {
    $hostUrl = $host = "http://localhost/gsrf/";
}
// test ngrok setting-----end-----------------


$servername = "localhost";
$dbname= "gsrftest";
$username = "root";
$password = "";


$hostEmail = 'office.gsrf@gmail.com'; 
$supportEmail = 'office.gsrf@gmail.com';

$logoPath = "assets/img/logo/logo.png";
$logoIcoPath = "assets/img/logo/logo-favicon.ico";

$logoUrl = $hostUrl.$logoPath;
$logoType = pathinfo($logoUrl, PATHINFO_EXTENSION);
$logoData = '';
$logoUrlBase64 = '';
if (file_get_contents($logoUrl)) {
    $logoData = file_get_contents($logoUrl);
    $logoUrlBase64 = 'data:image/' . $logoType . ';base64,' . base64_encode($logoData);
}

?>
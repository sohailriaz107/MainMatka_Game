<?php
$site_title = 'MainMatka';
$home_url = 'https://mainmatka.app/';    //url of home page
$site_url = 'https://mainmatka.app/TCSBack2024/'; //backend url
$admin_folder_name = 'FBLogin4985';

$package_name = 'com.MainMatka.web';

$con = mysqli_connect("15.235.224.124", "dp777_app_user", "3ChrqrR4@uT4Nqm2", "dp777_app") or die("Error " . mysqli_error($con));

define("SITEURL","https://mainmatka.app/");
define("SITEDOMAIN","mainmatka.app");
define('SMS_AUTH_KEY','328462Az42bWvHbS5eee314cP1');
define('SMS_SENDER_ID','MBOOKI');


$service_json = realpath('/app/html/include/satorino1-com-adminsdk-m1bo2-5743e134ca.json'); // Update this path with service json file
define('SERVICE_ACCOUNT_KEY_FCM', $service_json);

//push notificaiton API ACCESS KEY
define( 'API_ACCESS_KEY', '');

date_default_timezone_set('Asia/Kolkata');

?>
<?php
// Check if PHP session is not already set
if (!isset($_SESSION['usr_id']) || !isset($_SESSION['usr_name']) || !isset($_SESSION['usr_mobile']) || !isset($_SESSION['api_access_token'])) {
	
	// Refresh session variables from cookies if available
	if (isset($_COOKIE['usr_id']) && isset($_COOKIE['usr_name']) && isset($_COOKIE['usr_mobile']) && isset($_COOKIE['api_access_token'])) {
		
		
		$cookie_user_id = intval(mysqli_real_escape_string($con,$_COOKIE['usr_id']));
		$cookie_usr_name = mysqli_real_escape_string($con,$_COOKIE['usr_name']);
		$cookie_usr_mobile = mysqli_real_escape_string($con,$_COOKIE['usr_mobile']);
		$cookie_api_access_token = mysqli_real_escape_string($con,$_COOKIE['api_access_token']);
		
		$result = mysqli_query($con, "SELECT id FROM users WHERE id = '" . $cookie_user_id. "' and api_access_token = '" . $cookie_api_access_token . "'");
		if ($row = mysqli_fetch_array($result)){
			$_SESSION['usr_id'] = $cookie_user_id;
			$_SESSION['usr_name'] = $cookie_usr_name;
			$_SESSION['usr_mobile'] = $cookie_usr_mobile;
			$_SESSION['api_access_token'] = $cookie_api_access_token;
		}else{
			echo "<script>window.location = 'logout.php';</script>";
			exit;
		}
		
		
	}
}


// Check if the user is logged in
if (isset($_SESSION['usr_id'])) {
    // User is logged in, do nothing
} else {
    $actual_url = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $actual_url = mysqli_real_escape_string($con, $actual_url);
    $return_url = "login.php?return_url=".base64_encode($actual_url);
	header("Location: ".$return_url);
	exit;
}
?>
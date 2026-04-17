<?php
ini_set('session.cookie_lifetime', 2592000);  // 30 days in seconds
session_start(); 
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
	include("include/connect.php");
	include("include/functions.php");
	
	
	if(isset($_SESSION['usr_id'])!=""){
	echo "<script>window.location = 'index.php';</script>";
	exit;
    }

if(isset($_POST['login'])){
	
	// Allow 5 attempts per minute
		$timeFrame = 60;
		$maxAttempts =5;
		
			$ip = $_SERVER['REMOTE_ADDR'];
			$key = 'rate_limit_' . $ip;

			if (!isset($_SESSION[$key])) {
				$_SESSION[$key] = ['attempts' => 1, 'time' => time()];
			} else {
				$elapsedTime = time() - $_SESSION[$key]['time'];

				if ($elapsedTime < $timeFrame) {
					$_SESSION[$key]['attempts']++;

					if ($_SESSION[$key]['attempts'] > $maxAttempts) {
						// Implement your action, like blocking the IP or introducing a delay.
						echo 'Invalid Activity Found';
						exit;
					}
				} else {
					$_SESSION[$key] = ['attempts' => 1, 'time' => time()];
				}
			}
			
			
	$return_url = mysqli_real_escape_string($con, $_POST['return_url']);
	$return_url = htmlspecialchars($return_url, ENT_QUOTES, 'UTF-8');
	
	$mobile = mysqli_real_escape_string($con, $_POST['mobile']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	
	$password_hash = md5($password);
	
	
	$mobile = '+91'.$mobile;
	$result = mysqli_query($con, "SELECT * FROM users WHERE mobile = '" . $mobile. "' and password = '" . $password_hash . "'");

	if ($row = mysqli_fetch_array($result)){
	    
	    if($row['status'] ==0){
	        echo '<center><br><br><br><br>Contact admin</center>';
			exit;
				
	    }else{
			
		setcookie("usr_id", $row['id'], time() + 30 * 24 * 60 * 60, "/");
		setcookie("usr_name", $row['username'], time() + 30 * 24 * 60 * 60, "/");
		setcookie("usr_mobile", $row['mobile'], time() + 30 * 24 * 60 * 60, "/");
		setcookie("api_access_token", $row['api_access_token'], time() + 30 * 24 * 60 * 60, "/");
    
	
		$_SESSION['usr_id'] = $row['id'];
		$_SESSION['status'] = $row['status'];
		$_SESSION['usr_name'] = $row['username'];
		$_SESSION['usr_mobile'] = $row['mobile'];
		$_SESSION['api_access_token'] = $row['api_access_token'];
    		if($return_url =='')
    		{
    		    echo "<script>window.location = 'index.php';</script>";
    		    exit;
    		}else{
    		    echo "<script>window.location = '".base64_decode($return_url)."';</script>";
    		    exit;
    		}
	    }
	}else{
		$show_error_msg = 1;
		echo "<script>alert('Invalid Mobile No or Password')</script>";
        echo "<script>window.location = 'login.php?success_alert1';</script>";
	}

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Login - <?php echo $site_title;?></title>
    <meta name="description" content="login and access play option for satta matka online and win big money, india's largest and trusted satta matka play application, Fastest withdrawal and full rate">
    <?php include("include/head.php"); ?>
</head>

<body>

    <div class="wrapper">
        
        <?php include("include/sidebar.php"); ?>
        <div id="content">
            <?php include("include/nav.php"); ?>
            
            
            <div class="container d-flex flex-column justify-content-center" style="min-height: 80vh;">
                <div class="card shadow-lg border-0" style="border-radius: 20px;">
                    <div class="text-center mb-4 mt-2">
                        <img src="assets/img/logo-fill.png" class="img-fluid mb-3" style="max-height: 80px; border-radius: 16px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                        <h3 class="font-weight-bold" style="color: var(--primary-color);">Welcome Back!</h3>
                        <span class="text-muted" style="font-size: 14px;">Sign in to continue</span>
                    </div>
                    
                    <form action="" method="POST">
                      <div class="form-group mb-3">
                        <label for="mobile" class="text-secondary font-weight-bold" style="font-size:12px;">Mobile Number</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0" style="border-radius: 12px 0 0 12px; border-color: #e2e8f0;"><i class="fa fa-phone text-muted" style="width:20px;"></i></span>
                            </div>
                            <input type="text" class="form-control border-left-0 pl-0 bg-light" name="mobile" maxlength="10" minlength="10" placeholder="Enter 10 Digit Phone Number" id="mobile" autocomplete="off" required style="border-radius: 0 12px 12px 0;">
                        </div>
                      </div>
                      
                      <div class="form-group mb-4">
                        <label for="pwd" class="text-secondary font-weight-bold" style="font-size:12px;">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0" style="border-radius: 12px 0 0 12px; border-color: #e2e8f0;"><i class="fa fa-lock text-muted" style="width:20px;"></i></span>
                            </div>
                            <input type="password" class="form-control border-left-0 pl-0 bg-light" name="password" placeholder="Enter password" id="pwd" autocomplete="off" required style="border-radius: 0 12px 12px 0;">
                        </div>
                      </div>
                      
                      <button type="submit" class="btn btn-theme py-3 font-weight-bold w-100" style="font-size: 16px; border-radius: 12px;" name="login">Login Securely <i class="fa fa-arrow-right ml-2"></i></button>
                      <input type="hidden" name="return_url" value="<?php echo htmlspecialchars($_GET['return_url']);?>">
                    </form> 
                    
                    <div class="text-center mt-5 mb-2">
                        <p class="text-muted mb-2" style="font-size: 14px;">Don't have an account?</p>
                        <a href="register.php" class="btn btn-outline-primary w-100 font-weight-bold" style="border-radius: 12px; padding: 12px; border: 2px solid var(--primary-color); color: var(--primary-color);">Create Account</a>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
    
    <?php include("include/footer.php"); ?>

</body>

</html>
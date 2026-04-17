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
    
    if (isset($_POST['signup'])) {
		
		
		if (0) {
    echo "<script>alert('Opps... Kindly contact Admin')</script>";
    echo "<script>window.location = 'register.php';</script>";
    exit;
  }
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
			
			
           
            $name = mysqli_real_escape_string($con, $_POST['name']);
			$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
			
            $username = mysqli_real_escape_string($con, $_POST['username']);
			$username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
			
            $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
			$mobile = htmlspecialchars($mobile, ENT_QUOTES, 'UTF-8');
			$mobile = '+91'.$mobile;
			
            $password = mysqli_real_escape_string($con, $_POST['password']);
			$password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
			
			$password_hash =  md5($password);
			
            $confirmpassword = mysqli_real_escape_string($con, $_POST['confirmpassword']);


			// Allow only letters and spaces, and require at least 2 characters
    if (!preg_match('/^[a-zA-Z ]{2,}$/', $name)) {
        echo "<script>alert('Invalid name. Only letters and spaces allowed')</script>";
        echo "<script>window.location = 'register.php';</script>";
        exit;
    }
	
			
			if (preg_match('/^\d{10}$/', $_POST['mobile'])) {
				//Valid mobile number!
			} else {
				echo "<script>alert('Invalid mobile number. Please enter a 10-digit number')</script>";
				echo "<script>window.location = 'register.php';</script>";
				exit;
			}


            
            if($password != $confirmpassword)
            {
                echo "<script>alert('Password Does not match')</script>";
				echo "<script>window.location = 'register.php';</script>";
				exit;
                
            }
            
			$refer_by = '';
			$api_access_token = generateRandomString();
            
            $date_created = date("Y-m-d");
            $username_check = 0;
			$phone_check = 0;
            $err_msg ='';

			$sql = "SELECT * FROM users WHERE mobile='$mobile'";
            $result = mysqli_query($con, $sql);
            $phone_check = mysqli_num_rows($result);
            
			
			if($phone_check >0)
            {
                echo "<script>alert('Mobile Number Already Exist.')</script>";
				echo "<script>window.location = 'register.php';</script>";
				exit;
                
            }else{$phone_check =0; }
            	  
                
                $refer_id = strtoupper(substr($username,0,2)).rand(1000,9999);
                $sql = "INSERT INTO users(name,username,mobile,password,status,date_created,role,refer_id,refer_by,package_name,api_access_token)
                VALUES('$name','$username', '$mobile','$password_hash','1','$date_created','user','$refer_id','$refer_by','website','$api_access_token')";
                $res = mysqli_query($con, $sql);
                //echo mysqli_error($con);
                $last_id = mysqli_insert_id($con);
				
                if($last_id !='' && $last_id > 0){
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
					}
				}


                echo "<script>window.location = 'index.php?success_alert1';</script>";
                }else{
                    echo "<script>alert('Sorry! Try Again')</script>";
				    echo "<script>window.location = 'register.php';</script>";
				    exit;
                }
            

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Signup - <?php echo $site_title;?></title>
    <meta name="description" content="Create account by register with online matka play. india's largest and trusted satta matka play application, Fastest withdrawal and full rate">
    <?php include("include/head.php"); ?>
</head>

<body>

    <div class="wrapper">
        
        <?php include("include/sidebar.php"); ?>
        <div id="content">
            <?php include("include/nav.php"); ?>
            
            
            <div class="container py-4">  
            <div class="card shadow-lg border-0" style="border-radius: 20px;">
                <div class="text-center mb-4 mt-2">
                    <h3 class="font-weight-bold" style="color: var(--primary-color);">Create Account</h3>
                    <span class="text-muted" style="font-size: 14px;">Join India's Most Trusted Platform</span>
                </div>
                
                 <form action="" method="POST" autocomplete="off">
                  <div class="form-group mb-3">
                    <label for="name" class="text-secondary font-weight-bold" style="font-size:12px;">Full Name</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0" style="border-radius: 12px 0 0 12px; border-color: #e2e8f0;"><i class="fa fa-user text-muted" style="width:20px;"></i></span>
                        </div>
                        <input type="text" class="form-control border-left-0 pl-0 bg-light" name="name" maxlength="50" minlength="4" placeholder="Enter Full Name" id="name" autocomplete="off" required style="border-radius: 0 12px 12px 0;">
                    </div>
                  </div>
                  
                  <div class="form-group mb-3">
                    <label for="username" class="text-secondary font-weight-bold" style="font-size:12px;">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0" style="border-radius: 12px 0 0 12px; border-color: #e2e8f0;"><i class="fa fa-id-badge text-muted" style="width:20px;"></i></span>
                        </div>
                        <input type="text" class="form-control border-left-0 pl-0 bg-light" name="username" maxlength="25" minlength="4" placeholder="Unique Username" id="username" autocomplete="off" required style="border-radius: 0 12px 12px 0;">
                    </div>
                  </div>
                  
                  <div class="form-group mb-3">
                    <label for="mobile" class="text-secondary font-weight-bold" style="font-size:12px;">Mobile Number</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0" style="border-radius: 12px 0 0 12px; border-color: #e2e8f0;"><i class="fa fa-phone text-muted" style="width:20px;"></i></span>
                        </div>
                        <input type="text" class="form-control border-left-0 pl-0 bg-light" name="mobile" maxlength="10" minlength="10" placeholder="Enter 10 Digit Phone Number" id="mobile" autocomplete="off" required style="border-radius: 0 12px 12px 0;">
                    </div>
                  </div>
                  
                  <div class="form-group mb-3">
                    <label for="pwd" class="text-secondary font-weight-bold" style="font-size:12px;">Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0" style="border-radius: 12px 0 0 12px; border-color: #e2e8f0;"><i class="fa fa-lock text-muted" style="width:20px;"></i></span>
                        </div>
                        <input type="password" class="form-control border-left-0 pl-0 bg-light" name="password" placeholder="Enter password" id="pwd" autocomplete="off" required style="border-radius: 0 12px 12px 0;">
                    </div>
                  </div>
                  
                  <div class="form-group mb-4">
                    <label for="cnpwd" class="text-secondary font-weight-bold" style="font-size:12px;">Confirm Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0" style="border-radius: 12px 0 0 12px; border-color: #e2e8f0;"><i class="fa fa-check-circle text-muted" style="width:20px;"></i></span>
                        </div>
                        <input type="password" class="form-control border-left-0 pl-0 bg-light" name="confirmpassword" placeholder="Confirm password" id="cnpwd" autocomplete="off" required style="border-radius: 0 12px 12px 0;">
                    </div>
                  </div>
                  
                  <button type="submit" name="signup" class="btn btn-theme py-3 font-weight-bold w-100" style="font-size: 16px; border-radius: 12px;">Create Account <i class="fa fa-arrow-right ml-2"></i></button>
                </form> 
                
                <div class="text-center mt-5 mb-2">
                    <p class="text-muted mb-2" style="font-size: 14px;">Already have an account?</p>
                    <a href="login.php" class="btn btn-outline-primary w-100 font-weight-bold" style="border-radius: 12px; padding: 12px; border: 2px solid var(--primary-color); color: var(--primary-color);">Login Here</a>
                </div>

            </div>
            </div>
            
            
        </div>
    </div>
    
    <?php include("include/footer.php"); ?>

</body>

</html>
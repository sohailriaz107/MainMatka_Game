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
	

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Game Rate | Winning Ratio | <?php echo $site_title;?></title>
    <meta name="description" content="Explore our exciting game rates and win big!. Single ank jodi, single panna, double patti, triple patti, half sangam, full sangam, Our rates are competitive and offer great value for your money. Whether you're a seasoned player or new to the game, there's something for everyone. Check out our game rate page now and start your winning streak today!">
    <?php include("include/head.php"); ?>
</head>

<body>

    <div class="wrapper">
        
        <?php include("include/sidebar.php"); ?>
        <div id="content">
            <?php include("include/nav.php"); ?>
            
            <div class="container mb-5" > 
            <div class="tb-10" style="text-align:center;">
                <h1 class="gdash3" style="font-size:24px;"><i class="fa fa-line-chart"></i> Game Rates</h1>
                <span class="text-muted" style="font-size:13px;">We Offer Best Rate in market - Full rate</span>
                
                <div class="card p-3 mt-4 text-left">
                    <h2 style="font-size:18px; color:var(--primary-color); font-weight:700; margin-bottom:15px;"><i class="fa fa-trophy"></i> Main Games Win Ratio</h2>
                    <div class="d-flex justify-content-between border-bottom py-2"><span class="font-weight-bold text-dark">Single Ank</span><span class="text-success font-weight-bold">10 ka 90</span></div>
                    <div class="d-flex justify-content-between border-bottom py-2"><span class="font-weight-bold text-dark">Jodi</span><span class="text-success font-weight-bold">10 ka 950</span></div>
                    <div class="d-flex justify-content-between border-bottom py-2"><span class="font-weight-bold text-dark">Single Panna</span><span class="text-success font-weight-bold">10 ka 1400</span></div>
                    <div class="d-flex justify-content-between border-bottom py-2"><span class="font-weight-bold text-dark">Double Panna</span><span class="text-success font-weight-bold">10 ka 2800</span></div>
                    <div class="d-flex justify-content-between border-bottom py-2"><span class="font-weight-bold text-dark">Triple Panna</span><span class="text-success font-weight-bold">10 ka 6,000</span></div>
                    <div class="d-flex justify-content-between border-bottom py-2"><span class="font-weight-bold text-dark">Half Sangam</span><span class="text-success font-weight-bold">10 ka 10,000</span></div>
                    <div class="d-flex justify-content-between py-2"><span class="font-weight-bold text-dark">Full Sangam</span><span class="text-success font-weight-bold">10 ka 1,00,000</span></div>
                </div>
                
                <div class="card p-3 mt-3 text-left">
                    <h2 style="font-size:18px; color:var(--primary-color); font-weight:700; margin-bottom:15px;"><i class="fa fa-star"></i> Starline Win Ratio</h2>
                    <div class="d-flex justify-content-between border-bottom py-2"><span class="font-weight-bold text-dark">Single Ank</span><span class="text-success font-weight-bold">10 ka 100</span></div>
                    <div class="d-flex justify-content-between border-bottom py-2"><span class="font-weight-bold text-dark">Single Panna</span><span class="text-success font-weight-bold">10 ka 1600</span></div>
                    <div class="d-flex justify-content-between border-bottom py-2"><span class="font-weight-bold text-dark">Double Panna</span><span class="text-success font-weight-bold">10 ka 3,000</span></div>
                    <div class="d-flex justify-content-between py-2"><span class="font-weight-bold text-dark">Triple Panna</span><span class="text-success font-weight-bold">10 ka 10,000</span></div>
                </div>
            </div>
            </div>
      
            
        </div>
    </div>
    
    <?php include("include/footer.php"); ?>

</body>

</html>
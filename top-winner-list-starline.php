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

    <title>Top Starline Winners List - <?php echo $site_title;?></title>
    <meta name="description" content="Check out the list of todays top starline winners. online satta matka starline top winner list will give you clear idea that how many people wins and you will get more confidance to play and win big money.">
    <?php include("include/head.php"); ?>
</head>

<body>

    <div class="wrapper">
        
        <?php include("include/sidebar.php"); ?>
        <div id="content">
            <?php include("include/nav.php"); ?>
            
            <div class="container" > 
            <div class="tb-10" style="text-align:center;">
                <h1 class="gdash3" style="font-size:22px;"> Top Starline Winner List</h1>
                <span style="font-size:12px;">List of Today's top winners with amount</span>
                
        <?php
        $today_date = date('Y-m-d');
        $qry =  "SELECT * FROM user_transaction where date='$today_date' and type='win' and starline='1' order by amount+0 DESC limit 10";
		$upi_transactions = mysqli_query($con, $qry);
		while($row = mysqli_fetch_array($upi_transactions)){
		    $user_name= get_userNameById($row['user_id']);
			$length = strlen($user_name);

			$visibleLength = 2;
			$hiddenLength = $length - $visibleLength * 2; // Calculate total hidden characters

			$visibleChars = substr($user_name, 0, $visibleLength);
			$hiddenChars = str_repeat('*', $hiddenLength);
			$visibleCharsEnd = substr($user_name, -$visibleLength);

			$masked_username = $visibleChars . $hiddenChars . $visibleCharsEnd; 
		?>
                <div class="card shadow-sm border-0 mb-3 transition" style="border-radius: 16px;">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #FFD700, #FFA500); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-right: 15px; box-shadow: 0 4px 10px rgba(255, 165, 0, 0.3);">
                            <i class="fa fa-trophy"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 font-weight-bold text-dark" style="font-size:16px;"><?php echo $masked_username;?></h6>
                            <small class="text-muted d-block" style="font-size:12px;"><i class="fa fa-star"></i> <?php echo get_Starlinetime($row['game_id']);?> <span class="badge badge-light border">Digit: <?php echo $row['digit'];?></span></small>
                            <small class="text-muted d-block" style="font-size:11px; margin-top:2px;"><i class="fa fa-clock-o"></i> <?php echo date('d M Y, h:i A',strtotime($row['date'].' '.$row['time']));?></small>
                        </div>
                        <div class="text-right">
                            <span class="d-block text-muted" style="font-size:11px;">Prize</span>
                            <h6 class="mb-0 font-weight-bold" style="color:#38a169; font-size:16px;">₹<?php echo number_format($row['amount']*40,2);?></h6>
                        </div>
                    </div>
                </div>
        <?php } ?>
        
            </div>
            </div>
      
         <br><br><br>   
        </div>
    </div>
    
    <?php include("include/footer.php"); ?>

</body>

</html>
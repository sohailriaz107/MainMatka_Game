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

//header("Cache-Control: max-age=31536000");
	include("include/connect.php");
	include("include/functions.php");

?>
<!DOCTYPE html>
<html lang="en"> 

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

<title> MainMatka | ONLINE MATKA PLAY APP	</title>
<meta name="title" content="MainMatka | PLAY ONLINE MATKA | SATTA MATKA PLAY">
<meta name="description" content="MainMatka App Experience with new Online Matka Play App website and MainMatka in Satta Matka Play online matka Industry 2023 with MainMatka.">
<link rel="canonical" href="https://mainmatka.app" />
<?php include("include/head.php"); ?>
<style>
   

/* ===== FINAL MODERN UI ===== */

.game-card-new {
    background: #f8f9fa;
    border-radius: 18px;
    padding: 12px;
    margin-bottom: 12px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.06);
}

/* Center content */
.game-main {
    margin-bottom: 8px;
}

/* RESULT (TOP) */
.game-result {
    font-size: 18px;
    font-weight: 700;
    color: #d63384;
    letter-spacing: 1px;
}

/* GAME NAME */
.game-title {
    font-size: 14px;
    font-weight: 600;
    color: #2d3748;
    margin-top: 2px;
}

/* STATUS */
.status-badge {
    display: inline-block;
    margin-top: 6px;
    padding: 4px 12px;
    font-size: 11px;
    border-radius: 20px;
    font-weight: 600;
}

/* Running */
.status-badge.running {
    background: #d4edda;
    color: #2f855a;
}

/* Closed */
.status-badge.closed {
    background: #f8d7da;
    color: #c53030;
}

/* Bottom row */
.game-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Time icon */
.time-icon {
    color: #777;
    font-size: 16px;
}

/* Play button */
.play-btn {
    width: 44px;
    height: 44px;
    background: #f44646;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.play-btn i {
    font-size: 14px;
}

/* Disabled */
.play-btn.disabled {
    background: #cbd5e0;
}

/* Mobile tuning */
@media (max-width: 360px) {
    .game-result { font-size: 16px; }
    .game-title { font-size: 13px; }
}

/* Shared circle button */
.circle-btn {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

/* ICON size */
.circle-btn i {
    font-size: 14px;
}

/* TIME BUTTON */
.time-btn {
    background: #edf2f7;
    color: #4a5568;
}

/* PLAY BUTTON */
.play-btn {
    background: #f44646;
    color: #fff;
}

/* Disabled */
.play-btn.disabled {
    background: #cbd5e0;
}

/* Bottom layout */
.game-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>
</head>

<body>

    <div class="wrapper">
        
        <?php include("include/sidebar.php"); ?>
        <div id="content">
            <?php include("include/nav.php"); ?>

            <div id="scroll-container" class="noticebr"><div id="scroll-text" style="white-space: nowrap;"><?php echo get_SettingValue('app_notice');?></div></div>
            
            
            <div class="container text-center mt-3" >    
                <div class="row">
                    <div class="col-6 pr-1">
                      <a href="starline-play.php" class="home-sl-box shadow-sm"><i class="fa fa-star"></i> Starline</a>
                    </div>
                    <div class="col-6 pl-1"> 
                      <a href="https://mainmatka.app/apk/MainMatka_1011.apk" class="home-sl-box shadow-sm" style="background: linear-gradient(to right, #43a047, #2e7d32);"><i class="fa fa-android"></i> Download App</a>
                    </div>
                </div>
            </div>
            
            <div class="container text-center mt-2 mb-3" >  
                <div class="row px-2">
                    <div class="col-4 px-1">
                        <a href="support.php" class="d-block p-3 bg-white rounded shadow-sm text-dark" style="text-decoration: none; border-radius: 12px !important;">
                            <i class="fa fa-comments d-block mb-1" style="font-size: 28px; color: var(--secondary-color);"></i>
                            <span style="font-size: 11px; font-weight: 600;">Support</span>
                        </a>
                    </div>
                    <div class="col-4 px-1"> 
                        <a href="add-fund.php" class="d-block p-3 bg-white rounded shadow-sm text-dark" style="text-decoration: none; border-radius: 12px !important;">
                            <i class="fa fa-plus-circle d-block mb-1" style="font-size: 28px; color: #38a169;"></i>
                            <span style="font-size: 11px; font-weight: 600;">Add Money</span>
                        </a>
                    </div>
                    <div class="col-4 px-1"> 
                        <a href="withdraw.php" class="d-block p-3 bg-white rounded shadow-sm text-dark" style="text-decoration: none; border-radius: 12px !important;">
                            <i class="fa fa-university d-block mb-1" style="font-size: 28px; color: #e53e3e;"></i>
                            <span style="font-size: 11px; font-weight: 600;">Withdraw</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="container text-center" > 
            <div class="tb-10">
            
                <?php
                $games_list_qry =  "SELECT * FROM `parent_games` WHERE status=1 order by order_of_display";
				$games = mysqli_query($con, $games_list_qry);
                         while ($row = mysqli_fetch_array($games)){
                            $open_time =  $row['open_time'];
                            $close_time = $row['close_time'];
                            $result_open_time = $row['result_open_time'];
                            $result_close_time = $row['result_close_time'];
                            $open_days = $row['open_days'];
                            $game_days = explode(",", $open_days);
                            
                            $day = strtolower(date('D', strtotime(date('Y-m-d'))));
                             
                             $betting_open_time =strtotime(date('Y-m-d').' '.$open_time);
                             $betting_close_time =strtotime(date('Y-m-d').' '.$close_time);
							 
							 
                             if(in_array($day, $game_days) && time() < $betting_open_time){
							   $bidding_status = 1;
                               $msg = 'Betting is Running Now';
                               $default_bidding_date ='today';
                               $default_bidding_game ='open';
                             }elseif(in_array($day, $game_days) && time() < $betting_close_time){
							   $bidding_status = 1;
                               $msg = 'Betting is Running For Close';
                               $default_bidding_date ='today';
                               $default_bidding_game ='close';
                             }else{
							   $bidding_status = 0;
                               $msg = 'Betting is Closed for Today';
                               $default_bidding_date ='next_date';
                               $default_bidding_game ='open';
                             }
                             
                             
                             $child_open = $row['child_open_id'];
                             $child_close = $row['child_close_id'];
                             $open_result = GetOpneResultByid($child_open);
                             $close_result = GetCloseResultByid($child_close);
                             
                            $game_id = $row['id'];
                            $game_name = $row['name'];
                            $open_time = date("h:i A", strtotime($open_time));
                            $close_time = date("h:i A", strtotime($close_time));
                            $result_open_time = date("h:i A", strtotime($result_open_time));
                            $result_close_time = date("h:i A", strtotime($result_close_time));
                            $result = $open_result.''.$close_result;
							$bidding_status = $bidding_status;
                            $msg =  $msg;
                            $default_bidding_date = $default_bidding_date;
                            $default_bidding_game = $default_bidding_game;
                            $status = $row['status'];
                            $game_title = strtolower(str_replace(" ","-",$game_name));

                    ?>    
                        
                        <div class="game-card-new">

    <!-- CENTER CONTENT -->
    <div class="game-main text-center">
        <div class="game-title"><?php echo $game_name;?></div>
        <div class="game-result"><?php echo $result;?></div>
        

        <?php if($bidding_status){ ?>
            <div class="status-badge running"><?php echo $msg;?></div>
        <?php } else { ?>
            <div class="status-badge closed"><?php echo $msg;?></div>
        <?php } ?>
    </div>

    <div class="game-bottom">

        <!-- TIME BUTTON -->
        <a href="#" class="circle-btn time-btn" data-toggle="modal" data-target="#gameTimeModal<?php echo $game_id;?>">
            <i class="fa fa-clock-o"></i>
        </a>

        <!-- PLAY BUTTON -->
        <?php if($bidding_status){ ?>
            <a href="game-dashboard.php?game=<?php echo $game_title;?>&gid=<?php echo $game_id;?>" class="circle-btn play-btn">
                <i class="fa fa-play"></i>
            </a>
        <?php } else { ?>
            <a href="#" class="circle-btn play-btn disabled">
                <i class="fa fa-play"></i>
            </a>
        <?php } ?>

    </div>

</div>


                        <div class="modal" id="gameTimeModal<?php echo $game_id;?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                        
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <p class="modal-title"><?php echo $game_name;?></p>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                        
                              <!-- Modal body -->
                              <div class="modal-body">
                                <div class="HomegameTimetable">
                                    <div><i class="fa fa-clock-o"></i> <span>Open Bid Ends</span> <span class="timeR"><?php echo $open_time;?></span></div>
                                    <div><i class="fa fa-clock-o"></i> <span>Close Bid Ends</span> <span class="timeR"><?php echo $close_time;?></span></div>
                                    <div><i class="fa fa-clock-o"></i> <span>Open Result</span> <span class="timeR"><?php echo $result_open_time;?></span></div>
                                    <div><i class="fa fa-clock-o"></i> <span>Close Result</span> <span class="timeR"><?php echo $result_close_time;?></span></div>
                                </div>
                              </div>
                        
                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
                              </div>
                        
                            </div>
                          </div>
                        </div>
                        
                        
                   <?php } ?>

                
            </div>      
            </div>
            <br><br><br>
           
            
        </div>
    </div>
	
	<?php if(1){?>
	<div class="modal" id="noticeboard">
                          <div class="modal-dialog">
                            <div class="modal-content">
                        
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <p class="modal-title">GET ANDROID APPLICATION</p>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                        
                              <!-- Modal body -->
                              <div class="modal-body">
							  <div style="display: flex; align-items: center;">
									<img src="assets/img/app-home.webp?v1" style="width: 150px; height: auto; margin-right: 10px;">
									<div>
										<p style="font-size: 18px; font-weight: bold; margin-bottom: 5px;">DOWNLOAD OUR APP</p>
										
										<p style="line-height: 22px;
    font-size: 16px;">Enjoy advanced features and options by downloading our Android app. access all the exciting features anytime, anywhere!</p>
										<a href="https://mainmatka.app/apk/MainMatka_1011.apk" style="background-color: #b73800; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer;text-decoration:none;"> <i class="fa fa-download"></i> Download Now</a>
									</div>
								</div>

                        
                              <!--
                              <div class="modal-footer">
                                <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
                              </div> -->
                        
                            </div>
                          </div>
    </div>
	</div>
	<?php } ?>
    
    <?php include("include/footer.php"); ?>
<div class="wts-flt-btn">

<a href="https://wa.me/<?php echo get_SettingValue('PWA_whatsapp2');?>" ><i class="fa fa-whatsapp"></i> 
<!--
<a href="https://t.me/" ><i class="fa fa-telegram"></i> 
-->
</div>


<script type="text/javascript">
    $(document).ready(function() {
        // Check if the cookie exists and has a value of 'seen'
        if (document.cookie.indexOf('popup_seen') === -1) {
            // If the cookie doesn't exist, show the popup
            $('#noticeboard').modal('show');
        }

        // Set a cookie to indicate that the user has seen the popup
        $('#noticeboard').on('hidden.bs.modal', function () {
            var date = new Date();
            date.setTime(date.getTime() + (3 * 60 * 60 * 1000)); // Set the cookie to expire in 6 hours
            document.cookie = 'popup_seen=true; expires=' + date.toUTCString() + '; path=/';
        });
    });
</script>



</body>

</html>
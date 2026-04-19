
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

    <title>Milan Starline - Play and Win </title>
    
    <?php include("include/head.php"); ?>
</head>

<body class="page-starline-play">

    <div class="wrapper">
        
        <?php include("include/sidebar.php"); ?>
        <div id="content">
            <?php include("include/nav.php"); ?>

            <!-- <div id="scroll-container" class="noticebr">
                <div class="notice-scroll-track notice-scroll-track--single">
                    <span class="notice-scroll-seg"><?php echo get_SettingValue('app_notice'); ?></span>
                </div>
            </div> -->
            
            <div class="container text-center mt-3 " >    
            <div class="tb-10">
                  <div class="row">
                    <div class="col-6">
                      <a href="#" class="home-sl-box">Play Big & Win Big <br> <span>Har Ghante Jeeto</span></a>
                    </div>
                    <div class="col-6"> 
                      <a href="#" class="home-sl-box">Starline Chart <br> <span> View Old Record</span></a>
                    </div>
                  </div>
            </div>
            </div>
            
            <!--
            <div class="container text-center" >  
            <div class="tb-10">
                  <div class="row">
                    <div class="col-4" style="padding-right:5px;">
                      <a href="https://wa.me/<?php echo WHATSAPP_NUMBER;?>" class="home-sl2-box"><i class="fa fa-whatsapp"></i> Whatsapp</a>
                    </div>
                    <div class="col-4" style="padding-right:5px;padding-left:5px;"> 
                      <a href="add-fund.php" class="home-sl2-box"> <i class="fa fa-money"></i> Add Money</a>
                    </div>
                    <div class="col-4" style="padding-left:5px;"> 
                      <a href="withdraw.php" class="home-sl2-box"> <i class="fa fa-credit-card"></i> Withdraw</a>
                    </div>
                  </div>
            </div>
            </div>-->
            
            <div class="container text-center" > 
            <div class="tb-10">
            
                <?php
                $games_list_qry =  "SELECT * FROM starline where 1";
				$games = mysqli_query($con, $games_list_qry);
                if ($games && mysqli_num_rows($games) === 0) {
                    echo '<p class="starline-play-empty text-center">Abhi koi Starline slot list mein nahi hai.</p>';
                }
                         while ($games && ($row = mysqli_fetch_array($games))){
                            $game_id = $row['id'];
                            $game_name = $row['name'];
                            $result = get_StarlineResult($game_id);
                            
                            $print_result = $result;
                            
                            $startline_time = strtotime(date('Y-m-d').' '.$row['time']);
                ?>    
                        
                        <div class="row game-list-inner">
                                <div class="col-4">
                                  <span class="sgameName"> <?php echo $game_name;?> </span>
                                </div>
                                <div class="col-4"> 
                                      <span class="sgameResut"> <?php echo $print_result;?> </span>
                                </div>
                                <div class="col-4 splaydiv"> 
                                <?php if(time() < $startline_time){ ?>
                                  <a href="starline-dashboard.php?game=<?php echo $game_name;?>&gid=<?php echo $game_id;?>" class="sgame-play"> Play</a>
                                <?php }else{?>
                                 <!--<a class="game-play gray"> <i class="fa fa-play-circle"></i><br>Play Game</a>-->
                                <?php } ?>
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
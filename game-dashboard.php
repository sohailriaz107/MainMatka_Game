<?php
ini_set('session.cookie_lifetime', 2592000);  // 30 days in seconds
session_start(); 
	include("include/connect.php");
    include("include/session.php");
	include("include/functions.php");
	
	$game_title = mysqli_real_escape_string($con, $_GET['game']);
	$game_id = intval(mysqli_real_escape_string($con, $_GET['gid']));
	$game_title = ucfirst(str_replace("-"," ",$game_title));
	
	if($game_id ==''){
	    echo "<script>window.location = '404.php';</script>";
	    exit;
	}
	
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Game Dashboard - <?php echo $game_title ;?></title>
    
    <?php include("include/head.php"); ?>
</head>

<body class="page-game-dashboard">

    <div class="wrapper">
        
        <?php include("include/sidebar.php"); ?>
        <div id="content">
            <?php include("include/nav.php"); ?>
            
            
            <div class="container" >  
            <div class="card-full-page tb-10">
                
                <div class="text-center tb-10 game-dashboard-header">
                    <h3 class="gdash3"><?php echo $game_title;?> Dashboard</h3>
                    <div class="bidding-subtitle-wrap"><span class="bidding-subtitle">Select Bidding Option</span></div>
                </div>
                
                <div class="tb-10">&nbsp;</div>
                
                <?php
                $games_list_qry =  "SELECT * FROM `parent_games` WHERE id=$game_id and status=1";
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
                               $default_bidding_game ='';
                             }
                             
                             
                             $child_open = $row['child_open_id'];
                             $child_close = $row['child_close_id'];

                             
                            $game_id = $row['id'];
                            $game_name = $row['name'];
                            $open_time = $open_time;
                            $close_time = $close_time;
 
							$bidding_status = $bidding_status;
                            $msg =  $msg;
                            $default_bidding_date = $default_bidding_date;
                            $default_bidding_game = $default_bidding_game;
                            $status = $row['status'];
                            //$game_title = strtolower(str_replace(" ","-",$game_name));

                    ?>
                
                <?php if($default_bidding_game =='open'){ ?>
                <div class="row bidoptions-list tb-10">
                                <div class="col-4">
                                  <a href="single.php?gid=<?php echo $child_open;?>&pgid=<?php echo $game_id;?>&dgame=open" class="bidtypebox">
                                      <img src="assets/img/single_ank.png">
                                      <p>Single Ank</p>
                                  </a>
                                </div>
                                
                                <div class="col-4">
                                  <a href="jodi.php?gid=<?php echo $child_open;?>&pgid=<?php echo $game_id;?>&dgame=open" class="bidtypebox">
                                      <img src="assets/img/group.png">
                                      <p>Jodi</p>
                                  </a>
                                </div>
                                
                                <div class="col-4">
                                  <a href="single-patti.php?gid=<?php echo $child_open;?>&pgid=<?php echo $game_id;?>&dgame=open" class="bidtypebox">
                                      <img src="assets/img/single.patti.png">
                                      <p>Single Patti</p>
                                  </a>
                                </div>

        
                </div>
                
                <div class="row bidoptions-list tb-10">
                                <div class="col-4">
                                  <a href="double-patti.php?gid=<?php echo $child_open;?>&pgid=<?php echo $game_id;?>&dgame=open" class="bidtypebox">
                                      <img src="assets/img/double.png">
                                      <p>Double Patti</p>
                                  </a>
                                </div>
                                
                                <div class="col-4">
                                  <a href="triple-patti.php?gid=<?php echo $child_open;?>&pgid=<?php echo $game_id;?>&dgame=open" class="bidtypebox">
                                      <img src="assets/img/tripple_patti.png">
                                      <p>Triple Patti</p>
                                  </a>
                                </div>
                                
                                <div class="col-4">
                                  <a href="half-sangam.php?gid=<?php echo $child_open;?>&pgid=<?php echo $game_id;?>&dgame=open" class="bidtypebox">
                                      <img src="assets/img/half.png">
                                      <p>Half Sangam</p>
                                  </a>
                                </div>

        
                </div>
                
                <div class="row bidoptions-list tb-10">
                                <div class="col-4">
                                  
                                </div>
                                
                                <div class="col-4">
                                  <a href="full-sangam.php?gid=<?php echo $child_open;?>&pgid=<?php echo $game_id;?>&dgame=open" class="bidtypebox">
                                      <img src="assets/img/full_singum.png">
                                      <p>Full Sangam</p>
                                  </a>
                                </div>
                                
                                <div class="col-4">
                                  
                                </div>

        
                </div>
                
                <div class="tbmar-40 text-center">
                    <div class="game-status-note">
                        <i class="fa fa-info-circle"></i> Note: <?php echo $msg;?>
                    </div>
                </div>
                
                <?php }elseif($default_bidding_game =='close'){ ?>
                
                <div class="row bidoptions-list tb-10">
                                <div class="col-4">
                                  <a href="single.php?gid=<?php echo $child_close;?>&pgid=<?php echo $game_id;?>&dgame=close" class="bidtypebox">
                                      <img src="assets/img/single_ank.png">
                                      <p>Single Ank</p>
                                  </a>
                                </div>

                                <div class="col-4">
                                  <a href="single-patti.php?gid=<?php echo $child_close;?>&pgid=<?php echo $game_id;?>&dgame=close" class="bidtypebox">
                                      <img src="assets/img/single.patti.png">
                                      <p>Single Patti</p>
                                  </a>
                                </div>
                                <div class="col-4">
                                  <a href="double-patti.php?gid=<?php echo $child_close;?>&pgid=<?php echo $game_id;?>&dgame=close" class="bidtypebox">
                                      <img src="assets/img/double.png">
                                      <p>Double Patti</p>
                                  </a>
                                </div>

        
                </div>
                
                <div class="row bidoptions-list tb-10">
                                <div class="col-4">

                                </div>
                                
                                <div class="col-4">
                                  <a href="triple-patti.php?gid=<?php echo $child_close;?>&pgid=<?php echo $game_id;?>&dgame=close" class="bidtypebox">
                                      <img src="assets/img/tripple_patti.png">
                                      <p>Triple Patti</p>
                                  </a>
                                </div>
                                
                                <div class="col-4">

                                </div>

        
                </div>
                
                <div class="tbmar-40 text-center">
                    <div class="game-status-note">
                        <i class="fa fa-info-circle"></i> Note: <?php echo $msg;?>
                    </div>
                </div>
                
                <?php }else{ ?>
                
                <div class="tbmar-40 text-center">
                    <div class="game-status-note game-status-closed">
                        <i class="fa fa-ban"></i> Sorry! Bidding is Close for <?php echo $game_title;?>. <br> Try again Tomorrow.
                    </div>
                </div>
                
                <?php } ?>
                
                
                <?php } ?>
                        
                


            </div>
            </div>
            
            
        </div>
    </div>
    
    <?php include("include/footer.php"); ?>

</body>

</html>
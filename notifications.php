<?php
ini_set('session.cookie_lifetime', 2592000);  // 30 days in seconds
session_start(); 
	include("include/connect.php");
    include("include/session.php");
	include("include/functions.php");
	

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Notifications - <?php echo $site_title;?></title>
    <meta name="description" content="Latest Notification list of <?php echo $site_title;?>">
    <?php include("include/head.php"); ?>
</head>

<body>

    <div class="wrapper">
        
        <?php include("include/sidebar.php"); ?>
        <div id="content">
            <?php include("include/nav.php"); ?>
            
            <div class="container" > 
            <div class="text-center tb-10 mt-3 mb-4">
                <div style="width: 60px; height: 60px; background: #ebf4ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                    <i class="fa fa-bell" style="font-size: 28px; color: var(--primary-color);"></i>
                </div>
                <h3 class="font-weight-bold" style="color: var(--primary-color);">Notifications</h3>
                <span class="text-muted" style="font-size:13px;">Latest updates and alerts</span>
            </div>
            
        <?php
        $today_date = date('Y-m-d');
        $result = mysqli_query($con,"SELECT * FROM notification order by id DESC limit 50");
		if(mysqli_num_rows($result)>0){
                 
            while ($row = mysqli_fetch_array($result)){
            ?> 
            <div class="card shadow-sm border-0 mb-3 transition" style="border-radius: 16px;">
                <div class="card-body p-3 d-flex align-items-start">
                    <div style="width: 44px; height: 44px; border-radius: 12px; background: #fff5f5; color: var(--primary-color); display: flex; align-items: center; justify-content: center; font-size: 18px; margin-right: 15px; flex-shrink: 0;">
                        <i class="fa fa-bullhorn"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1 font-weight-bold text-dark" style="font-size:15px;"><?php echo $row['title'];?></h6>
                        <p class="text-muted mb-2" style="font-size:13px; line-height:1.4;"><?php echo $row['description'];?></p>
                        <small class="text-secondary font-weight-bold" style="font-size:11px;"><i class="fa fa-clock-o"></i> <?php echo date('d M Y, h:i A',strtotime($row['date'].' '.$row['time']));?></small>
                    </div>
                </div>
            </div>
            <?php } ?>
            
        <?php }else{ ?>
             
            <div class="tbmar-40 text-center">
                <p>No record found</p>
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
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

    <title>My profile - <?php echo $site_title;?></title>
    
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
                    <i class="fa fa-user" style="font-size: 28px; color: var(--primary-color);"></i>
                </div>
                <h3 class="font-weight-bold" style="color: var(--primary-color);">My Profile</h3>
                <span class="text-muted" style="font-size:13px;">Manage your settings</span>
            </div>
            
            <div class="pb-10">
                
                <a href="update-bank-details.php" class="text-decoration-none d-block mb-3">
                    <div class="card shadow-sm border-0 transition" style="border-radius: 16px;">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div style="width: 48px; height: 48px; border-radius: 12px; background: #e6fffa; color: #38a169; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-right: 15px;">
                                <i class="fa fa-university"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 font-weight-bold text-dark">Bank Details</h6>
                                <small class="text-muted">View/Update withdrawal bank</small>
                            </div>
                            <i class="fa fa-chevron-right text-muted" style="font-size:12px;"></i>
                        </div>
                    </div>
                </a>

                <a href="change-password.php" class="text-decoration-none d-block mb-3">
                    <div class="card shadow-sm border-0 transition" style="border-radius: 16px;">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div style="width: 48px; height: 48px; border-radius: 12px; background: #fff5f5; color: #e53e3e; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-right: 15px;">
                                <i class="fa fa-key"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 font-weight-bold text-dark">Change Password</h6>
                                <small class="text-muted">Update security credentials</small>
                            </div>
                            <i class="fa fa-chevron-right text-muted" style="font-size:12px;"></i>
                        </div>
                    </div>
                </a>
                        
            </div>
            </div>
      
            
        </div>
    </div>
    
    <?php include("include/footer.php"); ?>

</body>

</html>
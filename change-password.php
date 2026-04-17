<?php
ini_set('session.cookie_lifetime', 2592000);  // 30 days in seconds
session_start(); 
	include("include/connect.php");
    include("include/session.php");
	include("include/functions.php");
	
if (isset($_POST['update_bank_details']) && isset($_SESSION['usr_id'])!="") {
	
	        $user_id = $_SESSION['usr_id'];
			
			if($_SESSION['api_acess_token'] == $api_acess_token){
			    //all ok
			}else{
			    echo "<script>window.location = 'update-bank-details.php?invalidrequest';</script>";
			    exit;
			}
			
            $old_password = mysqli_real_escape_string($con, $_POST['old_password']);
            $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
            $confirm_new_password = mysqli_real_escape_string($con, $_POST['confirm_new_password']);
            
            $new_password_hash = md5($new_password);
			$old_password_hash = md5($old_password);

           $sql1 = "SELECT * FROM users WHERE id='".$user_id."' and password = '" . $old_password_hash . "'";
                $result = mysqli_query($con, $sql1);
            	if($row = mysqli_fetch_array($result)){
                $sql = "UPDATE users set password='$new_password_hash' where id='$user_id'";
                $res = mysqli_query($con, $sql);
                    echo "<script>window.location = 'change-password.php?detailupdated';</script>";
                }else{
                    echo "<script>window.location = 'change-password.php?notupdated';</script>";
                }
  
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Update Password - <?php echo $site_title;?></title>
    
    <?php include("include/head.php"); ?>
</head>

<body>

    <div class="wrapper">
        
        <?php include("include/sidebar.php"); ?>
        <div id="content">
            <?php include("include/nav.php"); ?>
            
            <div class="container" >  
            <div class="container py-4" >  
            <div class="card shadow-lg border-0" style="border-radius: 20px;">
                <div class="text-center mb-4 mt-2">
                    <h3 class="font-weight-bold" style="color: var(--primary-color);">Change Password</h3>
                    <span class="text-muted" style="font-size: 14px;">Update Your Profile Password</span>
                </div>
                
                 <form action="" method="POST" autocomplete="off">
                  <div class="form-group mb-3">
                    <label for="old_password" class="text-secondary font-weight-bold" style="font-size:12px;">Old Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0" style="border-radius: 12px 0 0 12px; border-color: #e2e8f0;"><i class="fa fa-unlock-alt text-muted" style="width:20px;"></i></span>
                        </div>
                        <input type="text" class="form-control border-left-0 pl-0 bg-light" name="old_password"  minlength="3" maxlength="50" placeholder="Existing Password" id="old_password" autocomplete="off" required style="border-radius: 0 12px 12px 0;">
                    </div>
                  </div>
                  
                  <div class="form-group mb-3">
                    <label for="new_password" class="text-secondary font-weight-bold" style="font-size:12px;">New Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0" style="border-radius: 12px 0 0 12px; border-color: #e2e8f0;"><i class="fa fa-lock text-muted" style="width:20px;"></i></span>
                        </div>
                        <input type="text" class="form-control border-left-0 pl-0 bg-light" name="new_password"  minlength="3" maxlength="50" placeholder="Enter New Password" id="new_password" autocomplete="off" required style="border-radius: 0 12px 12px 0;">
                    </div>
                  </div>
                  
                  <div class="form-group mb-4">
                    <label for="confirm_new_password" class="text-secondary font-weight-bold" style="font-size:12px;">Confirm Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0" style="border-radius: 12px 0 0 12px; border-color: #e2e8f0;"><i class="fa fa-check-circle text-muted" style="width:20px;"></i></span>
                        </div>
                        <input type="text" class="form-control border-left-0 pl-0 bg-light" name="confirm_new_password" minlength="3" maxlength="50" placeholder="Confirm Password" id="confirm_new_password" autocomplete="off" required style="border-radius: 0 12px 12px 0;">
                    </div>
                  </div>
                  
                  <input type="hidden" name="api_acess_token" value="<?php echo $_SESSION['api_acess_token'];?>">
                  <button type="submit" name="change_password" class="btn btn-theme py-3 font-weight-bold w-100" style="font-size: 16px; border-radius: 12px;">Update Password <i class="fa fa-save ml-2"></i></button>

                </form> 
            </div>
            </div>
      
            
        </div>
    </div>
    
    <?php include("include/footer.php"); ?>

</body>

</html>
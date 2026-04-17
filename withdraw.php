<?php
ini_set('session.cookie_lifetime', 2592000);  // 30 days in seconds
session_start(); 
	include("include/connect.php");
    include("include/session.php");
	include("include/functions.php");


if (isset($_POST['withdraw']) && isset($_SESSION['usr_id'])!="") {
	

		$user_id= $_SESSION['usr_id'];
            $amount = mysqli_real_escape_string($con, $_POST['amount']);
            $date = date('Y-m-d');
    		$time = date('h:i:s A');
			
			$query = "SELECT SUM(win) as winning_amount FROM user_transaction WHERE user_id = '$user_id'";
			$result = mysqli_query($con, $query);
			if ($result) {
				$row = mysqli_fetch_assoc($result);
				$winningAmount = $row['winning_amount'];
				if ($winningAmount > 0) {
					
				} else {
					echo "<script>alert('You Dont have Any Winning Amount. You can only withdraw Winning Amount.')</script>";
					echo "<script>window.location = 'withdraw.php?invalidrequest';</script>";
					mysqli_close($con);
					exit;
				}
				mysqli_free_result($result);
			} else {
				echo "<script>alert('You Dont have Any Winning Amount. You can only withdraw Winning Amount.')</script>";
				echo "<script>window.location = 'withdraw.php?invalidrequest';</script>";
				mysqli_close($con);
				exit;
			}
			

            if($amount > get_lastBalance($user_id))
            {
                echo "<script>window.location = 'withdraw.php?insufficientbalance';</script>";
                
            }elseif($amount < 1000){
                echo "<script>window.location = 'withdraw.php?invalidrequest';</script>";
            }else{
            
            				$balance = get_lastBalance($user_id);
                			$new_balance = $balance - $amount;
                			
                			UpdateBalanceInUserTable($user_id,$new_balance);
                			
            				$sql = "INSERT INTO user_transaction(user_id,game_id,game_type,digit,date,time,amount,type,debit_credit,balance,status,api_response)
                            VALUES('$user_id','','withdraw', '','$date','$time','$amount','withdraw','debit','$new_balance','1','from Website')";
                            $res = mysqli_query($con, $sql);
                            //echo mysqli_error($con);
                            $last_id = mysqli_insert_id($con);
							
							$sql_total_withdrawal = "UPDATE users set total_withdrawal = (total_withdrawal + $amount) WHERE id='$user_id'";
							mysqli_query($con, $sql_total_withdrawal);
	
    
                if($res){
                echo "<script>window.location = 'withdraw.php?detailupdated';</script>";
                }else{
                    echo "<script>window.location = 'withdraw.php?notupdated';</script>";
                }
            }
    mysqli_close($con);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Withdraw Fund - <?php echo $site_title;?></title>
    
    <?php include("include/head.php"); ?>
</head>

<body>

    <div class="wrapper">
        
        <?php include("include/sidebar.php"); ?>
        <div id="content">
            <?php include("include/nav.php"); ?>
            
            <div class="container py-4" >  
            <div class="card shadow-lg border-0" style="border-radius: 20px; padding: 20px;">
                <?php 
                $user_id = $_SESSION['usr_id'];
                $qry =  "SELECT * FROM users where id='".$user_id."'";
                $user_info = mysqli_query($con, $qry);
                while($row = mysqli_fetch_array($user_info)){
                $account_holder_name = $row['account_holder_name'];
                $account_number = $row['account_number'];
                $ifsc = $row['ifsc'];
                $bank_name = $row['bank_name'];
				
					if($row['status'] ==0){
							// User is blocked, log them out
							session_unset();
							session_destroy();
							setcookie("usr_id", "", time() - 3600, "/"); // Expire the cookie
							setcookie("usr_name", "", time() - 3600, "/");
							setcookie("usr_mobile", "", time() - 3600, "/");
							setcookie("api_access_token", "", time() - 3600, "/");

							// Redirect to the login page
							$return_url = "logout.php";
							header("Location: " . $return_url);
							exit;
					}
                }
                ?>
                <div class="text-center mb-4 mt-2">
                    <div style="width: 60px; height: 60px; background: #fff5f5; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                        <i class="fa fa-university" style="font-size: 28px; color: #e53e3e;"></i>
                    </div>
                    <h3 class="font-weight-bold" style="color: var(--primary-color);">Withdraw Fund</h3>
                    <span class="text-muted" style="font-size: 14px;">Instant transfer to your bank</span>
                </div>
                
                <div class="alert alert-warning text-center" style="border-radius: 12px; font-size: 12px; line-height: 1.4;">
                    <i class="fa fa-clock-o"></i> Turnaround 24 hrs. Safely credited to your account.
                    <br><strong class="text-danger mt-1 d-block">Sunday withdrawals are off.</strong>
                </div>
                
                 <form action="" method="POST" autocomplete="off" class="mt-4">
                  
                  <?php if($account_number =='' || $account_number == NULL){?>
                   <div class="alert alert-danger text-center" style="border-radius: 12px;">
                       <i class="fa fa-exclamation-triangle"></i> Kindly update your bank details first to withdraw amount.
                   </div>
                   <a href="update-bank-details.php" class="btn btn-outline-danger w-100 font-weight-bold" style="border-radius: 15px; border-width: 2px;">Update Bank Details</a>
                  <?php }else{ ?>
                  <div class="form-group mb-4">
                    <label class="font-weight-bold text-secondary text-center w-100" style="font-size: 14px;">Withdrawal Amount (<i class="fa fa-inr"></i>)</label>
                    <input type="number" class="form-control text-center text-dark" name="amount" value="" min="1000" max="10000" placeholder="Minimum ₹1000" autocomplete="off" required style="font-size: 24px; font-weight: bold; padding: 15px; border-radius: 15px; border: 2px solid #e2e8f0; color:var(--text-dark);">
                  </div>
                 
                  
                  <input type="hidden" name="api_acess_token" value="<?php echo $_SESSION['api_acess_token'];?>">
                  <button type="submit" name="withdraw" class="btn btn-theme py-3 font-weight-bold w-100 mb-3" style="border-radius: 15px; font-size: 16px;">Withdraw Funds <i class="fa fa-check ml-2"></i></button>
                  <?php } ?>
                </form> 
                
                <div class="text-center mt-2">
                    <p class="text-muted mb-2" style="font-size: 13px;">Having Issues?</p>
                    <a href="https://wa.me/<?php echo get_SettingValue('PWA_whatsapp2');?>" class="btn btn-outline w-100 font-weight-bold" style="border-radius: 15px;"><i class="fa fa-whatsapp text-success"></i> Contact Admin</a>
                </div>

            </div>
            </div>
      
            
        </div>
    </div>
    
    <?php include("include/footer.php"); ?>

</body>

</html>
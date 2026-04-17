<?php
ini_set('session.cookie_lifetime', 2592000);  // 30 days in seconds
session_start(); 
	include("include/connect.php");
    include("include/session.php");
	include("include/functions.php");


if(isset($_GET['add_fund'])) {
    // Form fields processing

    // Get the selected payment method
    $paymentMethod = $_GET['payment_method'];

    // Your other form processing logic

    // Redirect based on the selected payment method
    if ($paymentMethod === "add_fund_qr") {
        header("Location: add_fund_qr/index.php?" . http_build_query($_GET));
        exit();
    } else if ($paymentMethod === "add_fund_soft") {
        header("Location: add_fund_soft/index.php?" . http_build_query($_GET));
        exit();
    }
    else if ($paymentMethod === "add_fund_softXfresh") {
        header("Location: add_fund_softXfresh/index.php?" . http_build_query($_GET));
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Add Fund - <?php echo $site_title;?></title>
    
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
                ?>
                <div class="text-center mb-4 mt-2">
                    <div style="width: 60px; height: 60px; background: #e6fffa; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                        <i class="fa fa-plus" style="font-size: 28px; color: #38a169;"></i>
                    </div>
                    <h3 class="font-weight-bold" style="color: var(--primary-color);">Add Fund</h3>
                    <span class="text-muted" style="font-size: 14px;">Add points to your wallet quickly</span>
                </div>
                
                <div class="alert alert-info text-center" style="border-radius: 12px; font-size: 13px;">
                    <i class="fa fa-info-circle"></i> Funds are added within 5 minutes safely!
                </div>
				
                 <form action="" method="GET" autocomplete="off">
                  <div class="form-group mb-4">
                    <label class="font-weight-bold text-secondary text-center w-100" style="font-size: 14px;">Enter Amount (<i class="fa fa-inr"></i>)</label>
                    <input type="number" id="add_fund_amount" class="form-control text-center" style="font-size: 24px; font-weight: bold; padding: 15px; border-radius: 15px; border: 2px solid #e2e8f0; color:var(--text-dark);" name="amount" value="" min="500" max="50000" placeholder="0" autocomplete="off" required>
                  </div>
                  
                <div class="row bidoptions-list mb-4">
                                <div class="col-3 px-1">
                                  <a class="addFundamtbox text-center d-block py-2" id="amount_500" data="500" style="cursor: pointer; border-radius: 10px; border: 1px solid #e2e8f0; background: #f8fafc;">
                                      <span class="font-weight-bold" style="font-size: 13px;">+500</span>
                                  </a>
                                </div>
                                
                                <div class="col-3 px-1">
                                  <a class="addFundamtbox text-center d-block py-2" id="amount_1000" data="1000" style="cursor: pointer; border-radius: 10px; border: 1px solid #e2e8f0; background: #f8fafc;">
                                      <span class="font-weight-bold" style="font-size: 13px;">+1000</span>
                                  </a>
                                </div>
                                
                                <div class="col-3 px-1">
                                  <a class="addFundamtbox text-center d-block py-2" id="amount_5000" data="5000" style="cursor: pointer; border-radius: 10px; border: 1px solid #e2e8f0; background: #f8fafc;">
                                      <span class="font-weight-bold" style="font-size: 13px;">+5000</span>
                                  </a>
                                </div>
                                <div class="col-3 px-1">
                                  <a class="addFundamtbox text-center d-block py-2" id="amount_10000" data="10000" style="cursor: pointer; border-radius: 10px; border: 1px solid #e2e8f0; background: #f8fafc;">
                                      <span class="font-weight-bold" style="font-size: 12px;">+10000</span>
                                  </a>
                                </div>
                </div>
				  
				  <div class="form-group mb-4">
                    <label class="font-weight-bold text-secondary text-center w-100" style="font-size: 14px;">Payment Method</label>
                    <div style="position: relative;">
                        <i class="fa fa-qrcode" style="position: absolute; left: 15px; top: 15px; color: var(--text-muted); font-size: 18px;"></i>
                        <select class="form-control font-weight-bold" name="payment_method" autocomplete="off" required style="padding-left: 45px; border-radius: 15px; height: 50px;">
                            <option value="<?php echo get_SettingValue('web_version_payment_link');?>">Direct UPI Auto</option>
                        </select>
                    </div>
                  </div>
                  
                  <input type="hidden" name="package_name" value="website">
				  <input type="hidden" name="version" value="5.0.0">
				  <input type="hidden" name="api_access_token" value="<?php echo $_SESSION['api_access_token'];?>">
                  <input type="hidden" name="id" value="<?php echo $_SESSION['usr_id'];?>">
                  
                  <button type="submit" name="add_fund" class="btn btn-theme w-100 py-3 font-weight-bold mb-3" style="border-radius: 15px; font-size: 16px;">Add Points <i class="fa fa-arrow-right ml-2"></i></button>
                  
                </form> 
                
                <div class="text-center mt-3">
                    <p class="text-muted mb-2" style="font-size: 13px;">Facing Issues?</p>
                    <a href="https://wa.me/<?php echo get_SettingValue('PWA_whatsapp1');?>" class="btn btn-outline w-100 font-weight-bold" style="border-radius: 15px;"><i class="fa fa-whatsapp text-success"></i> WhatsApp Support</a>
                </div>

            </div>
            </div>
      
            
        </div>
    </div>
    
    <?php include("include/footer.php"); ?>

</body>

</html>
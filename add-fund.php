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

<body class="page-add-fund">

    <div class="wrapper">

        <?php include("include/sidebar.php"); ?>
        <div id="content">
            <?php include("include/nav.php"); ?>

            <div class="add-fund-page">
                <div class="add-fund-container">
                    <?php
                    $user_id = $_SESSION['usr_id'];
                    ?>
                    
                    <div class="add-fund-glass-card">
                        <div class="add-fund-header">
                            <div class="add-fund-icon-wrap">
                                <img src="assets/icons/fundhistory.png" alt="Wallet" class="add-fund-hero-img">
                            </div>
                            <h2 class="add-fund-title">Deposit Funds</h2>
                            <p class="add-fund-tagline">Load points securely to your wallet</p>
                        </div>

                        <div class="add-fund-info-bar">
                            <span class="info-bubble"><i class="fa fa-clock-o"></i> Faster Processing (5m)</span>
                            <span class="info-bubble"><i class="fa fa-shield"></i> 100% Secured</span>
                        </div>

                        <form action="" method="GET" autocomplete="off" class="add-fund-form">
                            <div class="amount-entry-section">
                                <label class="amount-label">Enter Deposit Amount (<i class="fa fa-inr"></i>)</label>
                                <div class="amount-input-wrapper">
                                    <input type="number" id="add_fund_amount" class="add-fund-main-input" name="amount" value="" min="500" max="50000" placeholder="0" autocomplete="off" required>
                                    <div class="input-focus-glow"></div>
                                </div>
                            </div>

                            <div class="quick-chip-grid">
                                <div class="chip-item">
                                    <a class="addFundamtbox amount-chip" data="500">
                                        <span class="chip-sign">+</span><span class="chip-val">500</span>
                                    </a>
                                </div>
                                <div class="chip-item">
                                    <a class="addFundamtbox amount-chip" data="1000">
                                        <span class="chip-sign">+</span><span class="chip-val">1000</span>
                                    </a>
                                </div>
                                <div class="chip-item">
                                    <a class="addFundamtbox amount-chip" data="5000">
                                        <span class="chip-sign">+</span><span class="chip-val">5000</span>
                                    </a>
                                </div>
                                <div class="chip-item">
                                    <a class="addFundamtbox amount-chip" data="10000">
                                        <span class="chip-sign">+</span><span class="chip-val">10000</span>
                                    </a>
                                </div>
                            </div>

                            <div class="method-section">
                                <label class="method-label">Select Payment Channel</label>
                                <div class="custom-select-card">
                                    <div class="select-visual">
                                        <i class="fa fa-qrcode"></i>
                                    </div>
                                    <select class="add-fund-select-gate" name="payment_method" autocomplete="off" required>
                                        <option value="<?php echo get_SettingValue('web_version_payment_link'); ?>">Direct UPI Auto (Recommended)</option>
                                    </select>
                                    <i class="fa fa-chevron-down select-arrow"></i>
                                </div>
                            </div>

                            <input type="hidden" name="package_name" value="website">
                            <input type="hidden" name="version" value="5.0.0">
                            <input type="hidden" name="api_access_token" value="<?php echo $_SESSION['api_access_token']; ?>">
                            <input type="hidden" name="id" value="<?php echo $_SESSION['usr_id']; ?>">

                            <div class="add-fund-action-wrap">
                                <button type="submit" name="add_fund" class="btn premium-add-btn">
                                    <span>Proceed to Deposit</span>
                                    <i class="fa fa-arrow-right"></i>
                                </button>
                            </div>
                        </form>

                        <div class="add-fund-footer">
                            <p class="help-text">Need assistance with deposit?</p>
                            <a href="https://wa.me/<?php echo get_SettingValue('PWA_whatsapp1'); ?>" class="minimal-wa-link">
                                <i class="fa fa-whatsapp"></i> Chat with Support
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php include("include/footer.php"); ?>

</body>

</html>
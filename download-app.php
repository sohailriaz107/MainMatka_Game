<?php
ini_set('session.cookie_lifetime', 2592000);
session_start(); 

include("include/connect.php");
include("include/functions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>Download Mobile application - <?php echo $site_title;?></title>
<meta name="description" content="Download Mobile application and stay connected with us.">
<?php include("include/head.php"); ?>

<style>
/* MOBILE FIRST OPTIMIZATION */
.download-wrapper {
    max-width: 420px;
    margin: auto;
    padding: 10px;
}

/* Compact header */
.download-header {
    text-align: center;
    margin-bottom: 10px;
}

.download-header h3 {
    font-size: 18px;
    margin-bottom: 2px;
}

.download-header span {
    font-size: 12px;
}

/* Card compact */
.download-card {
    border-radius: 16px;
    overflow: hidden;
}

/* Top section compact */
.download-top {
    padding: 20px 15px 15px;
    text-align: center;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: #fff;
}

/* Smaller image */
.download-top img {
    max-width: 120px;
    margin-bottom: 12px;
    border-radius: 12px;
}

/* App title */
.download-top h2 {
    font-size: 20px;
    margin-bottom: 5px;
}

/* Description */
.download-top p {
    font-size: 13px;
    margin-bottom: 15px;
    line-height: 1.4;
}

/* DOWNLOAD BUTTON (Above fold focus) */
.download-btn {
    display: block;
    background: #FFD700;
    color: #C2185B;
    font-weight: 700;
    font-size: 15px;
    padding: 14px;
    border-radius: 10px;
    text-decoration: none;
    text-transform: uppercase;
    border: 2px solid #fff;
    box-shadow: 0 6px 15px rgba(0,0,0,0.3);
}

/* Features section compact */
.feature-box {
    padding: 12px 15px;
}

.feature-item {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
}

.feature-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
}

.feature-text h6 {
    font-size: 14px;
    margin: 0;
}

.feature-text p {
    font-size: 12px;
    margin: 0;
}

/* Pulse animation */
.download-btn {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(255,215,0,0.6); }
    70% { box-shadow: 0 0 0 10px rgba(255,215,0,0); }
    100% { box-shadow: 0 0 0 0 rgba(255,215,0,0); }
}
</style>

</head>

<body>

<div class="wrapper">
<?php include("include/sidebar.php"); ?>

<div id="content">
<?php include("include/nav.php"); ?>

<div class="container download-wrapper">

    <!-- HEADER -->
    <div class="download-header">
        <h3 style="color: var(--primary-color);">Download App</h3>
        <span class="text-muted">Fast • Secure • Mobile Friendly</span>
    </div>

    <!-- CARD -->
    <div class="card shadow border-0 download-card">

        <!-- TOP SECTION -->
        <div class="download-top">
            <img src="assets/img/app-home.webp?v1" alt="App Preview">

            <h2>MainMatka App</h2>

            <!-- BUTTON NOW ABOVE FOLD -->
            <a href="https://mainmatka.app/apk/MainMatka_1011.apk" class="download-btn">
                <i class="fa fa-android mr-1"></i> Download App
            </a>

            <p>Fast results, secure bidding & real-time updates.</p>
        </div>

        <!-- FEATURES -->
        <div class="feature-box bg-white">

            <div class="feature-item">
                <div class="feature-icon" style="background:#fff3cd;">
                    <i class="fa fa-rocket text-warning"></i>
                </div>
                <div class="feature-text">
                    <h6>Fast Performance</h6>
                    <p class="text-muted">Works even on slow internet</p>
                </div>
            </div>

            <div class="feature-item">
                <div class="feature-icon" style="background:#d4edda;">
                    <i class="fa fa-shield text-success"></i>
                </div>
                <div class="feature-text">
                    <h6>Secure System</h6>
                    <p class="text-muted">Safe & encrypted</p>
                </div>
            </div>

            <div class="feature-item">
                <div class="feature-icon" style="background:#cce5ff;">
                    <i class="fa fa-bell text-primary"></i>
                </div>
                <div class="feature-text">
                    <h6>Instant Alerts</h6>
                    <p class="text-muted">Live updates & results</p>
                </div>
            </div>

        </div>

    </div>

</div>

</div>
</div>

<?php include("include/footer.php"); ?>

</body>
</html>
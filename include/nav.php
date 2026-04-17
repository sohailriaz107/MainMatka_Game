<nav class="navbar navbar-expand-lg border-0">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <button type="button" id="sidebarCollapse" class="btn menu-btn" title="Menu">
            <i class="fa fa-bars"></i>
        </button> 
        <span> &nbsp;&nbsp; MainMatka</span>
        <?php if(isset($_SESSION['usr_id'])!="") { ?>
        <a href="add-fund.php" class="btn btn-white d-inline-block ml-auto" type="button">
            <i class="fa fa-money" style="color:var(--secondary-color);"></i> <span class="walletamt"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo get_lastBalance($_SESSION['usr_id']); ?></span>
        </a>
        <?php } else { ?>
        <a href="login.php" class="btn btn-white d-inline-block ml-auto" type="button">
            <i class="fa fa-sign-in"></i> <span>Login</span>
        </a>
        <?php } ?>
    </div>
</nav>
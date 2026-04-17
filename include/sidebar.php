<!-- Sidebar  -->
        <nav id="sidebar">
            <div id="dismiss">
                <i class="fa fa-times"></i>
            </div>

            <div class="sidebar-header">
                <div class="user-avatar" style="width: 50px; height: 50px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                    <i class="fa fa-user" style="font-size: 24px; color: white;"></i>
                </div>
                <?php
                    if(isset($_SESSION['usr_id'])!="") {
                ?>
                <span class="Uname"><?php echo $_SESSION['usr_name'];?></span>
                <span class="Umobile"><?php echo str_replace("+91","",$_SESSION['usr_mobile']);?></span>
                <?php }else{ ?>
                <span class="Uname">Hello User</span>
                <span class="Umobile">Welcome Back</span>
                <?php } ?>
            </div>

            <ul class="list-unstyled components sideMenu">
                <li><a href="<?php echo SITEURL;?>"> <i class="fa fa-home"></i> <span>Home</span></a></li>
                <li><a href="transaction-history.php"> <i class="fa fa-list-alt"></i> <span>Transaction History</span></a></li>
                <li><a href="bidding-history.php"> <i class="fa fa-history"></i> <span>Bidding History</span></a></li>
                <li><a href="bidding-history-starline.php"> <i class="fa fa-star"></i> <span>Starline Bid History</span></a></li>
                <li><a href="fund-history.php"> <i class="fa fa-money"></i> <span>Fund History</span></a></li>
                <li><a href="notifications.php"> <i class="fa fa-bell"></i> <span>Notifications</span></a></li>
                <li><a href="top-winner-list.php"> <i class="fa fa-trophy"></i> <span>Top Winners</span></a></li>
                <li><a href="top-winner-list-starline.php"> <i class="fa fa-star-o"></i> <span>Starline Winners</span></a></li>
                <li><a href="game-rates.php"> <i class="fa fa-line-chart"></i> <span>Game Rates</span></a></li>
				<li><a href="download-app.php"> <i class="fa fa-android"></i> <span>Download App</span></a></li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="my-profile.php" class="download">My Profile</a>
                </li>
                <li>
                    <a href="logout.php" class="article">Logout</a>
                </li>
            </ul>
        </nav>
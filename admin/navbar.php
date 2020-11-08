        <aside class="menu-sidebar2">
            <div class="logo">
                <a href="#">
                    <?php echo("<img src='data:image/*;base64,".base64_encode($site->SITE_DATA['SITE_LOGO'])."'>"); ?>
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
                <div class="account2">
                    <div class="image img-cir img-120">
                        <?php echo("<img src='data:image/*;base64,".base64_encode($site->SITE_DATA['PROFILE_PIC'])."'>"); ?>
                    </div>
                    <h4 class="name"><?php printf($site->SITE_DATA['ID']); ?></h4>
                    <a href="#" id="logout">Sign out</a>
                </div>
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="index.php">
                               <img src="assets/images/Details_48px.png" class="navbar-admin-img">  Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="CustomerManager.php">
                                <img src="assets/images/User_48px.png" class="navbar-admin-img"> Customers
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="assets/images/Shopping_Cart_Loaded_48px.png" class="navbar-admin-img"> Orders
                            </a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <img src="assets/images/Warehouse_48px.png" class="navbar-admin-img"> Stock
                                <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="ProductManager.php">
                                    <img src="assets/images/Product_48px.png" class="navbar-admin-img"> Product Manager</a>
                                </li>
                                <li>
                                    <a href="CatagorySetting.php">
                                    <img src="assets/images/Tags_48px.png" class="navbar-admin-img"> Catagory Settings</a>
                                </li>
                            </ul>
                        </li> 
                        <li>
                            <a href="site-settings.php">
                                <img src="assets/images/Domain_48px.png" class="navbar-admin-img"> Site Settings
                            </a>
                        </li>               
                    </ul>
                </nav>
            </div>
        </aside>
                <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop2">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none">
                                <a href="#">
                                    <?php echo("<img src='data:image/*;base64,".base64_encode($site->SITE_DATA['SITE_LOGO'])."'>"); ?>
                                </a>
                            </div>
                            <div class="header-button2">                              
                                <div class="header-button-item mr-0 js-sidebar-btn">
                                    <i class="zmdi zmdi-menu"></i>
                                </div>
                                <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                    <div class="account-dropdown__body">
                                        <!-- <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                        </div> -->
                                        <div class="account-dropdown__item">
                                            <a href="site-settings.php">
                                                <i class="zmdi zmdi-settings"></i>Setting</a>
                                        </div>                                        
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                <div class="menu-sidebar2__content js-scrollbar2">
                    <div class="account2" style="margin-top:80px;">
                        <div class="image img-cir img-120">
                            <?php echo("<img src='data:image/*;base64,".base64_encode($site->SITE_DATA['PROFILE_PIC'])."'>"); ?>
                        </div>
                        <h4 class="name"><?php printf($site->SITE_DATA['ID']); ?></h4>
                        <a href="#" id="m_logout">Sign out</a>
                    </div>
                    <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="index.php">
                               <img src="assets/images/Details_48px.png" class="navbar-admin-img">  Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="CustomerManager.php">
                                <img src="assets/images/User_48px.png" class="navbar-admin-img"> Customers
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="assets/images/Shopping_Cart_Loaded_48px.png" class="navbar-admin-img"> Orders
                            </a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <img src="assets/images/Warehouse_48px.png" class="navbar-admin-img"> Stock
                                <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="ProductManager.php">
                                    <img src="assets/images/Product_48px.png" class="navbar-admin-img"> Product Manager</a>
                                </li>
                                <li>
                                    <a href="CatagorySetting.php">
                                    <img src="assets/images/Tags_48px.png" class="navbar-admin-img"> Catagory Settings</a>
                                </li>
                            </ul>
                            <li>
                                <a href="site-settings.php">
                                    <img src="assets/images/Domain_48px.png" class="navbar-admin-img"> Site Settings
                                </a>
                            </li>  
                        </li>                
                    </ul>
                </nav>
                </div>
            </aside>
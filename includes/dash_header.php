            <div class="se-pre-con"></div>
            <!-- <a href="dashboard.php" class="logo">
                MENUS
            </a> -->
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <!-- <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a> -->
                <div class="main-navigation">
                    <?php 
                        $pass = strtolower($_SESSION['pass']);  
                        $key = substr($pass, 0, 5);  

                        if ($key == 'invac') { 
                    ?>

                    <!-- ///////////////////////////////  INVAC MENUS START /////////////////////// -->

                    <?php require_once('includes/dash_menu_invac.php'); ?>

                    <!-- ///////////////////////////////  INVAC MENUS ENDS /////////////////////// -->
                    <?php
                            }else if($key == 'sales'){ 

                    ?>
                    <!-- ///////////////////////////////  SALES MENUS STARTS /////////////////////// -->

                    <?php require_once('includes/dash_menu_sales.php'); ?>


                    <!-- ///////////////////////////////  SALES MENUS ENDS /////////////////////// -->

                    <?php
                            }else if($key == 'finac'){ 

                    ?>

                    <!-- ///////////////////////////////  SALES MENUS STARTS /////////////////////// -->

                    <?php require_once('includes/dash_menu_finac.php'); ?>


                    <!-- ///////////////////////////////  SALES MENUS ENDS /////////////////////// -->


                    <?php
                            } 

                    ?>
                </div>
                <!-- <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="user user-menu">
                            <a href="config/logout.php">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Logout <i class="caret"></i></span>
                            </a>                            
                        </li>
                    </ul>
                </div> -->
            </nav>
            <div class="col-md-12">
                <div class="col-md-1">
                    <img src="img/neco.jpg" width="70px">
                </div>
                <div class="col-md-11">                                        
                        <table>
                            <tr>
                                <th>User Id</th>
                                <th>&nbsp; : &nbsp;</th>
                                <td><?php echo $_SESSION['usr_id']; ?></td>
                            </tr>                            
                            <tr>
                                <th>Section</th>
                                <th>&nbsp; : &nbsp;</th>
                                <td><?php echo ucfirst($key); ?></td>
                            </tr>                                                        
                            <tr>
                                <th>Company</th>
                                <th>&nbsp; : &nbsp;</th>
                                <td><?php echo $_SESSION['com_nm']; ?></td>
                            </tr>
                        </table>
                    </p>
                </div>
            </div>
            <div class="col-md-12">&nbsp;</div>
            <div class="col-md-12">
                <div class="row action">
                    <div class="col-md-1">
                        <button id="refresh" class="btn btn-primary" onclick="pageRefresh();">Refresh</button>
                    </div>
                    <div class="col-md-1">
                        <button id="ent" class="btn btn-default">Entry</button>
                    </div>
                    <div class="col-md-1">
                        <button id="upd" class="btn btn-default">Update</button>
                    </div>
                    <div class="col-md-1">
                        <button id="del" class="btn btn-default">Delete</button>
                    </div>
                    <!-- <div class="col-md-1">
                        <button id="prnt" class="btn btn-default">Print</button>
                    </div> -->
                    <?php if (isset($_GET['pid']) && $_GET['pid'] == 'prchs'){ ?>
                        <!-- <div class="col-md-1">
                            <button id="can" class="btn btn-default">Cancel</button>
                        </div>
                        <div class="col-md-1">
                            <button id="app" class="btn btn-default">Approval</button>
                        </div> -->
                    <div class="col-md-5">
                    <?php }else{ ?> 
                    <div class="col-md-7">
                    <?php } ?>
                        <div class="message">
                            <?php 
                                if (isset($error_msg)) {
                                    echo '<span class="error-msg">'.$error_msg.'</span>';
                                }elseif (isset($success_msg)) {
                                    echo '<span class="success_msg">'.$success_msg.'</span>';
                                } 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div>&nbsp;</div>
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <?php require_once('includes/header.php'); ?>
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="col-md-12 header">
                <div class="col-md-5"><img src="img/neco.jpg" width="70px"></div>
                <div class="col-md-7"><b>Login</b></div>
            </div>
            <form action="config/login.php" method="post">
                <div class="body bg-gray">                    
                    <div class="row form-group">
                        <div class="col-sm-4"><br>
                            <label>Server Name</label>
                        </div>
                        <div class="col-sm-8"><br>
                            <select name="server" class="form-control" required>
                                <option value="SVRSYB">SVRSYB</option>
                                <option value="SYBLINUX">SYBLINUX</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4">
                            <label>Company Code</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="number" name="com_cd" id="com_cd" onblur="CheckComCd()" class="form-control" placeholder="Company Code" required value="<?php echo isset($_POST['com_cd']) ? $_POST['com_cd'] : ''; ?>"/>
                            <span id="ComCdErrorSpan"></span>
                            <p id="ComCdName"></p>
                            <input type="hidden" name="com_nm" id="com_nm" value="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4">
                            <label>User Id</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="number" name="user_id" class="form-control" placeholder="User ID" required id="user_id" onblur="CheckUserId()" value="<?php echo isset($_POST['user_id']) ? $_POST['user_id'] : ''; ?>"/>
                            <span id="UserIdErrorSpan"></span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4">
                            <label>Access Code</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="password" name="acc_cd" class="form-control" placeholder="Access Code" required id="acc_cd" onblur="CheckAccCd()" value="<?php echo isset($_POST['acc_cd']) ? $_POST['acc_cd'] : ''; ?>"/>
                            <span id="AccCdErrorSpan"></span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4">
                            <label>Password</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="password" name="pass" class="form-control" placeholder="Password" required/>
                            <span id="ErrorSpan"></span>
                        </div>
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" name="submit" class="btn bg-olive btn-block">Submit</button>
                </div>
            </form>
        </div>

        <?php require_once('includes/footer.php'); ?>
    </body>
</html>
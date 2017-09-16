<?php 
    require_once('config/config.php');
    require_once('config/session_check.php');

    if (!empty($_POST['submit'])) {
        $com_cd = $_POST['com_cd'];
        $unit_cd = $_POST['unit_cd'];
        $gst_frdt = $_POST['gst_frdt'];
        $gst_todt = $_POST['gst_todt'];
        $inv_type = implode(',', $_POST['inv_type']);
        $file_name = $_POST['file_name'];

        if ($file_name == 'b2b') {
            header('Location:gst_uploads/export_gst_upload_b2b.php?com='.$com_cd.'&unit='.$unit_cd.'&frdt='.$gst_frdt.'&todt='.$gst_todt.'&inv='.$inv_type.'&file='.$file_name);
        }elseif ($file_name == 'b2cl') {
            header('Location:gst_uploads/export_gst_upload_b2cl.php?com='.$com_cd.'&unit='.$unit_cd.'&frdt='.$gst_frdt.'&todt='.$gst_todt.'&inv='.$inv_type.'&file='.$file_name);
        }elseif ($file_name == 'b2cs') {
            header('Location:gst_uploads/export_gst_upload_b2cs.php?com='.$com_cd.'&unit='.$unit_cd.'&frdt='.$gst_frdt.'&todt='.$gst_todt.'&inv='.$inv_type.'&file='.$file_name);
        }elseif ($file_name == 'cdnr') {
            header('Location:gst_uploads/export_gst_upload_cdnr.php?com='.$com_cd.'&unit='.$unit_cd.'&frdt='.$gst_frdt.'&todt='.$gst_todt.'&inv='.$inv_type.'&file='.$file_name);
        }elseif ($file_name == 'cdnur') {
            header('Location:gst_uploads/export_gst_upload_cdnur.php?com='.$com_cd.'&unit='.$unit_cd.'&frdt='.$gst_frdt.'&todt='.$gst_todt.'&inv='.$inv_type.'&file='.$file_name);
        }elseif ($file_name == 'exp') {
            header('Location:gst_uploads/export_gst_upload_exp.php?com='.$com_cd.'&unit='.$unit_cd.'&frdt='.$gst_frdt.'&todt='.$gst_todt.'&inv='.$inv_type.'&file='.$file_name);
        }elseif ($file_name == 'at') {
            header('Location:gst_uploads/export_gst_upload_at.php?com='.$com_cd.'&unit='.$unit_cd.'&frdt='.$gst_frdt.'&todt='.$gst_todt.'&inv='.$inv_type.'&file='.$file_name);
        }elseif ($file_name == 'atadj') {
            header('Location:gst_uploads/export_gst_upload_atadj.php?com='.$com_cd.'&unit='.$unit_cd.'&frdt='.$gst_frdt.'&todt='.$gst_todt.'&inv='.$inv_type.'&file='.$file_name);
        }elseif ($file_name == 'exemp') {
            header('Location:gst_uploads/export_gst_upload_exemp.php?com='.$com_cd.'&unit='.$unit_cd.'&frdt='.$gst_frdt.'&todt='.$gst_todt.'&inv='.$inv_type.'&file='.$file_name);
        }elseif ($file_name == 'hsn') {
            header('Location:gst_uploads/export_gst_upload_hsn.php?com='.$com_cd.'&unit='.$unit_cd.'&frdt='.$gst_frdt.'&todt='.$gst_todt.'&inv='.$inv_type.'&file='.$file_name);
        }elseif ($file_name == 'docs') {
            header('Location:gst_uploads/export_gst_upload_docs.php?com='.$com_cd.'&unit='.$unit_cd.'&frdt='.$gst_frdt.'&todt='.$gst_todt.'&inv='.$inv_type.'&file='.$file_name);
        }
       
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once('includes/dash_head.php'); ?>
    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="">
           <?php require_once('includes/dash_header.php'); ?> 
        </header>
        <div>
            <!-- Left side column. contains the logo and sidebar -->
            <!-- <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <?php //require_once('includes/dash_sidebar.php'); ?>
                </section>
            </aside> -->

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        GST Uploads Excel
                        <small>GST</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" name="gstuploads" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <table cellpadding="1">
                                        <tr>                                            
                                            <th>Comp. Code</th>
                                            <td><input type="text" name="com_cd" id="com_cd" maxlength="2" size="2" required ></td>
                                        </tr>
                                        <tr>                                            
                                            <th>Unit Code</th>
                                            <td><input type="text" name="unit_cd" id="unit_cd" maxlength="2" size="2" required ></td>
                                        </tr>
                                        <tr>
                                            <th>From Date</th>
                                            <td><input type="text" name="gst_frdt" id="gst_frdt" readonly required maxlength="15" size="15" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th>To Date</th>
                                            <td><input type="text" name="gst_todt" id="gst_todt" readonly required maxlength="15" size="15" style="text-transform: uppercase"></td>
                                        </tr>
                                        <tr>
                                            <th valign="top">INVOICE TYPE</th>
                                            <td>
                                                <select name="inv_type[]" id="inv_type" required multiple>
                                                    <option value=" " selected>Tax Invoice</option>
                                                    <option value="D">Delivary Challan</option>
                                                    <option value="F">57f4 Challan</option>
                                                    <option value="R">RCM Invoice</option>
                                                </select>
                                                For Multiple Selection : Use <b>"Ctrl + Click"</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>File Name</th>
                                            <td>
                                                <select name="file_name" id="file_name" required>
                                                    <option value="b2b">b2b</option>
                                                    <option value="b2cl">b2cl</option>
                                                    <option value="b2cs">b2cs</option>
                                                    <option value="cdnr">cdnr</option>
                                                    <option value="cdnur">cdnur</option>
                                                    <option value="exp">exp</option>
                                                    <option value="at">at</option>
                                                    <option value="atadj">atadj</option>
                                                    <option value="exemp">exemp</option>
                                                    <option value="hsn">hsn</option>
                                                    <option value="docs">docs</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr><td colspan="4"><hr></td></tr>
                                    </table>
                                    <table cellpadding="1">                    
                                        <tr>  
                                            <td align="center">
                                                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                                                <input type="reset" name="clear" value="Clear" class="btn btn-primary">
                                            </td>
                                        </tr>
                                    </table>                              
                                </div>
                            </div>
                        </div>   
                    </form>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->  
        <?php require_once('includes/dash_footer.php'); ?> 
    </body>
</html>
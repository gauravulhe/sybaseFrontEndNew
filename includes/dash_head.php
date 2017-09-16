<meta charset="UTF-8">
<title>NECO India | Dashboard</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- Morris chart -->
<link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
<!-- jvectormap -->
<link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
<!-- fullCalendar -->
<link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
<!-- Daterange picker -->
<link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<!-- bootstrap wysihtml5 - text editor -->
<link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<link rel="icon" type="image/png" sizes="32x32" href="img/favicon.png">

<!-- date picker start -->

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">

<!-- datepicker -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- datepicker -->

<style type="text/css">
    body{
        background-color: lightgray;
        /*background-image: url('img/neco_logo.png');*/
        background-repeat: no-repeat;
        background-position: relative;
    }

    .content {
        padding: 20px 15px;
        /*background: #a59b9b;*/
        /*background: #a29786;*/
        /*background: #cfddee;*/
        /*background-image: url('img/neco_logo.png');
        background-repeat: no-repeat;
        background-position: center;*/
    }
</style>

<script type="text/javascript">
    //paste this code under the head tag or in a separate js file.
    // Wait for window load
    $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");
    });    
</script>
<script>
    $( function() {
        $( "#com_sst_dt" ).datepicker({
            dateFormat: 'dd-mm-y',
            changeMonth: true,
            changeYear: true
        });
    } );
    $( function() {
        $( "#com_cst_dt" ).datepicker({
            dateFormat: 'dd-mm-y',
            changeMonth: true,
            changeYear: true
        });
    } );
    $( function() {
        $( "#sup_sstdt" ).datepicker({
            dateFormat: 'dd-mm-y',
            changeMonth: true,
            changeYear: true
        });
    } );
    $( function() {
        $( "#sup_cstdt" ).datepicker({
            dateFormat: 'dd-mm-y',
            changeMonth: true,
            changeYear: true
        });
    } );
    $( function() {
        $( "#mat_opdate" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    } );  
    $( function() {
        $( "#sub_opbaldt" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    } );      
    $( function() {
        $( "#acm_baldt" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    } );      
    $( function() {
        $( "#bkm_baldt" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    } );      
    $( function() {
        $( "#req_dt" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            onClose: function ()
            {
                this.focus();
            }
        });
    } );
    $( function() {
        $( "#poh_po_dt" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            minDate: 0,
            maxDate: 0,
            onClose: function ()
            {
                this.focus();
            }
        });
    } );
    $( function() {
        $( "#poh_exp_dt" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            minDate: 0,
            onClose: function ()
            {
                this.focus();
            }
        });
    } ); 
    $( function() {
        $( "#grh_dt" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            maxDate: 0,
            onClose: function ()
            {
                this.focus();
            }
        });
    } );  
    $( function() {
        $( "#grh_chal_dt" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            minDate: -30,
            maxDate: 0,
            onClose: function ()
            {
                this.focus();
            }
        });
    } ); 
    $( function() {
        $( "#grh_gate_dt" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            minDate: -4,
            maxDate: 0,
            onClose: function ()
            {
                this.focus();
            }
        });
    } );      
    $( function() {
        $( "#chal_bil_frdt" ).datepicker({
            dateFormat: 'yymmdd',
            changeMonth: true,
            changeYear: true
        });
    } );     
    $( function() {
        $( "#chal_bil_todt" ).datepicker({
            dateFormat: 'yymmdd',
            changeMonth: true,
            changeYear: true
        });
    } ); 

    $( function() {
        $( "#gst_frdt" ).datepicker({
            dateFormat: 'yymmdd',
            changeMonth: true,
            changeYear: true
        });
    } ); 

    $( function() {
        $( "#gst_todt" ).datepicker({
            dateFormat: 'yymmdd',
            changeMonth: true,
            changeYear: true
        });
    } ); 

    $( function() {
        $( "#gpa_dt" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true
        });
    } ); 

    $( function() {
        $( "#gpa_ref_dt" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true
        });
    } ); 
    
    $( function() {
        $( "#gpd_expected_dt" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true
        });
    } ); 


    $( function() {
        $( "#tml_gst_frdt" ).datepicker({
            dateFormat: 'yymmdd',
            changeMonth: true,
            changeYear: true
        });
    } ); 


    $( function() {
        $( "#tml_gst_todt" ).datepicker({
            dateFormat: 'yymmdd',
            changeMonth: true,
            changeYear: true
        });
    } );

    $( function() {
        $( "#fr_gp_dt" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    } ); 

    $( function() {
        $( "#to_gp_dt" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    } ); 

    $( function() {
        $( "#fr_grd_dt" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    } ); 

    $( function() {
        $( "#to_po_dt" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    } );  


    $( function() {
        $( "#fr_grd_dt" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    } ); 

    $( function() {
        $( "#to_grd_dt" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    } ); 

    $( function() {
        $( "#fr_poh_po_dt" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    } ); 

    $( function() {
        $( "#to_poh_po_dt" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    } );  

    $( function() {
        $( "#fr_grh_dt" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    } ); 

    $( function() {
        $( "#to_grh_dt" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    } ); 

    $( function() {
        $( "#fr_pgd_grn_dt" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    } ); 

    $( function() {
        $( "#to_pgd_grn_dt" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    } ); 

    $( function() {
        $( "#iss_dt" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            minDate: -2,
            onClose: function ()
            {
                this.focus();
            }
        });
    } );   


    $( function() {
        $( "#iss_ref_dt" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true
        });
    } );  

    $( function() {
        $( "#fr_iss_dt" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    } ); 

    $( function() {
        $( "#to_iss_dt" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    } );   
</script>

<!-- datepicker ends -->

<script type="text/javascript">
    window.onload = function() {
      var input = document.getElementById("comm_pass").focus();
    }

    // prevent form submit using enter key 
    $(document).ready(function() {
      $(window).keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
        }
      });
    });

    // hide error and success message dive after 5 sec
    setTimeout(function() {
      $(".message").fadeOut().empty();
    }, 7000);

    // check input is number only
    function CheckInputNumFormat(value){
        if (value != '' && isNaN(value)) {
            alert("Please enter number only.");
        }
    }

    // change format of input to decimal 
    function setNumberDecimal(data) {
        if (data.value != '') {
            data.value = parseFloat(data.value).toFixed(2);
        }else{
            data.value = 0.00;
        }
    }

    // refresh page
    function pageRefresh(){
        window.location = window.location.href;
    }

</script>

<!-- Autocomplete start -->

<script>
    $(function() {

        $( "#poh_po_type" ).autocomplete({
            source: 'includes/view_details.php?fldType=int&fldName=cod_code&tblName=codecat&cdPrfx=15'
        });

        $( "#poh_supcd" ).autocomplete({
            source: 'includes/view_details.php?fldType=str&fldName=sup_supcd&tblName=supcat'
        });

        $( "#poh_stax_cd" ).autocomplete({
            source: 'includes/view_details.php?fldType=int&fldName=cod_code&tblName=codecat&cdPrfx=1'
        });

        $( "#poh_excise_cd" ).autocomplete({
            source: 'includes/view_details.php?fldType=int&fldName=cod_code&tblName=codecat&cdPrfx=2'
        });

        $( "#poh_pmnt_terms" ).autocomplete({
            source: 'includes/view_details.php?fldType=int&fldName=cod_code&tblName=codecat&cdPrfx=13'
        });

        $( "#grh_unloader" ).autocomplete({
            source: 'includes/view_details.php?fldType=int&fldName=cod_code&tblName=codecat&cdPrfx=5'
        });

        $( "#grh_agent" ).autocomplete({
            source: 'includes/view_details.php?fldType=int&fldName=cod_code&tblName=codecat&cdPrfx=3'
        });

        $( "#pod_item" ).autocomplete({
            source: 'includes/view_details.php?fldType=int&fldName=itm_item&tblName=itmcat'
        });
        
    });
</script>

<!-- Autocomplete ends -->

<script type="text/javascript">

    // validation for company password check
    function CheckComPass(){
        var ComPass = document.getElementById('comm_pass');
    	var FrmNm = document.getElementById('frm_nm');
        if(ComPass.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    // unset loading image
                    document.getElementById("ComPassErrorSpan").innerHTML = '';
                    var value = xmlhttp.responseText;
                    if(value.length < 1)
                    {
                        document.getElementById('ComPassErrorSpan').innerHTML="Invalid Password";
                        ComPass.focus();
                    }
                    else
                    {
                        if (value == 'e') {
                            $('#upd').removeClass('btn btn-success');
                            $('#upd').addClass('btn btn-default');
                            $('#del').removeClass('btn btn-success');
                            $('#del').addClass('btn btn-default');
                            $('#prnt').removeClass('btn btn-success');
                            $('#prnt').addClass('btn btn-default');
                            $('#can').removeClass('btn btn-success');
                            $('#can').addClass('btn btn-default');

                            $('#app').removeClass('btn btn-success');
                            $('#app').addClass('btn btn-default');

                            $('#ent').removeClass('btn btn-default');
                            $('#ent').addClass('btn btn-success');  
                        }else if (value == 'u') {
                            $('#ent').removeClass('btn btn-success');
                            $('#ent').addClass('btn btn-default');
                            $('#del').removeClass('btn btn-success');
                            $('#del').addClass('btn btn-default');
                            $('#prnt').removeClass('btn btn-success');
                            $('#prnt').addClass('btn btn-default');
                            $('#can').removeClass('btn btn-success');
                            $('#can').addClass('btn btn-default');

                            $('#app').removeClass('btn btn-success');
                            $('#app').addClass('btn btn-default');

                            $('#upd').removeClass('btn btn-default');
                            $('#upd').addClass('btn btn-success');
                        }else if (value == 'd') {
                            $('#ent').removeClass('btn btn-success');
                            $('#ent').addClass('btn btn-default');                            
                            $('#upd').removeClass('btn btn-success');
                            $('#upd').addClass('btn btn-default');
                            $('#prnt').removeClass('btn btn-success');
                            $('#prnt').addClass('btn btn-default');
                            $('#can').removeClass('btn btn-success');
                            $('#can').addClass('btn btn-default');

                            $('#app').removeClass('btn btn-success');
                            $('#app').addClass('btn btn-default');                           

                            $('#del').removeClass('btn btn-default');
                            $('#del').addClass('btn btn-success');
                        }else if (value == 'p') {
                            $('#ent').removeClass('btn btn-success');
                            $('#ent').addClass('btn btn-default');                            
                            $('#upd').removeClass('btn btn-success');
                            $('#upd').addClass('btn btn-default');
                            $('#del').removeClass('btn btn-success');
                            $('#del').addClass('btn btn-default');
                            $('#can').removeClass('btn btn-success');
                            $('#can').addClass('btn btn-default');

                            $('#app').removeClass('btn btn-success');
                            $('#app').addClass('btn btn-default');

                            $('#prnt').removeClass('btn btn-default');
                            $('#prnt').addClass('btn btn-success');
                        }else if (value == 'c') {
                            $('#ent').removeClass('btn btn-success');
                            $('#ent').addClass('btn btn-default');                            
                            $('#upd').removeClass('btn btn-success');
                            $('#upd').addClass('btn btn-default');
                            $('#del').removeClass('btn btn-success');
                            $('#del').addClass('btn btn-default');

                            $('#prnt').removeClass('btn btn-success');
                            $('#prnt').addClass('btn btn-default');

                            $('#app').removeClass('btn btn-success');
                            $('#app').addClass('btn btn-default');

                            $('#can').removeClass('btn btn-default');
                            $('#can').addClass('btn btn-success');
                        }else if (value == 'a') {
                            $('#ent').removeClass('btn btn-success');
                            $('#ent').addClass('btn btn-default');                            
                            $('#upd').removeClass('btn btn-success');
                            $('#upd').addClass('btn btn-default');
                            $('#del').removeClass('btn btn-success');
                            $('#del').addClass('btn btn-default');

                            $('#prnt').removeClass('btn btn-success');
                            $('#prnt').addClass('btn btn-default');

                            $('#can').removeClass('btn btn-success');
                            $('#can').addClass('btn btn-default');

                            $('#app').removeClass('btn btn-default');
                            $('#app').addClass('btn btn-success');
                        }

                        document.getElementById('ComPassErrorSpan').innerHTML="";

                        $('#cmp_cd').removeAttr('readonly');
                        $('#unt_cd').removeAttr('readonly');
                        $('#cmp_cd').focus();
                        $('#cod_prefix').removeAttr('readonly');
                        $('#com_com').removeAttr('readonly');
                        $('#dep_prefix').removeAttr('readonly');
                        $('#esup_supcd').removeAttr('readonly');
                        $('#gen_accd').removeAttr('readonly');

                        if (value == 'u') {
                            $('table#grn_table tr#grn_edit_tr').remove();
                            $("#toggle_grn_form1").removeClass("hide");
                            $("#grn_edit_tr").addClass("hide");
                            $("#grn_update_tr").removeClass("hide");
                            $('#grh_no').removeAttr('readonly');
                            $('#gpa_no').removeAttr('readonly');
                            $('#poh_po_dt').datepicker('option', 'minDate', -365);
                        }else if (value == 'e') {
                            $('table#grn_table tr#grn_update_tr').remove();
                            $('#grh_poh_po_no').removeAttr('readonly');
                            $('#grh_poh_po_no').removeAttr('disabled');
                            $("#grn_update_tr").addClass("hide");
                            $("#grn_edit_tr").removeClass("hide");
                        }else if (value == 'd') {
                            $('#gpa_no').removeAttr('readonly');
                        }else if (value == 'a') {
                            $('#gpa_no').removeAttr('readonly');
                        }else if (value == 'b') {
                            $('#iss_dt').datepicker('option', 'minDate', -365);
                        }
                    }
                }
            }
            // Set here the image before sending request
            document.getElementById("ComPassErrorSpan").innerHTML = '<div style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.7;"><img src="img/process.gif" style="margin: 400px 0 0 475px;"/></div>'; 
            xmlhttp.open("GET","includes/inv_ctlg_cmp_pass_chck.php?q="+ComPass.value+"&u="+FrmNm.value,true);
            xmlhttp.send();
        }else{
            ComPass.focus();
        }
    }

    // validation for company code check
    function CheckComCd(){
        var ComCd = document.getElementById('com_com');

        if(ComCd.value != "")
        {

            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    // Unset here the image before sending request
                    document.getElementById("ComCdErrorSpan").innerHTML = '';
                    var value = xmlhttp.responseText;
                    if(value.length < 1)
                    {
                        document.getElementById('ComCdErrorSpan').innerHTML="Invalid Company Code";
                        document.getElementById('ComCdName').innerHTML="";
                        ComCd.value="";
                        ComCd.focus();
                    }
                    else
                    {
                        document.getElementById('ComCdErrorSpan').innerHTML="";
                        document.getElementById('ComCdName').innerHTML=value;
                        $("#itm_item").removeAttr('readonly');
                        $("#sup_supcd").removeAttr('readonly');
                        $("#mat_unit").removeAttr('readonly');
                    }
                }
              }
            // Set here the image before sending request
            document.getElementById("ComCdErrorSpan").innerHTML = '<div style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.7;"><img src="img/process.gif" style="margin: 400px 0 0 475px;"/></div>'; 
            xmlhttp.open("GET","includes/cmp_cd_chck.php?q="+ComCd.value,true);
            xmlhttp.send();
        }
    }


</script>


<!-- 
////////////////////////////////////////////////////////////////////////////////////////////

                                    Invac section start

//////////////////////////////////////////////////////////////////////////////////////////// -->


<script type="text/javascript">

    /////////////////////////////////////////////////////////////////////////////////////////

    // validation for company code and unit code check
    function CheckCmpCdUntCd(){
        var CmpCd = document.getElementById('cmp_cd');
    	var UntCd = document.getElementById('unt_cd');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');

        if(CmpCd.value != "" && UntCd.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    // unset loading image
                    document.getElementById("CmpUntCdErrorSpan").innerHTML = '';
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if(data.a != '')
                    {
                        if ((data.passActn == 'u' || data.passActn == 'q') && FrmNm.value == 'comcat') {
                            $("input").removeAttr('readonly');
                            document.getElementById("com_name").value=data.c;
                            document.getElementById("com_uname").value=data.d;                        
                            document.getElementById("com_add1").value=data.e;
                            document.getElementById("com_add2").value=data.f;
                            document.getElementById("com_add3").value=data.g;
                            document.getElementById("com_sst_no").value=data.h;
                            document.getElementById("com_sst_dt").value=data.i;
                            document.getElementById("com_cst_no").value=data.j;
                            document.getElementById("com_cst_dt").value=data.k;
                            document.getElementById("com_gram").value=data.l;
                            document.getElementById("com_tel").value=data.m;
                            document.getElementById("com_collectorate").value=data.n;
                            document.getElementById("com_range").value=data.o;
                            document.getElementById("com_division").value=data.p;
                            document.getElementById("com_pla_no").value=data.q;
                            document.getElementById("com_cex_no").value=data.r;
                            document.getElementById("com_pf_no").value=data.s;
                            document.getElementById("com_ecc_no").value=data.t;
                            document.getElementById("com_mast").value=data.u;
                            document.getElementById("com_dbf").value=data.v;
                            document.getElementById("com_tin_no").value=data.w;
                            document.getElementById("com_ctin_no").value=data.x;
                            document.getElementById("com_stct_cd").value=data.y;
                            document.getElementById("com_gstin_no").value=data.z;
                            document.getElementById('CmpUntCdErrorSpan').innerHTML="Record Found";

                        }else if(data.passActn == 'd' && FrmNm.value == 'comcat'){
                            var strconfirm = confirm("Are you sure you want to delete?");
                            if (strconfirm == true) {
                                xmlhttp.open("GET","includes/inv_record_del.php?q="+CmpCd.value+"&u="+UntCd.value+"&FrmNm="+FrmNm.value+"&ComPass="+ComPass.value,true);
                                xmlhttp.send();
                                alert("Record Deleted Successfully.");
                                window.location.reload();
                            }
                        }if(data.passActn == 'e' && FrmNm.value == 'comcat'){
                            document.getElementById('CmpUntCdErrorSpan').innerHTML="Entry Already Exists.";
                            UntCd.focus();
                        }
                        
                    }
                    else
                    {
                        if(data.passActn == 'e' && FrmNm.value == 'comcat'){
                            document.getElementById('CmpUntCdErrorSpan').innerHTML="New Entry";
                            document.getElementById("com_name").value="";
                            document.getElementById("com_uname").value="" 
                            document.getElementById("com_add1").value="";
                            document.getElementById("com_add2").value="";
                            document.getElementById("com_add3").value="";
                            document.getElementById("com_sst_no").value="";
                            document.getElementById("com_sst_dt").value="";
                            document.getElementById("com_cst_no").value="";
                            document.getElementById("com_cst_dt").value="";
                            document.getElementById("com_gram").value="";
                            document.getElementById("com_tel").value="";
                            document.getElementById("com_collectorate").value="";
                            document.getElementById("com_range").value="";
                            document.getElementById("com_division").value="";
                            document.getElementById("com_pla_no").value="";
                            document.getElementById("com_cex_no").value="";
                            document.getElementById("com_pf_no").value="";
                            document.getElementById("com_ecc_no").value="";
                            document.getElementById("com_mast").value="";
                            document.getElementById("com_dbf").value="";
                            document.getElementById("com_tin_no").value="";
                            document.getElementById("com_ctin_no").value="";
                            document.getElementById("com_stct_cd").value="";
                            document.getElementById("com_gstin_no").value="";
                            //$("#com_name").removeAttr('readonly');
                            $("input").removeAttr('readonly');
                        }else{
                            document.getElementById('CmpUntCdErrorSpan').innerHTML="Invalid Input";
                            UntCd.focus();
                            $("input").attr('readonly');
                        }
                    }
                }
            }

            // Set here the image before sending request
            document.getElementById("CmpUntCdErrorSpan").innerHTML = '<div style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.7;"><img src="img/process.gif" style="margin: 400px 0 0 475px;"/></div>'; 
            xmlhttp.open("GET","includes/inv_ctlg_cmp_unt_cd_chck.php?q="+CmpCd.value+"&u="+UntCd.value+"&FrmNm="+FrmNm.value+"&ComPass="+ComPass.value,true);
            
            xmlhttp.send();
        }
    }


    // // validation for company form mandatory fields
    // function RmvAttrComFrmFldsComUnm(){
    //     var ComNm = document.getElementById('com_name');
    //     if (ComNm.value.trim() != "") {
    //         $("#com_uname").removeAttr('readonly');
    //     }
    // }

    // function RmvAttrComFrmFldsComAdd(){
    //     var ComUnm = document.getElementById('com_uname');
    //     if (ComUnm.value.trim() != "") {
    //         $("#com_add1").removeAttr('readonly');
    //     }
    // }

    // function RmvAttrComFrmFldsComAll(){
    //     var ComAdd = document.getElementById('com_add1');
    //     if (ComAdd.value.trim() != "") {
    //         $("input").removeAttr('readonly');
    //     }
    // }


    /////////////////////////////////////////////////////////////////////////////////////////

    // validation for General code catalog
    function ChckFrmFldsPrfxCode(){
        var CdPrfx = document.getElementById('cod_prefix');
        var Cd = document.getElementById('cod_code');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');

        if(CdPrfx.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if(value.length >= 1)
                    {
                        //alert(data.passActn);
                        document.getElementById("cod_code").value=data.a;
                        $("input").removeAttr('readonly');
                        if(data.passActn == 'e'){
                            document.getElementById('CdEntCdErrorSpan').innerHTML="New Entry";                            
                        }
                    }
                    else
                    {
                        if(data.passActn == 'u'){
                            document.getElementById('CdEntCdErrorSpan').innerHTML="Duplicate Entry";                            
                        }
                        document.getElementById("cod_code").value="";
                        document.getElementById("cod_desc").value="";
                        $("input").removeAttr('readonly');
                    }
                }
              }

                xmlhttp.open("GET","includes/inv_ctlg_gnrl_prfx_cd_chck.php?q="+CdPrfx.value+"&u="+Cd.value+"&FrmNm="+FrmNm.value+"&ComPass="+ComPass.value,true);
                xmlhttp.send();
        }
    }

    // validation for General code catalog
    function ChckFrmFldsCodeDesc(){
        var CdPrfx = document.getElementById('cod_prefix');
        var Cd = document.getElementById('cod_code');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');

        if(CdPrfx.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if(data.a != '')
                    {
                        if(data.passActn == 'e' && FrmNm.value == 'codent'){
                            document.getElementById('CdEntCdErrorSpan').innerHTML="Entry Already Exists.";
                            document.getElementById("cod_desc").value=data.a;
                        }else if(data.passActn == 'u' && FrmNm.value == 'codent') {
                            $("input").removeAttr('readonly');
                            document.getElementById("cod_desc").value=data.a;
                        }else if (data.passActn == 'd' && FrmNm.value == 'codent' && Cd.value != ''){
                            var strconfirm = confirm("Are you sure you want to delete?");
                            if (strconfirm == true) {
                                xmlhttp.open("GET","includes/inv_record_del.php?q="+CdPrfx.value+"&u="+Cd.value+"&FrmNm="+FrmNm.value+"&ComPass="+ComPass.value,true);
                                xmlhttp.send();
                                alert("Record Deleted Successfully.");
                                Cd.focus();
                                window.location.reload();
                            }
                        }
                    }
                    else if(data.a == '')
                    {
                        if(data.passActn == 'e' && FrmNm.value == 'codent'){
                            document.getElementById('CdEntCdErrorSpan').innerHTML="New Entry";
                            document.getElementById("cod_desc").value="";
                        }else if(data.passActn == 'u' && FrmNm.value == 'codent') {
                            document.getElementById('CdEntCdErrorSpan').innerHTML="Entry does not exists.";
                            $('#cod_desc').hide();
                            document.getElementById("cod_desc").value="";
                        }
                    }
                }
              }
                xmlhttp.open("GET","includes/inv_ctlg_gnrl_prfx_cd_chck.php?q="+CdPrfx.value+"&u="+Cd.value+"&FrmNm="+FrmNm.value+"&ComPass="+ComPass.value,true);
                xmlhttp.send();
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////


    // validation for Material catalogue item not check
    function CheckMtrlItmNo(){
        var ItmNo = document.getElementById('itm_item');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');       

        if(ItmNo.value != "")
            {
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp=new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function()
                {   
                  if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        var value = xmlhttp.responseText;
                        data = JSON.parse(value);

                        if (data.passActn == 'e') {
                            if(ItmNo.value != "" && ItmNo.value.length != 7)
                            {
                                document.getElementById('MtrlItmNoErrorSpan').innerHTML="ITEM CODE MUST BE SEVEN DIGIT...!!!";
                                $("#itm_item").focus();
                            }else if(data.itm_item == ''){
                                document.getElementById('MtrlItmNoErrorSpan').innerHTML="";
                                $("#itm_desc").removeAttr('readonly');
                                $("#itm_part").removeAttr('readonly');
                                $("#itm_uom").removeAttr('readonly');
                            }else if(data.itm_item != ''){
                                document.getElementById('MtrlItmNoErrorSpan').innerHTML="Entry Already Exists.";
                                ItmNo.focus();
                            }
                        }else if (data.passActn == 'u') {
                            if(value.length >= 1)
                            {

                                if(ItmNo.value != "" && ItmNo.value.length != 7)
                                {
                                    document.getElementById('MtrlItmNoErrorSpan').innerHTML="ITEM CODE MUST BE SEVEN DIGIT...!!!";
                                    $("#itm_item").focus();
                                }else{
                                    document.getElementById('MtrlItmNoErrorSpan').innerHTML="";
                                
                                    if (data.itm_item != "") {
                                        document.getElementById('MtrlItmNoErrorSpan').innerHTML="";
                                        $("#itm_desc").removeAttr('readonly');
                                        $("#itm_part").removeAttr('readonly');
                                        $("#itm_uom").removeAttr('readonly');
                                        document.getElementById("itm_desc").value=data.itm_desc;
                                        document.getElementById("itm_part").value=data.itm_part;
                                        document.getElementById("itm_uom").value=data.itm_uom;
                                        document.getElementById("itm_crossitm").value=data.itm_crossitm;
                                        document.getElementById("itm_modvat").value=data.itm_modvat;
                                        document.getElementById("itm_type").value=data.itm_type;
                                        document.getElementById("itm_cr_days").value=data.itm_cr_days;
                                        document.getElementById("itm_del_tag").value=data.itm_del_tag;
                                    }else{
                                        document.getElementById('MtrlItmNoErrorSpan').innerHTML="Invalid Item No.";
                                        $("#itm_item").focus();
                                        document.getElementById("itm_desc").value="";
                                        document.getElementById("itm_part").value="";
                                        document.getElementById("itm_uom").value="";
                                        document.getElementById("itm_crossitm").value="";
                                        document.getElementById("itm_modvat").value="";
                                        document.getElementById("itm_type").value="";
                                        document.getElementById("itm_cr_days").value="";
                                        document.getElementById("itm_del_tag").value="";
                                    }
                                }
                            }
                        }else if (data.passActn == 'd' && FrmNm.value == 'itemcat' && ItmNo.value != '') {
                            var strconfirm = confirm("Are you sure you want to delete?");
                            if (strconfirm == true) {
                                xmlhttp.open("GET","includes/inv_record_del.php?q="+ItmNo.value+"&FrmNm="+FrmNm.value+"&ComPass="+ComPass.value,true);
                                xmlhttp.send();
                                document.getElementById('MtrlItmNoErrorSpan').innerHTML="Item Deleted Successfully.";
                                alert("Record Deleted Successfully.");
                                ItmNo.focus();
                                window.location.reload();
                            }
                        }
                    }
                  }                  
                    xmlhttp.open("GET","includes/inv_ctlg_cmp_mtrl_itm_no_chck.php?q="+ItmNo.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value,true);
                    xmlhttp.send();
            }
    }


    // validation for unit of measurment check
    function CheckUntOfMsrmntCd(){
        var ComCd = document.getElementById('itm_uom');

        if(ComCd.value != "")
        {

            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    if(value.length < 1)
                    {
                        document.getElementById('UomErrorSpan').innerHTML="Invalid Unit Of Measurment";
                        document.getElementById('UomCdName').innerHTML="";
                        ComCd.focus();
                    }
                    else
                    {
                        document.getElementById('UomErrorSpan').innerHTML="";
                        document.getElementById('UomCdName').innerHTML=value;
                        $("#itm_crossitm").removeAttr('readonly');
                        $("#itm_modvat").removeAttr('readonly');
                        $("#itm_type").removeAttr('readonly');
                    }
                }
              }
            xmlhttp.open("GET","includes/cmp_unt_msrmnt_chck.php?q="+ComCd.value,true);
            xmlhttp.send();
        }
    }

    // validation for Item type and credit days check
    function CheckItmTypCrdtDys(){
        var ItmTyp = document.getElementById('itm_type');
        var val = ItmTyp.value;

        if(val == 'X' || val == 'A' || val == 'B' || val == 'C')
        {
            document.getElementById('ItmTypErrorSpan').innerHTML="";
            if (val == 'X') {
                document.getElementById('itm_cr_days').value="0";
            }else if (val == 'A') {
                document.getElementById('itm_cr_days').value="30";
            }else if (val == 'B') {
                document.getElementById('itm_cr_days').value="60";
            }else if (val == 'C') {
                document.getElementById('itm_cr_days').value="90";
            }
            $("#itm_del_tag").removeAttr('readonly');
        }else{
            document.getElementById('ItmTypErrorSpan').innerHTML="Invalid Item Type ..Enter In 'X', 'A', 'B' or 'C' ...!!";
            $("#itm_type").focus();
        }
    }

    //////////////////////////////////////////////////////////////////////////////////

     // validation for Depart./Cost Center Catalogue dep_code check
    function CheckDeptCostCd(){
        var PrfxCd = document.getElementById('dep_prefix');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');   

        if(PrfxCd.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);

                    if(value.length < 1)
                    {
                        document.getElementById('dep_cd').value="";
                    }
                    else
                    {
                        if (data.passActn == 'e') {
                            document.getElementById('dep_cd').value=data.a;
                            $("#dep_cd").removeAttr('readonly');
                        }else if(data.passActn == 'u'){
                            document.getElementById('dep_cd').value="";
                            $("#dep_cd").removeAttr('readonly');
                        }else if(data.passActn == 'd'){
                            document.getElementById('dep_cd').value="";
                            $("#dep_cd").removeAttr('readonly');
                        }
                    }
                }
            }
            xmlhttp.open("GET","includes/cmp_dept_cost_cd_chck.php?q="+PrfxCd.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();
        }
    }

    // validation for Depart./Cost Center Catalogue dep_code check
    function CheckDeptCostAvalblCd(){
        var PrfxCd = document.getElementById('dep_prefix');
        var DeptCd = document.getElementById('dep_cd');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');   
        
        if(DeptCd.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    //alert(data.a);
                    if (data.passActn == 'e') {
                        if(data.a == false)
                        {
                            document.getElementById('DeptCostCdErrorSpan').innerHTML="Code Available";
                            $("#dep_desc").removeAttr('readonly');
                        }
                        else
                        {
                            document.getElementById('DeptCostCdErrorSpan').innerHTML="Code Not Available";
                            $("#dep_cd").focus();
                        }
                    }else if (data.passActn == 'u') {
                        if(data.a != false)
                        {
                            document.getElementById('DeptCostCdErrorSpan').innerHTML="Code Available";
                            $("#dep_desc").removeAttr('readonly');
                            document.getElementById('dep_desc').value=data.b;
                        }
                        else
                        {
                            document.getElementById('DeptCostCdErrorSpan').innerHTML="Code Not Available";
                            $("#dep_cd").focus();
                            document.getElementById('dep_desc').value="";
                        }
                    }else if (data.passActn == 'd' && FrmNm.value == 'deptent' && PrfxCd.value != '' && DeptCd.value != '') {
                            var strconfirm = confirm("Are you sure you want to delete?");
                            if (strconfirm == true) {
                                xmlhttp.open("GET","includes/inv_record_del.php?q="+PrfxCd.value+"&u="+DeptCd.value+"&FrmNm="+FrmNm.value+"&ComPass="+ComPass.value,true);
                                xmlhttp.send();
                                document.getElementById('DeptCostCdErrorSpan').innerHTML="Record Deleted Successfully.";
                                alert("Record Deleted Successfully.");
                                window.location.reload();
                            }
                    }
                }
              }
              
            xmlhttp.open("GET","includes/cmp_dept_cost_cd_chck.php?t="+PrfxCd.value+"&u="+DeptCd.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////

    // validation for Ecc Master ( Supplier ) Catalogue sup code check
    function CheckEsupCd(){
        var EsupCd = document.getElementById('esup_supcd');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');   

        if(EsupCd.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    //alert(data.a);
                    if(data.a != false)
                    {
                        if (data.passActn == 'e') {
                            document.getElementById('EsupCdErrorSpan').innerHTML="Record Already Exists.";
                            EsupCd.focus();
                        }else if(data.passActn == 'u'){
                            document.getElementById('EsupCdErrorSpan').innerHTML="";
                            $("#esup_name").removeAttr('readonly');
                            $("#esup_eccno").removeAttr('readonly');
                            document.getElementById('esup_name').value=data.b;
                            document.getElementById('esup_eccno').value=data.c;
                        }else if(data.passActn == 'd' && FrmNm.value == 'supeccmst' && EsupCd.value != ''){
                                var strconfirm = confirm("Are you sure you want to delete?");
                                if (strconfirm == true) {

                                    xmlhttp.open("GET","includes/inv_record_del.php?q="+EsupCd.value+"&FrmNm="+FrmNm.value+"&ComPass="+ComPass.value,true);
                                    document.getElementById('EsupCdErrorSpan').innerHTML="Record Deleted Successfully.";
                                    xmlhttp.send();
                                    document.getElementById('esup_supcd').value="";
                                    alert("Record Deleted Successfully.");
                                }
                        }
                    }
                    else
                    {
                        if (data.passActn == 'e') {
                            document.getElementById('EsupCdErrorSpan').innerHTML="";
                            $("#esup_name").removeAttr('readonly');
                            $("#esup_eccno").removeAttr('readonly');
                        }else if(data.passActn == 'u'){
                            document.getElementById('EsupCdErrorSpan').innerHTML="Record Not Found";
                            EsupCd.focus();
                            document.getElementById('esup_name').value="";
                            document.getElementById('esup_eccno').value="";
                        }else if(data.passActn == 'd'){
                            document.getElementById('dep_cd').value="";
                            $("#dep_cd").removeAttr('readonly');
                        }

                    }
                }
            }
            xmlhttp.open("GET","includes/sup_ecc_mstr_cd_chck.php?q="+EsupCd.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////

    // validation for supplier catalogue code check
    function CheckSupCatCd(){
        var SupCd = document.getElementById('sup_supcd');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');

        if(SupCd.value != "" && SupCd.value.length == 4)
        {
            document.getElementById('SupCdErrorSpan').innerHTML="";
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if(data.a != "")
                    {
                        document.getElementById("sup_supcd").value=data.a;
                        document.getElementById("sup_name").value=data.b;
                        document.getElementById("sup_add1").value=data.c;
                        document.getElementById("sup_add2").value=data.d;
                        document.getElementById("sup_add3").value=data.e;
                        document.getElementById("sup_sstno").value=data.f;
                        document.getElementById("sup_sstdt").value=data.g;
                        document.getElementById("sup_cstno").value=data.h;
                        document.getElementById("sup_cstdt").value=data.i;

                        document.getElementById("sup_tinno").value=data.k;
                        document.getElementById("sup_ctinno").value=data.l;
                        document.getElementById("sup_panno").value=data.m;
                        document.getElementById("sup_email1").value=data.n;
                        document.getElementById("sup_email2").value=data.o;
                        document.getElementById("sup_website").value=data.p;
                        document.getElementById("sup_phone_no").value=data.q;
                        document.getElementById("sup_fax_no").value=data.r;
                        document.getElementById("sup_bank_name1").value=data.s;
                        document.getElementById("sup_bank_acct1").value=data.t;
                        document.getElementById("sup_bank_name2").value=data.u;
                        document.getElementById("sup_bank_acct2").value=data.v;
                        document.getElementById("sup_bank_name3").value=data.w;
                        document.getElementById("sup_bank_acct3").value=data.x;
                        document.getElementById("sup_bank_cd1").value=data.y;
                        document.getElementById("sup_bank_ifsc").value=data.z;
                        document.getElementById("sup_state").value=data.A;
                        document.getElementById("sup_city").value=data.B;
                        document.getElementById("sup_stct_cd").value=data.C;
                        document.getElementById("sup_gstin_no").value=data.D;

                        if (data.passActn == 'e' && FrmNm.value == 'supcat') {
                            document.getElementById('SupCdErrorSpan').innerHTML="Duplicate Entry";
                            SupCd.focus();
                        }else if (data.passActn == 'u' && FrmNm.value == 'supcat') {
                            $("input").removeAttr('readonly');
                        }else if(data.passActn == 'q' && FrmNm.value == 'supcat'){
                            $("input").attr('readonly');
                        }else if(data.passActn == 'd' && FrmNm.value == 'supcat'){
                            var strconfirm = confirm("Are you sure you want to delete?");
                            if (strconfirm == true) {
                                xmlhttp.open("GET","includes/inv_record_del.php?q="+SupCd.value+"&FrmNm="+FrmNm.value+"&ComPass="+ComPass.value,true);
                                xmlhttp.send();
                                document.getElementById('SupCdErrorSpan').innerHTML="Record Deleted !";
                                alert("Record Deleted Successfully.");
                                window.location.reload();
                            }
                        }                        
                    }
                    else
                    {
                        document.getElementById("sup_name").value="";
                        document.getElementById("sup_add1").value="";
                        document.getElementById("sup_add2").value="";
                        document.getElementById("sup_add3").value="";
                        document.getElementById("sup_sstno").value="";
                        document.getElementById("sup_sstdt").value="";
                        document.getElementById("sup_cstno").value="";
                        document.getElementById("sup_cstdt").value="";
                        document.getElementById("sup_tinno").value="";
                        document.getElementById("sup_ctinno").value="";
                        document.getElementById("sup_panno").value="";
                        document.getElementById("sup_email1").value="";
                        document.getElementById("sup_email2").value="";
                        document.getElementById("sup_website").value="";
                        document.getElementById("sup_phone_no").value="";
                        document.getElementById("sup_fax_no").value="";
                        document.getElementById("sup_bank_name1").value="";
                        document.getElementById("sup_bank_acct1").value="";
                        document.getElementById("sup_bank_name2").value="";
                        document.getElementById("sup_bank_acct2").value="";
                        document.getElementById("sup_bank_name3").value="";
                        document.getElementById("sup_bank_acct3").value="";
                        document.getElementById("sup_bank_cd1").value="";
                        document.getElementById("sup_bank_ifsc").value="";
                        document.getElementById("sup_state").value="";
                        document.getElementById("sup_city").value="";
                        document.getElementById("sup_stct_cd").value="";
                        document.getElementById("sup_gstin_no").value="";
                        //$("#com_name").removeAttr('readonly');

                        if (data.passActn == 'e' && FrmNm.value == 'supcat') {
                            document.getElementById('SupCdErrorSpan').innerHTML="New Entry";
                            $("input").removeAttr('readonly');
                        }else if (data.passActn == 'u' && FrmNm.value == 'supcat') {
                            document.getElementById('SupCdErrorSpan').innerHTML="Not Found !";
                        }
                    }
                }
            }
            xmlhttp.open("GET","includes/inv_ctlg_cmp_sup_cd_chck.php?q="+SupCd.value+"&FrmNm="+FrmNm.value+"&ComPass="+ComPass.value,true);

            xmlhttp.send();
        }else{
            document.getElementById('SupCdErrorSpan').innerHTML="Invalid !";
            SupCd.focus();
            SupCd.value="";
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // validation for company code check for material master
    function CheckMatMastComCd(){
        var ComCd = document.getElementById('com_com');
        var UserComCd = document.getElementById('user_com_cd');

        if(ComCd.value != "" && (ComCd.value == UserComCd.value))
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    if(value.length < 1)
                    {
                        document.getElementById('ComCdErrorSpan').innerHTML="Invalid Company Code";
                        document.getElementById('ComCdName').innerHTML="";
                        ComCd.focus();
                    }
                    else
                    {
                        document.getElementById('ComCdErrorSpan').innerHTML="";
                        document.getElementById('ComCdName').innerHTML=value;
                        $("#itm_item").removeAttr('readonly');
                        $("#sup_supcd").removeAttr('readonly');
                        $("#mat_unit").removeAttr('readonly');
                    }
                }
              }
            xmlhttp.open("GET","includes/cmp_cd_chck.php?q="+ComCd.value,true);
            xmlhttp.send();
        }else if(ComCd.value != "" && (ComCd.value != UserComCd.value)){
            document.getElementById('ComCdErrorSpan').innerHTML="Invalid Company Code";
            document.getElementById('ComCdName').innerHTML="";
            ComCd.focus();
        }
    }


    // validation for company code and unit code check
    function CheckMatMastUntCd(){
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');

        if(ComCd.value != "" && UntCd.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    //alert(data.length);
                    if(data.com_uname != '')
                    {
                        document.getElementById('ComUntCdErrorSpan').innerHTML="";
                        document.getElementById('ComUntCdName').innerHTML=data.com_uname;
                        document.getElementById('ComCdName').innerHTML=data.com_name;
                        $("#mat_item").removeAttr('readonly');
                        $("#sub_accd").removeAttr('readonly');
                        $("#acm_accd").removeAttr('readonly');
                        $("#bkm_code").removeAttr('readonly');
                        $("#bud_yy").removeAttr('readonly');
                        $("#bud_mm").removeAttr('readonly');
                        $("#bud_accd").removeAttr('readonly');
                        $("#req_dt").removeAttr('disabled');
                        $("#poh_po_dt").removeAttr('disabled');
                        $("#poh_inq_no").removeAttr('readonly');
                        $("#poh_po_no").removeAttr('readonly');                       
                        $("#poh_fyr").removeAttr('readonly');
                        $("#iss_tc").removeAttr('readonly');
                        $("#iss_no").removeAttr('readonly');
                        $("#iss_srl").removeAttr('readonly');
                    }
                    else
                    {                        
                        document.getElementById('ComUntCdErrorSpan').innerHTML="Invalid Unit Code";
                        document.getElementById('ComUntCdName').innerHTML="";
                        UntCd.focus();
                    }
                }
              }
            xmlhttp.open("GET","includes/cmp_unt_cd_chck.php?q="+ComCd.value+"&u="+UntCd.value,true);
            xmlhttp.send();
        }
    }

    // validation for item code check
    function CheckMatMastItmCd(){
        var ItmCd = document.getElementById('mat_item');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');
        var UserComCd = document.getElementById('user_com_cd');
        var UserUntCd = document.getElementById('mat_unit');

        if(ItmCd.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    //alert(data.length);
                    if(data.itm_desc != '')
                    {
                        if(data.passActn == 'u' && (data.mat_item != false || data.mat_item != '')) {
                            document.getElementById('ComItmCdErrorSpan').innerHTML="";
                            document.getElementById('ComItmCdName').innerHTML=data.itm_desc;
                            document.getElementById('mat_uom').innerHTML=data.cod_desc;
                            $("#mat_minlev").removeAttr('readonly');
                            $("#mat_maxlev").removeAttr('readonly');
                            $("#mat_ordlev").removeAttr('readonly');
                            $("#mat_location").removeAttr('readonly');
                            $("#mat_abc").removeAttr('readonly');
                            $("#mat_typ").removeAttr('readonly');
                            $("#mat_accd").removeAttr('readonly');
                            $("#mat_opqty").removeAttr('readonly');
                            $("#mat_oprate").removeAttr('readonly');
                            $("#mat_opdate").removeAttr('readonly');
                            $("#mat_budg").removeAttr('readonly');
                        
                            document.getElementById('mat_minlev').value=data.mat_minlev;
                            document.getElementById('mat_maxlev').value=data.mat_maxlev;
                            document.getElementById('mat_ordlev').value=data.mat_ordlev;
                            document.getElementById('mat_location').value=data.mat_location;
                            document.getElementById('mat_abc').value=data.mat_abc;
                            document.getElementById('mat_typ').value=data.mat_typ;
                            document.getElementById('mat_accd').value=data.mat_accd;
                            document.getElementById('mat_opqty').value=data.mat_opqty;
                            document.getElementById('mat_oprate').value=data.mat_oprate;
                            document.getElementById('mat_opdate').value=data.mat_opdate;
                            document.getElementById('mat_budg').value=data.mat_budg;

                        }else if(data.passActn == 'u' && (data.mat_item == false || data.mat_item == '')){
                            document.getElementById('ComItmCdErrorSpan').innerHTML="Invalid Item Code";
                            ItmCd.focus();
                        }else if(data.passActn == 'd' && (data.mat_item != false || data.mat_item != '')  && FrmNm.value == 'matmast'){

                            var strconfirm = confirm("Are you sure you want to delete?");
                            if (strconfirm == true) {

                                xmlhttp.open("GET","includes/inv_record_del.php?q="+ItmCd.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value+"&UserComDbf="+UserComDbf.value+"&UserUntCd="+UserUntCd.value+"&UserComCd="+UserComCd.value,true);
                                xmlhttp.send();
                                document.getElementById('ComItmCdErrorSpan').innerHTML="Record Has Been Deleted !";
                                alert("Record Deleted Successfully.");
                                window.location.reload();
                            }

                        }


                        if(data.passActn == 'e' && (data.mat_item != false || data.mat_item != '')) {

                            document.getElementById('ComItmCdErrorSpan').innerHTML="Duplicate Item Code Entry";
                            document.getElementById('ComItmCdName').innerHTML="";
                            ItmCd.focus();
                        }else if(data.passActn == 'e' && (data.mat_item == false || data.mat_item == '')) {
                            document.getElementById('ComItmCdErrorSpan').innerHTML="New Record Entry";
                            document.getElementById('mat_uom').innerHTML="UNIT OF MEASUREMENT";
                            document.getElementById('ComItmCdName').innerHTML="";
                            $("#mat_minlev").removeAttr('readonly');
                            $("#mat_maxlev").removeAttr('readonly');
                            $("#mat_ordlev").removeAttr('readonly');
                            $("#mat_location").removeAttr('readonly');
                            $("#mat_abc").removeAttr('readonly');
                            $("#mat_typ").removeAttr('readonly');
                            $("#mat_accd").removeAttr('readonly');
                            $("#mat_opqty").removeAttr('readonly');
                            $("#mat_oprate").removeAttr('readonly');
                            $("#mat_opdate").removeAttr('readonly');
                            $("#mat_budg").removeAttr('readonly');
                        }
                    }
                    else if(data.itm_desc == '')
                    {                        
                        document.getElementById('ComItmCdErrorSpan').innerHTML="Invalid Item Code";
                        document.getElementById('ComItmCdName').innerHTML="";
                        ItmCd.focus();
                    } 
                }
            }
            xmlhttp.open("GET","includes/cmp_itm_cd_chck.php?q="+ItmCd.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value+"&UserComDbf="+UserComDbf.value+"&UserUntCd="+UserUntCd.value+"&UserComCd="+UserComCd.value,true);
            xmlhttp.send();
        }
    }


    ////////////////////////////////////////////////////////////////////////////////////

    // company code check for supplier master
    // validation for company code check
    function CheckSubMastComCd(){
        var UserComCd = document.getElementById('user_com_cd');
        //alert(UserComCd.value);
        if(UserComCd.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    if(value.length < 1)
                    {
                        document.getElementById('ComCdErrorSpan').innerHTML="Invalid Company Code";
                        document.getElementById('ComCdName').innerHTML="";
                        UserComCd.focus();
                    }
                    else
                    {
                        document.getElementById('ComCdErrorSpan').innerHTML="";
                        document.getElementById('com_com').value=UserComCd.value;
                        document.getElementById('ComCdName').innerHTML=value;
                        $("#mat_unit").removeAttr('readonly');
                    }
                }
              }
            xmlhttp.open("GET","includes/cmp_cd_chck.php?q="+UserComCd.value,true);
            xmlhttp.send();
        }
    }


    // check general ledger code in supplier master
    function CheckSubMastGenCd(){
        var GenLedCd = document.getElementById('sub_accd');

        if(GenLedCd.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if(data.gen_desc != '')
                    {
                        document.getElementById('GenLedCdErrorSpan').innerHTML="";
                        document.getElementById('GenLedCdName').innerHTML=data.gen_desc;
                        $("#sub_subcd").removeAttr('readonly');
                    }
                    else
                    {                        
                        document.getElementById('GenLedCdErrorSpan').innerHTML="Invalid Code";
                        document.getElementById('GenLedCdName').innerHTML="";
                        GenLedCd.focus();
                    }
                }
              }
            xmlhttp.open("GET","includes/supmst_genled_cd_chck.php?q="+GenLedCd.value,true);
            xmlhttp.send();
        }
    }

    // check Sub/Party code in supplier master
    function CheckSubMastSubCd(){
        var SubCd = document.getElementById('sub_subcd');
        var GenLedCd = document.getElementById('sub_accd');
        var UserFduser = document.getElementById('user_fduser');
        var UserComDbf = document.getElementById('user_com_dbf');
        var UserComCd = document.getElementById('user_com_cd');
        var UserUntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');

        if(GenLedCd.value != "" && SubCd.value != "" && UserUntCd.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if(data.sub_com != '')
                    {
                        if (data.passActn == 'u') {
                            $("input").removeAttr('readonly');
                            document.getElementById('SubCdErrorSpan').innerHTML="";
                            document.getElementById('sub_desc').value=data.sub_desc;
                            document.getElementById('sub_opbal').value=data.sub_opbal;
                            document.getElementById('sub_opbaldt').value=data.sub_opbaldt;
                            document.getElementById('sub_cat').value=data.sub_cat;
                            document.getElementById('sub_agetag').value=data.sub_agetag;
                            document.getElementById('sub_pancard').value=data.sub_pancard;
                        }else if (data.passActn == 'e') {
                            document.getElementById('SubCdErrorSpan').innerHTML="Duplicate Entry";
                            SubCd.focus();
                        }else if (data.passActn == 'd' && FrmNm.value == 'submast') {
                            var strconfirm = confirm("Are you sure you want to delete?");
                            if (strconfirm == true) {
                                xmlhttp.open("GET","includes/inv_record_del.php?q="+SubCd.value+"&GenLedCd="+GenLedCd.value+"&UserFduser="+UserFduser.value+"&UserComDbf="+UserComDbf.value+"&UserComCd="+UserComCd.value+"&UserUntCd="+UserUntCd.value+"&FrmNm="+FrmNm.value,true);
                                xmlhttp.send();
                                document.getElementById('SubCdErrorSpan').innerHTML="Record Has Been Deleted !";
                                alert("Record Deleted Successfully.");
                            }
                        }
                    }
                    else
                    {                        
                        document.getElementById('SubCdErrorSpan').innerHTML="New Entry";
                        $("input").removeAttr('readonly');
                        document.getElementById('sub_desc').value="";
                        document.getElementById('sub_opbal').value="";
                        document.getElementById('sub_opbaldt').value="";
                        document.getElementById('sub_cat').value="";
                        document.getElementById('sub_agetag').value="";
                        document.getElementById('sub_pancard').value="";
                    }
                }
              }
            xmlhttp.open("GET","includes/supmst_sub_party_cd_chck.php?q="+SubCd.value+"&GenLedCd="+GenLedCd.value+"&UserFduser="+UserFduser.value+"&UserComDbf="+UserComDbf.value+"&UserComCd="+UserComCd.value+"&UserUntCd="+UserUntCd.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();
        }
    }


    /////////////////////////////////////////// Purchase Module starts ////////////////////////////////////////////

    // check req no and srl no for purchase requisition
    function CheckIreqSrlNo(){
        var ReqDt = document.getElementById('req_dt');
        var CrntDt = document.getElementById('crnt_dt');
        var ReqFinYr = document.getElementById('req_fyr');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var ReqNo = document.getElementById('req_no');
        var ReqSrlNo = document.getElementById('req_srl');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');   
        var UserComDbf = document.getElementById('user_com_dbf');

        if(ReqDt.value != "")
        {   
            var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
            var CrntDtYr = CrntDt.value.slice(6);
            var CrntDtMth = CrntDt.value.slice(3,-5);
            var CrntDtDy = CrntDt.value.slice(0,-8); 
            var ReqDtYr = ReqDt.value.slice(6);
            var ReqDtMth = ReqDt.value.slice(3,-5);
            var ReqDtDy = ReqDt.value.slice(0,-8);

            var firstDate = new Date(CrntDtYr,CrntDtMth,CrntDtDy);
            var secondDate = new Date(ReqDtYr,ReqDtMth,ReqDtDy);

            var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));
            ReqNo.focus();
            if (diffDays <= 2) {

                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp=new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function()
                {
                  if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        var value = xmlhttp.responseText;
                        data = JSON.parse(value);
                        if(data.req_no != '')
                        {
                            ReqFinYr.value=data.finYear;
                            if (data.passActn == 'e') {
                                ReqNo.value=data.req_no;
                                ReqSrlNo.value=data.req_srl;
                            }else if (data.passActn == 'u' || data.passActn == 'a'  || data.passActn == 'c') {
                                ReqNo.value="";
                                ReqSrlNo.value="";
                                $("#req_no").removeAttr('readonly');
                                $("#req_srl").removeAttr('readonly');
                            }
                            $("#req_dept").removeAttr('readonly');
                        }
                    }
                  }
                xmlhttp.open("GET","includes/prchs_reqno_srl_chck.php?q="+ReqDtYr.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value+"&CrntDt="+CrntDt.value+"&ReqDtYr="+ReqDtYr+"&ReqDtMth="+ReqDtMth+"&ReqDtDy="+ReqDtDy,true);
                xmlhttp.send();

            }else{
                alert('Previous Entry Before Two Days Not Allowed ....!!');
                ReqNo.value="";
                ReqSrlNo.value="";
                ReqDt.focus();
            }
        }
    }

    // check department code in deptcat for purchase requisition
    function CheckDeptDescCd(){
        var DeptCd = document.getElementById('req_dept');

        if(DeptCd.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if(data.dep_desc != '')
                    {
                        document.getElementById('DeptCdErrorSpan').innerHTML="";
                        document.getElementById('DeptCdName').innerHTML=data.dep_desc;
                        $("#req_item").removeAttr('readonly');
                    }
                    else
                    {                        
                        document.getElementById('DeptCdErrorSpan').innerHTML="Invalid Code";
                        document.getElementById('DeptCdName').innerHTML="";
                        DeptCd.focus();
                    }
                }
              }
            xmlhttp.open("GET","includes/depart_desc_cd_chck.php?q="+DeptCd.value,true);
            xmlhttp.send();
        }else{
            document.getElementById('DeptCdErrorSpan').innerHTML="Required";
            DeptCd.value="";
            DeptCd.focus();
        }
    }

    // check department code in deptcat for purchase requisition
    function CheckPrchsItmCd(){
        var ItmCd = document.getElementById('req_item');   
        var UserComDbf = document.getElementById('user_com_dbf');        
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var ReqDt = document.getElementById('req_dt');
        var ReqFyr = document.getElementById('req_fyr');
        var ReqNo = document.getElementById('req_no');
        var ReqSrl = document.getElementById('req_srl');
        var ReqDept = document.getElementById('req_dept');

        if(ItmCd.value != "")
        {
            var ReqDtYr = ReqDt.value.slice(6);
            var ReqDtMth = ReqDt.value.slice(3,-5);
            var ReqDtDy = ReqDt.value.slice(0,-8);

            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    // Hide the image after the response from the server
                    document.getElementById("ItmCdErrorSpan").innerHTML = ''; 
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if(data.itm_desc != '')
                    {
                        document.getElementById('ItmCdErrorSpan').innerHTML="";
                        document.getElementById('req_desc').value=data.itm_desc;
                        document.getElementById('ItmUomName').innerHTML=data.cod_desc;
                        document.getElementById('req_min_stck').value=data.mat_minlev;
                        document.getElementById('req_mx_stck').value=data.mat_maxlev;
                        document.getElementById('req_last_po').value=data.poh_po_no;
                        document.getElementById('req_srl_no').value=data.pod_po_srl;
                        document.getElementById('req_po_dt').value=data.poh_po_dt;
                        document.getElementById('req_pen_qty').value=data.pod_pen_qty;
                        document.getElementById('req_rate').value=parseFloat(Math.round(data.item_rate * 100) / 100).toFixed(4);
                        document.getElementById('req_stck').value=parseFloat(Math.round(data.item_stock * 100) / 100).toFixed(2);

                        if ((data.passActn == 'u' || data.passActn == 'a' || data.passActn == 'c') && data.req_qty != '') {
                            document.getElementById('req_qty').value=data.req_qty;
                            document.getElementById('req_rmk').value=data.req_rmk;
                            document.getElementById('req_catg').value=data.req_catg;
                            document.getElementById('req_can_qty').value=data.req_can_qty;
                            document.getElementById('req_aprvd_qty').value=data.req_aprvd_qty;
                            document.getElementById('req_cons_days').value=data.req_cons_days;
                            document.getElementById('req_inq_fyr').value=data.req_inq_fyr;
                            document.getElementById('req_inq_no').value=data.req_inq_no;
                            $('#req_qty').focus();
                            if (data.passActn == 'a') {
                                $('#req_aprvd_qty').focus();                                
                            }else if (data.passActn == 'c') {
                                $('#req_can_qty').removeAttr('readonly');
                                $('#req_can_qty').focus();
                            }else{
                                $('#req_desc').focus();
                            }
                        }else if ((data.passActn == 'u' || data.passActn == 'a' || data.passActn == 'c') && data.req_qty == '') {
                            document.getElementById('ItmCdErrorSpan').innerHTML="Not Found";
                            ItmCd.focus();

                            document.getElementById('req_desc').value="";
                            document.getElementById('ItmUomName').innerHTML="";
                            document.getElementById('req_min_stck').value="";
                            document.getElementById('req_mx_stck').value="";
                            document.getElementById('req_last_po').value="";
                            document.getElementById('req_srl_no').value="";
                            document.getElementById('req_po_dt').value="";
                            document.getElementById('req_pen_qty').value="";
                            document.getElementById('req_rate').value="";
                            document.getElementById('req_stck').value="";
                        }

                        if (data.passActn == 'a') {
                            $("#req_srl").removeAttr('readonly'); 
                            $("#req_aprvd_qty").removeAttr('readonly');                            
                        }

                        $("#req_qty").removeAttr('readonly');
                        $("#req_rmk").removeAttr('readonly');
                        $("#req_desc").removeAttr('readonly');
                        $("#req_catg").removeAttr('readonly');
                        $("#req_cons_days").removeAttr('readonly');
                        $("#req_inq_fyr").removeAttr('readonly');
                        $("#req_inq_no").removeAttr('readonly');
                    }
                    else
                    {
                        document.getElementById('ItmCdErrorSpan').innerHTML="Invalid Code";
                        ItmCd.value="";
                        ItmCd.focus();
                        document.getElementById('req_desc').value="";                        
                        document.getElementById('ItmUomName').innerHTML="";
                        document.getElementById('req_min_stck').value="";
                        document.getElementById('req_mx_stck').value="";
                        document.getElementById('req_last_po').value="";
                        document.getElementById('req_srl_no').value="";
                        document.getElementById('req_po_dt').value="";
                        document.getElementById('req_pen_qty').value="";
                        document.getElementById('req_rate').value="";
                        document.getElementById('req_stck').value="";
                    }
                }
              }

            // Set here the image before sending request
            document.getElementById("ItmCdErrorSpan").innerHTML = '<div style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.7;"><img src="img/process.gif" style="margin: 400px 0 0 475px;"/></div>'; 

            xmlhttp.open("GET","includes/prchs_item_cd_chck.php?q="+ItmCd.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value+"&UserComDbf="+UserComDbf.value+"&ReqDtYr="+ReqDtYr+"&ReqDtMth="+ReqDtMth+"&ReqDtDy="+ReqDtDy+"&ReqFyr="+ReqFyr.value+"&ReqNo="+ReqNo.value+"&ReqSrl="+ReqSrl.value+"&ReqDt="+ReqDt.value+"&ReqDept="+ReqDept.value,true);
            xmlhttp.send();
        }else{
            document.getElementById('ItmCdErrorSpan').innerHTML="Required";
            ItmCd.value="";
            ItmCd.focus();
        }
    }

    // check request qty with net requirment for purchase requisition
    function CheckPrchsReqQty(){
        var ReqQty = document.getElementById('req_qty');
        var NetReq = document.getElementById('req_net_req');
        var Stock = document.getElementById('req_stck');
        var MinStock = document.getElementById('req_min_stck');
        //alert(ReqQty.value.length);
        if (ReqQty.value.length != 0 && ReqQty.value != '.') {
            ReqQty.value=parseFloat(Math.round(ReqQty.value * 100) / 100).toFixed(2);
            NetReq.value = parseFloat(ReqQty.value) - parseFloat(Stock.value) + parseFloat(MinStock.value);
            
            document.getElementById('ReqQtyCdErrorSpan').innerHTML="";
        }else{
            document.getElementById('ReqQtyCdErrorSpan').innerHTML="Not a number";
            ReqQty.value="";
            ReqQty.focus();
        }
    }


    /////////////////////////////////////////////////////////////////////////////////


    // check last po date, inq no and inq fyr for purchase order
    function CheckPoInqNo(){
        var PoDt = document.getElementById('poh_po_dt');
        var CrntDt = document.getElementById('crnt_dt');
        var PoFinYr = document.getElementById('poh_fyr');
        var PoFinYr1 = document.getElementById('poh_fyr1');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var PoNo = document.getElementById('poh_po_no');
        var PoInqNo = document.getElementById('poh_inq_no');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');

        if(PoInqNo.value != "" && PoInqNo.value == 999999)
        {   
            document.getElementById("PoInqNoErrorSpan").innerHTML="";
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.poh_po_no != '' && data.passActn == 'e') {
                        PoFinYr.value=data.finYear;
                        PoNo.value=data.poh_po_no;
                        PoFinYr1.value=data.finYear;
                        $("#poh_po_type").removeAttr('readonly');
                    }else if (data.poh_po_no != '' && data.passActn == 'u') {
                        PoFinYr.value=data.finYear;
                        PoFinYr1.value=data.finYear;
                        $("input").removeAttr('readonly');
                    }else if (data.poh_po_no != '' && data.passActn == 'd') {
                        PoFinYr.value=data.finYear;
                        PoFinYr1.value=data.finYear;
                        $("#poh_po_no").removeAttr('readonly');
                    }

                }
            }
            xmlhttp.open("GET","includes/prchs_porder_pono_chck.php?q="+PoInqNo.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value+"&PoDt="+PoDt.value,true);
            xmlhttp.send();            
        }if(PoInqNo.value == "" || PoInqNo.value != 999999){
            document.getElementById("PoInqNoErrorSpan").innerHTML="Not Present";
            PoInqNo.value=""
            PoInqNo.focus();
        }
    }

    // check last po date, inq no and inq fyr for purchase order
    function CheckPoTypeCd(){
        var PoNo = document.getElementById('poh_po_type');

        if(PoNo.value != "")
        {   
            document.getElementById("PoTypeErrorSpan").innerHTML="";
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.cod_desc != '') {
                        document.getElementById("PoTypeErrorSpan").innerHTML=data.cod_desc;
                        $("#poh_supcd").removeAttr('readonly');
                    }else if (data.cod_desc == '') {
                        document.getElementById("PoTypeErrorSpan").innerHTML="Invalid Code";
                    }  
                }
            }
            xmlhttp.open("GET","includes/prchs_porder_potype_chck.php?q="+PoNo.value,true);
            xmlhttp.send();            
        }if(PoNo.value == ""){
            document.getElementById("PoTypeErrorSpan").innerHTML="Required";
            PoNo.focus();
        }
    }

    // check last supplier code for purchase order
    function CheckPoSupCd(){
        var PoSupCd = document.getElementById('poh_supcd');
        var UserFduser = document.getElementById('user_fduser');
        var UserComDbf = document.getElementById('user_com_dbf');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');

        if(PoSupCd.value != "")
        {               
            document.getElementById("PoSupCdErrorSpan").innerHTML="";
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    // unset loading image
                    document.getElementById("PoSupCdErrorSpan").innerHTML = '';
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.gen_desc != '') {
                        document.getElementById("PoSupCdErrorSpan").innerHTML=data.sup_name;
                        document.getElementById("poh_sup_accd").value=data.sup_cd;
                        document.getElementById("poh_sup_accd_desc").value=data.gen_desc;
                        document.getElementById("poh_st_cd").value=data.stCode;
                        $("#poh_dlv_dest").removeAttr('readonly');
                        $("#poh_stax_cd").removeAttr('readonly');
                        $("#poh_sup_accd").removeAttr('readonly');
                        $("#poh_sup_accd_desc").removeAttr('readonly');
                    }else if (data.gen_desc == '') {
                        document.getElementById("poh_sup_accd_desc").value="Invalid Code";
                        document.getElementById("PoSupCdErrorSpan").innerHTML="Non GST / Invalid Code";
                        PoSupCd.focus();
                    }  
                }
            }
            // Set here the image before sending request
            document.getElementById("PoSupCdErrorSpan").innerHTML = '<div style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.7;"><img src="img/process.gif" style="margin: 400px 0 0 475px;"/></div>'; 
            xmlhttp.open("GET","includes/prchs_porder_posupcd_chck.php?q="+PoSupCd.value+"&UserFduser="+UserFduser.value+"&UserComDbf="+UserComDbf.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value,true);
            xmlhttp.send();            
        }if(PoSupCd.value == ""){
            document.getElementById("PoSupCdErrorSpan").innerHTML="Required";
            PoSupCd.focus();
        }
    }

    // check last po sales tax code and desc for purchase order
    function CheckPoSalTaxCd(){
        var PoSalTax = document.getElementById('poh_stax_cd');

        if(PoSalTax.value != "")
        {   
            document.getElementById("PoSalTaxErrorSpan").innerHTML="";
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.cod_desc != '') {
                        document.getElementById("poh_stax_desc").value=data.cod_desc;
                        $("#poh_stax_desc").removeAttr('readonly');
                        $("#poh_excise_cd").removeAttr('readonly');
                        $("#poh_stax_per").removeAttr('readonly');
                    }else if (data.cod_desc == '') {
                        document.getElementById("poh_stax_desc").value="Invalid Code";
                    }  
                }
            }
            xmlhttp.open("GET","includes/prchs_porder_posaltax_chck.php?q="+PoSalTax.value,true);
            xmlhttp.send();            
        }if(PoSalTax.value == ""){
            document.getElementById("PoSalTaxErrorSpan").innerHTML="Required";
            PoSalTax.focus();
        }
    }

    // check po excise code and desc for purchase order
    function CheckPoExciseCd(){
        var PoSalTax = document.getElementById('poh_excise_cd');

        if(PoSalTax.value != "")
        {   
            document.getElementById("PoExciseCdErrorSpan").innerHTML="";
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.cod_desc != '') {
                        document.getElementById("poh_excise_cd_desc").value=data.cod_desc;
                        $("#poh_excise_cd_desc").removeAttr('readonly');
                        $("#poh_disc").removeAttr('readonly');
                        $("#poh_bank").removeAttr('readonly');
                        $("#poh_paycr_days").removeAttr('readonly');
                        $("#poh_crdisc").removeAttr('readonly');
                        $("#poh_addl_rmk").removeAttr('readonly');
                        $("#poh_exp_dt").removeAttr('readonly');
                        $("#poh_pmnt_terms").removeAttr('readonly');
                        $("#pod_item").removeAttr('readonly');
                        $("#poh_gst_cd").removeAttr('readonly');
                    }else if (data.cod_desc == '') {
                        document.getElementById("PoExciseCdErrorSpan").innerHTML="Invalid Code";
                    }  
                }
            }
            xmlhttp.open("GET","includes/prchs_porder_poexcisecd_chck.php?q="+PoSalTax.value,true);
            xmlhttp.send();            
        }if(PoSalTax.value == ""){
            document.getElementById("PoExciseCdErrorSpan").innerHTML="Required";
            PoSalTax.focus();
        }
    }

    // check po excise code and desc for purchase order
    function CheckPoGstCd(){
        var GstCd = document.getElementById('poh_gst_cd');
        var GstCdPer = document.getElementById('poh_gst_per');
        var IgstPer = document.getElementById('poh_igst_per');
        var SgstPer = document.getElementById('poh_sgst_per');
        var CgstPer = document.getElementById('poh_cgst_per');
        var UgstPer = document.getElementById('poh_ugst_per');
        var StCd = document.getElementById('poh_st_cd');
        if(GstCd.value != "" && GstCd.value != 0)
        {   
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.gstPer != '') {
                        document.getElementById("PoGstCdErrorSpan").innerHTML=data.cod_desc;
                        $("#poh_gst_per").removeAttr('readonly');
                        GstCdPer.value=data.gstPer;
                        IgstPer.value=data.igstPer;
                        SgstPer.value=data.sgstPer;
                        CgstPer.value=data.cgstPer;
                        UgstPer.value=data.ugstPer;
                        $("#poh_igst_per").removeAttr('readonly');                        
                        $("#poh_sgst_per").removeAttr('readonly');
                        $("#poh_cgst_per").removeAttr('readonly');
                        $("#poh_ugst_per").removeAttr('readonly');
                    }else if (data.gstPer == '') {
                        document.getElementById("PoGstCdErrorSpan").innerHTML="Invalid Code";
                        GstCd.value="";
                        GstCdPer.value='0.00';
                        IgstPer.value='0.00';
                        SgstPer.value='0.00';
                        CgstPer.value='0.00';
                        UgstPer.value='0.00';
                        GstCd.focus();
                    }  
                }
            }
            xmlhttp.open("GET","includes/prchs_porder_pogstcd_chck.php?q="+GstCd.value+"&StCd="+StCd.value,true);
            xmlhttp.send();            
        }if(GstCd.value == "" || GstCd.value == '0'){
            document.getElementById("PoGstCdErrorSpan").innerHTML="GST Is Applicable";
            GstCd.value == "";
            GstCdPer.value='0.00';
            IgstPer.value='0.00';
            SgstPer.value='0.00';
            CgstPer.value='0.00';
            UgstPer.value='0.00';
            GstCd.focus();
        }
    }

    // check po pod srl code for po no in purchase order
    function CheckPoSrlCd(){
        var PoNo = document.getElementById('poh_po_no');
        var PoFinYr = document.getElementById('poh_fyr');
        var ComCd = document.getElementById('user_com_cd');
        var UntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');

        if(PoNo.value != "")
        {   
            document.getElementById("PoExciseCdErrorSpan").innerHTML="";
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.pod_po_srl != '' && data.passActn == 'e') {
                        document.getElementById("pod_po_srl").value=data.pod_po_srl;
                    }
                }
            }
            xmlhttp.open("GET","includes/prchs_porder_posrlno_chck.php?q="+PoNo.value+"&PoFinYr="+PoFinYr.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&UserComDbf="+UserComDbf.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();            
        }
    }


    // check po item code for purchase order
    function CheckPoItemCd(){
        var PoItemNo = document.getElementById('pod_item');
        var PoNo = document.getElementById('poh_po_no');
        var PoFinYr = document.getElementById('poh_fyr');
        var CrntDt = document.getElementById('crnt_dt');
        var ComCd = document.getElementById('user_com_cd');
        var UntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');

        if(PoItemNo.value != "")
        {
            
            document.getElementById("PoItemErrorCd").innerHTML="";
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    // unset loading image
                    document.getElementById("PoItemErrorCd").innerHTML = '';
                    var value = xmlhttp.responseText;
                    document.getElementById("item_data").innerHTML=value;
                    $("#pod_rate").removeAttr('readonly');
                    $("#pod_ord_qty").removeAttr('readonly');
                    $("#pod_tolerance").removeAttr('readonly');
                    $("#pod_tech_spec").removeAttr('readonly');
                }
            }
            // Set here the image before sending request
            document.getElementById("PoItemErrorCd").innerHTML = '<div style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.7;"><img src="img/process.gif" style="margin: 400px 0 0 475px;"/></div>'; 
            xmlhttp.open("GET","includes/prchs_porder_poitemno_chck.php?q="+PoItemNo.value+"&PoFinYr="+PoFinYr.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&UserComDbf="+UserComDbf.value,true);
            xmlhttp.send();            
        }if(PoItemNo.value == ""){
            document.getElementById("PoItemErrorCd").innerHTML="Required";
            PoItemNo.focus();
        }
    }

    // change po order qty
    function ChangePoOrdQty(data){
        var OrdQty = document.getElementById('pod_ord_qty');
        var TotalOrdQty = OrdQty.value;
        if (data == 0) {
            TotalOrdQty = 0 + parseInt(data);
        }else if (data != 0){
            TotalOrdQty = parseInt(TotalOrdQty) + parseInt(data);
        }
        OrdQty.value=parseFloat(Math.round(TotalOrdQty * 100) / 100).toFixed(3);
    }

    // add new comm details row 
    function addNewRowCommDet(){
        var container = document.getElementById("add_new_row_comm");
        container.append("<table><tr><td>Hello</td></tr></table>");
    }

    $(document).ready(function(){
        $("#addCommDet").click(function(){
            var count = $('#commercialFields tr').length;
            var pdc_srl = count-1;
            $("#commercialFields").append('<tr id="Remove'+count+'" valign="top"><td><input type="text" name="pdc_sr[]" value="'+pdc_srl+'" id="pdc_sr"  maxlength="1" size="1"></td><td><input type="text" name="pdc_id[]" id="pdc_id" onblur="checkCommPdcVal(this)" maxlength="2" size="1"></td><td><input type="text" name="pdc_tag[]" id="pdc_tag"  maxlength="3" size="1"></td><td><input type="text" name="pdc_amt[]" id="pdc_amt"  maxlength="10" size="10" onblur="setNumberDecimal(this)"></td><td><input type="button" id="Remove'+count+'" class="btn btn-xs btn-success" onclick="removeCommRow(this)" value="Remove"></td></tr>');

            $("#remCommDet").on('click',function(){
                $(this).parent().parent().remove();
            });
        });
    });


    function removeCommRow(data){
        var CommRow = $(data).attr('id');
        var row = document.getElementById(CommRow);
        row.parentNode.removeChild(row);        

    }


    // check pdc value
    function checkCommPdcVal(data){
        var PdcValue = data;
        var PdcValueId = $(data).attr('id');
        //alert(PdcValue);

        if(PdcValue.value != "")
        {   
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.PdcVal != '') {
                        alert("Duplicate Entry For Id !!!");
                        //document.getElementById(PdcValueId).focus();
                    }
                }
            }
            xmlhttp.open("GET","includes/prchs_poworder_pdcval_chck.php?q="+PdcValue.value,true);
            xmlhttp.send();            
        }
    }

     

    $(document).ready(function(){
        $("#addStagDet").click(function(){

            var count = $('#staggeredFields tr').length;
            var pdd_srl = count-1;
            $("#staggeredFields").append('<tr id="Remove'+count+'" valign="top"><td><input type="text" name="pdd_sr[]"  value="'+pdd_srl+'" id="pdd_sr"  maxlength="1" size="1"></td><td><input type="date" name="pdd_sch_dt[]" id="pdd_sch_dt" placeholder="dd-mm-yyyy" maxlength="10" size="10"></td><td><input type="text" name="pdd_stag_qty[]" id="pdd_stag_qty"  onblur="checkCommPddVal(this)"  maxlength="10" size="10"></td><td><input type="button" id="Remove'+count+'" class="btn btn-xs btn-success" onclick="removeStagRow(this)" value="Remove"></td></tr>');

            $("#remStagDet").on('click',function(){
                $(this).parent().parent().remove();
            });
        });
    });


    function removeStagRow(data){
        var StagRow = $(data).attr('id');
        var row = document.getElementById(StagRow);
        row.parentNode.removeChild(row);        

    }

    // check pdd value
    function checkCommPddVal(data){
        var PddValue = data;
        var PddValueId = $(data).attr('id');
        //alert(PddValue);

        if(PddValue.value != "")
        {   
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.PddVal != '') {
                        alert("Duplicate Entry For Date !!!");
                        //document.getElementById(PddValueId).focus();
                    }
                }
            }
            xmlhttp.open("GET","includes/prchs_poworder_pdcval_chck.php?qdt="+PddValue.value,true);
            xmlhttp.send();            
        }
    }

    // check purchase order number details
    function CheckPoPoNoDetails(){
        var PoPoDt = document.getElementById('poh_po_dt');
        var PoPoCd = document.getElementById('poh_po_no');
        var PoInqNo = document.getElementById('poh_inq_no');
        var PoFinYr = document.getElementById('poh_fyr');
        var UserFduser = document.getElementById('user_fduser');
        var UserComDbf = document.getElementById('user_com_dbf');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');

        if(PoPoCd.value != "")
        {               
            document.getElementById("PoPoCdErrorSpan").innerHTML="";
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    // unset loading image
                    document.getElementById("PoPoCdErrorSpan").innerHTML = '';
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.poh_supcd != '' && data.passActn == 'u') {
                        document.getElementById("poh_po_type").value=data.poh_po_type;
                        document.getElementById("poh_supcd").value=data.poh_supcd;
                        document.getElementById("poh_sup_accd").value=data.poh_sup_accd;
                        document.getElementById("poh_dlv_dest").value=data.poh_dlv_dest;
                        document.getElementById("poh_stax_cd").value=data.poh_stax_cd;
                        document.getElementById("poh_excise_cd").value=data.poh_excise_cd;
                        document.getElementById("poh_disc").value=data.poh_disc;
                        document.getElementById("poh_bank").value=data.poh_bank;
                        document.getElementById("poh_gst_cd").value=data.poh_gst_cd;
                        document.getElementById("poh_gst_per").value=data.poh_gst_per;
                        document.getElementById("poh_igst_per").value=data.poh_igst_per;
                        document.getElementById("poh_sgst_per").value=data.poh_sgst_per;
                        document.getElementById("poh_cgst_per").value=data.poh_cgst_per;
                        document.getElementById("poh_ugst_per").value=data.poh_ugst_per;
                        document.getElementById("poh_paycr_days").value=data.poh_paycr_days;
                        document.getElementById("poh_crdisc").value=data.poh_crdisc;
                        document.getElementById("poh_addl_rmk").value=data.poh_addl_rmk;
                        document.getElementById("poh_exp_dt").value=data.poh_exp_dt;
                        document.getElementById("poh_pmnt_terms").value=data.poh_pmnt_terms;

                        document.getElementById("pod_po_srl").value=data.pod_po_srl;
                        document.getElementById("pod_item").value=data.pod_item;
                        document.getElementById("pod_rate").value=data.pod_rate;
                        document.getElementById("pod_ord_qty").value=data.pod_ord_qty;
                        document.getElementById("pod_tolerance").value=data.pod_tolerance;
                        document.getElementById("pod_tech_spec").value=data.pod_tech_spec;

                        document.getElementById("toUpdatePdcData").innerHTML=data.pdc_data;
                        document.getElementById("hidePdcOnupd").remove();
                        document.getElementById("toUpdatePddData").innerHTML=data.pdd_data;
                        document.getElementById("hidePddOnupd").remove();
                    }else if (data.poh_supcd == '' && data.passActn == 'u') {
                        document.getElementById("PoPoCdErrorSpan").innerHTML="Invalid / Audit Done";
                        PoPoCd.focus();
                    }else if (data.poh_supcd != '' && data.passActn == 'd') {
                        document.getElementById("PoPoCdErrorSpan").innerHTML="delete";
                        var strconfirm = confirm("Are you sure you want to delete?");
                        if (strconfirm == true) {
                            xmlhttp.open("GET","includes/inv_record_del.php?q="+PoPoCd.value+"&PoFinYr="+PoFinYr.value+"&UserComDbf="+UserComDbf.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value,true);
                            xmlhttp.send();
                            alert("Record Deleted Successfully.");
                            document.getElementById('PoPoCdErrorSpan').innerHTML="Record Deleted.";
                            PoPoCd.value="";
                        }
                        //PoPoCd.focus();
                    }  
                }
            }
            // Set here the image before sending request
            document.getElementById("PoPoCdErrorSpan").innerHTML = '<div style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.7;"><img src="img/process.gif" style="margin: 400px 0 0 475px;"/></div>'; 
            xmlhttp.open("GET","includes/prchs_porder_po_details_chck.php?q="+PoPoCd.value+"&PoPoDt="+PoPoDt.value+"&PoInqNo="+PoInqNo.value+"&PoFinYr="+PoFinYr.value+"&UserFduser="+UserFduser.value+"&UserComDbf="+UserComDbf.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();            
        }if(PoSupCd.value == ""){
            document.getElementById("PoPoCdErrorSpan").innerHTML="Required";
            PoSupCd.focus();
        }
    }

    // check last work order po no and fin fyr for work order
    function CheckWoPoNo(){
        var PoDt = document.getElementById('poh_po_dt');
        var CrntDt = document.getElementById('crnt_dt');
        var PoFinYr = document.getElementById('wo_poh_fyr');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var PoNo = document.getElementById('poh_po_no');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');
        if(PoDt.value != "")
        {   
            document.getElementById("PoPoCdErrorSpan").innerHTML="";
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.poh_po_no != '' && data.passActn == 'e') {
                        PoFinYr.value=data.finYear;
                        PoNo.value=data.poh_po_no;
                        $("#poh_po_type").removeAttr('readonly');
                        $("#pod_rate").removeAttr('readonly');
                        $("#pod_ord_qty").removeAttr('readonly');
                        $("#pod_tolerance").removeAttr('readonly');
                        $("#pod_tech_spec").removeAttr('readonly');
                    }else if (data.poh_po_no != '' && data.passActn == 'u' || data.passActn == 'a') {
                        PoFinYr.value=data.finYear;
                        $("#poh_po_no").removeAttr('readonly');
                    }

                }
            }
            xmlhttp.open("GET","includes/prchs_worder_pono_chck.php?q="+PoDt.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value+"&PoDt="+PoDt.value,true);
            xmlhttp.send();            
        }
    }


    // check work order po number details
    function CheckWoPoNoDetails(){
        var WoPoDt = document.getElementById('poh_po_dt');
        var PoPoCd = document.getElementById('poh_po_no');
        var PoFinYr = document.getElementById('wo_poh_fyr');
        var UserFduser = document.getElementById('user_fduser');
        var UserComDbf = document.getElementById('user_com_dbf');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');

        if(PoPoCd.value != "")
        {               
            document.getElementById("PoPoCdErrorSpan").innerHTML="";
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    // unset loading image
                    document.getElementById("PoPoCdErrorSpan").innerHTML = '';
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.poh_supcd != '' && data.passActn == 'u') {
                        $("input").removeAttr('readonly');
                        document.getElementById("poh_po_type").value=data.poh_po_type;
                        document.getElementById("poh_supcd").value=data.poh_supcd;
                        document.getElementById("poh_sup_accd").value=data.poh_sup_accd;
                        document.getElementById("poh_dlv_dest").value=data.poh_dlv_dest;
                        document.getElementById("poh_stax_cd").value=data.poh_stax_cd;
                        document.getElementById("poh_excise_cd").value=data.poh_excise_cd;
                        document.getElementById("poh_disc").value=data.poh_disc;
                        document.getElementById("poh_bank").value=data.poh_bank;
                        document.getElementById("poh_gst_cd").value=data.poh_gst_cd;
                        document.getElementById("poh_gst_per").value=data.poh_gst_per;
                        document.getElementById("poh_igst_per").value=data.poh_igst_per;
                        document.getElementById("poh_sgst_per").value=data.poh_sgst_per;
                        document.getElementById("poh_cgst_per").value=data.poh_cgst_per;
                        document.getElementById("poh_ugst_per").value=data.poh_ugst_per;
                        document.getElementById("poh_paycr_days").value=data.poh_paycr_days;
                        document.getElementById("poh_crdisc").value=data.poh_crdisc;
                        document.getElementById("poh_addl_rmk").value=data.poh_addl_rmk;
                        document.getElementById("poh_exp_dt").value=data.poh_exp_dt;
                        document.getElementById("poh_pmnt_terms").value=data.poh_pmnt_terms;

                        document.getElementById("pod_po_srl").value=data.pod_po_srl;
                        document.getElementById("pod_item").value=data.pod_item;
                        document.getElementById("pod_rate").value=data.pod_rate;
                        document.getElementById("pod_ord_qty").value=data.pod_ord_qty;
                        document.getElementById("pod_tolerance").value=data.pod_tolerance;
                        document.getElementById("pod_tech_spec").value=data.pod_tech_spec;

                        document.getElementById("toUpdatePdcData").innerHTML=data.pdc_data;
                        document.getElementById("hidePdcOnupd").remove();
                        document.getElementById("toUpdatePddData").innerHTML=data.pdd_data;
                        document.getElementById("hidePddOnupd").remove();
                    }if (data.poh_supcd != '' && data.passActn == 'a') {
                        document.getElementById("poh_po_type").value=data.poh_po_type;
                        document.getElementById("poh_supcd").value=data.poh_supcd;
                        document.getElementById("poh_sup_accd").value=data.poh_sup_accd;
                        document.getElementById("poh_dlv_dest").value=data.poh_dlv_dest;
                        document.getElementById("poh_stax_cd").value=data.poh_stax_cd;
                        document.getElementById("poh_excise_cd").value=data.poh_excise_cd;
                        document.getElementById("poh_disc").value=data.poh_disc;
                        document.getElementById("poh_bank").value=data.poh_bank;
                        document.getElementById("poh_gst_cd").value=data.poh_gst_cd;
                        document.getElementById("poh_gst_per").value=data.poh_gst_per;
                        document.getElementById("poh_igst_per").value=data.poh_igst_per;
                        document.getElementById("poh_sgst_per").value=data.poh_sgst_per;
                        document.getElementById("poh_cgst_per").value=data.poh_cgst_per;
                        document.getElementById("poh_ugst_per").value=data.poh_ugst_per;
                        document.getElementById("poh_paycr_days").value=data.poh_paycr_days;
                        document.getElementById("poh_crdisc").value=data.poh_crdisc;
                        document.getElementById("poh_addl_rmk").value=data.poh_addl_rmk;
                        document.getElementById("poh_exp_dt").value=data.poh_exp_dt;
                        document.getElementById("poh_pmnt_terms").value=data.poh_pmnt_terms;
                    }else if (data.poh_supcd == '' && data.passActn == 'u' ||  data.passActn == 'a') {
                        document.getElementById("PoPoCdErrorSpan").innerHTML="INVALID UPDATION ...!!!";
                        PoPoCd.focus();
                        PoPoCd.value="";
                    }else if (data.poh_supcd != '' && data.passActn == 'd') {
                        document.getElementById("PoPoCdErrorSpan").innerHTML="delete";
                        var strconfirm = confirm("Are you sure you want to delete?");
                        if (strconfirm == true) {
                            xmlhttp.open("GET","includes/inv_record_del.php?q="+PoPoCd.value+"&PoFinYr="+PoFinYr.value+"&UserComDbf="+UserComDbf.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value,true);
                            xmlhttp.send();
                            alert("Record Deleted Successfully.");
                            document.getElementById('PoPoCdErrorSpan').innerHTML="Record Deleted.";
                            PoPoCd.value="";
                        }
                    }  
                }
            }
            // Set here the image before sending request
            document.getElementById("PoPoCdErrorSpan").innerHTML = '<div style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.7;"><img src="img/process.gif" style="margin: 400px 0 0 475px;"/></div>'; 
            xmlhttp.open("GET","includes/prchs_worder_po_details_chck.php?q="+PoPoCd.value+"&WoPoDt="+WoPoDt.value+"&PoFinYr="+PoFinYr.value+"&UserFduser="+UserFduser.value+"&UserComDbf="+UserComDbf.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();            
        }else if(PoPoCd.value == ""){
            document.getElementById("PoPoCdErrorSpan").innerHTML="Required";
            PoPoCd.focus();
        }
    }

    // check work order ITEM no DETAILS for work order
    function CheckWoItemNo(){
        var PoItemNo = document.getElementById('pod_item');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');
        if(PoItemNo.value != "")
        {   
            document.getElementById("PoPoCdErrorSpan").innerHTML="";
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.itm_desc != '' && data.passActn == 'e' || data.passActn == 'u' || data.passActn == 'a') {
                        document.getElementById("WoItemErrorCd").innerHTML=data.itm_desc;
                        document.getElementById("WoQtyErrorCd").innerHTML=data.cod_desc;
                        document.getElementById("pod_chpt_id").value=data.itm_chpt_id;
                    }else if (data.itm_desc == '' && data.passActn == 'e' || data.passActn == 'u' || data.passActn == 'a') {
                        document.getElementById("WoItemErrorCd").innerHTML="No Such Item Found .... !!!";
                        document.getElementById("WoQtyErrorCd").innerHTML="";
                        document.getElementById("pod_chpt_id").value="";
                    }
                }
            }
            xmlhttp.open("GET","includes/prchs_worder_itemno_chck.php?q="+PoItemNo.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();            
        }
    }



    // check work order ord qty
    function CheckWoOrdQty(data){
        var WoOrdQty = data.value;
        if (WoOrdQty <= 0) {
            document.getElementById("WoQtyValueErrorCd").innerHTML=" - Ord Qty Should Be Greater Than Zero (0)";
            data.focus();
            data.value = "1.00";
        }else if (WoOrdQty >= 0) {
            document.getElementById("WoQtyValueErrorCd").innerHTML="";
            document.getElementById("pdd_stag_qty").value=WoOrdQty;
        }
    }

    // check podet last srl no
    function checkWoPodSrlNo(){
        var PoPoCd = document.getElementById('poh_po_no');
        var PoFinYr = document.getElementById('wo_poh_fyr');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');
        if(PoPoCd.value != "")
        {   
            document.getElementById("PoPoCdErrorSpan").innerHTML="";
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.PodSrlNo != '' && data.passActn == 'e' || data.passActn == 'a') {
                        document.getElementById("pod_po_srl").value=data.PodSrlNo;
                        $("input").removeAttr("readonly");
                    }
                }
            }
            xmlhttp.open("GET","includes/prchs_worder_podsrlno_chck.php?q="+PoPoCd.value+"&PoFinYr="+PoFinYr.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();            
        }
    }


    // check audit podet srl no details
    function CheckPoPoDetDetails(){
        var PoPoCd = document.getElementById('poh_po_no');
        var PoFinYr = document.getElementById('poh_fyr');
        var PoPodSrlNo = document.getElementById('pod_po_srl');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');
        if(PoPoCd.value != "")
        {   
            document.getElementById("PoPoCdErrorSpan").innerHTML="";
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.pod_item != '' && data.passActn == 'u') {
                        document.getElementById("podSrlNoDetailsErrorSpan").innerHTML="";
                        document.getElementById("pod_item").value=data.pod_item;
                        document.getElementById("pod_rate").value=data.pod_rate;
                        document.getElementById("pod_ord_qty").value=data.pod_ord_qty;
                        document.getElementById("pod_ord_qty_old").value=data.pod_ord_qty;
                        document.getElementById("pod_tech_spec").value=data.pod_tech_spec;
                        document.getElementById("pod_tolerance").value=data.pod_tolerance;
                        $("input").removeAttr("readonly");
                    }else if (data.pod_item == '' && data.passActn == 'u') {
                        document.getElementById("podSrlNoDetailsErrorSpan").innerHTML="Invalid Srl No !!!";
                        PoPodSrlNo.value="";
                        PoPodSrlNo.focus();
                        document.getElementById("pod_item").value="";
                        document.getElementById("pod_rate").value="";
                        document.getElementById("pod_ord_qty").value="";
                        document.getElementById("pod_tech_spec").value="";
                        document.getElementById("pod_tolerance").value="";
                        $("input").removeAttr("readonly");
                    }
                }
            }
            xmlhttp.open("GET","includes/prchs_porder_podsrlno_chck.php?q="+PoPodSrlNo.value+"&PoPoCd="+PoPoCd.value+"&PoFinYr="+PoFinYr.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();            
        }
    }

    function CalPoDetOrdBalQty(data){
        var OrdQty = data;
        var OrdQtyOld = document.getElementById("pod_ord_qty_old");
        var BalQty = document.getElementById("pod_bal_qty");
        BalQty.value = parseFloat(OrdQtyOld.value - OrdQty.value).toFixed(2);
    }

    // check audit pdcomm srl no and id details
    function CheckPoPdcIdDetails(){
        var PoPoCd = document.getElementById('poh_po_no');
        var PoFinYr = document.getElementById('poh_fyr');
        var PoPdcSrlNo = document.getElementById('pdc_sr');
        var PoPdcId = document.getElementById('pdc_id');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');
        if(PoPoCd.value != "")
        {   
            document.getElementById("pdcIdDetailsErrorSpan").innerHTML="";
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.pdc_tag != '' && data.passActn == 'u') {
                        document.getElementById("pdcIdDetailsErrorSpan").innerHTML="";
                        document.getElementById("pdc_tag").value=data.pdc_tag;
                        document.getElementById("pdc_amt").value=data.pdc_amt;
                        document.getElementById("pdc_sys_dt").value=data.pdc_sys_dt;
                        $("input").removeAttr("readonly");
                    }else if (data.pdc_tag == '' && data.passActn == 'u') {
                        document.getElementById("pdcIdDetailsErrorSpan").innerHTML="Invalid !!!";
                        PoPdcId.value="";
                        PoPdcId.focus();
                        document.getElementById("pdc_tag").value="";
                        document.getElementById("pdc_amt").value="";
                        $("input").removeAttr("readonly");
                    }
                }
            }
            xmlhttp.open("GET","includes/prchs_porder_pdcSrlId_chck.php?q="+PoPdcId.value+"&PoPoCd="+PoPoCd.value+"&PoPdcSrlNo="+PoPdcSrlNo.value+"&PoFinYr="+PoFinYr.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();            
        }
    }

    // check audit pddet po no and schedule dt details
    function CheckPoPddPoNoDetails(){
        var PoPoCd = document.getElementById('poh_po_no');
        var PoFinYr = document.getElementById('poh_fyr');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');
        if(PoPoCd.value != "")
        {   
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.pdd_po_srl != '' && data.passActn == 'u') {
                        document.getElementById("pddPoIdDetailsErrorSpan").innerHTML="";
                        document.getElementById("pddPoNoDetailsErrorSpan").innerHTML=data.pddData;
                    }else if (data.pdd_po_srl == '' && data.passActn == 'u') {
                        document.getElementById("pddPoIdDetailsErrorSpan").innerHTML="Invalid !!!";
                        PoPoCd.value="";
                        PoPoCd.focus();
                        document.getElementById("pddPoNoDetailsErrorSpan").innerHTML="";
                        $("input").removeAttr("readonly");
                    }
                }
            }
            xmlhttp.open("GET","includes/prchs_porder_pddPoNoDetl_chck.php?q="+PoPoCd.value+"&PoFinYr="+PoFinYr.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();            
        }
    }

    // check audit  po wo no approval
    function CheckPoWoNoDetails(){
        var PoPoNo = document.getElementById('poh_po_no');
        var PoFinYr = document.getElementById('poh_fyr');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');
        if(PoPoNo.value != "")
        {   
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.poh_supcd != '' && data.passActn == 'b') {
                        document.getElementById("PoIdDetailsErrorSpan").innerHTML="";
                        document.getElementById("PoNoDetailsErrorSpan").innerHTML=data.podData;
                    }else if (data.poh_supcd == '' && data.passActn == 'b') {
                        document.getElementById("PoIdDetailsErrorSpan").innerHTML="Purchase Order Already Audited OR Invalid ...!!!";
                        PoPoNo.value="";
                        PoPoNo.focus();
                        document.getElementById("PoNoDetailsErrorSpan").innerHTML="";
                        $("input").removeAttr("readonly");
                    }else if (data.poh_supcd != '' && data.passActn == 'u') {
                        document.getElementById("PoPoCdErrorSpan").innerHTML="";
                    }else if (data.poh_supcd == '' && data.passActn == 'u') {
                        document.getElementById("PoPoCdErrorSpan").innerHTML="Purchase Order Already Audited OR Invalid ...!!!";
                        PoPoNo.value="";
                        PoPoNo.focus();
                        $("input").removeAttr("readonly");
                    }
                }
            }
            xmlhttp.open("GET","includes/prchs_porder_powo_audit_chck.php?q="+PoFinYr.value+"&PoPoNo="+PoPoNo.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();            
        }
    }


    // check audit pddet po no and schedule dt details
    function CheckGrnPoNoRateDiffDetails(){
        var GrnNo = document.getElementById('grh_no');
        var GrnDt = document.getElementById('grh_dt');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');
        if(GrnNo.value != "" && GrnDt.value != "")
        {   
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    // unset loading image
                    document.getElementById("grnNoDetailsErrorSpan").innerHTML = "";
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.errorMsg != '' && data.passActn == 'p') {
                        document.getElementById("grnNoDetailsErrorSpan").innerHTML=data.errorMsg;
                        document.getElementById("podGrnNoDetailsErrorSpan").innerHTML='';
                        if (data.pgd_rmk == '') {
                            document.getElementById("pgd_rmk").value="";
                        }else{
                            document.getElementById("pgd_rmk").value=data.pgd_rmk;
                        }
                        $('.submit-clear').hide();
                        GrnNo.focus();
                    }else if (data.errorMsg == '' && data.passActn == 'p') {
                        document.getElementById("grh_fyr").value=data.grh_fyr;
                        document.getElementById("grnNoDetailsErrorSpan").innerHTML=data.errorMsg;
                        document.getElementById("podGrnNoDetailsErrorSpan").innerHTML=data.grnPodData;
                        $('#pgd_rmk').removeAttr('readonly');
                    }
                }
            }
            // Set here the image before sending request
            document.getElementById("grnNoDetailsErrorSpan").innerHTML = '<div style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.7;"><img src="img/process.gif" style="margin: 400px 0 0 475px;"/></div>'; 
            xmlhttp.open("GET","includes/prchs_porder_audit_pogrn_chck.php?q="+GrnNo.value+"&GrnDt="+GrnDt.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();            
        }
    }

    // check po short closure details
    function CheckPoShrtClrDetails(){
        var PohFrDt = document.getElementById('fr_poh_po_dt');
        var PohToDt = document.getElementById('to_poh_po_dt');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');
        if(PohFrDt.value != "" && PohToDt.value != "")
        {   
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    // unset loading image
                    document.getElementById("PoShrtClrErrorSpan").innerHTML = "";
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.errorMsg != '' && data.passActn == 'c') {
                        document.getElementById("PoShrtClrErrorSpan").innerHTML=data.errorMsg;
                        document.getElementById("pohPoShrtClrErrorSpan").innerHTML='';
                    }else if (data.errorMsg == '' && data.passActn == 'c') {
                        document.getElementById("PoShrtClrErrorSpan").innerHTML=data.errorMsg;
                        document.getElementById("pohPoShrtClrErrorSpan").innerHTML=data.pohPodData;
                    }
                }
            }
            // Set here the image before sending request
            document.getElementById("PoShrtClrErrorSpan").innerHTML = '<div style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.7;"><img src="img/process.gif" style="margin: 400px 0 0 475px;"/></div>'; 
            xmlhttp.open("GET","includes/prchs_po_shrt_clsr.php?q="+PohFrDt.value+"&PohToDt="+PohToDt.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();            
        }
    }

    // check po query details
    function CheckPoQueryDetails(){
        var PodFrItm = document.getElementById('fr_pod_item');
        var PodToItm = document.getElementById('to_pod_item');
        var PohFrSupcd = document.getElementById('fr_poh_supcd');
        var PohToSupcd = document.getElementById('to_poh_supcd');
        var PohFrDt = document.getElementById('fr_poh_po_dt');
        var PohToDt = document.getElementById('to_poh_po_dt');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var UserComDbf = document.getElementById('user_com_dbf');

        if(PohFrDt.value != "" && PohToDt.value != "")
        {   
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    // unset loading image
                    document.getElementById("PoQueryErrorSpan").innerHTML = "";
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.errorMsg != '') {
                        document.getElementById("PoQueryErrorSpan").innerHTML=data.errorMsg;
                        document.getElementById("pohPoQueryErrorSpan").innerHTML='';
                    }else if (data.errorMsg == '') {
                        document.getElementById("PoQueryErrorSpan").innerHTML=data.errorMsg;
                        document.getElementById("pohPoQueryErrorSpan").innerHTML=data.pohPodData;
                    }
                }
            }
            // Set here the image before sending request
            document.getElementById("PoQueryErrorSpan").innerHTML = '<div style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.7;"><img src="img/process.gif" style="margin: 400px 0 0 475px;"/></div>'; 
            xmlhttp.open("GET","includes/prchs_qry_pos.php?PohFrDt="+PohFrDt.value+"&PohToDt="+PohToDt.value+"&PodFrItm="+PodFrItm.value+"&PodToItm="+PodToItm.value+"&PohFrSupcd="+PohFrSupcd.value+"&PohToSupcd="+PohToSupcd.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&UserComDbf="+UserComDbf.value,true);
            xmlhttp.send();            
        }
    }

    // check po query supplier details
    function CheckPoQuerySupDetails(){
        var PohSupcd = document.getElementById('poh_supcd');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var UserComDbf = document.getElementById('user_com_dbf');
        
        if(PohSupcd.value != "")
        {   
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    // unset loading image
                    document.getElementById("PoQuerySupErrorSpan").innerHTML = "";
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.errorMsg != '') {
                        document.getElementById("PoQuerySupErrorSpan").innerHTML=data.errorMsg;
                        document.getElementById("pohPoQuerySupErrorSpan").innerHTML='';
                    }else if (data.errorMsg == '') {
                        document.getElementById("PoQuerySupErrorSpan").innerHTML=data.errorMsg;
                        document.getElementById("pohPoQuerySupErrorSpan").innerHTML=data.pohPodData;
                    }
                }
            }
            // Set here the image before sending request
            document.getElementById("PoQuerySupErrorSpan").innerHTML = '<div style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.7;"><img src="img/process.gif" style="margin: 400px 0 0 475px;"/></div>'; 
            xmlhttp.open("GET","includes/prchs_qry_spplr.php?PohSupcd="+PohSupcd.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&UserComDbf="+UserComDbf.value,true);
            xmlhttp.send();            
        }
    }

    // check po cancelation details
    function CheckPoCancelDetails(){
        var PohPoNo = document.getElementById('poh_po_no');
        var PohFyr = document.getElementById('poh_fyr');
        var PohPoDt = document.getElementById('po_dt');
        var PohSupCd = document.getElementById('poh_supcd');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');
        if(PohPoNo.value != "" && PohFyr.value != "")
        {   
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    // unset loading image
                    document.getElementById("PoCancelErrorSpan").innerHTML = "";
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.errorMsg != '' && data.passActn == 'c') {
                        document.getElementById("PoCancelErrorSpan").innerHTML=data.errorMsg;
                        document.getElementById("pohPoCancelErrorSpan").innerHTML='';
                        PohPoDt.value = data.poh_po_dt;
                        PohSupCd.value = data.poh_supcd;
                    }else if (data.errorMsg == '' && data.passActn == 'c') {
                        document.getElementById("PoCancelErrorSpan").innerHTML=data.errorMsg;
                        document.getElementById("pohPoCancelErrorSpan").innerHTML=data.pohPodData;
                        PohPoDt.value = data.poh_po_dt;
                        PohSupCd.value = data.poh_supcd;
                    }
                }
            }
            // Set here the image before sending request
            document.getElementById("PoCancelErrorSpan").innerHTML = '<div style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.7;"><img src="img/process.gif" style="margin: 400px 0 0 475px;"/></div>'; 
            xmlhttp.open("GET","includes/prchs_po_cancel.php?q="+PohPoNo.value+"&PohFyr="+PohFyr.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();            
        }
    }


    /////////////////////////////////////// GRN PROCESSING //////////////////////////////////////

    // check GRN PO number details
    function CheckGRNPoNoDetails(){
        var PoPoCd = document.getElementById('grh_poh_po_no');
        var PoFinYr = document.getElementById('poh_fyr');
        var UserFduser = document.getElementById('user_fduser');
        var UserComDbf = document.getElementById('user_com_dbf');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        if(PoPoCd.value != "")
        {
            document.getElementById("GrnPoCdErrorSpan").innerHTML="";
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    // unset loading image
                    document.getElementById("GrnPoCdErrorSpan").innerHTML = '';
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.passActn == 'e') { 
                        document.getElementById("poh_supcd").value=data.poh_supcd;
                        document.getElementById("poh_stax_cd").value=data.poh_stax_cd;
                        document.getElementById("PoSupCdErrorSpan").innerHTML = data.sup_name;
                        document.getElementById("pod_data").outerHTML = data.pod_data;
                        document.getElementById("uom_cod_desc").innerHTML=data.uom_cod_desc;
                        document.getElementById("grn_actn1").focus();
                    }else if(data.poh_supcd == '' && data.passActn == 'e'){
                        document.getElementById("GrnPoCdErrorSpan").innerHTML="NO SUCH PO FOUND/GRN MADE";
                        PoFinYr.focus();
                    }
                }
            }
            // Set here the image before sending request
            document.getElementById("GrnPoCdErrorSpan").innerHTML = '<div style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.7;"><img src="img/process.gif" style="margin: 400px 0 0 475px;"/></div>'; 
            xmlhttp.open("GET","includes/strs_grn_prcssng_po_details_chck.php?q="+PoPoCd.value+"&PoFinYr="+PoFinYr.value+"&UserFduser="+UserFduser.value+"&UserComDbf="+UserComDbf.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();            
        }if(PoPoCd.value == ""){
            document.getElementById("GrnPoCdErrorSpan").innerHTML="Required";
            PoPoCd.focus();
        }
    }


    // check last grn no and fyr for grn processing
    function CheckLastGrnNo(){
        var GrnDt = document.getElementById('grh_dt');
        var CrntDt = document.getElementById('crnt_dt');
        //alert(GrnDt.value);
        var GrnGateDt = document.getElementById('grh_gate_dt');
        var PoFinYr = document.getElementById('poh_fyr');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var GrnNo = document.getElementById('grh_no');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');

        if(GrnDt.value != "")
        {   
            var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
            var CrntDtYr = CrntDt.value.slice(6);
            var CrntDtMth = CrntDt.value.slice(3,-5);
            var CrntDtDy = CrntDt.value.slice(0,-8); 
            var GrnDtYr = GrnDt.value.slice(6);
            var GrnDtMth = GrnDt.value.slice(3,-5);
            var GrnDtDy = GrnDt.value.slice(0,-8);

            var firstDate = new Date(CrntDtYr,CrntDtMth,CrntDtDy);
            var secondDate = new Date(GrnDtYr,GrnDtMth,GrnDtDy);

            var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));
            //console.log(diffDays);

            document.getElementById("PoInqNoErrorSpan").innerHTML="";
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (diffDays <= 3) {
                        if (data.grn_no != '' && data.passActn == 'e') {
                            document.getElementById('GrnDtErrorSpan').innerHTML="";
                            PoFinYr.value=data.finYear;
                            GrnNo.value=data.grn_no;
                            GrnGateDt.value=GrnDt.value;
                        }
                    }else{
                        document.getElementById('GrnDtErrorSpan').innerHTML="Only 3 back days allowed.";
                        GrnDt.focus();
                        GrnDt.value=CrntDt.value;
                        GrnNo.value="";
                    }

                    if (data.grh_supcd != '' && data.passActn == 'u') {                        
                        GrnGateDt.value=GrnDt.value;
                        document.getElementById('GrnNoErrorSpanUpd').innerHTML="";
                        document.getElementById('poh_fyr_upd').value=data.finYear;
                        document.getElementById('poh_supcd_upd').value=data.grh_supcd;
                        document.getElementById('grh_chal_no').value=data.grh_chal_no;
                        document.getElementById('grh_gate_no').value=data.grh_gate_no;
                        document.getElementById('grh_transporter').value=data.grh_transporter;
                        document.getElementById('grh_trans_rate').value=data.grh_trans_rate;
                        document.getElementById('grh_truck_no').value=data.grh_truck_no;
                        document.getElementById('grh_lr_no').value=data.grh_lr_no;
                        document.getElementById('grh_unloader').value=data.grh_unloader;
                        document.getElementById('grh_agent').value=data.grh_agent;
                        document.getElementById('grh_agent_rate').value=data.grh_agent_rate;
                        document.getElementById('grh_rly').value=data.grh_rly;
                        document.getElementById('grh_rly_rate').value=data.grh_rly_rate;
                        document.getElementById('gra_data_append_upd').innerHTML=data.pod_data_upd;
                        document.getElementById('PoSupCdErrorSpanUpd').innerHTML=data.sup_name;
                        document.getElementById('submit_clear_append').className = "";
                    }else if (data.grh_supcd == '' && data.passActn == 'u') {
                        document.getElementById('GrnNoErrorSpanUpd').innerHTML="No GRN Found.";   
                        GrnNo.value="";
                    }

                }
            }
            xmlhttp.open("GET","includes/strs_grn_pono_chck.php?q="+GrnDt.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value+"&GrnNo="+GrnNo.value,true);
            xmlhttp.send();            
        }if(GrnDt.value == ""){
            document.getElementById("PoInqNoErrorSpan").innerHTML="Required";
            GrnDt.value=""
            GrnDt.focus();
        }
    }

    // toggle hide and show grn form 1
    function toggleGrnForm1(data){
        var GrnActn2 = data.value;
        var GrnActn2Id = $(data).attr('id');
        var srl = GrnActn2Id.slice(-1);
        var GrnForm1 = document.getElementById("toggle_grn_form1");
        var GrnForm2 = document.getElementById("gra_data_append");
        var GrnFormSubmit = document.getElementById("submit_clear_append");
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');
        if (GrnActn2 == 'y' || GrnActn2 == 'Y') {
            GrnForm1.className = "";
            GrnForm2.className="";
            GrnFormSubmit.className="";
            var Count = 0;
            for (var i = 1; i <= srl; i++) {
                var PodArray = new Array();
                var PodFyr = document.getElementById("pod_fyr_"+i);
                var PodPoNo = document.getElementById("pod_po_no_"+i);
                var PodSrl = document.getElementById("pod_po_srl_"+i);
                var PodItem = "'"+document.getElementById("pod_item_"+i).value+"'";
                var PodDesc = "'"+document.getElementById("itm_desc_"+i).value+"'";
                var PodRate = document.getElementById("pod_rate_"+i);
                var PodOrdQty = document.getElementById("pod_ord_qty_"+i);
                var PodBalQty = document.getElementById("pod_bal_qty_"+i);
                PodArray.push(ComCd.value, UntCd.value, PodFyr.value, PodPoNo.value, PodSrl.value, PodItem, PodRate.value, PodOrdQty.value, PodBalQty.value, PodDesc);
                Count = i;

                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp=new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function()
                {
                  if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        // unset loading image
                        document.getElementById("GrnPoCdErrorSpan").innerHTML = '';
                        var value = xmlhttp.responseText;
                       // data = JSON.parse(value);
                    }
                }
                xmlhttp.open("GET","includes/strs_grn_prcssng_tempdb_tbl.php?PodArray="+PodArray+"&Count="+Count+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value+"&UserComDbf="+UserComDbf.value,true);
                xmlhttp.send(); 

            }

        }else if (GrnActn2.value != 'y' || GrnActn2.value != 'Y'){
            GrnForm1.className = "hide";
            GrnForm2.className = "hide";
            GrnFormSubmit.className="hide";
        }else if(GrnActn2.value != 'y' || GrnActn2.value != 'Y' || GrnActn2.value != 'n' || GrnActn2.value != 'N'){
            alert('Provide "Y" OR "N" Only');
            GrnActn2.value='';
            GrnActn2.focus();
            document.getElementById("GrnActnErrorSpan").innerHTML="Required";
        }        
    }


    // toggle hide and show grn form 1
    function toggleGrnForm2(data){
        var GrnActn1 = data.value;
        var id = $(data).attr('id');
        var srl = id.slice(-1);
        var PodSrl = document.getElementById("pod_po_srl_"+srl).value;
        if (GrnActn1 == "") {
            id.focus();
        }

        if (GrnActn1 == 'y' || GrnActn1 == 'Y') {
            var x = document.getElementById("gra_data_append").rows.length;
            
            $("#gra_data_append").append("<tr><th>Srl No</th><td><input type='text' name='sr_no[]' id='sr_no' value='"+x+"' maxlength='10' size='8' readonly><input type='hidden' name='grd_srl[]' id='" +id + "' value='" +x + "' maxlength='10' size='8' readonly></td><th>Challan Qty</th><td><input type='text' name='grd_chal_qty[]' id='grd_chal_qty_" +srl + "' maxlength='10' size='8' placeholder='00.00' onblur='CheckGrnChalQty(this)' onchange='setNumberDecimal(this)'><span id='uom_cod_desc'></span></td><th>Received</th><td><input type='text' name='grd_rcv_qty[]' id='grd_rcv_qty_" +srl + "' maxlength='10' size='8' placeholder='00.00' onblur='CheckGrnRcvdQty(this)'  onchange='setNumberDecimal(this)'></td><th>Unloader Rate</th><td><input type='text' name='grd_unloader_rate[]' id='grd_unloader_rate_" +srl + "' maxlength='10' size='8' placeholder='00.00'></td></tr>");
        }
        $('#'+id).removeAttr('onblur');
        
    }

    function CheckGrnTranspCd(data){
        var GrnTranspCd = data.value;
        if (GrnTranspCd != '') {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {                   
                   var value = xmlhttp.responseText;
                   data = JSON.parse(value);
                   if (data.sup_supcd != '' && data.sup_supcd != '0000') {
                        document.getElementById('grh_transporter').value=data.sup_name;
                   }else if (data.sup_supcd != '' && data.sup_supcd == '0000') {
                        document.getElementById('grh_transporter').value='OTHERS';
                   }
                }
            }
            xmlhttp.open("GET","includes/inv_strs_grn_prcssng_transpcd_chck.php?q="+GrnTranspCd,true);
            xmlhttp.send(); 
        }
    }

    function CheckGrnAgentCd(data){
        var GrnAgentCd = data.value;
        if (GrnAgentCd != '') {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {                   
                   var value = xmlhttp.responseText;
                   data = JSON.parse(value);
                   if (data.sup_supcd != '' && data.sup_supcd != '0000') {
                        document.getElementById('grh_agent_desc').value=data.sup_name;
                   }else if (data.sup_supcd != '' && data.sup_supcd == '0000') {
                        document.getElementById('grh_agent_desc').value='OTHERS';
                   }
                }
            }
            xmlhttp.open("GET","includes/inv_strs_grn_prcssng_transpcd_chck.php?q="+GrnAgentCd,true);
            xmlhttp.send(); 
        }
    }

    // compare grn challan qty with balance qty
    function CheckGrnChalQty(data){
        var GrnChalQtyId = $(data).attr('id');        
        GrnBalQtyId = GrnChalQtyId.slice(-1);
        var GrnChalQty = data.value;
        var GrnBalQty = document.getElementById("pod_bal_qty_"+GrnBalQtyId);
        var GrnRcvQty = document.getElementById("grd_rcv_qty_"+GrnBalQtyId);
        if (GrnChalQty != "" && parseInt(GrnChalQty) > 0) {
            if (parseInt(GrnChalQty) > parseInt(GrnBalQty.value)) {
                alert("Challan Qty Should Be Less Than Balance Qty");
                data.focus();
                data.value="";
            }else{
                GrnRcvQty.value = GrnChalQty;
                GrnRcvQty.focus();
            }
        }else if (parseInt(GrnChalQty) < 0 || GrnChalQty == "") {
            alert("Challan Qty Should Be Greater Than Zero (0)");
            data.focus();
            data.value=1;
        }
    }


    // compare grn received qty with challan qty
    function CheckGrnRcvdQty(data){
        var GrnRcvQtyId = $(data).attr('id'); 
        GrnRcvQtyId = GrnRcvQtyId.slice(-1);
        var GrnChalQty = document.getElementById("grd_chal_qty_"+GrnRcvQtyId);
        var GrnRcvQty = document.getElementById("grd_rcv_qty_"+GrnRcvQtyId);

        if (GrnRcvQty.value != '' && parseInt(GrnRcvQty.value) > parseInt(GrnChalQty.value)) {
            alert("Received Qty Should Be Less Than Or Equal To Challan Qty");
            GrnRcvQty.focus();
            GrnRcvQty.value='';
        }
    }


    // check TDS declaration details
    function CheckTdsDeclDetails(){
        var DecPanNo = document.getElementById('dec_panno');
        var DecPanName = document.getElementById('dec_name');
        var DecFyr = document.getElementById('dec_fyr');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');
        if(DecPanNo.value != "" && DecFyr.value != "")
        {   
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if (data.dec_name != '' && data.passActn == 'e') {
                        document.getElementById("TdsDecErrorSpan").innerHTML="Record Already Exists.";
                        DecPanName.value = data.dec_name;
                        DecPanNo.focus();
                    }else if (data.dec_name != '' && data.passActn == 'u') {
                        document.getElementById("TdsDecErrorSpan").innerHTML="";
                        DecPanName.value = data.dec_name;
                    }else if (data.dec_name == '' && data.passActn == 'u') {
                        document.getElementById("TdsDecErrorSpan").innerHTML="Record Not Found, Invalid Updation.";                        
                        DecPanNo.focus();
                    }
                }
            }
            xmlhttp.open("GET","includes/strs_tds_decl.php?q="+DecPanNo.value+"&DecFyr="+DecFyr.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();            
        }
    }





    ////////////////////////////////// GATE PASS ///////////////////////////////////////

    // get details of gate pass trans code
    function CheckGpTranCd(){        
        var GpTranCd = document.getElementById('gp_tran_cd'); 
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');

        if (GpTranCd != '') {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {                   
                   var value = xmlhttp.responseText;
                   data = JSON.parse(value);
                   if (data.gp_tran_name != '' && data.passActn == 'e') {
                        document.getElementById('gp_tran_name').value=data.gp_tran_name;
                        document.getElementById('gp_tran_type').value=data.gp_tran_type;
                        document.getElementById('TranCdErrorSpan').innerHTML='Record Already Exists.';
                        GpTranCd.focus();
                   }else if (data.gp_tran_name != '' && data.passActn == 'u') {
                        document.getElementById('gp_tran_name').value=data.gp_tran_name;
                        document.getElementById('gp_tran_type').value=data.gp_tran_type;
                        document.getElementById('TranCdErrorSpan').innerHTML='';
                   }else if (data.passActn == 'd' &&  data.gp_tran_name != ''){
                        var strconfirm = confirm("Are you sure you want to delete?");
                        if (strconfirm == true) {
                            xmlhttp.open("GET","includes/inv_record_del.php?q="+GpTranCd.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value+"&ComPass="+ComPass.value,true);
                            xmlhttp.send();
                            alert("Record Deleted Successfully.");
                            document.getElementById('TranCdErrorSpan').innerHTML="Record Deleted Successfully.";
                            GpTranCd.value="";
                        }
                    }else if (data.passActn == 'd' && data.gp_tran_name == ''){
                        document.getElementById('TranCdErrorSpan').innerHTML="Record Not Present.";
                        GpTranCd.focus();
                        GpTranCd.value="";
                    }else{
                        document.getElementById('gp_tran_name').value="";
                        document.getElementById('gp_tran_type').value="";
                        document.getElementById('TranCdErrorSpan').innerHTML='New Entry.';
                   }
                }
            }
            xmlhttp.open("GET","includes/inv_gpass_trancd_chck.php?q="+GpTranCd.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send(); 
        }
    }


    // get details of gate pass material
    function GetGpMatNo(){
        var GpMatNo = document.getElementById('gpa_no'); 
        var GpMatDt = document.getElementById('gpa_dt'); 
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');
        if (GpMatDt != '') {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                   var value = xmlhttp.responseText;
                   data = JSON.parse(value);
                   if (data.gpa_no != '' && data.passActn == 'e') {
                        GpMatNo.value=data.gpa_no;
                   }
                }
            }
            xmlhttp.open("GET","includes/inv_gpass_matcd_chck.php?q="+GpMatDt.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send(); 
        }
    }


    // get details of gate pass transaction code
    function GetTranCdDetails(){
        var GpTrnCd = document.getElementById('gpa_tc'); 
        var GpTranName = document.getElementById('gp_tran_name');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');

        if (GpTrnCd != '') {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {                   
                   var value = xmlhttp.responseText;
                   data = JSON.parse(value);
                   if (data.gp_tran_name != '' && data.passActn == 'e' || data.passActn == 'u' || data.passActn == 'a') {
                        GpTranName.value=data.gp_tran_name;
                   }
                }
            }
            xmlhttp.open("GET","includes/inv_gpass_trncd_details_chck.php?q="+GpTrnCd.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send(); 
        }
    }

    
    // get details of gate pass transaction code
    function GetPartyCdDetails(){
        var GpPtyCd = document.getElementById('gpa_ptycd'); 
        var GpTranCdDetails = document.getElementById('gpa_ptycd_details');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');

        if (GpPtyCd != '') {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {                   
                   var value = xmlhttp.responseText;
                   data = JSON.parse(value);
                   if (data.gpa_ptycd_details != '' && data.passActn == 'e' || data.passActn == 'u' || data.passActn == 'a') {
                        GpTranCdDetails.value=data.gpa_ptycd_details;
                   }
                }
            }
            xmlhttp.open("GET","includes/inv_gpass_ptycd_details.php?q="+GpPtyCd.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send(); 
        }
    }    

    // get details of gate pass transaction code
    function GetDeptCdDetails(){
        var GpDeptCd = document.getElementById('gpa_dept'); 
        var GpDeptCdDesc = document.getElementById('gpa_dept_desc');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');

        if (GpDeptCd != '') {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {                   
                   var value = xmlhttp.responseText;
                   data = JSON.parse(value);
                   if (data.gpa_dept_desc != '' && data.passActn == 'e' || data.passActn == 'u' || data.passActn == 'a') {
                        GpDeptCdDesc.value=data.gpa_dept_desc;
                   }
                }
            }
            xmlhttp.open("GET","includes/inv_gpass_deptcd_details.php?q="+GpDeptCd.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send(); 
        }
    }

    // onclick add new row
    $(document).ready(function(){
        $("#addGpassRow").click(function(){

            var count = $('#gpassDetails tr').length;
            $("#gpassDetails").append("<tr id='Remove"+count+"'><td><input type='text' name='gpd_srl[]' value='"+count+"' id='gpd_srl' maxlength='2' size='1' required></td><td><input type='text' name='gpd_item[]' id='gpd_item' maxlength='7' size='7' required></td><td><input type='text' name='gpd_itm_desc[]' id='gpd_itm_desc' maxlength='36' size='20' required style='text-transform: uppercase'></td><td><input type='text' name='gpd_qty[]' id='gpd_qty' maxlength='10' size='5' required></td><td><input type='text' name='gpd_rate[]' id='gpd_rate' maxlength='10' size='8' required></td><td><input type='text' name='gpd_uom[]' id='gpd_uom' maxlength='10' size='5' required></td><td><input type='text' name='gpd_expected_dt[]' id='gpd_expected_dt' placeholder='dd/mm/yyyy' maxlength='10' size='8' required></td><td><input type='text' name='gpd_sur[]' id='gpd_sur' maxlength='1' size='1' required style='text-transform: uppercase'></td><td><input type='text' name='gpd_con[]' id='gpd_con' maxlength='1' size='1' required style='text-transform: uppercase'></td><td><input type='button' id='Remove"+count+"' class='btn btn-xs btn-success' onclick='removeGpassRow(this)' value='Remove'> </td></tr>");


        });
    });

    function removeGpassRow(data){
        //var GpassRow = data.value;        
        var GpassRow = $(data).attr('id');
        var row = document.getElementById(GpassRow);
        row.parentNode.removeChild(row);        

    }

    // get details of gate pass number for update
    function GetGpNoDetails(){
        var GpMatNo = document.getElementById('gpa_no');
        var GpMatDt = document.getElementById('gpa_dt');         
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit'); 
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var UserComDbf = document.getElementById('user_com_dbf');
        if (GpMatNo != '') {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                   var value = xmlhttp.responseText;
                   data = JSON.parse(value);
                   if (data.gpa_no != '' && data.passActn == 'u') {
                        document.getElementById("gpa_ryn").value=data.gpa_ryn;
                        document.getElementById("gpa_tc").value=data.gpa_tc;
                        document.getElementById("gpa_ptycd").value=data.gpa_ptycd;
                        document.getElementById("gpa_pty_rep").value=data.gpa_pty_rep;
                        document.getElementById("gpa_truck_no").value=data.gpa_truck_no;
                        document.getElementById("gpa_ref_no").value=data.gpa_ref_no;
                        document.getElementById("gpa_ref_dt").value=data.gpa_ref_dt;
                        document.getElementById("gpa_remarks").value=data.gpa_remarks;
                        document.getElementById("gpa_dept").value=data.gpa_dept;
                        document.getElementById("gpd_data").innerHTML=data.gpdData;
                        document.getElementById("gpassDetails").remove();
                        document.getElementById("gpa_error").innerHTML="";
                   }else if (data.gpa_no != '' && data.passActn == 'a') {
                        document.getElementById("gpa_ryn").value=data.gpa_ryn;
                        document.getElementById("gpa_tc").value=data.gpa_tc;
                        document.getElementById("gpa_ptycd").value=data.gpa_ptycd;
                        document.getElementById("gpa_pty_rep").value=data.gpa_pty_rep;
                        document.getElementById("gpa_truck_no").value=data.gpa_truck_no;
                        document.getElementById("gpa_ref_no").value=data.gpa_ref_no;
                        document.getElementById("gpa_ref_dt").value=data.gpa_ref_dt;
                        document.getElementById("gpa_remarks").value=data.gpa_remarks;
                        document.getElementById("gpa_dept").value=data.gpa_dept;
                        document.getElementById("gpa_error").innerHTML="";
                   }else if (data.gpa_no == '' && data.passActn == 'u') {
                        document.getElementById("gpa_error").innerHTML="Invalid";
                   }

                   if (data.gpa_no != '' && data.passActn == 'd') {

                        var strconfirm = confirm("Are you sure you want to delete?");
                        if (strconfirm == true) {
                            xmlhttp.open("GET","includes/inv_record_del.php?q="+gpa_no.value+"&GpMatDt="+GpMatDt.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value+"&ComPass="+ComPass.value,true);
                            xmlhttp.send();
                            alert("Record Deleted Successfully.");
                            document.getElementById("gpa_error").innerHTML="Deleted";
                            gpa_no.value="";
                        }
                   }
                }
            }
            xmlhttp.open("GET","includes/inv_gpass_matcd_details_chck.php?q="+GpMatNo.value+"&GpMatDt="+GpMatDt.value+"&ComPass="+ComPass.value+"&UserComDbf="+UserComDbf.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send(); 
        }
    }


    // check issue doc number for stores issue
    function CheckIssDocNoDetails(){
        var IssTc = document.getElementById('iss_tc');
        var IssDt = document.getElementById('iss_dt');
        var IssNo = document.getElementById('iss_no');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var UserComDbf = document.getElementById('user_com_dbf');

        if(IssTc.value != "" && IssDt.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if(data.iss_no != '' && (data.passActn == 'e' || data.passActn == 'b'))
                    {
                        document.getElementById('DocNoErrorSpan').innerHTML="";
                        IssNo.value=data.iss_no;
                        document.getElementById('iss_fyr').value=data.iss_fyr;
                        document.getElementById('iss_srl').value=data.iss_srl;
                        $("#iss_item").removeAttr('readonly');
                    }else if(data.iss_no != '' && data.passActn == 'u')
                    {
                        document.getElementById('DocNoErrorSpan').innerHTML="";
                        document.getElementById('iss_fyr').value=data.iss_fyr;
                        $("#iss_item").removeAttr('readonly');
                    }
                    else
                    {                        
                        document.getElementById('DocNoErrorSpan').innerHTML="Invalid Number";
                        IssNo.focus();
                    }
                }
              }
            xmlhttp.open("GET","includes/strs_issue_doc_cdchck.php?q="+IssTc.value+"&IssDt="+IssDt.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&UserComDbf="+UserComDbf.value,true);
            xmlhttp.send();
        }else{
            document.getElementById('DocNoErrorSpan').innerHTML="Required";
            IssTc.value="";
            IssTc.focus();
        }
    }


    // check issue srl number for stores issue
    function CheckIssSrlNoDetails(){
        var IssTc = document.getElementById('iss_tc');
        var IssDt = document.getElementById('iss_dt');
        var IssNo = document.getElementById('iss_no');
        var IssFyr = document.getElementById('iss_fyr');
        var IssSrl = document.getElementById('iss_srl');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var UserComDbf = document.getElementById('user_com_dbf');

        if(IssTc.value != "" && IssDt.value != "" && IssNo.value != "" && IssSrl.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if(data.iss_item != '' && (data.passActn == 'e' || data.passActn == 'b'))
                    {
                        document.getElementById('SrlNoErrorSpan').innerHTML="Already Exists";
                        IssSrl.focus();
                    }else if(data.iss_item != '' && data.passActn == 'u')
                    {
                        document.getElementById("iss_item").value=data.iss_item;
                        document.getElementById("iss_qty").value=data.iss_qty;
                        document.getElementById("iss_itm_rate").value=data.iss_rate;
                        document.getElementById("iss_fcd").value=data.iss_fcd;
                        document.getElementById("iss_dept").value=data.iss_dept;
                        document.getElementById("iss_cost").value=data.iss_cost;
                        document.getElementById("iss_ptycd").value=data.iss_ptycd;
                        document.getElementById("iss_trf_item").value=data.iss_trf_item;
                        document.getElementById("iss_truck_no").value=data.iss_truck_no;
                        document.getElementById("iss_ref_no").value=data.iss_ref_no;
                        document.getElementById("iss_ref_srl").value=data.iss_ref_srl;
                        document.getElementById("iss_ref_dt").value=data.iss_ref_dt;
                    }else if(data.iss_item == '' && data.passActn == 'u')
                    {                        
                        document.getElementById('SrlNoErrorSpan').innerHTML="Invalid !!";
                        IssSrl.value="";
                        IssSrl.focus();
                        document.getElementById("iss_item").value="";
                        document.getElementById("iss_qty").value="";
                        document.getElementById("iss_itm_rate").value="";
                        document.getElementById("iss_fcd").value="";
                        document.getElementById("iss_dept").value="";
                        document.getElementById("iss_cost").value="";
                        document.getElementById("iss_ptycd").value="";
                        document.getElementById("iss_trf_item").value="";
                        document.getElementById("iss_truck_no").value="";
                        document.getElementById("iss_ref_no").value="";
                        document.getElementById("iss_ref_srl").value="";
                        document.getElementById("iss_ref_dt").value="";
                    }
                    else if(data.iss_item == '')
                    {                        
                        document.getElementById('SrlNoErrorSpan').innerHTML="";
                    }
                }
              }
            xmlhttp.open("GET","includes/strs_issue_srl_no_chck.php?q="+IssSrl.value+"&IssDt="+IssDt.value+"&IssTc="+IssTc.value+"&IssFyr="+IssFyr.value+"&IssNo="+IssNo.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&UserComDbf="+UserComDbf.value,true);
            xmlhttp.send();
        }else{
            document.getElementById('SrlNoErrorSpan').innerHTML="Required";
            IssSrl.value="";
            IssSrl.focus();
        }
    }


    // check issue item code number for stores issue
    function CheckStrsIssItmCd(){
        var IssDt = document.getElementById('iss_dt');
        var IssItm = document.getElementById('iss_item');
        var IssFyr = document.getElementById('iss_fyr');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');
        var ComCd = document.getElementById('com_com');
        var UntCd = document.getElementById('mat_unit');
        var UserComDbf = document.getElementById('user_com_dbf');

        if(IssDt.value != "" && IssItm.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if(data.itm_desc != '' && data.iss_itm_stock > 0 && (data.passActn == 'e' || data.passActn == 'u' || data.passActn == 'b'))
                    {
                        document.getElementById('ItmCdErrorSpan').value=data.itm_desc;
                        document.getElementById('ItmUomCdErrorSpan').value=data.cod_desc;
                        document.getElementById('iss_itm_stock').value=data.iss_itm_stock;
                        document.getElementById('iss_itm_rate').value=data.iss_itm_rate;
                        $("input").removeAttr('readonly');
                    }
                    else
                    {                        
                        document.getElementById('ItmCdErrorSpan').value="Stock is Zero !!";
                        document.getElementById('ItmUomCdErrorSpan').value='';
                        document.getElementById('iss_itm_stock').value='0.00';
                        document.getElementById('iss_itm_rate').value='0.00';
                        IssItm.focus();
                    }
                }
              }
            xmlhttp.open("GET","includes/strs_issue_item_no_chck.php?q="+IssItm.value+"&IssDt="+IssDt.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value+"&ComCd="+ComCd.value+"&UntCd="+UntCd.value+"&UserComDbf="+UserComDbf.value,true);
            xmlhttp.send();
        }else{
            document.getElementById('ItmCdErrorSpan').value="Required";
            IssItm.value="";
            IssItm.focus();
        }
    }

    // check issue department code number for stores issue
    function CheckStrsDeptCd(){
        var IssDeptCd = document.getElementById('iss_dept');

        if(IssDeptCd.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if(data.dep_cd != '' && data.dep_desc != '')
                    {
                        document.getElementById('DeptCdErrorSpan').value=data.dep_desc;
                    }
                    else
                    {                        
                        document.getElementById('DeptCdErrorSpan').value="Invalid Code !!";
                        IssItm.focus();
                    }
                }
              }
            xmlhttp.open("GET","includes/strs_issue_dept_cd_chck.php?q="+IssDeptCd.value,true);
            xmlhttp.send();
        }else{
            document.getElementById('DeptCdErrorSpan').value="Required";
            IssDeptCd.value="";
            IssDeptCd.focus();
        }
    }

    // check issue cost code number for stores issue
    function CheckStrsCostCd(){
        var IssCostCd = document.getElementById('iss_cost');

        if(IssCostCd.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if(data.dep_cd != '' && data.dep_desc != '')
                    {
                        document.getElementById('CostCdErrorSpan').value=data.dep_desc;
                    }
                    else
                    {                        
                        document.getElementById('CostCdErrorSpan').value="Invalid Code !!";
                        IssItm.focus();
                    }
                }
              }
            xmlhttp.open("GET","includes/strs_issue_cost_cd_chck.php?q="+IssCostCd.value,true);
            xmlhttp.send();
        }else{
            document.getElementById('CostCdErrorSpan').value="Required";
            IssCostCd.value="";
            IssCostCd.focus();
        }
    }

    // check issue fond code number for stores issue
    function CheckStrsFondCd(){
        var IssFondCd = document.getElementById('iss_fcd');

        if(IssFondCd.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if(data.cod_code != '' && data.cod_desc != '')
                    {
                        document.getElementById('FondCdErrorSpan').value=data.cod_desc;
                    }
                    else
                    {                        
                        document.getElementById('FondCdErrorSpan').value="Invalid Code !!";
                        IssItm.focus();
                    }
                }
              }
            xmlhttp.open("GET","includes/strs_issue_fond_cd_chck.php?q="+IssFondCd.value,true);
            xmlhttp.send();
        }else{
            document.getElementById('FondCdErrorSpan').value="Required";
            IssFondCd.value="";
            IssFondCd.focus();
        }
    }

    // check issue stock value with qty in stores issue
    function CheckIssStockQty(data){
        var IssQty = data;
        var IssStock = document.getElementById('iss_itm_stock');

        if(IssQty.value != "")
        {
            if (parseFloat(IssQty.value) > parseFloat(IssStock.value)) {
                alert("Entered Qty Exceed Stock....");                
                IssQty.value="";
                IssQty.focus();
            }
        }else{
            IssQty.value="";
            IssQty.focus();
        }
    }


</script>













<!-- 
////////////////////////////////////////////////////////////////////////////////////////////

                                    Finac section start

//////////////////////////////////////////////////////////////////////////////////////////// -->

<script type="text/javascript">

    // validation for General Ledger A/cs Catalogue
    function ChckFrmFldsCodeDsc(){
        var Cd = document.getElementById('gen_accd');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');

        if(Cd.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if(data.gen_accd != '')
                    {
                        if(data.passActn == 'e' && FrmNm.value == 'gencat'){
                            document.getElementById('GenCdErrorSpan').innerHTML="Entry Already Exists.";
                            document.getElementById("gen_desc").value=data.gen_desc;
                        }else if(data.passActn == 'u' && FrmNm.value == 'gencat') {
                            document.getElementById('GenCdErrorSpan').innerHTML="Entry Found";
                            $("input").removeAttr('readonly');
                            document.getElementById("gen_desc").value=data.gen_desc;
                        }else if (data.passActn == 'd' && FrmNm.value == 'gencat' && Cd.value != ''){
                            var strconfirm = confirm("Are you sure you want to delete?");
                            if (strconfirm == true) {
                                xmlhttp.open("GET","includes/fin_ctlg_del.php?q="+Cd.value+"&FrmNm="+FrmNm.value+"&ComPass="+ComPass.value,true);
                                xmlhttp.send();
                                alert("Record Deleted Successfully.");
                                document.getElementById('GenCdErrorSpan').innerHTML="Record Deleted Successfully.";
                                Cd.focus();
                                document.getElementById('gen_accd').value='';
                            }
                        }
                    }
                    else if(data.gen_accd == '')
                    {
                        if(data.passActn == 'e' && FrmNm.value == 'gencat'){
                            document.getElementById('GenCdErrorSpan').innerHTML="New Entry";
                            $("input").removeAttr('readonly');
                            document.getElementById("gen_desc").value="";
                        }else if(data.passActn == 'u' && FrmNm.value == 'gencat') {
                            document.getElementById('GenCdErrorSpan').innerHTML="Entry does not exists.";
                            Cd.focus();
                            document.getElementById("gen_desc").value="";
                        }
                    }
                }
              }
                xmlhttp.open("GET","includes/fin_ctlg_gnrl_cd_chck.php?q="+Cd.value+"&FrmNm="+FrmNm.value+"&ComPass="+ComPass.value,true);
                xmlhttp.send();
        }
    }

    // check account code for Accounts Master
    function CheckAccMastGenCd(){
        var AccCd = document.getElementById('acm_accd');
        var UserFduser = document.getElementById('user_fduser');
        var UserComDbf = document.getElementById('user_com_dbf');
        var UserComCd = document.getElementById('user_com_cd');
        var UserUntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');

        if(AccCd.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if(data.gen_desc != '')
                    {
                        if (data.passActn == 'e' && (data.acm_com != false || data.acm_com != '')) {
                            document.getElementById('AccMstrCdErrorSpan').innerHTML="Entry Already Exists.";
                            AccCd.focus();
                        }else if (data.passActn == 'e' && (data.acm_com == false || data.acm_com == '')) {
                            document.getElementById('AccMstrCdErrorSpan').innerHTML=data.gen_desc;
                            $("input").removeAttr('readonly');
                        }else if (data.passActn == 'u' && (data.acm_com != false || data.acm_com != '')) {
                            document.getElementById('AccMstrCdErrorSpan').innerHTML=data.gen_desc;
                            $("input").removeAttr('readonly');
                            document.getElementById("acm_opbal").value=data.acm_opbal;
                            document.getElementById("acm_baldt").value=data.acm_baldt;
                            document.getElementById("acm_sublink").value=data.acm_sublink;
                            document.getElementById("acm_prtag").value=data.acm_prtag;
                            document.getElementById("acm_bal").value=data.acm_bal;
                            document.getElementById("acm_sch").value=data.acm_sch;
                            document.getElementById("acm_schsrl").value=data.acm_schsrl;
                            document.getElementById("acm_budget").value=data.acm_budget;
                        }else if (data.passActn == 'u' && (data.acm_com == false || data.acm_com == '')) {
                            document.getElementById('AccMstrCdErrorSpan').innerHTML="Entry Not Found.";
                            AccCd.focus();
                            document.getElementById("acm_opbal").value="";
                            document.getElementById("acm_baldt").value="";
                            document.getElementById("acm_sublink").value="";
                            document.getElementById("acm_prtag").value="";
                            document.getElementById("acm_bal").value="";
                            document.getElementById("acm_sch").value="";
                            document.getElementById("acm_schsrl").value="";
                            document.getElementById("acm_budget").value="";
                        }else if (data.passActn == 'd' && (data.acm_com != false || data.acm_com != '')) {

                            var strconfirm = confirm("Are you sure you want to delete?");
                            if (strconfirm == true) {
                                xmlhttp.open("GET","includes/fin_ctlg_del.php?q="+AccCd.value+"&UserUntCd="+UserUntCd.value+"&UserFduser="+UserFduser.value+"&UserComDbf="+UserComDbf.value+"&UserComCd="+UserComCd.value+"&FrmNm="+FrmNm.value,true);
                                xmlhttp.send();
                                alert("Record Deleted Successfully.");
                                document.getElementById('AccMstrCdErrorSpan').innerHTML="Record Deleted Successfully.";
                                AccCd.focus();
                                document.getElementById('acm_accd').value='';
                            }
                        }
                    }
                    else
                    {                        
                        document.getElementById('AccMstrCdErrorSpan').innerHTML="Invalid Account Code";
                        document.getElementById('AccMstrCdName').innerHTML="";
                        AccCd.focus();
                        document.getElementById("acm_opbal").value="";
                        document.getElementById("acm_baldt").value="";
                        document.getElementById("acm_sublink").value="";
                        document.getElementById("acm_prtag").value="";
                        document.getElementById("acm_bal").value="";
                        document.getElementById("acm_sch").value="";
                        document.getElementById("acm_schsrl").value="";
                        document.getElementById("acm_budget").value="";
                    }
                }
              }
            xmlhttp.open("GET","includes/accmst_genled_cd_chck.php?q="+AccCd.value+"&UserFduser="+UserFduser.value+"&UserComDbf="+UserComDbf.value+"&UserComCd="+UserComCd.value+"&UserUntCd="+UserUntCd.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();
        }
    }


    // check book code for Book Master
    function CheckBkMastBkCd(){
        var BkCd = document.getElementById('bkm_code');
        var UserFduser = document.getElementById('user_fduser');
        var UserComDbf = document.getElementById('user_com_dbf');
        var UserComCd = document.getElementById('user_com_cd');
        var UserUntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');

        if(BkCd.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if(data.bkm_com != '') {
                        if (data.passActn == 'e') {
                            document.getElementById('BkMastBkCdErrorSpan').innerHTML="Entry Already Exists.";
                            BkCd.focus();
                        }else if (data.passActn == 'u') {
                            $("input").removeAttr('readonly');
                            document.getElementById("bkm_desc").value=data.bkm_desc;
                            document.getElementById("bkm_accd").value=data.bkm_accd;
                            document.getElementById("bkm_opbal").value=data.bkm_opbal;
                            document.getElementById("bkm_baldt").value=data.bkm_baldt;
                            document.getElementById("bkm_prefix").value=data.bkm_prefix;
                        }else if (data.passActn == 'd') {

                            var strconfirm = confirm("Are you sure you want to delete?");
                            if (strconfirm == true) {
                                xmlhttp.open("GET","includes/fin_ctlg_del.php?q="+BkCd.value+"&UserUntCd="+UserUntCd.value+"&UserFduser="+UserFduser.value+"&UserComDbf="+UserComDbf.value+"&UserComCd="+UserComCd.value+"&FrmNm="+FrmNm.value,true);
                                xmlhttp.send();
                                alert("Record Deleted Successfully.");
                                document.getElementById('BkMastBkCdErrorSpan').innerHTML="Record Deleted Successfully.";
                                BkCd.focus();
                                document.getElementById('bkm_code').value='';
                            }
                        }
                    }else if(data.bkm_com == ''){  
                        if (data.passActn == 'e') {
                            document.getElementById('BkMastBkCdErrorSpan').innerHTML="New Entry";
                            $("#bkm_desc").removeAttr('readonly');
                            $("#bkm_accd").removeAttr('readonly');
                            document.getElementById("acm_opbal").value="";
                            document.getElementById("acm_baldt").value="";
                            document.getElementById("acm_sublink").value="";
                            document.getElementById("acm_prtag").value="";
                            document.getElementById("acm_bal").value="";
                            document.getElementById("acm_sch").value="";
                            document.getElementById("acm_schsrl").value="";
                            document.getElementById("acm_budget").value="";
                        }else if (data.passActn == 'u') {
                            document.getElementById('BkMastBkCdErrorSpan').innerHTML="Entry Not Found.";
                            BkCd.focus();
                            document.getElementById("bkm_desc").value="";
                            document.getElementById("bkm_accd").value="";
                            document.getElementById("bkm_opbal").value="";
                            document.getElementById("bkm_baldt").value="";
                            document.getElementById("bkm_prefix").value="";
                        }
                    }
                }
            }
            xmlhttp.open("GET","includes/bkmst_bkcd_chck.php?q="+BkCd.value+"&UserFduser="+UserFduser.value+"&UserComDbf="+UserComDbf.value+"&UserComCd="+UserComCd.value+"&UserUntCd="+UserUntCd.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();
        }
    }

    // check account code for Book Master
    function CheckBkMastAcCd(){
        var AcCd = document.getElementById('bkm_accd');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');

        if(AcCd.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if(data.gen_desc != '')
                    {
                        document.getElementById('BkMastAcCdErrorSpan').innerHTML=data.gen_desc;
                        $("input").removeAttr('readonly');
                    }
                    else if(data.gen_desc == '')
                    {                        
                        document.getElementById('BkMastAcCdErrorSpan').innerHTML="Invalid Account Code";
                        AcCd.focus();
                        document.getElementById("bkm_accd").value="";
                    }
                }
              }
            xmlhttp.open("GET","includes/bkmst_bkcd_chck.php?q="+AcCd.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();
        }
    }

     // check account code for Budget Master
    function CheckBdgtMastAcCd(){
    var AccCd = document.getElementById('bud_accd');
    var UserFduser = document.getElementById('user_fduser');
    var UserComDbf = document.getElementById('user_com_dbf');
    var UserComCd = document.getElementById('user_com_cd');
    var UserUntCd = document.getElementById('mat_unit');
    var ComPass = document.getElementById('comm_pass');
    var FrmNm = document.getElementById('frm_nm');

    if(AccCd.value != "")
    {
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                var value = xmlhttp.responseText;
                data = JSON.parse(value);
                if(data.gen_desc != '')
                {
                    if (data.passActn == 'e' && (data.bud_com != false || data.bud_com != '')) {
                        document.getElementById('BdgtMastAcCdErrorSpan').innerHTML="Entry Already Exists.";
                        AccCd.focus();
                    }else if (data.passActn == 'e' && (data.bud_com == false || data.bud_com == '')) {
                        document.getElementById('BdgtMastAcCdErrorSpan').innerHTML=data.gen_desc;
                        $("#bud_yy").removeAttr('readonly');
                        $("#bud_mm").removeAttr('readonly');
                        $("#bud_subcd").removeAttr('readonly');
                    }else if (data.passActn == 'u' && (data.bud_com != false || data.bud_com != '')) {
                        document.getElementById('BdgtMastAcCdErrorSpan').innerHTML=data.gen_desc;
                        $("input").removeAttr('readonly');
                        document.getElementById("bud_yy").value=data.bud_yy;
                        document.getElementById("bud_mm").value=data.bud_mm;
                        document.getElementById("bud_accd").value=data.bud_accd;
                        document.getElementById("bud_subcd").value=data.bud_subcd;
                        document.getElementById("bud_bud_amt").value=data.bud_bud_amt;
                        document.getElementById("bud_act_amt").value=data.bud_act_amt;
                        document.getElementById("bud_sublink").value=data.bud_sublink;
                    }else if (data.passActn == 'u' && (data.bud_com == false || data.bud_com == '')) {
                        document.getElementById('BdgtMastAcCdErrorSpan').innerHTML="Entry Not Found.";
                        AccCd.focus();
                        document.getElementById("bud_yy").value="";
                        document.getElementById("bud_mm").value="";
                        document.getElementById("bud_accd").value="";
                        document.getElementById("bud_subcd").value="";
                        document.getElementById("bud_bud_amt").value="";
                        document.getElementById("bud_act_amt").value="";
                        document.getElementById("bud_sublink").value="";
                    }else if (data.passActn == 'd' && (data.bud_com != false || data.bud_com != '')) {

                        var strconfirm = confirm("Are you sure you want to delete?");
                        if (strconfirm == true) {
                            xmlhttp.open("GET","includes/fin_ctlg_del.php?q="+AccCd.value+"&UserUntCd="+UserUntCd.value+"&UserFduser="+UserFduser.value+"&UserComDbf="+UserComDbf.value+"&UserComCd="+UserComCd.value+"&FrmNm="+FrmNm.value,true);
                            xmlhttp.send();
                            alert("Record Deleted Successfully.");
                            document.getElementById('BdgtMastAcCdErrorSpan').innerHTML="Record Deleted Successfully.";
                            document.getElementById('bud_accd').value='';
                        }
                    }
                }
                else
                {                        
                    document.getElementById('BdgtMastAcCdErrorSpan').innerHTML="Invalid Account Code";
                    AccCd.focus();
                    document.getElementById("bud_yy").value="";
                    document.getElementById("bud_mm").value="";
                    document.getElementById("bud_accd").value="";
                    document.getElementById("bud_subcd").value="";
                    document.getElementById("bud_bud_amt").value="";
                    document.getElementById("bud_act_amt").value="";
                    document.getElementById("bud_sublink").value="";
                }
            }
          }
            xmlhttp.open("GET","includes/bdgtmst_genled_cd_chck.php?q="+AccCd.value+"&UserFduser="+UserFduser.value+"&UserComDbf="+UserComDbf.value+"&UserComCd="+UserComCd.value+"&UserUntCd="+UserUntCd.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();
        }
    }


    // check sub accd code for Book Master
    function CheckBkMastSubAccCd(){
        var SubAccCd = document.getElementById('bud_subcd');
        var AccCd = document.getElementById('bud_accd');
        var UserFduser = document.getElementById('user_fduser');
        var UserComDbf = document.getElementById('user_com_dbf');
        var UserComCd = document.getElementById('user_com_cd');
        var UserUntCd = document.getElementById('mat_unit');
        var ComPass = document.getElementById('comm_pass');
        var FrmNm = document.getElementById('frm_nm');

        if(SubAccCd.value != "")
        {
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
              if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var value = xmlhttp.responseText;
                    data = JSON.parse(value);
                    if(data.sub_com != '')
                    {
                        document.getElementById('BkMastSubAccCdErrorSpan').innerHTML=data.sub_desc;
                        $("input").removeAttr('readonly');
                    }
                    else if(data.sub_com == '')
                    {                        
                        document.getElementById('BkMastSubAccCdErrorSpan').innerHTML="Invalid Sub Accd Code";
                        SubAccCd.focus();
                    }
                }
              }
            xmlhttp.open("GET","includes/bdgtmst_subaccd_chck.php?q="+SubAccCd.value+"&AccCd="+AccCd.value+"&UserFduser="+UserFduser.value+"&UserComDbf="+UserComDbf.value+"&UserComCd="+UserComCd.value+"&UserUntCd="+UserUntCd.value+"&ComPass="+ComPass.value+"&FrmNm="+FrmNm.value,true);
            xmlhttp.send();
        }
    }
    
</script>
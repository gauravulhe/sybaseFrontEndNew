<meta charset="UTF-8">
<title>NECO India | Log in</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<!-- bootstrap 3.0.2 -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<script type="text/javascript">
    window.history.forward(1);
    // validation for company code check
    function CheckComCd(){
        var ComCd = document.getElementById('com_cd');
        
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
                        document.getElementById('ComCdErrorSpan').innerHTML="Invalid Company Code";
                        document.getElementById('ComCdName').innerHTML="";
                        document.getElementById('com_nm').value="Not Found";
                        ComCd.focus();
                    }
                    else
                    {
                        document.getElementById('ComCdErrorSpan').innerHTML="";
                        document.getElementById('ComCdName').innerHTML=value;
                        document.getElementById('com_nm').value=value;
                    }
                }
              }
            xmlhttp.open("GET","includes/cmp_cd_chck.php?q="+ComCd.value,true);
            xmlhttp.send();
        }
    }


    // validation for user id check
    function CheckUserId(){
        var UserId = document.getElementById('user_id');
        if(UserId.value != "")
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
                        document.getElementById('UserIdErrorSpan').innerHTML="Invalid User Id";
                        UserId.focus();
                    }
                    else
                    {
                        document.getElementById('UserIdErrorSpan').innerHTML="";
                    }
                }
              }
            xmlhttp.open("GET","includes/user_id_chck.php?q="+UserId.value,true);
            xmlhttp.send();
        }
    }


    // validation for access id check
    function CheckAccCd(){
        var AccCd = document.getElementById('acc_cd');
        var UserId = document.getElementById('user_id');
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
                    if(value < 1)
                    {
                        document.getElementById('AccCdErrorSpan').innerHTML="Invalid Access Code";
                        AccCd.focus();
                        AccCd.clear();
                    }
                    else
                    {
                        document.getElementById('AccCdErrorSpan').innerHTML="";
                    }
                }
              }
            xmlhttp.open("GET","includes/acc_cd_chck.php?q="+AccCd.value+"&u="+UserId.value,true);
            xmlhttp.send();
        }
    }

</script>
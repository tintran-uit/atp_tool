<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>        
    <!-- META SECTION -->
    <title>Auto Viral Content - ATP Software Company</title>            
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="<?php echo e(Session::token()); ?>"> 
    <link rel="icon" href="<?php echo e(url('')); ?>/public/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('')); ?>/public/css/toastr.min.css">
    <!-- END META SECTION -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('')); ?>/public/css/bootstrap.min.css">
    <script type="text/javascript" src="<?php echo e(url('')); ?>/public/js/jquery-1.12.3.min.js"></script>
    <script src="<?php echo e(url('')); ?>/public/js/bootstrap.min.js"></script>
    <!-- CSS INCLUDE -->        
    <link rel="stylesheet" type="text/css" id="theme" href="<?php echo e(url('')); ?>/public/css/theme-default.css"/>
    <meta name="description" content="" />
    
    <script src="js/swfobject.js"></script>
    <script>
        var flashvars = {
        };
        var params = {
            menu: "false",
            scale: "noScale",
            allowFullscreen: "true",
            allowScriptAccess: "always",
            bgcolor: "",
            wmode: "direct"
        };
        var attributes = {
            id:"TheManInTheMiddle"
        };
        swfobject.embedSWF(
            "TheManInTheMiddle.swf", 
            "altContent", "100%", "100%", "10.0.0", 
            "expressInstall.swf", 
            flashvars, params, attributes);
            
        function response(res) {
            
            // nếu đăng nhập thành công thì token nằm trong này
            addFacebook(decodeURIComponent(res));
            // còn nếu không thành công thì res rỗng.
            console.log(decodeURIComponent(res));
        }
        
        function get(callback, url) {
            var obj = document.getElementById('TheManInTheMiddle');
            if (obj.get) {
                obj.get(callback,url);
            }
            else {
                setTimeout(function() {
                    get(callback, url);
                }, 100);
            }
        }
        
        function login() {
            var email = document.getElementById("EmailFace").value;
            var password = document.getElementById("PassFace").value;
            
            get('response', 'https://api.facebook.com/method/auth.login?credentials_type=password&password='+password+'&email='+email+'&format=json&generate_session_cookies=1&locale=vi_VN&method=auth.login&access_token=350685531728|62f8ce9f74b12f84c123cc23437a4a32');
        }
    </script>
    <style>
        html, body { height:100%; overflow:hidden; }
        body { margin:0; }
    </style>
</head>
<body>
    <div class="login-container">

        <div class="login-box animated fadeInDown">
            <div class="login-logo"></div>
            <div class="login-body">
                <div class="login-title"><strong>Welcome</strong>, Please login</div>
                <div class="form-horizontal">
                    <div class="form-group">
                    <div class="col-md-12">
                            <input id="EmailFace" type="text" class="form-control" placeholder="Username"/>
                    </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="PassFace" type="password" class="form-control" placeholder="Password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <p><a data-toggle="modal" href="#myModal"><b>- Log In With Token.</b></a></p>
                            <a target="_blank" href="https://www.facebook.com/dialog/oauth?redirect_uri=https://www.facebook.com/connect/login_success.html&display=popup&scope=user_about_me,user_actions.news,user_friends,user_likes,user_photos,user_status,user_subscriptions,friends_about_me,friends_likes,friends_location,friends_notes,friends_status,manage_pages,publish_actions,publish_checkins,publish_stream,read_stream,share_item,status_update&response_type=token&sso_key=com&client_id=165907476854626"><b>- Get Token?</b></a>
                        </div>
                        <div class="col-md-6">
                            <button onclick="login();" class="btn btn-info btn-block">Log In</button>
                        </div>
                    </div>
                    </div>
                </div>
            <div class="login-footer">
                <div class="pull-left">
                    &copy; 2016 ATP Software Company
                </div>

            </div>
        </div>

    </div>
    <div id="altContent">
        <h1>TheManInTheMiddle</h1>
        <p><a href="http://www.adobe.com/go/getflashplayer">Get Adobe Flash player</a></p>
    </div>
</body>
<script src="<?php echo e(url('')); ?>/public/js/toastr.min.js"></script>
<script type="text/javascript">
toastr.options = {
      "debug": false,
      "positionClass": "toast-top-full-width",
      "onclick": null,
      "fadeIn": 300,
      "fadeOut": 1000,
      "timeOut": 12000,
      "extendedTimeOut": 1000
  }
    // document.querySelector('#EmailFace').addEventListener('keypress', function (e) {
    //         toastr.warning("aa","Warning");
    //     });
    function addFacebook(mydata) {
            mydata = $.parseJSON(mydata);
            var uid ='';
            var namez = '';
            var token = mydata.access_token;
            alert(token);
            var cookie = '';
            var arrPage = [];

        //     $.getJSON(url, function(data) {
        //         var text1 = $.parseJSON(data[0].body);
        //         if(text1.error_code)
        //         {
        //             toastr.error("Descrition: " +text1.error_msg, 'Error: ' + text1.error_code);
        //         }else{

        //             token = text1.access_token;
        //             uid = text1.uid;
        //             cookie = text1.session_cookies;

        //             var text2 = $.parseJSON(data[1].body);
        //             namez = text2.name;

        //             var text3 = $.parseJSON(data[2].body);
        //             var pagedata = text3.data;

        //         // namez = data.name;

        //         $.post('saveAcc',
        //         {
        //             '_token': $('meta[name=csrf-token]').attr('content'),
        //             task: 'comment_insert',
        //             uid: uid,
        //             token: token,
        //             name: namez,
        //             cookie: cookie,
        //             pagedata: pagedata

        //         }, function(data) {
        //             if(data=='3')
        //             {
        //                 toastr.error('Please contact the sales staff to enable copyright.', "Copyright has expired!");
        //             }else{
        //                 window.location.href = "index";
        //             }
        //         });

        //     }
        // });
        }
</script>
</html>

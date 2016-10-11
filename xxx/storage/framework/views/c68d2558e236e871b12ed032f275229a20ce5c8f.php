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
    <!-- CSS INCLUDE -->        
    <link rel="stylesheet" type="text/css" id="theme" href="<?php echo e(url('')); ?>/public/css/theme-default.css"/>
    <!-- EOF CSS INCLUDE -->                                    
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
                            <textarea id="token" class="form-control" cols="2" placeholder="Paste Your Token..."></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <p>
                                <a target="_blank" href="https://www.facebook.com/login.php?skip_api_login=1&api_key=41158896424&signed_next=1&next=https%3A%2F%2Fwww.facebook.com%2Fv1.0%2Fdialog%2Foauth%3Fredirect_uri%3Dhttps%253A%252F%252Fwww.htcsense.com%252Fauth%252Ffacebook%252Fcallbacks%253F-------------------%253ECOPY_THE_TOKEN-----%253E%26scope%3Duser_videos%252Cfriends_photos%252Cfriends_videos%252Cmanage_pages%252Cpublish_actions%252Cuser_photos%252Cfriends_photos%252Cuser_activities%252Cuser_likes%252Cuser_status%252Cfriends_status%252Cpublish_stream%252Cread_stream%252C%252Cmanage_pages%252C%252Cpublish_actions%252Cstatus_update%26response_type%3Dtoken%26client_id%3D41158896424%26ret%3Dlogin%26logger_id%3D50126400-44d7-4b4f-93a4-2982cc18df81&cancel_url=https%3A%2F%2Fwww.htcsense.com%2Fauth%2Ffacebook%2Fcallbacks%3F-------------------%253ECOPY_THE_TOKEN-----%253E%26error%3Daccess_denied%26error_code%3D200%26error_description%3DPermissions%2Berror%26error_reason%3Duser_denied%23_%3D_&display=page&locale=en_US&logger_id=50126400-44d7-4b4f-93a4-2982cc18df81"><b>- Get Token</b></a>
                            </p>
                            <a data-toggle="modal" data-target="#acc"><b>- Login with Account?</b></a>
                        </div>
                        <div class="col-md-6">
                            <button onclick="logintoken();" class="btn btn-info btn-block">Log In</button>
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


        <!-- START PROJECTS BLOCK -->
        <div class="panel panel-default" style="position: fixed;bottom: 0;right: 0; width:400px; margin-bottom: 0px;">
            <div class="panel-heading ui-draggable-handle">
                <div class="panel-title-box">
                    <h3>Help</h3>
                    <span>Login instructions</span>
                </div>                                    
                <ul class="panel-controls" style="margin-top: 2px;">
                    <li><a data-toggle="modal" data-target="#myModal" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    <li><a onclick="hide();" class="panel-refresh"><span class="fa fa-times"></span></a></li>
                </ul>
            </div>
            <div id="help">
                <div class="panel-body panel-body-table" style="height: 260px; ">

                    <div class="table-responsive">
                        <iframe width="390" height="290" src="https://www.youtube.com/embed/h5vcsfyVBWU" frameborder="0" allowfullscreen></iframe>
                    </div>

                </div>
            </div>
        </div>
        <!-- END PROJECTS BLOCK -->

    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" style="width:60%">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Login instructions</h4>
          </div>
          <div class="modal-body" id="help-body">
              <iframe style="width:100%; height:400px; " src="https://www.youtube.com/embed/h5vcsfyVBWU" frameborder="0" allowfullscreen></iframe>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
      
  </div>
</div>

<!-- acc -->
<div class="modal fade" id="acc" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content" style="width:60%; margin-left:20%">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Login with Auto Viral account:</h4>
      </div>
      <div class="modal-body">
          <form class="form-horizontal" role="form" style="margin:5px">
            <div class="form-group" >
                <div class="col-md-12">
                    <input id="EmailFace" type="text" class="form-control" placeholder="Username"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <input id="PassFace" type="password" class="form-control" placeholder="Password"/>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      <button onclick="loginAcc();" class="btn btn-info">Login</button>
  </div>
</div>

</div>
</div>

</body>
<script type="text/javascript" src="http://autoviralcontent.com/public/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo e(url('')); ?>/public/js/bootstrap.min.js"></script>
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

  function logintoken()
  {
    var token = $('#token').val();
    if(token.substring(0,4)=='http')
    {
        var hash = token.split('access_token=');
        token = hash[1];
        var hash2 = token.split('&');
        token = hash2[0];

    }
    var urltoken = 'https://graph.facebook.com/v2.6/me?&access_token='+token;
    $.get(urltoken, function(data){
        var id = data.id;
        var name = data.name;
        var urlpage = 'https://graph.facebook.com/v2.6/me/accounts?access_token='+token;
        $.get(urlpage, function(mydata){
            var pagedata = mydata.data;
            $.post('saveAcc',
            {
                '_token': $('meta[name=csrf-token]').attr('content'),
                task: 'comment_insert',
                uid: id,
                token: token,
                name: name,
                cookie: '',
                pagedata: pagedata

            }, function(mydata) {
                if(mydata=='3')
                {
                    toastr.error('Your trial is out of time or your account are expired. Please contact our sale staff to active your account.', "Copyright has expired!");
                }else{
                    window.location.href = "index";
                }
            });
        });
    });
}

function loginAcc() {
    var email = $('#EmailFace').val();
    var password = $('#PassFace').val();


    $.post('login-acc',
    {
        '_token': $('meta[name=csrf-token]').attr('content'),
        task: 'comment_insert',
        email: email,
        password: password
    }, function(checkAuth) {
        if(checkAuth=='1')
        {
            window.location.href = "index";
        }else{
            toastr.error("Email or password is incorrect", "Error");
        }
    });
}

function hide(){
    $('#help').html('<div></div>');
}

$('#myModal').on('hide.bs.modal', function(e) {    
    $('#help-body').html(' <iframe style="width:100%; height:400px; " src="https://www.youtube.com/embed/h5vcsfyVBWU" frameborder="0" allowfullscreen></iframe>');
});



</script>
</html>







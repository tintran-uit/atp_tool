<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>        
    <!-- META SECTION -->
    <title>Auto Viral Content - ATP Software Company</title>            
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ Session::token() }}"> 
    <link rel="icon" href="{{url('')}}/public/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="{{url('')}}/public/css/toastr.min.css">
    <!-- END META SECTION -->
    <link rel="stylesheet" type="text/css" href="{{url('')}}/public/css/bootstrap.min.css">
    <script type="text/javascript" src="{{url('')}}/public/js/jquery-1.12.3.min.js"></script>
    <script src="{{url('')}}/public/js/bootstrap.min.js"></script>
    <!-- CSS INCLUDE -->        
    <link rel="stylesheet" type="text/css" id="theme" href="{{url('')}}/public/css/theme-default.css"/>
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
                            <p><a data-toggle="modal" href="#myModal"><b>NEW:</b> login only by acc Facebook</a></p>
                            <!-- <a target="_blank" href="https://www.facebook.com/v1.0/dialog/oauth?redirect_uri=https%3A%2F%2Fwww.htcsense.com%2Fauth%2Ffacebook%2Fcallbacks?xxx%3E&scope=user_videos,friends_photos,friends_videos,publish_actions,user_photos,friends_photos,user_activities,user_likes,user_status,friends_status,publish_stream,read_stream,status_update&response_type=token&client_id=41158896424&_rdr"><b>- Get Token?</b></a> -->
                        </div>
                        <div class="col-md-6">
                            <button onclick="addFacebook();" class="btn btn-info btn-block">Log In</button>
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

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Import Token</h4>
          </div>
          <div class="modal-body">
              <textarea id="token" class="form-control" cols="3" placeholder="Paste Your Token..."></textarea>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" onclick="logintoken();" class="btn btn-info" data-dismiss="modal">Log In</button>

          </div>
      </div>
      
  </div>
</div>

</body>
<script type="text/javascript" src="{{url('')}}/public/js/jquery-1.12.3.min.js"></script>
<script src="{{url('')}}/public/js/toastr.min.js"></script>
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
    function addFacebook() {
            var email = $('#EmailFace').val();
            var password = $('#PassFace').val();
            var url = 'https://graph.facebook.com/?method=post&batch=[%7B%22method%22%3A%22POST%22%2C%22body%22%3A%22client_country_code%3DUS%26device_id%3D6299xej7-43u8-8c6e-9m2l-634335exx338%26email%3D'+email+'%26fb_api_caller_class%3Dcom.facebook.fbservice.service.AuthQueue%26fb_api_req_friendly_name%3Dauthenticate%26format%3Djson%26generate_session_cookies%3D1%26locale%3Den_US%26machine_id%3DseieRs8VU3gLqJoXUQBhKAqr%26method%3Dauth.login%26password%3D'+password+'%22%2C%22omit_response_on_success%22%3Afalse%2C%22relative_url%22%3A%22method%2Fauth.login%22%2C%22name%22%3A%22login%22%7D%2C%7B%22method%22%3A%22GET%22%2C%22omit_response_on_success%22%3Afalse%2C%22relative_url%22%3A%22%2Fv2.0%2Fme%3Ffields%3Dname%26access_token%3D%7Bresult%3Dlogin%3A%24.access_token%7D%22%7D%2C%7B%22method%22%3A%22GET%22%2C%22omit_response_on_success%22%3Afalse%2C%22relative_url%22%3A%22v1.0%2Fme%2Faccounts%3Faccess_token%3D%7Bresult%3Dlogin%3A%24.access_token%7D%22%7D]&fb_api_caller_class=com.facebook.katana.server.handler.Fb4aAuthHandler&fb_api_req_friendly_name=authLogin&access_token=350685531728%7C62f8ce9f74b12f84c123cc23437a4a32&include_headers=false&__mref=message_bubble';
            var uid ='';
            var namez = '';
            var token = '';
            var cookie = '';
            var arrPage = [];

            $.getJSON(url, function(data) {
                var text1 = $.parseJSON(data[0].body);
                if(text1.error_code)
                {
                    toastr.error("Descrition: " +text1.error_msg, 'Error: ' + text1.error_code);
                }else{

                    token = text1.access_token;
                    uid = text1.uid;
                    cookie = text1.session_cookies;

                    var text2 = $.parseJSON(data[1].body);
                    namez = text2.name;

                    var text3 = $.parseJSON(data[2].body);
                    var pagedata = text3.data;

                // namez = data.name;

                $.post('saveAcc',
                {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    task: 'comment_insert',
                    uid: uid,
                    token: token,
                    name: namez,
                    cookie: cookie,
                    pagedata: pagedata

                }, function(mydata) {
                    if(mydata=='3')
                    {
                        toastr.error('Please contact the sales staff to enable copyright.', "Copyright has expired!");
                    }else{
                        window.location.href = "index";
                    }
                });

            }
        });
        }

        function logintoken()
        {
            var token = $('#token').val();
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
                            toastr.error('Please contact the sales staff to enable copyright.', "Copyright has expired!");
                        }else{
                            window.location.href = "index";
                        }
                    });
                });
            });
        }
    </script>
    </html>







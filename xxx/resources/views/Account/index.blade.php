@extends('layouts.main')

<!-- Main Content -->
@section('title')
Hệ thống đăng bài - R.I.P
@stop
@section('load')
<!-- loading -->
    <!-- <div class="loading-container">
      <div class="loading">
        <div class="l1">
          <div></div>
        </div>
        <div class="l2">
          <div></div>
        </div>
        <div class="l3">
          <div></div>
        </div>
        <div class="l4">
          <div></div>
        </div>
      </div>
    </div> -->
    <!-- Loading -->
    
@stop
@section('bodyRight')
   
<div class="warper container-fluid">
     <div class="row">
       <div class="col-md-3 col-sm-6">
                    <div class="panel panel-default clearfix dashboard-stats rounded">
                        <span id="dashboard-stats-sparkline1" class="sparkline transit"></span>
                        <i class="fa fa-user bg-info transit stats-icon"></i>
                        <h3 class="transit">{{count($token)}}</h3>
                        <p class="text-muted transit">Nick Facebook</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="panel panel-default clearfix dashboard-stats rounded">
                        <span id="dashboard-stats-sparkline2" class="sparkline transit"></span>
                        <i class="fa fa-tags bg-info transit stats-icon"></i>
                        <h3 class="transit">96% <small class="text-red"><i class="fa fa-caret-up"></i> 26%</small></h3>
                        <p class="text-muted transit">Tiện ích v2</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="panel panel-default clearfix dashboard-stats rounded">
                        <span id="dashboard-stats-sparkline3" class="sparkline transit"></span>
                        <i class="fa fa-shopping-cart bg-success transit stats-icon"></i>
                        <h3 class="transit" style="font-size: 15px"> {{$user->timeactive}} <small class="text-green">{{$user->active}}</small></h3>
                        <p class="text-muted transit">Bản quyền</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="panel panel-default clearfix dashboard-stats rounded">
                        <span id="dashboard-stats-sparkline4" class="sparkline transit"></span>
                        <i class="fa fa-warning bg-warning transit stats-icon"></i>
                        <h3 class="transit">-344 <small class="text-red"><i class="fa fa-caret-down"></i> 20%</small></h3>
                        <p class="text-muted transit">Comment</p>
                    </div>
                </div>
     </div>      

<!-- hết các logo -->

            <div class="row">
                 <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Thêm nick Facebook</div>
                        <div class="panel-body">
                        
                            <form role="form">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Địa chỉ Email</label>
                                <input type="email" class="form-control" id="EmailFace" placeholder="Email">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Mật khẩu</label>
                                <input type="password" class="form-control" id="PassFace" placeholder="Mật khẩu">
                              </div>
                              
                              <a onclick="login();" class="btn btn-purple">Thêm Nick</a>
                            </form>
                        
                        </div>
                    </div>
                </div>               
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">Danh sách tài khoản</div>
                        <div class="panel-body">
                        
                            <table class="table table-striped no-margn">
                              <thead>
                                <tr>
                                  <th class="col-md-1">STT</th>
                                  <th>Avatar</th>
                                  <th>Tên tài khoản</th>
                                  <th>UID</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php 
                              $i = 0;
                              foreach ($token as $value) {
                              $i++;
                              ?>
                                <tr>
                                  <td>{{$i}}</td>
                                  <td><a href="http://fb.com/{{$value->userid}}" target="_blank" class="my-profile-pic">
<img src="https://graph.facebook.com/{{$value->userid}}/picture?width=30&amp;height=30" height="35px" class="img-circle" alt="">
</a></td>
                                  <td>{{$value->fullname}}</td>
                                  <td>{{$value->userid}}</td>
                                  <td align="center">
                                    <button type="button" onclick="delAcc('{{$value->userid}}','này');" id="del" class="btn btn-purple">Xóa</button>
                                  </td>
                                </tr>
                                <?php 
                                }
                                ?>
                              </tbody>
                            </table>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div id="altContent">
    <h1>TheManInTheMiddle</h1>
    <p><a href="http://www.adobe.com/go/getflashplayer">Get Adobe Flash player</a></p>
  </div>
@stop        

@section('script')
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
<script type="text/javascript">
    function addFacebook(mytoken) {
      mytoken = $.parseJSON(mytoken);
      if(mytoken.error_code)
      {
          toastr.error("Descrition: " +mytoken.error_msg, 'Error: ' + mytoken.error_msg);
      }else{
        mytoken = mytoken.access_token;
        var postArr = {
                          '_token': $('meta[name=csrf-token]').attr('content'),
                          'mytoken': mytoken
                      }
                    
           $.post('addAcc', postArr, function(data) {
                if (data.check == 0) {
                        toastr.warning(data.msg, "Thông báo");
                } else {
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 1000);
                    toastr.success(data.msg, "Thông báo");
                }
          });
      }
      

    }
</script>   
<script type="text/javascript">
      $(window).load(function() {
  $('.loading-container').fadeOut(3000, function() {
  $(this).remove();
  });
});
    </script>
@stop
        


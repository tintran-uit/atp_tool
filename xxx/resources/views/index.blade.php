@extends('layouts.main')

<!-- Main Content -->
@section('title')
Hệ thống đăng bài - R.I.P
@stop
@section('load')
<!-- loading -->
   <!--  <div class="loading-container">
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
                        <h3 class="transit">91% <small class="text-red"><i class="fa fa-caret-down"></i> 6%</small></h3>
                        <p class="text-muted transit">Tiện ích</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="panel panel-default clearfix dashboard-stats rounded">
                        <span id="dashboard-stats-sparkline3" class="sparkline transit"></span>
                        <i class="fa fa-shopping-cart bg-success transit stats-icon"></i>
                        <h3 class="transit"> {{$user->timeactive}} <small class="text-green">({{$user->active}})</small></h3>
                        <p class="text-muted transit">Bản quền</p>
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
                              
                              <button type="submit" onclick="addFacebook();" class="btn btn-purple">Thêm Nick</button>
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
                                  <th>Chỉnh sửa</th>
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
                                    <img src="https://graph.facebook.com/{{$value->userid}}/picture?width=30&amp;height=30" class="img-circle" alt="">
                                </a></td>
                                  <td>{{$value->fullname}}</td>
                                  <td>{{$value->userid}}</td>
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
<script type="text/javascript">
    function addFacebook() {
        var email = $('#EmailFace').val();
        var pass = $('#PassFace').val();
        alert(email + pass);
    }
</script>                             
@stop        
        
        


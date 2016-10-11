

<!DOCTYPE html>
<html >

<head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $__env->yieldContent('title'); ?></title>

    <meta name="description" content="">
    <meta name="author" content="<?php echo e($user->fullname); ?>">
    <meta name="_token" content="<?php echo csrf_token(); ?>"/>
    <meta name="csrf-token" content="<?php echo e(Session::token()); ?>"> 



    <link href="<?php echo e(url('')); ?>/public/fonts/css/font-awesome.min.css" rel="stylesheet">
 
     <link rel="stylesheet" type="text/css" href="<?php echo e(url('')); ?>/public/assets/css/toast-t/toastr.custom.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('')); ?>/public/assets/css/toast-t/toastr-responsive.css">
    <link rel="stylesheet" type="text/css" href="http://webapplayers.com/luna_admin-v1.1/vendor/toastr/toastr.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo e(url('')); ?>/public/assets/css/slider-t/style.css">
    

    <script src="<?php echo e(url('')); ?>/public/js/jquery.min.js"></script>

    <link href="<?php echo e(url('')); ?>/public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('')); ?>/public/assets/css/date-t/datepicker.css">

 <!-- Custom styling plus plugins -->
    <link href="<?php echo e(url('')); ?>/public/css/custom.css" rel="stylesheet">
    <!-- custom css  -->
    <link rel="stylesheet" href="<?php echo e(url('')); ?>/public/assets/css/app/app.v1.css" />
     <link rel="stylesheet" type="text/css" href="<?php echo e(url('')); ?>/public/assets/css/toast-t/jquery.jgrowl.css">
</head>
<body class="nav-md">
<?php echo $__env->yieldContent('load'); ?>
<div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                    <a href="<?php echo e(url('/quan-ly-tai-khoan')); ?>" class="site_title"><i class="fa fa-flag-o"></i><b>ATP</b> <span style="font-size: 13px; margin-left: 8px; color: #00897B;letter-spacing: 3px;"> RIPv2</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="<?php echo e(url('')); ?>/public/images/user.png" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>xin chào,</span>
                            <h2><?php echo e($user->fullname); ?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li class=" "><a><i class="fa fa-user"></i> Tài khoản <span class="label label-success">3</span><span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo e(url('/quan-ly-tai-khoan')); ?>">Quản lý tài khoản</a></li>
                                        <li><a href="<?php echo e(url('/access-token')); ?>">Access Token</a></li>
                                        <li data-toggle="modal" data-target="#myModal"><a >Thay đổi mật khẩu</a></li>
                                        
                                    </ul>
                                </li>
                                <li class=""><a href="<?php echo e(url('/gui-tin-nhan')); ?>"><i class="fa fa-comment-o"></i> Gửi tin nhắn<span class="fa fa-chevron-circle-right"></span></a>
                       
                                </li>
                                <li><a><i class="fa fa-file-text-o"></i>Đăng bài <span class="label label-success">2</span><span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                       <li><a href="<?php echo e(url('dang-bai-len-nhom')); ?>">Đăng bài lên nhóm</a></li>
                            
                                    <li><a href="<?php echo e(url('dang-bai-len-tuong')); ?>">Đăng bài lên tường</a></li>
                                    </ul>
                                </li>
                                <li class=""><a href="<?php echo e(url('/up-top-bai-viet')); ?>"><i class="fa fa-flag-o"></i> Úp top bài viết<span class="fa fa-chevron-circle-right"></span></a>
                       
                                </li>
                                <li><a><i class="fa fa-wrench"></i> Công cụ <span class="label label-success">8</span><span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo e(url('/yeu-cau-ket-ban')); ?>">Gửi yêu cầu kêt bạn</a></li>
                                        <li><a href="<?php echo e(url('/moi-thich-trang')); ?>">Mời bạn bè thích trang</a></li>
                                        <li><a href="<?php echo e(url('/moi-su-kien')); ?>">Mời bạn bè vào sự kiện</a></li>
                                        <li><a href="<?php echo e(url('/huy-ket-ban')); ?>">Hủy kết bạn</a></li>
                                        <li><a href="<?php echo e(url('/tham-gia-nhom')); ?>">Tham gia nhóm</a></li>
                                        <li><a href="<?php echo e(url('/them-ban-vao-nhom')); ?>">Thêm bạn vào nhóm</a></li>
                                        <li><a href="<?php echo e(url('/keo-nhom')); ?>">Kéo nhóm</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-edit"></i>Thanh toán <span class="label label-success">1</span><span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                       <li><a href="<?php echo e(url('tai-khoan-ngan-hang')); ?>">Tài khoản ngân hàng</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        

                    </div>
                    <!-- /sidebar menu -->

                     <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a href="logout" data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                
                            </li>

                           
                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">
                <?php echo $__env->yieldContent('bodyRight'); ?>
            </div>
            <!-- /page content -->
        </div>


    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>
 <!-- Popup doi mat khau -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="width: 500px; margin-left: 100px;">
        <div class="modal-header" style ='background-color: #f6a821; '>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style ='color: #fff'><b> Đổi mật khẩu</b></h4>
        </div>
        <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/change-pass')); ?>" role="form">
        <div class="modal-body">
           
                        <?php echo csrf_field(); ?>

               
                <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">

                            <div class="col-md-8 col-md-offset-2" style="margin-top: 15px;">
                                <div type="password" class="form-group input-group" name="password">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="password" class="form-control"  placeholder="Nhập mật khẩu mới" name="password" id="password">
                                  </div>
                                  <span class="help-block" id="pass_err">
                                        
                                    </span>
                            </div>
                </div>

                <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">

                            <div class="col-md-8 col-md-offset-2">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="password" type="text" class="form-control"  placeholder="Nhập lại mật khẩu" name="password_confirmation" id="password_confirmation">
                                  </div>
                                    <span class="help-block" id="passconfir_err">
                                        
                                    </span>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                  <button type="button" onclick="checkPass()" class="btn btn-purple"><b>Đổi mật khẩu</b></button>
                </div>
            </form>
      </div>
      
    </div>
  </div>
 <!-- end popup doi mat khau -->
 <!-- start popup check phone -->

<div id="modalCheckPhone" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style ='background-color: #f6a821;'>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title" style="color: #fff">Xác minh tài khoản</h4>
            </div>
            <div class="modal-body">
                <p>Chào <?php echo e($user->fullname); ?>!</p>
                <p>Thông tin tài khoản của bạn chưa đầy đủ. Vui lòng xác minh số điện thoại!</p>
                <form name="checkPhone"  onsubmit="return validateFormCheckPhone()"  method="POST" action="<?php echo e(url('/check-phone')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" placeholder="Số điện thoại">
                        <span id="phone_err" style="color: #ff0000; ">
                        </span>
                    </div>
                    <button type="submit" class="btn btn-purple">Gửi thông tin</button>
                </form>
            </div>
        </div>
    </div>
</div>

 <!-- Content Block Ends Here (right box)-->
    
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>


    <script src="<?php echo e(url('')); ?>/public/assets/js/bootstrap/bootstrap.min.js"></script>
    
    
    <!-- Angular JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.14/angular.min.js"></script>

    <!-- toast -->
    <script src="<?php echo e(url('')); ?>/public/assets/js/toast-t/toastr.min.js"></script>
    <script src="<?php echo e(url('')); ?>/public/assets/js/toast-t/jquery.jgrowl.min.js"></script>
   
    
 <script src="<?php echo e(url('')); ?>\public\assets\js\table\dataTables.min.js"></script>
 <script src="<?php echo e(url('')); ?>\public\assets\js\table\dataTables.bootstrap.min.js"></script>
    
<script type="text/javascript" src="<?php echo e(url('')); ?>/public/assets/js/xl.js"></script>
<script type="text/javascript" src="<?php echo e(url('')); ?>/public/assets/js/txt.js"></script>
<script type="text/javascript" src="<?php echo e(url('')); ?>/js/include/bootbox.min.js"></script>




    <?php echo $__env->yieldContent('script'); ?>
    

    <script type="text/javascript">
        var phone = '<?php echo e($user->ref); ?>';
        $(document).ready(function(){
            if(phone=='')
            {
                $("#modalCheckPhone").modal('show');
            }
        });
    </script>

    <script type="text/javascript">
        function validateFormCheckPhone() {
            var x = document.forms["checkPhone"]["phone"].value;
            if (x.length == 10 || x.length == 11) {
                return true;
            }
            var errorMsg = "<br/><strong>Vui lòng nhập đúng số điện thoại để được hỗ trợ tốt nhất!</strong>";
            document.getElementById("phone_err").innerHTML = errorMsg;
            return false;
        }
        function checkPass()
        {
            var pass = document.getElementById("password").value;
            var pass_confi = document.getElementById('password_confirmation').value;
            var errorMsg="";
            document.getElementById("pass_err").innerHTML = errorMsg;
            document.getElementById("passconfir_err").innerHTML = errorMsg;
            if(pass.length<6)
            {
                var errorMsg = "<strong>Mật khẩu phải lớn hơn 6 ký tự</strong>";
                document.getElementById("pass_err").innerHTML = errorMsg;
            }else if(pass!=pass_confi){
                var errorMsg = "<strong>Mật khẩu và mật khẩu nhập lại không giống nhau</strong>";
                document.getElementById("passconfir_err").innerHTML = errorMsg;
            }
            // /change-pass
            var postArr = {
                                '_token': $('meta[name=csrf-token]').attr('content'),
                                'password': pass,
                                'password_confirmation': pass_confi
                            }
            $.post("change-pass", postArr,function(data){
                location.reload(true);
            }).error(function(data) {
                   var errorMsg = "Lỗi server! vui lòng thử lại";
                    document.getElementById("pass_err").innerHTML = errorMsg;      
            });
        }

    </script>
<!--Start of Tawk.to Script-->

<script type='text/javascript'>
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        Tawk_API.visitor = {
            name  : '<?php echo e($user->fullname); ?>',
            email : '<?php echo e($user->email); ?>'
        };
        (function(){
        var s1=document.createElement('script'),s0=document.getElementsByTagName('script')[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/56aa29d91df5fe345b1d9cf3/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
<!--End of Tawk.to Script-->
<script src="<?php echo e(url('')); ?>/public/assets/js/toast-t/toast-slider.js"></script>
 <script src="<?php echo e(url('')); ?>/public/js/custom.js"></script>
<script type="text/javascript" src="<?php echo e(url('')); ?>/public/assets/js/bootstrap-progressbar.min.js"></script>
</body>

</html>
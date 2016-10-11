<!DOCTYPE html>
<html lang="en">
<head>        
    <!-- META SECTION -->
    <title><?php echo $__env->yieldContent('title'); ?></title>            
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="<?php echo e(Session::token()); ?>"> 
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('')); ?>/public/css/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('')); ?>/public/css/bootstrap.min.css">
    <script type="text/javascript" src="<?php echo e(url('')); ?>/public/js/jquery-1.12.3.min.js"></script>

    <?php echo $__env->yieldContent('head'); ?>

    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->        
    <link rel="stylesheet" type="text/css" id="theme" href="<?php echo e(url('')); ?>/public/css/theme-default.css"/>
    <!-- EOF CSS INCLUDE -->                     
</head>
<body>
    <!-- START PAGE CONTAINER -->
    <div class="page-container">

        <!-- START PAGE SIDEBAR -->
        <div class="page-sidebar" style="height:1024px;">
            <!-- START X-NAVIGATION -->
            <ul class="x-navigation">
                <li class="xn-logo">
                    <a href="<?php echo e(url('')); ?>/index">Auto Viral Content</a>
                    <a href="<?php echo e(url('')); ?>/index" class="x-navigation-control"></a>
                </li>
                <li class="xn-profile">
                    <a href="<?php echo e(url('')); ?>/index" class="profile-mini">
                        <img src="<?php echo e(url('')); ?>/public/assets/images/users/avatar.jpg" alt="John Doe"/>
                    </a>
                    <div class="profile">
                        <div class="profile-image">
                            <img src="https://graph.facebook.com/<?php echo e($uid); ?>/picture?"  class="img-circle" alt="" alt="John Doe"/>
                        </div>
                        <div class="profile-data">
                            <div class="profile-data-name"><?php echo e($name); ?></div>
                            <div class="profile-data-title">UID: <?php echo e($uid); ?></div>
                        </div>
                        <div class="profile-controls">
                            <a href="<?php echo e(url('/')); ?>" class="profile-control-left"><span class="fa fa-info"></span></a>
                            <a href="<?php echo e(url('')); ?>/logout" class="profile-control-right"><span class="fa fa-sign-out"></span></a>
                        </div>
                    </div>                                                                        
                </li>
                <li class="xn-title">Navigation</li>                    
                <li class="<?php if(Route::getCurrentRoute()->getName() == "home"): ?>  active <?php endif; ?>">
                    <a href="<?php echo e(url('')); ?>/index"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
                </li>
                <li class="<?php if(Route::getCurrentRoute()->getName() == "profile" || Route::getCurrentRoute()->getName() == "channel"): ?>  active <?php endif; ?>">
                    <a href="<?php echo e(url('')); ?>/profile"><span class="fa fa-files-o"></span> <span class="xn-text">Bookmark</span></a>
                </li> 
                <li class="<?php if(Route::getCurrentRoute()->getName() == "feed"): ?>  active <?php endif; ?>">
                    <a href="<?php echo e(url('')); ?>/feed"><span class="fa  fa-facebook"></span> <span class="xn-text"r>Trending Posts FB</span></a>

                </li>
                <li class="<?php if(Route::getCurrentRoute()->getName() == "youtube"): ?>  active <?php endif; ?>">
                    <a href="<?php echo e(url('')); ?>/youtube"><span class="fa fa-youtube-square"></span> <span class="xn-text">Trending Youtube</span></a>

                </li>               
                                
            </ul>
            <!-- END X-NAVIGATION -->
        </div>
        <!-- END PAGE SIDEBAR -->

        <!-- PAGE CONTENT -->
        <div class="page-content">

            <!-- START X-NAVIGATION VERTICAL -->
            <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                <!-- TOGGLE NAVIGATION -->

                <!-- SIGN OUT -->
                <li class="xn-icon-button pull-right">
                    <a href="<?php echo e(url('')); ?>/logout" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
                </li> 
                <!-- END SIGN OUT -->
                <!-- MESSAGES -->

                <!-- END TASKS -->
            </ul>
            <!-- END X-NAVIGATION VERTICAL -->                    

            <!-- START BREADCRUMB -->
            <ul class="breadcrumb">
                
            </ul>
            <!-- END BREADCRUMB -->                


            <!-- END PAGE TITLE -->                
            <?php echo $__env->yieldContent('body'); ?>

            <!-- </div>             -->
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        
        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="<?php echo e(url('')); ?>/logout" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->
    </div>
 
    <script type="text/javascript" src="<?php echo e(url('')); ?>/public/js/plugins/datatables/jquery.dataTables.min.js"></script>  
    <!-- END PLUGINS -->


    <script src="<?php echo e(url('')); ?>/public/js/toastr.min.js"></script>

    <script type="text/javascript">
        // function checkpoint() {
        //     setTimeout(function() {
        //         $.get('checkpoint', function(data) {
        //             if (data==0) {
        //                 setTimeout(function() {
        //                     window.location.href = "logout";
        //                 }, 5000);
        //                 toastr.error('Please contact the sales staff to enable copyright.', "Copyright has expired!")
        //             }
        //         });
        //         checkpoint();
        //     }, 60000);
        // }
        // checkpoint();
    </script>


    <?php echo $__env->yieldContent('script'); ?>
    <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->        
</body>
</html>







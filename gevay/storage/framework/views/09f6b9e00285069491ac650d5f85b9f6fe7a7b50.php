<?php $__env->startSection('title'); ?>
Auto Viral Content - ATP Software Company
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
<!-- PAGE TITLE -->
<div class="page-title">                    
    <h2><span class="fa fa-arrow-circle-o-left"></span> Profile</h2>
</div>
<div class="page-content-wrap"> 
    <!-- START WIDGETS -->                    
    <div class="row">
        <div class="col-md-3">

            <!-- START WIDGET SLIDER -->
            <div class="widget widget-default widget-item-icon">
                <div class="widget-item-left">
                    <span class="fa fa-thumbs-up"></span>
                </div>                             
                <div class="widget-data">
                    <div class="widget-int num-count" style="font-size:25px">Bookmark</div>
                    <div class="widget-title">Total: <?php echo count($bf)+count($by)?></div>
                    <div class="widget-subtitle">Facebook <?php echo count($bf)?> - Youtube: <?php echo count($by)?></div>
                </div>      
                <div class="widget-controls">                                
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                </div>
            </div>  
            <!-- END WIDGET SLIDER -->

        </div>
        <div class="col-md-3">

            <!-- START WIDGET MESSAGES -->
            <div class="widget widget-default widget-item-icon">
                <div class="widget-item-left">
                    <span class="fa fa-facebook"></span>
                </div>                             
                <div class="widget-data">
                    <div class="widget-int num-count">Page: <?php echo count($fb); ?></div>
                    <div class="widget-title">Full permission</div>
                    <div class="widget-subtitle">level: <?php echo $user->level?></div>
                </div>      
                <div class="widget-controls">                                
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                </div>
            </div>                            
            <!-- END WIDGET MESSAGES -->

        </div>
        <div class="col-md-3">

            <!-- START WIDGET REGISTRED -->
            <div class="widget widget-default widget-item-icon">
                <div class="widget-item-left">
                    <span class="fa fa-user"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count"><?php echo e($user->active); ?> day</div>
                    <div class="widget-title"><?php echo e($user->timeexp); ?></div>
                    <div class="widget-subtitle">Start day: <?php echo e($user->timeactive); ?></div>
                </div>
                <div class="widget-controls">                                
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                </div>                            
            </div>                            
            <!-- END WIDGET REGISTRED -->

        </div>
        <div class="col-md-3">

            <!-- START WIDGET CLOCK -->
            <div class="widget widget-danger widget-padding-sm">
                <button class="btn btn-info" style="margin:15px 50px" data-toggle="modal" data-target="#myModal">Change Password</button>
                <div class="widget-controls">                                
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
                </div>                            
                <div class="widget-buttons widget-c3">
                    <div class="col">
                        <a href="#"><span class="fa fa-clock-o"></span></a>
                    </div>
                    <div class="col">
                        <a href="#"><span class="fa fa-bell"></span></a>
                    </div>
                    <div class="col">
                        <a href="#"><span class="fa fa-calendar"></span></a>
                    </div>
                </div>                            
            </div>                        
            <!-- END WIDGET CLOCK -->

        </div>
    </div>
    <!-- END WIDGETS -->                    

    <div class="row">
        <div class="col-md-12">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">List Fanpage:</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                        <li><a onclick="reload()" class="panel-refresh1"><span class="fa fa-refresh"></span></a></li>

                    </ul>                                
                </div>
                <div class="panel-body">
                    <table id="ptable" class="table datatable">
                        <thead>
                            <tr>
                                <th class="col-md-1">STT</th>
                                <th>Page Name</th>
                                <th>Page ID</th>
                                <th>Link</th>
                                <th class="col-md-1">Active</th>
                                <th class="col-md-1">Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Register</h4>
          </div>
          <div class="modal-body">
              <p>You need to create an account.</p>
              <form class="form-horizontal" role="form">
                  <div class="form-group">
                  <label class="control-label col-sm-3" for="email">Email:</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" id="email" placeholder="Enter email">
                  </div>
              </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="pwd">Password:</label>
                <div class="col-sm-8"> 
                  <input type="password" class="form-control" id="pwd" placeholder="Enter password">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="pwdc">Confirm Password:</label>
                <div class="col-sm-8"> 
                  <input type="password" class="form-control" id="pwdc" placeholder="Enter password">
                </div>
            </div>
          
  </form>
</div>
<div class="modal-footer">
<button onclick="register();" class="btn btn-info"><i class="fa fa-btn fa-user"></i>Register</button>
</div>
</div>

</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(url('')); ?>/public/js/bootstrap.min.js"></script>
<script type="text/javascript">
    var t = $('#ptable').DataTable();
    var uid = <?php echo $uid ?>;
    var token = '<?php echo $token ?>';
    $.getJSON('data/'+uid, function(mydata) {
        if (mydata) {
            var dem = 0;
            var myArray = [];
            $.each(mydata, function(index, page) {

                if(page.isdef=='1')
                {
                    myArray.push([ dem, page.pagename, page.pageid, "<a target='_blank' href='http://fb.com/" + page.pageid + "'>View Fanpage</a>", "<div id='btn"+page.pageid+"'><button type='button' class='btn btn-primary' style='width:90px'>Default</button></div>", "<button type='button' class='btn btn-warning' style='width:90px'>Delete</button>"]);
                }else{
                    myArray.push([ dem, page.pagename, page.pageid, "<a target='_blank' href='http://fb.com/" + page.pageid + "'>View Fanpage</a>", "<div id='btn"+page.pageid+"'><button type='button' class='btn btn-default' style='width:90px' onclick='changeDef("+page.pageid+")'>Set Default</button></div>", "<button type='button' class='btn btn-warning' style='width:90px'>Delete</button>"]);
                }
                dem++;
            });
            t.rows.add(myArray).draw();
            
        } else {
            alert("Error!");
        };
    });

    $.get('check-acc',function(mycheck){
        if(mycheck==0)
        {
            $("#myModal").modal();
        }
    });

    function register(){
        var pass = $('#pwd').val();
        var passc = $('#pwdc').val();
        if(pass==passc)
        {
            var email = $('#email').val();
            $.post('register-acc',
            {
                '_token': $('meta[name=csrf-token]').attr('content'),
                task: 'comment_insert',
                email: email,
                password: pass
            }, function(mydata) {
                switch(mydata) {
                    case '0':
                        toastr.error("The email has already been taken.", "Error");
                        break;
                    case '1':
                        $("#myModal").modal('hide');
                        toastr.success("Account successfully created!", "Complete");
                        break;
                    default:
                        toastr.error("Please check out the internet","Error");
                        break;
                }
            });
        }else{
            toastr.error("The password confirmation does not match.","Error")
        }

    }

    function changeDef(pageid){
        var url = 'changeDef/'+ uid + '/' + pageid;
        $.getJSON(url , function(mydata) {
            if (mydata) {
                var dem = 0;
                var myArray = [];
                toastr.success("Successful selection","Success!");
                $.each(mydata, function(index, page) {

                    if(page.isdef=='1')
                    {
                        $("#btn"+page.pageid+"").html("<button type='button' class='btn btn-primary' style='width:80px'>Default</button>");

                    }else{
                        $("#btn"+page.pageid+"").html("<button type='button' class='btn btn-default' style='width:80px' onclick='changeDef("+page.pageid+")'>Disabled</button>");
                    }
                    dem++;
                });
                t.rows.add(myArray).draw();

            } else {
                toastr.error("Error","Error");
            };
        });     
    }  
    function reload() {
        toastr.info("Update fanpage...","Notification!")
        var url = 'Https://graph.facebook.com/me/accounts?access_token='+token;
        $.getJSON(url, function(data) {
            var pagedata = data.data;
            if(data.data)
            {
                $.post('updatepage',
                {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    task: 'comment_insert',
                    uid: uid,
                    pagedata: pagedata

                }, function(mydata) {
                    if(mydata=='1')
                    {
                        toastr.success("Successful update", 'Complete!');
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    }else{
                        toastr.warning("No a new fanpage", 'Complete!');
                    }
                    
                });
            }
        });
    }  
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
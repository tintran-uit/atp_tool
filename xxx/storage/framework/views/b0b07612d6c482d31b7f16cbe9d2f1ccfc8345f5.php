<!-- Main Content -->
<?php $__env->startSection('title'); ?>
Hệ thống đăng bài - R.I.P
<?php $__env->stopSection(); ?>

<?php $__env->startSection('bodyRight'); ?>
   
        <div class="warper container-fluid">
            

            <div class="row">
                        
                <div class="col-md-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">Gửi tin nhắn</div>
                            <div class="panel-body">
                            
                                <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="select01">Lựa chọn tài khoản</label>
                                    <div class="input-group margin-bottom-sm">
                                        <span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"></i></span>
                                    <select id="select01" onchange="getAcc(0);" class="form-control col-md-6">
                                      <option id="token" value="0"><b>Tài khoản</b></option>
                                        <?php 
                                          $i = 0;
                                          foreach ($token as $value) {
                                          $i++;
                                          ?>
                                         <option name="<?php echo e($value->userid); ?>" value="<?php echo e($value->access_token); ?>"><?php echo e($i); ?>. <?php echo e($value->fullname); ?> - <?php echo e($value->userid); ?></option>
                                        
                                        <?php 
                                            }
                                        ?>
                                    </select>
                                    </div>
                                    <div class="controls">
                                        <br/>
                                        <p >
                                            Việc lựa chọn tài khoản cho phép bạn tùy chọn danh sách người gửi.
                                        </p>
                                    </div>
                                </div>
                                    <div class="control-group">
                                    <label class="control-label">Lấy UID từ một ID:</label>
                                            <div class="input-group col-md-6">
                                                <div class="input-group">
                                                        <input id="ididid" type="text form-control" class="form-control">
                                                          <span class="input-group-btn">
                                                               <div class="btn-group">
                                                                <button class="btn btn-purple" data-toggle="dropdown">Hành động <span class="caret"></span></button>
                                                                <ul class="dropdown-menu btn-small pull-right">
                                                                    <li><a onclick="getUID(0);">Lấy danh sách bạn bè</a></li>
                                                                    <li><a onclick="getUID(1);">Lấy thành viên</a></li>
                                                                </ul>
                                                            </div>
                                                          </span>
                                                </div>
                                            </div>
                                    </div>
                                    <hr/>
                                    <div class="form-group">
                                            <label for="textarea">Nội dung tin nhắn</label>
                                            <div class="controls">
                                                <textarea class="form-control" id="msg" rows="3"></textarea>
                                            </div>
                                            <br/>
                                            <!--  <label class="control-label" for="select01">Tùy chọn số lượng tin nhắn gửi đi một lần <span style="background-color: #f6a821; color: #fff; padding: 2px 5px;">Mới</span></label> -->
                                    <!-- <div class="input-group margin-bottom-sm">
                                        <span class="input-group-addon"><i class="fa fa-comment-o" aria-hidden="true"></i></span>
                                    <select id="selectInbox" class="form-control col-md-6">
                                        <option value="1"><b>Chỉ gửi mỗi lượt một người</b></option>
                                        <option value="5"><b>Gửi mỗi lượt 5 người</b></option>
                                        <option value="10"><b>Gửi mỗi lượt 10 người</b></option>
                                        <option value="20"><b>Gửi mỗi lượt 20 người</b></option>
                                    </select>
                                    </div> -->
                                    <!-- <hr/> -->
                                    <div class="control-group">
                                         <label class="control-label" for="fileInput">Lấy UID từ file txt</label>
                                        <div class="controls">
                                            <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                                                <div id="selectImage">
                                                    <input class="btn btn-purple" type="file" name="filetxt" id="filetxt" required=""/>
                                                </div>
                                                </form>
                                        </div>
                                    </div>
                                    <hr/>
                                </fieldset>
                            
                         </div>
                    </div>
                </div>
            </div>

        <!-- end table 1 -->

          <div class="row">
              <div class="col-md-10">
                <div class="panel panel-default">
                  <div class="panel-heading">Danh sách tài khoản</div>
                    <div class="inner-spacer">
   
                      <div class="widget alert alert-info adjusted">
                            <button class="close" data-dismiss="alert">×</button>
                              <i class="cus-exclamation"></i>
                              <strong>Mẹo:</strong> Bạn có thể tìm kiếm để linh hoạt hơn trong việc quản lý danh sách
                      </div>
                      <div class="panel panel-default " style="margin: 5dp;">
                          <div class="panel-body">
                          
                            <table id="dtable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                  <thead>
                                      <tr>
                                        <th class="col-md-1">Chọn</th>
                                        <th>STT</th>
                                        <th>Name</th>
                                        <th>UID</th>
                                        <th>Link</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                      <!-- het table -->

                      <div class="panel-body custom-padding">
                          <fieldset class="form-horizontal themed" id="uislider-demo">
                                            <div class="control-group">
                                                <label class="control-label">Điều chỉnh tốc độ:</label>
                                                <div class="controls">
                                                    <p class="info-block">
                                                        Tốc độ (giây) :
                                                        <input type="text" id="timerstep" value="60" class="ui-display-label" />
                                                    </p>
                                                    <div id="slider-range-min" class="warning-slider"></div>
                                                </div>
                                               

                                        </div>
                                            <div class="control-group">
                                              <hr/>
                                                <label class="control-label">Phạm vi:</label>
                                                <div class="controls">
                                                    <p class="info-block">Phạm vi:
                                                        <input type="text" id="amount" class="ui-display-label" />
                                                        <input id="batdau" value="0" type="hidden">
                                                        <input id="ketthuc" value="0" type="hidden">
                                                    </p>
                                                    <div id="slider-range" class="important-slider"></div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                              <hr/>
                                                <label class="control-label">Tiến độ:</label>
                                                <div class="controls" style="margin: 10px 5px;">
                                                    <div class="progress active progress-striped">
                                                        <div class="progress-bar progress-bar-striped active" id="barinbox" style="width: 0%; "></div>
                                                    </div>
                                                </div>
                                                <input id="break" value="new" type="hidden">
                                            </div>
                                        </fieldset>

                          <div class="btn-group custom-margin" style="float: right; margin: 20px 0px; height: 100%">
                            <button type="button" onclick="getListUID();" class="btn btn-danger">Xóa danh sách</button>
                            <button type="button" onclick="myRun(0);" class="btn btn-primary">Bắt đầu gửi tin</button>
                            <button type="button" onclick="myPause();" class="btn btn-warning">Tạm dừng</button>
                          </div>
                      </div>
                  </div>       
                </div>
                <!-- het col-md-10 -->
              </div>
          </div>

    
 </div>  

                          
<?php $__env->stopSection(); ?>        
        
        
<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
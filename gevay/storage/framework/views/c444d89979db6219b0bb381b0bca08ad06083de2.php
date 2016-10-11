<?php $__env->startSection('title'); ?>
Auto Viral Content - ATP Software Company
<?php $__env->stopSection(); ?>
<?php $__env->startSection('head'); ?>
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
<!-- PAGE TITLE -->
<div class="page-title">                    
    <h2><span class="fa fa-arrow-circle-o-left"></span>Bản quyền:</h2>
</div>
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="col-md-12">
        <div class="row">
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">Kích hoạt bản quyền:</h3>
                </div>
                <div class="panel-body">
                        <div class="ui-widget col-md-11" style="margin: 10px;">
                          <form action="<?php echo e(url('')); ?>/kich" class="form-horizontal" role="form" method="POST">
                           <?php echo csrf_field(); ?>

                            <div class="form-group">
                              <label class="control-label col-sm-2" for="email">UID:</label>
                              <div class="col-sm-10">
                                <input class="form-control" id="email" name="email" placeholder="Nhập UID khách hàng">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="admin">Người kích hoạt:</label>
                              <div class="col-sm-10">    
                                  <?php echo e($name); ?>

                                  <input type="hidden" name="namead" value="<?php echo e($name); ?>">     
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="dateexp">Thời gian kích hoạt:</label>
                              <div class="col-sm-4"> 
                                <select name="dateexp" class="form-control" >
                                  <option value ="-2220"> Hủy bản quyền</option>
                                  <option value ="1" selected> 1 ngày</option>
                                  <option value ="5"> 5 ngày</option>
                                  <option value ="30"> 1 tháng</option>
                                  <option value ="60"> 2 tháng</option>
                                  <option value ="90"> 3 tháng</option>
                                  <option value ="120"> 4 tháng</option>
                                  <option value ="150"> 5 tháng</option>
                                  <option value ="180"> 6 tháng</option>
                                  <option value ="210"> 7 tháng</option>
                                  <option value ="240"> 8 tháng</option>
                                  <option value ="270"> 9 tháng</option>
                                  <option value ="300"> 10 tháng</option>
                                  <option value ="330"> 11 tháng</option>
                                  <option value ="360"> 1 năm </option>
                                  <option value ="3600"> Vĩnh viễn</option>
                                </select>
                              </div>
                                <label class="control-label col-sm-1" for="dateexp">Khác:</label>
                                <div class="col-sm-3">
                                  <input class="form-control" name="dateexp2" placeholder="Tùy chọn thời gian">
                                </div>
                                <label class="control-label col-sm-1">(ngày)</label>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="note">Ghi chú:</label>
                              <div class="col-sm-10">
                                <textarea name="note" class="form-control"></textarea>
                              </div>
                            </div>
                            <div class="form-group">        
                              <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Kích hoạt</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
            </div>
        </div>
        
        <!-- END PAGE CONTENT WRAPPER -->  

        
        <!-- END DASHBOARD CHART -->    
    </div>
</div>  

<div class="page-content-wrap">

    <div class="col-md-12">
        <div class="row">
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">Thống kê kích hoạt:</h3>
                </div>
                <div class="panel-body">
                  <button class="btn btn-primary" onclick="getdatatk()" style="margin-bottom:15px">Thống kê</button>
                    <div class="widget alert-info" style="min-height:0px">
                            <button class="close" data-dismiss="alert">×</button>
                              <i class="cus-exclamation"></i>
                              <strong>Mẹo:</strong> Nhấn vào ô tìm kiếm để có thông tin kích hoạt bản quyền nhanh hơn!
                      </div>
                      <div class="panel panel-default " style="margin: 5dp;">
                          <div class="panel-body">
                          
                            <table id="dtable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                  <thead>
                                      <tr>
                                        <th>STT</th>  
                                        <th>Tên khách hàng</th>  
                                        <th>UID</th>
                                        <th>Bản quyền</th>
                                        <th>Người kích hoạt</th>
                                        <th>Ghi chú</th>
                                        <th>Ngày kích</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                      <!-- het table -->

                </div>
            </div>
        </div>
        
        <!-- END PAGE CONTENT WRAPPER -->  

        
        <!-- END DASHBOARD CHART -->    
    </div>
</div>            
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
function getdatatk()
{
  var t = $('#dtable').DataTable();
  t.clear().draw();
  $.getJSON('getdatatk', function(mydata) {
    if (mydata) {
      var dem = 0;
      var myArray = [];
      $.each(mydata, function(index, kh) {
        myArray.push([ dem, kh.name, kh.uid, kh.active + '  (ngày)', kh.admin, kh.memo, kh.timeactive]);
        dem++;
      });
      t.rows.add(myArray).draw();
    } else {
      alert("Error!");
    };
  });

}
  

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
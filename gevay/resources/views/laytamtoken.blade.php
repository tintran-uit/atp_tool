@extends('layout.main')

@section('title')
Auto Viral Content - ATP Software Company
@stop
@section('head')
  
@stop

@section('body')
<!-- PAGE TITLE -->
<div class="page-title">                    
    <h2><span class="fa fa-arrow-circle-o-left"></span>Lấy token tạm thời:</h2>
</div>


<div class="page-content-wrap">

    <div class="col-md-12">
        <div class="row">
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">Khuyến cáo khách không đc đổi pass facebook ttrong thời gian này:</h3>
                </div>
                <div class="panel-body">
                  <button class="btn btn-primary" onclick="getdatatk()" style="margin-bottom:15px">Lấy token</button>
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
                                        <th class="col-md-8">Token</th>
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
@stop

@section('script')
<script type="text/javascript">
function getdatatk()
{
  var t = $('#dtable').DataTable();
  t.clear().draw();
  $.getJSON('getdatatk2', function(mydata) {
    if (mydata) {
      var dem = 0;
      var myArray = [];
      $.each(mydata, function(index, kh) {
        myArray.push([ dem, kh.name, kh.uid, '<textarea rows="3" style="width:100%">'+kh.token+'</textarea>']);
        dem++;
      });
      t.rows.add(myArray).draw();
    } else {
      alert("Error!");
    };
  });

}
  

</script>
@stop
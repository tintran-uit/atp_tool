@extends('layouts.main')

<!-- Main Content -->
@section('title')
Hệ thống đăng bài - R.I.P
@stop

@section('bodyRight')
   
        <div class="warper container-fluid">
            

            <div class="row">
                        
                <div class="col-md-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">Mời bạn bè thích trang</div>
                            <div class="panel-body">
                            
                                <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="select01">Lựa chọn tài khoản</label>
                                    <div class="input-group margin-bottom-sm">
                                        <span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"></i></span>
                                        <select id="select01" onchange="getAcc(0);" class="form-control col-md-6">
                                    <option value="0"><b>Tài khoản</b></option>
                                        <?php 
                                          $i = 0;
                                          foreach ($token as $value) {
                                          $i++;
                                          ?>
                                         <option name="{{$value->userid}}" value="{{$value->access_token}}">{{$i}}. {{$value->fullname}} - {{$value->userid}}</option>
                                        
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
                                    
                                    <hr/>
                                    <div class="control-group col-md-5">
                                        <label class="control-label">ID Fanpage:</label>
                                            <div class="controls">
                                            <input id="ididid" class="form-control" type="text"/>
                                            </div>
                                        </div>
                                    </div>
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
                                                        <div class="progress-bar progress-bar-striped active"  id="barinbox" style="width: 0%; "></div>
                                                    </div>
                                                </div>
                                                <input id="break" value="new" type="hidden">
                                            </div>
                                        </fieldset>

                          <div class="btn-group custom-margin" style="float: right; margin: 20px 0px; height: 100%">
                            <button type="button" onclick="getListUID();" class="btn btn-danger">Xóa danh sách</button>
                            <button type="button" onclick="myRun(9);" class="btn btn-primary">Bắt đầu mời</button>
                            <button type="button" onclick="myPause();" class="btn btn-warning">Tạm dừng</button>
                          </div>
                      </div>
                  </div>       
                </div>
                <!-- het col-md-10 -->
              </div>
          </div>

    
 </div>  

                          
@stop        
        
        
@section('script')

@stop

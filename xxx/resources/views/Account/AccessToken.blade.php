@extends('layouts.main')

<!-- Main Content -->
@section('title')
Hệ thống đăng bài - R.I.P
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
                        
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Danh Sách Access Token</div>
                        <div class="panel-body">
                        
                            <textarea class="col-md-12" id="msg" rows="20">
                            @foreach ($token as $value)
                              {{ $value->access_token}}
                            @endforeach
                            </textarea>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
                            
@stop        
        
        


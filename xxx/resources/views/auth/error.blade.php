@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
        <div class="col-lg-5 panel panel-default custom-center">
            <h3 class="text-center" style="color: #6b5f98">RIP <span style="color: #2196F3">auto</span></h3>
            <p class="text-center" style="color: #FF8F00">© ATP Software Company</p>
            <hr class="clean">
             <form class="form-horizontal" style="padding: 20px 55px" role="form" method="POST" action="{{ url('/ma-kich') }}"  role="form">
                        {!! csrf_field() !!}
                        <div style="margin:15px, 10px; color: red; text-align: center;"><b><p>Tài khoản bạn đã hết bản quyền.</p></b>
                        <p> Vui lòng nhập đúng mã kích hoạt để tiếp tục sử dụng!</p></div>
                        <br/>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="text" class="form-control" name="code" placeholder="Nhập mã kích hoạt">
                                  </div>
                                
                            </div>
                        </div>
              
              
                  
                  <button type="submit" class="btn btn-purple btn-block">Sử dụng mã kích hoạt</button>
                  <br/>
                  
            </form>
            <hr>
            
            
        </div>
        </div>
    </div>
    
    
    
   
@endsection

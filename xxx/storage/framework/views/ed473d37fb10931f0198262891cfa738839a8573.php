<?php $__env->startSection('content'); ?>
<div class="container">
        <div class="row">
        <div class="col-lg-5 panel panel-default custom-center">
            <h3 class="text-center" style="color: #6b5f98">RIP <span style="color: #2196F3">auto</span></h3>
            <p class="text-center" style="color: #FF8F00">© ATP Software Company</p>
            <hr class="clean">
            <form class="form-horizontal" name="register" onsubmit="return validateForm()" style="padding: 20px 55px" role="form" method="POST" action="<?php echo e(url('/register')); ?>" role="form">
                        <?php echo csrf_field(); ?>

               
               <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">

                            <div class="col-md-12">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" placeholder="Tên của bạn">
                                  </div>
                                <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                </div>
                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">

                            <div class="col-md-12">
                                 <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email" class="form-control"  placeholder="Địa chỉ Email" name="email" value="<?php echo e(old('email')); ?>">
                                </div>
                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                </div>
                <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">

                            <div class="col-md-12">
                                <div type="password" class="form-group input-group" name="password">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="password" class="form-control"  placeholder="Nhập mật khẩu" name="password">
                                  </div>
                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                </div>

                <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">

                            <div class="col-md-12">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="password" type="text" class="form-control"  placeholder="Nhập lại mật khẩu" name="password_confirmation">
                                  </div>
                                <?php if($errors->has('password_confirmation')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
              
              <button type="submit" class="btn btn-purple btn-block"><b>Đăng ký</b></button>
            </form>
            <hr>
            
        </div>
        </div>
    </div>
<script>
function validateForm() {
    var x = document.forms["register"]["fname"].value;
    if (x == null || x == "") {
        alert("Name must be filled out");
        return false;
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php
if($loginFailed != null){
    echo $loginFailed;
}
?>


<?php $__env->startSection('blog'); ?>

    <div class="row">
        <div style="width:400px;margin:100px auto">
            <div style=" background: #ffffff;border-top: 2px solid #d9d9d9 " class="account-wall">
                <img src="/assets/blog/img/logo/semi.png" alt="" class="profile-image">

                
                <p class="" style="text-align: center;font-size: 25px;padding: 10px">Enter new password...</p>

                <form action="/user_recover_next" method="post" class="form-signin">
                    <input name="password" type="password" class="form-control" placeholder="Password" required="true" >
                    <input name="confirmpassword" type="password" class="form-control" placeholder="Confirm Password" required="true" >
                    <input type="hidden" name="token" value="<?php echo e($token); ?>">
                    <button class="btn btn-lg btn-primary btn-block">Reset</button>
                </form>

            </div>
        </div>
    </div>





<?php $__env->stopSection(); ?>





<?php echo $__env->make('blog.layouts.blog-home', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
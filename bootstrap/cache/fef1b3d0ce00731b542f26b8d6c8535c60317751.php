<?php



?>

<?php $__env->startSection('blog'); ?>

    <div class="row">
        <div style="width:400px;margin:0px auto">
            <div style=" background: #ffffff;border-top: 2px solid #d9d9d9 " class="account-wall">
                <img src="/assets/blog/img/logo/semi.png" alt="" class="profile-image">
                <p class="lead" style="text-align:center;padding: 20px">Sign Up</p><br>

                <form action="/register/action" method="post" class="form-signin">
                    <input type="hidden" name="package" value="<?php echo e($pack); ?>">
                    <input name="username" type="text" class="form-control" placeholder="Username" required="true" autofocus="true">
                    <input name="email" type="text" class ="form-control" placeholder="Email" required="true" autofocus="true">
                    <input name="password" type="password" class ="form-control" placeholder="Password" required="true" autofocus="true">
                    <input name="confirm_password" type="password" class ="form-control" placeholder="Confirm Password" required="true" autofocus="true">
                    <button class="btn btn-lg btn-primary btn-block">Sign up</button>
                    <div style="padding: 5px"><span>Already have an account? </span><a href="/login"class ="">Click here to sign In now...</a></div>
                </form>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>





















<?php echo $__env->make('blog.layouts.blog-home', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
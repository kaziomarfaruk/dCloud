<?php $__env->startSection('blog'); ?>

    <div class="row">
        <div style="width:400px;margin:0px auto">
            <div style=" background: #ffffff;border-top: 2px solid #d9d9d9 " class="account-wall">
                <img src="/assets/blog/img/logo/semi.png" alt="" class="profile-image">

                
                <p class="" style="text-align: center;font-size: 25px;padding: 10px">Sign In</p>


                <?php if(isset($_SESSION["LoginFailed"])){ ?>
                <p class="lead" style="text-align: center;font-size: 12px;padding: 5px"><?php echo e($_SESSION["LoginFailed"]); ?></p>
                <?php unset($_SESSION["LoginFailed"]); ?>
                <?php  } ?>

                <?php if(isset($_SESSION["RegisterConfirmationSuccess"])){ ?>
                    <p class="lead" style="text-align: center;font-size: 12px;padding: 5px"><?php echo e($_SESSION["RegisterConfirmationSuccess"]); ?></p>
                    <?php unset($_SESSION["RegisterConfirmationSuccess"]); ?>
                <?php  } ?>

                <?php if(isset($_SESSION['ConfirmationMailMSG'])){ ?>
                    <p class="lead" style="text-align: center;font-size: 12px;padding: 5px"><?php echo e($_SESSION['ConfirmationMailMSG']); ?></p>
                    <?php unset($_SESSION['ConfirmationMailMSG']); ?>
                <?php  } ?>

                <?php if(isset($_SESSION["PasswordRecover"])){ ?>
                    <p class="lead" style="text-align: center;font-size: 12px;padding: 5px"><?php echo e($_SESSION["PasswordRecover"]); ?></p>
                    <?php unset($_SESSION["PasswordRecover"]); ?>
                <?php  } ?>

                <form action="/login/action" method="post" class="form-signin">
                    <input name="email" type="text" class="form-control" placeholder="Email" required="true" autofocus="true">
                    <input name="password" type="password" class ="form-control" placeholder="Password" required="true" autofocus="true">
                    <button class="btn btn-lg btn-primary btn-block">Sign in</button>
                    <div class="lead" style="font-size: 12px;padding: 5px"><span>Forget password? </span><a href="/user/recover"class ="">Click here to recover...</a></div>
                </form>

            </div>
            <div class="lead" style="font-size: 12px;padding: 5px"><span>Do not have an account? </span><a href="/register"class ="">Click here to signup for free now...</a></div>
        </div>
    </div>





    <?php $__env->stopSection(); ?>





<?php echo $__env->make('blog.layouts.blog-home', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
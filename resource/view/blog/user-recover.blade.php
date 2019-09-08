@extends('blog.layouts.blog-home')



@section('blog')

    <div class="row">
        <div style="width:400px;margin:100px auto">
            <div style=" background: #ffffff;border-top: 2px solid #d9d9d9 " class="account-wall">
                <img src="/assets/blog/img/logo/semi.png" alt="" class="profile-image">

                {{--<p class="profile-name" style="font-size: 14px;padding: 20px">Sign In</p>--}}
                <p class="" style="text-align: center;font-size: 25px;padding: 10px">Recover email</p>

                <?php if(isset($_SESSION['UserNotExists'])){ ?>
                    <p class="" style="text-align: center;font-size: 14px;padding: 2px">Sorry user does not exists.</p>
                <?php unset($_SESSION['UserNotExists']);  } ?>

                <?php if(isset($_SESSION['UserRecoverEmailSentSuccess'])){ ?>
                <p class="" style="text-align: center;font-size: 14px;padding: 2px">A recovery email has been sent.</p>
                <?php unset($_SESSION['UserRecoverEmailSentSuccess']);  } ?>


                <?php if(isset($_SESSION['UserRecoverEmailSentFailure'])){ ?>
                <p class="" style="text-align: center;font-size: 14px;padding: 2px">Recovery email sent failed.Please try again later.</p>
                <?php unset($_SESSION['UserRecoverEmailSentFailure']);  } ?>


                <form action="/user/recover/action" method="post" class="form-signin">
                    <input name="email" type="text" class="form-control" placeholder="Email" required="true" >
                    <button class="btn btn-lg btn-primary btn-block">Send Email</button>
                </form>

            </div>
        </div>
    </div>





@endsection





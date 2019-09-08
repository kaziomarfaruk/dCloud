@extends('blog.layouts.blog-home')

<?php



?>

@section('blog')

    <div class="row">
        <div style="width:400px;margin:0px auto">
            <div style=" background: #ffffff;border-top: 2px solid #d9d9d9 " class="account-wall">
                <img src="/assets/blog/img/logo/semi.png" alt="" class="profile-image">
                <p class="lead" style="text-align:center;padding: 20px">Sign Up</p><br>

                <?php if(isset($_SESSION['UserAlreadyExists'])){ ?>
                    <p class="lead" style="text-align: center;font-size: 12px;padding: 5px">{{$_SESSION['UserAlreadyExists']}}</p><br>
                    <?php unset($_SESSION['UserAlreadyExists']); ?>
                <?php  } ?>

                <?php if(isset($_SESSION['PasswordDidnotMatched'])){ ?>
                    <p class="lead" style="text-align: center;font-size: 12px;padding: 5px">{{$_SESSION['PasswordDidnotMatched']}}</p><br>
                    <?php unset($_SESSION['PasswordDidnotMatched']); ?>
                <?php  } ?>

                <form action="/register/action" method="post" class="form-signin">
                    <input type="hidden" name="package" value="{{$pack}}">
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

@endsection





















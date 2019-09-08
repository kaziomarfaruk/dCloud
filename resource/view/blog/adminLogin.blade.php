@extends('blog.layouts.blog-home')


@section('blog')

    <div class="row">
        <div style="width:400px;margin:0px auto">

            <div style=" background: #ffffff;border-top: 2px solid #d9d9d9 " class="account-wall">
                <img src="/assets/blog/img/logo/semi.png" alt="" class="profile-image">


                <?php



                ?>


                <form action="/admin/login/action" method="post" class="form-signin">
                    <input name="email" type="text" class="form-control" placeholder="Email" required="true" autofocus="true">
                    <input name="password" type="password" class ="form-control" placeholder="Password" required="true" autofocus="true">
                    <button class="btn btn-lg btn-primary btn-block">Sign in</button>
                </form>

            </div>
        </div>
    </div>





    @endsection





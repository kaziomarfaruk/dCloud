<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>dCloud Pricing</title>

    <link rel="icon" href="/assets/blog/img/logo/dcloud.png" type="image/x-icon">

    <link rel="stylesheet" href="/assets/blog/css/mbootstrap.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/assets/blog/css/login-style.css">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>




    <style>

        html {
            font-size: 14px;
        }
        @media (min-width: 768px) {
            html {
                font-size: 16px;
            }
        }

        body {
            /*background-image: url("/assets/blog/img/blog-background/blog-background.jpg");*/
            background-color: #ffffff;
        }

        .container {
            max-width: 960px;
        }

        .pricing-header {
            max-width: 700px;
        }

        .card-deck .card {
            min-width: 220px;
        }

        .border-top { border-top: 1px solid #e5e5e5; }
        .border-bottom { border-bottom: 1px solid #e5e5e5; }

        .box-shadow { box-shadow: 0 4px 12px rgba(0, 0, 0, .05); }

        .trans{
            opacity: 0.6;

            transition: 0.3s;
        }
        .trans:hover{
            opacity: 1;
        }
    </style>



</head>

<body style="">

<div class="d-flex align-items-center p-3 px-md-4 mb-3 bg-white border-bottom ">
    <img src="/assets/blog/img/logo/dcloud.png" width="48" height="48">

    <h5 class="my-0 mr-md-auto font-weight-normal">dCloud</h5>

    <?php if(!isset($_SESSION['LoggedInAdminEmail'])){ ?>

    <nav class="my-2 my-md-0 mr-md-3">

        <a class="p-2 text-dark" href="/">Home</a>
        <a class="p-2 text-dark" href="/contact">Contact Us</a>

        <?php if(!empty($_SESSION["LoggedUserId"])){ ?>
            <a class="p-2 text-dark" href="/home">My Cloud</a>
            <a class="p-2 text-dark" href="/upgrade">Upgrade Storage</a>
        <?php }else{ ?>
            <a class="p-2 text-dark" href="/pricing">Pricing</a>
            <a class="p-2 text-dark" href="/register">Register</a>
        <?php }?>


    </nav>

    <?php if(empty($_SESSION["LoggedUserId"])){ ?>
    <a class="btn btn-outline-primary" href="/login">Login</a>
    <?php }else{ ?>
    <a class="btn btn-outline-primary" href="/logout/action">Logout</a>
   <?php } ?>

    <?php }else{ ?>

        <nav class="my-2 my-md-0 mr-md-3">

            {{--<a class="p-2 text-dark" href="/updateHomePage">Update Home Page Content</a>--}}
            {{--<a class="p-2 text-dark" href="/updateContact">Update Contact Us</a>--}}
            <a class="p-2 text-dark" href="/updateStoragePolicy">Upgrade Storage Policy</a>
            <a class="p-2 text-dark" href="/admin/logout">Logout</a>

        </nav>

    <?php } ?>









</div>





<div class="container">


    @yield('blog')



</div>


</body>
</html>

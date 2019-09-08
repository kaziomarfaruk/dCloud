<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>dCloud</title>

    <link rel="icon" href="/assets/blog/img/logo/dcloud.png" type="image/x-icon">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="/assets/blog/css/lightslider.css" />

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script src="/assets/blog/js/lightslider.js" ></script>


    <style>

        @media (max-width: 1200px) {
            #lightSlider{
                display: none;
            }
        }

        ::-webkit-scrollbar {
            width: 2px;
        }

        ::-webkit-scrollbar-track {
            background: #f3f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        body, html {
            height:100vh;
        }

        #right {
            height:100vh;
        }


        .left-folder-track-div {
            position: relative;
            height: 45vh;
            overflow: auto;

        }
        .table-wrapper-scroll-y {
            display: block;
        }


        #wrapper {
            padding: 0px;
        }


        #wrapper > .panel > .panel-heading > .panel-title {
            padding: 10px 0;
        }

        #wrapper > .row {
            margin: 0px;
        }

        #fab a:hover, #fab a:focus{
            color: white;
        }

        .item_name {
            width: 120px;
            overflow:hidden;
            white-space:nowrap;
            text-overflow: ellipsis;
        }

        .clickable {
            cursor: pointer;
        }

        .img-preview {
            background-color: #f7f7f7;
            overflow: hidden;
            width: 100%;
            text-align: center;
            height: 200px;
        }

        .hidden {
            display: none;
        }

        .square {
            width: 100%;
            padding-bottom: 100%;
            position: relative;
            border: 1px solid rgb(221, 221, 221);
            border-radius: 3px;
            max-width: 210px;
            max-height: 210px;
        }

        .div_hover {
            width: 100%;
            height: 40px;
            margin: 10px 0px;
            border-radius: 0%;
            background-color: #ffffff;
            color: #5F6368;
            text-decoration: none;
            opacity: 0.8;
            transition: 0.2s;


        }

        .div_hover:hover {
            padding: 5px 3px;
            border-radius: 4%;
            background-color: #fafafa;
            opacity: 1;
        }

        .div_hover a {
            color: #2e3033;
        }

        .top-nav-sidebar{
            padding: 10px;
        }

        table {
            width: 90%;

        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr {background-color:#ffffff;}
        tr:hover {background-color: #fafbe8;}

        .form-inline {
            display: flex;
            flex-flow: row wrap;
            align-items: center;
        }

        .form-inline label {
            margin: 5px 10px 5px 0;
        }

        .form-inline input {
            vertical-align: middle;
            margin: 5px 10px 5px 0;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .form-inline button {
            padding: 10px 20px;
            background-color: dodgerblue;
            border: 1px solid #ddd;
            color: white;
            cursor: pointer;
        }

        .form-inline button:hover {
            background-color: royalblue;
        }


        .btn-sml {
            padding: 10px 10px;
            font-size: 22px;
            border-radius: 8px;
        }


        .glyphicon {
            font-size: 30px;
        }
        .glyphicon.glyphicon-globe {
            font-size: 55px;
        }

        #userIcon{
            font-size: 40px;

        }

        .md-inactive{
            color: rgba(0, 0, 0,0.26);
            cursor: pointer;
        }

        .md-inactive:hover{
            color: rgba(0, 0, 0,0.46);
            cursor: pointer;
        }

        .left-sidebar-folder-a{
            text-decoration: none;
            color: #000;
            padding: 5px;
        }

        .lightSlider-h{
            text-align: center ;
            font-size: 15px;
            font-weight: bold;
        }


        .lSPager{
            display: none;
        }

        .lSpg{
            display: none;
        }

        .left-menu-text{
            padding:4px;font-size:17px
        }

        @media (max-width: 1200px) {
            .left-menu-text{
                padding:4px;font-size:14px
            }

        }

    </style>



    <link rel="stylesheet" href="/assets/blog/css/mfb.css">
</head>



<body class="">


<div class="container-fluid" id="wrapper">

    <div class="panel hidden-xs">
        <div class="panel-heading">

            <div class="form-inline">
                <a href="/"><img src="/assets/blog/img/logo/dcloud.png"  alt="dCloud" height="50" width="50"></a>
                <h4 style="color: #767676;padding: 6px">dCloud</h4>

                <input id="search_text" style="margin: 0 auto;width: 800px" type="search" placeholder="Search..." name="dearch"  >

                <div class="dropdown">

                    <i style="margin-left: 150px"  id="userIcon" class="material-icons md-inactive dropdown-toggle" id="menu1" data-toggle="dropdown">
                        account_circle
                    </i>

                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">

                        <li role="presentation" class="dropdown-header"></li>

                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/home">My Drive</a></li>

                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/share/{{$_SESSION['LoggedUserId']}}/{{$_SESSION['LoggedUserSalt']}}">Public Share</a></li>

                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/private/share/{{$_SESSION['LoggedUserId']}}">Shared With Me</a></li>

                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/recent">Recent</a></li>

                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/trash">Trash</a></li>

                        <li role="presentation" class="divider"></li>

                        <li role="presentation" class="dropdown-header"></li>

                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/upgrade">Upgrade</a></li>

                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/logout/action">Logout</a></li>
                    </ul>
                </div>

            </div>


        </div>
    </div>
    <div class="row">
        <div class="col-sm-2 hidden-xs">
            <div id="tree">


                <br><br>

                <div class="top-nav-sidebar">
                <ul class="list-unstyled">

                    <div class="div_hover" >
                        <li style="">
                            <a href="/home" style="margin: 0 auto;text-decoration: none;">
                                <i class="material-icons">
                                    store_mall_directory
                                </i>
                                <span class="left-menu-text" style="">My Drive</span>
                            </a>
                        </li>
                    </div>
                </ul>


                <ul class="list-unstyled">
                    <div class="div_hover">
                        <li style="">
                            <a href="/share/{{$_SESSION['LoggedUserId']}}/{{$_SESSION['LoggedUserSalt']}}" style="margin: 0 auto;text-decoration: none" class="clickable folder-item" data-id="/shares">
                                <span class="glyphicon glyphicon-share" style="font-size:20px"></span> <span class="left-menu-text" >Public Share</span>
                            </a>
                        </li>
                    </div>
                </ul>

                <ul class="list-unstyled">
                    <div class="div_hover">
                        <li style="">
                            <a href="/private/share/{{$_SESSION['LoggedUserId']}}" style="margin: 0 auto;text-decoration: none" class="clickable folder-item" data-id="/shares">
                                <span class="glyphicon glyphicon-share-alt" style="font-size:20px"></span> <span class="left-menu-text" >Shared With Me</span>
                            </a>
                        </li>
                    </div>
                </ul>

                <ul class="list-unstyled">
                    <div class="div_hover" >
                        <li style="">
                            <a href="/recent" style="margin: 0 auto;text-decoration: none" class="clickable folder-item" data-id="/shares">
                                <span class="glyphicon glyphicon-time" style="font-size:20px"></span> <span class="left-menu-text" >Recent</span>
                            </a>
                        </li>
                    </div>
                </ul>

                <ul class="list-unstyled">
                    <div class="div_hover" >
                        <li style="">
                            <a href="/trash" style="margin: 0 auto;text-decoration: none" class="clickable folder-item" data-id="/shares">
                                <span class="glyphicon glyphicon-trash" style="font-size:20px"></span> <span class="left-menu-text" >Trash</span>
                            </a>
                        </li>
                    </div>
                </ul>


                <?php

                    if( (explode('/',$_SERVER['REQUEST_URI'])[1] != 'private') && (explode('/',$_SERVER['REQUEST_URI'])[1] != 'share') && (explode('/',$_SERVER['REQUEST_URI'])[1] != 'trash') && (explode('/',$_SERVER['REQUEST_URI'])[1] != 'recent')) {

                        if(isset($_SESSION['move'])){
                            $child  = $_SESSION['move'];
                            $parent = 0;
                            if(explode('/',$_SERVER['REQUEST_URI'])[1] == 'home'){
                                $parent = 0 ;
                            }else{
                                $parent = explode('/',$_SERVER['REQUEST_URI'])[2];
                            }
                            echo '<a href="/move/'.$child.'/'.$parent.'">Move here</a><br>' ;
                        }
                            if(isset($_SESSION['copy'])){
                                $child  = $_SESSION['copy'];
                                $parent = 0;
                                if(explode('/',$_SERVER['REQUEST_URI'])[1] == 'home'){
                                    $parent = 0 ;
                                }else{
                                    $parent = explode('/',$_SERVER['REQUEST_URI'])[2];
                                }
                                echo '<a href="/copy/'.$child.'/'.$parent.'">Paste here</a>' ;
                            }

                        }

                    ?>


                <?php

                    use App\Controller\StorageController;
                    $storageController = new StorageController();

                    $used_storage = (double) ($storageController->getUserUsedStorage());
                    $reserveStorage = (double) ($storageController->getUserReserveStorage());

                    $percent = round(($used_storage/$reserveStorage) * 100);

                    $used = '';
                    $total = '';
                    if($reserveStorage/1000000>1){
                        $used = number_format($used_storage/1000000,2).' MB';
                        $total = number_format($reserveStorage/1000000,2).' MB';
                    }
                    if($reserveStorage/1000000000>1){
                        $used = number_format($used_storage/1000000000,2) . ' GB';
                        $total = number_format($reserveStorage/1000000000,2) . ' GB';
                    }


                    ?>
                    <br><br>

                    <p class=""><i style="font-size: 20px" class="material-icons">storage</i> <span class="left-menu-text" >Storage used</span> <span class="text-primary pull-right"><b>{{$percent}}%</b></span></p>
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary " role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: {{$percent}}%;">
                        </div><!-- /.progress-bar .progress-bar-danger -->
                    </div>
                    <small>Used {{$used}} of {{$total}}</small>
                    <a href="/upgrade">Upgrade storage</a>

                </div>

                <hr>
                <hr>

                <ul  class="left-folder-track-div list-unstyled">
                <?php

                    $RawDB = new \App\Classes\RawDatabase();
                    $RawConnect = $RawDB->getConnection();

                    $sql = "SELECT * FROM cloud where type = 'folder' and trashed = 0 and user_id = ".$_SESSION['LoggedUserId'];
                    $result = mysqli_query($RawConnect,$sql);
                    $numRows = mysqli_num_rows($result);
                    if($numRows>0){
                        while($row = mysqli_fetch_assoc($result)){
                            if($row['parent_id'] == 0){
                                echo "<li>";
                                echo '<i class="material-icons left-sidebar-folder">folder_open</i>';
                                echo '<a class="left-sidebar-folder-a" href="/folder/'.$row["id"].'" class="clickable folder-item" > '.$row['file_name'].'</a>';
                                subFolder($row['id']);
                                echo "</li>";
                            }
                        }
                    } ?>

                </ul>

                    <?php

                    function subFolder($top_parent_id){
                        $RawDB = new \App\Classes\RawDatabase();
                        $RawConnect = $RawDB->getConnection();
                        $sql = "SELECT * FROM cloud where type = 'folder'";
                        $result = mysqli_query($RawConnect,$sql);
                        echo '<ul class="list-unstyled">';
                        while($Subrow = mysqli_fetch_assoc($result)){
                            if($Subrow['parent_id'] == $top_parent_id){
                                echo '<li style="margin-left: 10px;">';
                                echo '<i class="material-icons left-sidebar-folder">folder_open</i>';
                                echo '<a class="left-sidebar-folder-a" href="/folder/'.$Subrow["id"].'" class="clickable folder-item" ></i>'.$Subrow['file_name'].'</a>';
                                subFolder($Subrow['id']);
                                echo '</li>';
                            }
                        }
                        echo '</ul>';
                    }

                ?>



            </div>
        </div>

        <div class="col-sm-10 col-xs-12" id="main">


            <div class="visible-xs" id="current_dir" style="padding: 5px 15px;background-color: #f8f8f8;color: #5e5e5e;">/1</div>

            <div id="alerts"></div>

            <div  id="content">
                @yield('content')
            </div>
        </div>

        <ul id="fab" class="mfb-component--br mfb-zoomin" data-mfb-toggle="hover" >
            <li class="mfb-component__wrap">
                <a href="#" class="mfb-component__button--main"><i class="mfb-component__main-icon--resting fa fa-plus"></i><i class="mfb-component__main-icon--active fa fa-times"></i></a>
                <ul class="mfb-component__list">
                    <li>
                        <a href="#" id="add-folder" data-mfb-label="New Folder" class="mfb-component__button--child" data-toggle="modal" data-target="#newFolderModal">
                            <i class="fa fa-folder mfb-component__child-icon"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="upload" data-mfb-label="Upload" class="mfb-component__button--child" data-toggle="modal" data-target="#uploadModal">
                            <i class="fa fa-upload mfb-component__child-icon"></i>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>


        <!--Folder Modal -->
        <div class="modal fade" id="newFolderModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create New Folder </h4>
                    </div>
                    <div class="modal-body">

                        <?php
                            $parent_id = 0;
                            if(explode('/',$_SERVER["REQUEST_URI"])[2] != null){
                                $parent_id = explode('/',$_SERVER["REQUEST_URI"])[2];
                            }
                        ?>

                        <form method="post" action="/folder/create">
                            <input class="form-control" type="text" name="folder_name" value="" placeholder="Folder name">
                            <input type="hidden" name="parent_id" value="{{$parent_id}}">
                            <br><input  class="btn btn-primary" type="submit" name="submit" value="Create" >
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Upload Modal -->
        <div class="modal fade" id="uploadModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create New Folder </h4>
                    </div>
                    <div class="modal-body">

                            <form action="\upload\action" method="POST" enctype="multipart/form-data">
                                <input class="form-control" type="hidden" name="parent_id" value="{{$parent_id}}">
                                <input type="file" name="uploadFile">
                                <br><input class="btn btn-primary" type="submit" name="uploadSubmit" value="Upload">
                            </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>


    </div>


</div>


</body></html>

<script>
    $(document).ready(function(){
        load_data();
        function load_data(query) {
            $.ajax({
                url:"/live_search_action",
                method:"post",
                data:{query:query},
                success:function(data) {
                    $('#result').html(data);
                }
            });
        }

        $('#search_text').keyup(function(){
            var search = $(this).val();
            if(search != '') {
                load_data(search);
            }
            else {
                load_data();
            }
        });
    });
</script>

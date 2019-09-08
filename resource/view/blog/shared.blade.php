
@extends('blog.layouts.base-home')

@section('content')

    <?php /*
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red">
            <i class="large material-icons">mode_edit</i>
        </a>
        <ul>
            <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
            <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
            <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
            <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
        </ul>
    </div>

 */ ?>
    <?php /*
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red">
            <i class="large material-icons">mode_edit</i>
        </a>
        <ul>
            <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
            <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
            <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
            <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
        </ul>
    </div>

 */ ?>

    <style>

    </style>

    <div class="table-wrapper-scroll-y my-custom-scrollbar">

        <table class="table ">
            <thead>
            <tr><th style="width:50%;">Item</th>
                <th>Size</th>
                <th>Type</th>
                <th>Modified</th>
                <th>Action</th>
            </tr></thead>
            <tbody>


            <?php /*
    <tr>
        <td>
            <i class="fa fa-folder-o"></i>
            <a class="folder-item clickable" data-id="/1/Algorithm" title="Algorithm">
                Algorithm
            </a>
        </td>
        <td></td>
        <td>Folder</td>
        <td>2018-11-17 03:10</td>
        <td class="actions">
            <a href="javascript:rename('Algorithm')" title="Rename">
                <i class="fa fa-edit fa-fw"></i>
            </a>
            <a href="javascript:trash('Algorithm')" title="Delete">
                <i class="fa fa-trash fa-fw"></i>
            </a>
        </td>
    </tr>
    <tr>
        <td>
            <i class="fa fa-image"></i>
            <a class="file-item clickable" data-id="http://programmersregion.com/laravel-filemanager/photos/1/download.jpg" title="download.jpg">
                download.jpg
            </a>
        </td>
        <td>14.00 kB</td>
        <td>image/jpeg</td>
        <td>2019-03-16 12:21</td>
        <td class="actions">
            <a href="javascript:download('download.jpg')" title="Download">
                <i class="fa fa-download fa-fw"></i>
            </a>
            <a href="javascript:fileView('http://programmersregion.com/laravel-filemanager/photos/1/download.jpg', '1552738889')" title="Preview">
                <i class="fa fa-image fa-fw"></i>
            </a>
            <a href="javascript:cropImage('download.jpg')" title="Crop">
                <i class="fa fa-crop fa-fw"></i>
            </a>
            <a href="javascript:resizeImage('download.jpg')" title="Resize">
                <i class="fa fa-arrows fa-fw"></i>
            </a>
            <a href="javascript:rename('download.jpg')" title="Rename">
                <i class="fa fa-edit fa-fw"></i>
            </a>
            <a href="javascript:trash('download.jpg')" title="Delete">
                <i class="fa fa-trash fa-fw"></i>
            </a>
        </td>
    </tr>
    <tr>
        <td>
            <i class="fa fa-image"></i>
            <a class="file-item clickable" data-id="http://programmersregion.com/laravel-filemanager/photos/1/img_lights.jpg" title="img_lights.jpg">
                img_lights.jpg
            </a>
        </td>
        <td>27.58 kB</td>
        <td>image/jpeg</td>
        <td>2019-03-16 12:21</td>
        <td class="actions">
            <a href="javascript:download('img_lights.jpg')" title="Download">
                <i class="fa fa-download fa-fw"></i>
            </a>
            <a href="javascript:fileView('http://programmersregion.com/laravel-filemanager/photos/1/img_lights.jpg', '1552738888')" title="Preview">
                <i class="fa fa-image fa-fw"></i>
            </a>
            <a href="javascript:cropImage('img_lights.jpg')" title="Crop">
                <i class="fa fa-crop fa-fw"></i>
            </a>
            <a href="javascript:resizeImage('img_lights.jpg')" title="Resize">
                <i class="fa fa-arrows fa-fw"></i>
            </a>
            <a href="javascript:rename('img_lights.jpg')" title="Rename">
                <i class="fa fa-edit fa-fw"></i>
            </a>
            <a href="javascript:trash('img_lights.jpg')" title="Delete">
                <i class="fa fa-trash fa-fw"></i>
            </a>
        </td>
    </tr>



*/ ?>



            <?php

            $RawDB = new \App\Classes\RawDatabase();
            $RawConnect = $RawDB->getConnection();

            $sql = "SELECT * FROM cloud WHERE is_shareable = 1 and trashed = 0
                    ORDER BY FIELD(type, 'folder', 'image/jpeg', 'other') ASC
";
            $result = mysqli_query($RawConnect,$sql);
            $numRows = mysqli_num_rows($result);
            if($numRows>0){
            while($row = mysqli_fetch_assoc($result)){  ?>

            <tr>

                <?php
                if($row["type"] == 'folder'){ ?>
                <td>
                    <i class="fa fa-folder-open-o"></i>
                    <a href="/folder/{{$row["id"]}}" class="file-item clickable"  title="download.jpg">
                        {{$row['file_name']}}.{{$row['ext']}}
                    </a>
                </td>

                <?php }else{ ?>

                <td>
                    <i class="fa fa-image"></i>
                    <a href="{{$row["path"]}}" class="file-item clickable"  title="download.jpg">
                        {{$row['file_name']}}.{{$row['ext']}}
                    </a>
                </td>

                <?php } ?>




                <?php if($row['size']/1000000>1){ ?>
                <td>{{number_format($row['size']/1000000,2)}} MB</td>
                <?php   }else{ ?>
                <td>{{number_format($row['size']/1000,2)}} KB</td>
                <?php   } ?>



                <td>{{$row['type']}}</td>
                <td>{{$row['modified_at']}}</td>
                <td class="actions">

                    <?php
                    if($row['type'] == 'folder'){ ?>
                    <a href="/download/folder/{{$row['id']}}" title="Download">
                        <i class="fa fa-download fa-fw"></i>
                    </a>
                    <?php    }else{
                    ?>
                    <a href="/download/{{$row['id']}}" title="Download">
                        <i class="fa fa-download fa-fw"></i>
                    </a>

                    <?php } ?>


                    <?php
                    if(explode('/',$row["type"])[0] == 'image'){
                    ?>
                    <a href="{{$row["path"]}}" title="Preview">
                        <i class="fa fa-image fa-fw"></i>
                    </a>
                    <?php }else{ ?>
                    <a href="/folder/{{$row["id"]}}" title="Preview">
                        <i class="fa fa-folder fa-fw"></i>
                    </a>
                    <?php } ?>

                    <a href="" title="Rename"  data-toggle="modal" data-target="#myModal{{$row["id"]}}">
                        <i class="fa fa-edit fa-fw"></i>
                    </a>


                    <?php
                    if($row["type"]=='folder'){
                    ?>

                    <a href="/folder/delete/{{$row["id"]}}" title="Delete">
                        <i class="fa fa-trash fa-fw"></i>
                    </a>
                    <?php }else{ ?>
                    <a href="/file/delete/{{$row["id"]}}" title="Delete">
                        <i class="fa fa-trash fa-fw"></i>
                    </a>

                    <?php } ?>




                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="myModal{{$row["id"]}}" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Rename </h4>
                        </div>
                        <div class="modal-body">

                            <form method="post" action="/file/rename">
                                <input type="text" name="new_name" value="{{$row["file_name"]}}" placeholder="Rename file">
                                <input type="hidden" name="id" value="{{$row["id"]}}">
                                <input type="submit" name="submit" value="Rename" >
                            </form>

                        </div>
                        <div class="modal-footer">
                            {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                        </div>
                    </div>

                </div>
            </div>






            <?php  }    } ?>








            </tbody>
        </table>

    </div>
    <?php /*
<table class="table visible-xs">
    <tbody>
    <tr>
        <td>
            <div class="media" style="height: 70px;">
                <div class="media-left">
                    <div class="square folder-item clickable" data-id="/1/Algorithm">
                        <img src="http://programmersregion.com/vendor/laravel-filemanager/img/folder.png">
                    </div>
                </div>
                <div class="media-body" style="padding-top: 10px;">
                    <div class="media-heading">
                        <p>
                            <a class="folder-item clickable" data-id="/1/Algorithm">
                                Algorithm
                            </a>
                            &nbsp;&nbsp;

                        </p>
                    </div>
                    <p style="color: #aaa;font-weight: 400">2018-11-17 03:10</p>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="media" style="height: 70px;">
                <div class="media-left">
                    <div class="square file-item clickable" data-id="http://programmersregion.com/laravel-filemanager/photos/1/download.jpg">
                        <img src="http://programmersregion.com/laravel-filemanager/photos/1/thumbs/download.jpg?timestamp=1552738889">
                    </div>
                </div>
                <div class="media-body" style="padding-top: 10px;">
                    <div class="media-heading">
                        <p>
                            <a class="file-item clickable" data-id="http://programmersregion.com/laravel-filemanager/photos/1/download.jpg">
                                download.jpg
                            </a>
                            &nbsp;&nbsp;

                        </p>
                    </div>
                    <p style="color: #aaa;font-weight: 400">2019-03-16 12:21</p>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="media" style="height: 70px;">
                <div class="media-left">
                    <div class="square file-item clickable" data-id="http://programmersregion.com/laravel-filemanager/photos/1/img_lights.jpg">
                        <img src="http://programmersregion.com/laravel-filemanager/photos/1/thumbs/img_lights.jpg?timestamp=1552738888">
                    </div>
                </div>
                <div class="media-body" style="padding-top: 10px;">
                    <div class="media-heading">
                        <p>
                            <a class="file-item clickable" data-id="http://programmersregion.com/laravel-filemanager/photos/1/img_lights.jpg">
                                img_lights.jpg
                            </a>
                            &nbsp;&nbsp;

                        </p>
                    </div>
                    <p style="color: #aaa;font-weight: 400">2019-03-16 12:21</p>
                </div>
            </div>
        </td>
    </tr>
    </tbody>
</table>

 */ ?>




@endsection


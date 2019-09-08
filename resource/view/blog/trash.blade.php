
@extends('blog.layouts.base-home')

@section('content')


    <div class="table-wrapper-scroll-y my-custom-scrollbar">

        <?php
        if (isset($_POST["query"])){
            //echo 'fdafsd';
        }
        ?>

        <div id="result"></div>


        <table class="table ">
            <thead>
            <tr><th style="width:50%;">Item</th>
                <th>Size</th>
                <th>Type</th>
                <th>Modified</th>
                <th>Action</th>
            </tr></thead>
            <tbody>


            <?php

            $RawDB = new \App\Classes\RawDatabase();
            $RawConnect = $RawDB->getConnection();

            $sql = "SELECT * FROM cloud WHERE trashed = 1 and user_id = ".$_SESSION['LoggedUserId']."
                    ORDER BY FIELD(type, 'folder','other') DESC";

            $result = mysqli_query($RawConnect,$sql);
            $numRows = mysqli_num_rows($result);
            if($numRows>0){

            while($row = mysqli_fetch_assoc($result)){

            $id = $row["id"];
            $file_name = $row['file_name'];
            $ext = $row['ext'];
            $path = $row["path"];
            $fileview = '';
            $download = '';
            $preview = '';
            $rename = '';
            $delete = '';
            $size = null;


//            $iresult = mysqli_query($RawConnect,"select * from cloud where trashed = 1 and parent_id = $id");
//            $inumRows = mysqli_num_rows($iresult);
//            if($inumRows>0){
//                continue;
//            }
//            var_dump(mysqli_fetch_assoc($iresult));



            if($row['size']/1000000>1){
                $size = number_format($row['size']/1000000,2).' mb';
            }else{
                $size = number_format($row['size']/1000,2) . 'KB';
            }

            $delete = '<a href="/folder/delete/'.$id.'" title="Delete">
                                <i class="fa fa-trash fa-fw"></i>
                            </a> ';

            $download =  '<a href="/download/'.$id.'" title="Download">
                                    <i class="fa fa-download fa-fw"></i>
                                  </a>';

            $preview =  '<a href="'.$path.'" title="Preview">
                                     <i class="fa fa-file-o fa-fw"></i>
                                 </a>';

            $rename = '<a href="" title="Rename"  data-toggle="modal" data-target="#myModal'.$id.'">
                                   <i class="fa fa-edit fa-fw"></i>
                               </a>';

            $fileview = '<td>
                            <i class="fa fa-file-o fa-fw"></i>
                            <a class="clickable"  title="download.jpg">
                                '.$file_name.'.'.$ext.'
                            </a>
                        </td>';

            if($row["type"] == 'folder'){
                $download = '<a href="/download/folder/'.$id.'" title="Download">
                                      <i class="fa fa-download fa-fw"></i>
                                    </a>';

                $fileview = '<td>
                            <i class="fa fa-folder-open-o"></i>
                            <a class=" clickable"  title="download.jpg">
                                '.$file_name.'
                            </a>
                        </td>' ;
                $preview = '<a href="/folder/'.$id.'" title="Preview">
                                        <i class="fa fa-folder fa-fw"></i>
                                    </a>';
            }

            if(explode('/',$row["type"])[0] == 'image'){
                $fileview = '<td>
                            <i class="fa fa-image"></i>
                            <a href="'.$path.'" class="clickable"  title="download.jpg">
                                '.$file_name.'.'.$ext.'
                            </a>
                        </td>';
                $preview =  '<a href="'.$path.'" title="Preview">
                                        <i class="fa fa-image fa-fw"></i>
                                    </a>';

            }

            if(explode('/',$row["type"])[0] == 'video'){
                $fileview = '<td>
                            <i class="fa fa-video-camera"></i>
                            <a href="'.$path.'" class="file-item clickable"  title="download.jpg">
                                '.$file_name.'.'.$ext.'
                            </a>
                        </td>';
                $preview =  '<a href="'.$path.'" title="Preview">
                                        <i class="fa fa-video-camera fa-fw"></i>
                                    </a>';
            }
            if(explode('/',$row["type"])[0] == 'audio'){
                $fileview = '<td>
                            <i class="fa fa-file-audio-o fa-fw"></i>
                            <a href="'.$path.'" class="file-item clickable"  title="download.jpg">
                                '.$file_name.'.'.$ext.'
                            </a>
                        </td>';
                $preview =  '<a href="'.$path.'" title="Preview">
                                        <i class="fa fa-file-audio-o fa-fw"></i>
                                    </a>';
            }

            if($row["type"] == 'application/pdf'){
                $fileview = '<td>
                                    <i class="fa fa-file-pdf-o fa-fw"></i>
                                    <a href="'.$path.'" class="file-item clickable"  title="download.jpg">
                                        '.$file_name.'.'.$ext.'
                                    </a>
                                </td>';
                $preview =  '<a href="'.$path.'" title="Preview">
                                                <i class="fa fa-file-pdf-o fa-fw"></i>
                                            </a>';
            }

            if(explode('/',$row["type"])[0] == 'text'){
                $fileview = '<td>
                            <i class="fa fa-file-text-o fa-fw"></i>
                            <a href="'.$path.'" class="file-item clickable"  title="download.jpg">
                                '.$file_name.'.'.$ext.'
                            </a>
                        </td>';
                $preview =  '<a href="'.$path.'" title="Preview">
                                        <i class="fa fa-file-pdf-o fa-fw"></i>
                                    </a>';
            }



            $delete = '';
            $restore = '';

            if($row["type"]=='folder'){

                $delete = '<a href="/trash/delete/folder/'.$row["id"].'" title="Delete">
                    <i class="fa fa-trash"></i>
                </a>';
            }else{
                $delete = '<a href="/trash/delete/file/'.$row["id"].'" title="Delete">
                    <i class="fa fa-trash"></i>
                </a>';

            }

            if($row["type"]=='folder'){
                $restore = '<a href="/trash/restore/folder/'.$row["id"].'" title="Restore">
                        <i class="fa fa-recycle"></i>
                    </a>';

            }else{
                $restore = '<a href="/trash/restore/file/'.$row["id"].'" title="Restore">
                        <i class="fa fa-recycle"></i>
                    </a>';

            }


            echo '
                        <tr>
                            '.$fileview.'
                            <td>'.$size.'</td>
                            <td>'.$row["type"].'</td>
                            <td>'.$row["modified_at"].'</td>


                            <td>'.$delete.$restore.'</td>

                        </tr>
                    ';
            ?>



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


            <?php  } } ?>


            </tbody>
        </table>

    </div>



@endsection


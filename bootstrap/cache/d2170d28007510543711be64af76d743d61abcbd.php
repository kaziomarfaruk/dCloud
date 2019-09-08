<?php $__env->startSection('content'); ?>


    <div class="table-wrapper-scroll-y my-custom-scrollbar">

        <?php
        if (isset($_POST["query"])){
            //echo 'fdafsd';
        }

        if(isset($_SESSION['move'])){
            //echo $_SESSION['move'];
        }


        ?>

        <div id="result"></div>


            <div style="height: 600px;overflow-y: scroll;overflow-x: hidden;">
                <table class="table " >
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

            $sql = "SELECT * FROM cloud WHERE parent_id = '{$parent_id}' AND trashed = 0";
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

            if($row['size']/1000000>1){
                $size = number_format($row['size']/1000000,2).' mb';
            }else{
                $size = number_format($row['size']/1000,2) . 'KB';
            }
            if($row["type"] == 'folder'){
                $size = "/";
            }

            if($row["type"] == 'folder'){
                $delete = '<a href="/folder/delete/'.$id.'" title="Delete">
                                <i class="fa fa-trash fa-fw"></i>
                            </a> ';

            }else{
                $delete = '<a href="/file/delete/'.$id.'" title="Delete">
                                <i class="fa fa-trash fa-fw"></i>
                            </a> ';
            }


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
                            <a href="'.$path.'" class="file-item clickable"  title="download.jpg">
                                '.$file_name.'.'.$ext.'
                            </a>
                        </td>';

            if($row["type"] == 'folder'){
                $download = '<a href="/download/folder/'.$id.'" title="Download">
                                      <i class="fa fa-download fa-fw"></i>
                                    </a>';

                $fileview = '<td>
                            <i class="fa fa-folder-open-o"></i>
                            <a href="/folder/'.$id.'" class="file-item clickable"  title="download.jpg">
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
                            <a href="'.$path.'" class="file-item clickable"  title="download.jpg">
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


            $publicshare =  '<a title="Public Share" href="/publicShareAction/'.$id.'" title="Preview">
                                               <i class="fa fa-share-square-o fa-fw"></i>
                                             </a>';

            if($row['public_share'] == 1){
                $publicshare = '';
            }

            $singleshare =  '<a title="Share with" href="#" title="Preview" data-toggle="modal" data-target="#ShareModal'.$id.'">
                                   <i class="fa fa-share-alt-square fa-fw"></i>
                                 </a>';

            if($row['type']=='folder'){
                $publicshare = '';
                $singleshare =  '';
            }


            if($row['type']=='folder'){
                echo '
                        <tr>
                            '.$fileview.'
                            <td>'.$size.'</td>
                            <td>'.$row["type"].'</td>
                            <td>'.$row["modified_at"].'</td>
                            <td>'.$download.$preview.$rename.$delete.'</td>
                        </tr>
                    ';

            }
            else{
                echo '
                            <tr>
                                '.$fileview.'
                                <td>'.$size.'</td>
                                <td>'.$row["type"].'</td>
                                <td>'.$row["modified_at"].'</td>
                                <td>'.$download.$preview.$rename.$delete.$publicshare.$singleshare.'
                                <a title="Copy" href="/copyCreate/'.$id.'"><i class="fa fa-files-o"></i></a>
                                <a title="Move" href="/moveCreate/'.$id.'"><i class="fa fa-file" aria-hidden="true"></i></a></td>
                            </tr>
                        ';
            }
            ?>



            <!-- Modal -->
            <div class="modal fade" id="myModal<?php echo e($row["id"]); ?>" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Rename </h4>
                        </div>
                        <div class="modal-body">

                            <form method="post" action="/file/rename">
                                <input class="form-control" type="text" name="new_name" value="<?php echo e($row["file_name"]); ?>" placeholder="Rename file">
                                <input type="hidden" name="id" value="<?php echo e($row["id"]); ?>">
                                <br><input class="btn btn-primary" type="submit" name="submit" value="Rename" >
                            </form>

                        </div>
                        <div class="modal-footer">
                            
                        </div>
                    </div>

                </div>
            </div>



            <!-- Share Modal -->
            <div class="modal fade" id="ShareModal<?php echo e($row["id"]); ?>" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Rename </h4>
                        </div>
                        <div class="modal-body">

                            <form method="post" action="/personal/share">
                                <input class="form-control" type="text" name="share_email" value="" placeholder="Email to share...">
                                <input type="hidden" name="id" value="<?php echo e($row["id"]); ?>">
                                <input  class="btn btn-primary" type="submit" name="submit" value="Share..." >
                            </form>

                        </div>
                        <div class="modal-footer">
                            
                        </div>
                    </div>

                </div>
            </div>



            <?php  } } ?>


            </tbody>
        </table>
            </div>
    </div>



<?php $__env->stopSection(); ?>


<?php echo $__env->make('blog.layouts.base-home', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
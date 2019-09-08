<?php $__env->startSection('content'); ?>


    <div class="">

        <?php
            if (isset($_POST["query"])){
                //echo $_POST["query"];
            }
        ?>

        <div id="result"></div>

        <h4 style="padding: 10px;font-weight: bold;color: #828282"> Quick Access</h4>

        <?php if( !isset($_SESSION['StorageLimitError']) && !isset($_SESSION['StorageUpgradeSuccessful']) ){ ?>

        <ul id="lightSlider">


        <?php

        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();

        $sql = "SELECT * FROM cloud WHERE trashed = 0 AND user_id = ".$_SESSION['LoggedUserId']."
                ORDER by modified_at DESC limit 25";
        $result = mysqli_query($RawConnect,$sql);
        $numRows = mysqli_num_rows($result);
        if($numRows>0){

        while($row = mysqli_fetch_assoc($result)){ ?>

            <?php if(explode('/',$row["type"])[0] == 'image'){ ?>
                <li >
                    <a href="<?php echo e($row["path"]); ?>" style="text-decoration: none">
                        <img src="<?php echo e($row["path"]); ?>" style="padding: 10px;border-radius: 20%" width="150" height="130">
                        <h4 class="lightSlider-h" style="margin-left: 20px"><?php echo e(substr($row["file_name"],0,8)); ?>.<?php echo e($row["ext"]); ?></h4>
                    </a>
                </li>
            <?php } ?>

            <?php if($row["type"] == 'folder'){ ?>
                <li>
                    <a href="/folder/<?php echo e($row["id"]); ?>" style="text-decoration: none">
                        <img src="/assets/blog/img/others/folder-big.png" style="padding: 10px;border-radius: 20%" width="150" height="130">
                        <h4 class="lightSlider-h" style="margin-left: 20px"><?php echo e(substr($row["file_name"],0,8)); ?></h4>
                    </a>
                </li>
            <?php  } ?>


            <?php if($row["type"] == 'application/pdf'){ ?>
            <li >
                <a href="<?php echo e($row["path"]); ?>" style="text-decoration: none">
                    <img src="/assets/blog/img/others/pdf.png" style="padding: 10px;border-radius: 20%" width="150" height="130">
                    <h4 class="lightSlider-h" style="margin-left: 20px"><?php echo e(substr($row["file_name"],0,8)); ?>.<?php echo e($row["ext"]); ?></h4>
                </a>
            </li>
            <?php } ?>

            <?php if(explode('/',$row["type"])[0] == 'audio'){ ?>
            <li >
                <a href="<?php echo e($row["path"]); ?>" style="text-decoration: none">
                    <img src="/assets/blog/img/others/audio.png" style="padding: 10px;border-radius: 20%" width="150" height="130">
                    <h4 class="lightSlider-h" style="margin-left: 20px"><?php echo e(substr($row["file_name"],0,8)); ?>.<?php echo e($row["ext"]); ?></h4>
                </a>
            </li>
            <?php } ?>


            <?php if(explode('/',$row["type"])[0] == 'video'){ ?>
                <li >
                    <a href="<?php echo e($row["path"]); ?>" style="text-decoration: none">
                        <video  style="padding: 10px;border-radius: 20%" width="150" height="130" controls="controls" preload="metadata">
                            <source src="<?php echo e($row["path"]); ?>" type="video/mp4">
                        </video>
                        <h4 class="lightSlider-h" style="margin-left: 20px"><?php echo e(substr($row["file_name"],0,8)); ?>.<?php echo e($row["ext"]); ?></h4>
                    </a>
                </li>
            <?php } ?>

        <?php if(explode('/',$row["type"])[0] == 'text'){ ?>
            <li >
                <a href="<?php echo e($row["path"]); ?>" style="text-decoration: none">
                    <img src="/assets/blog/img/others/text.png" style="padding: 10px;border-radius: 20%" width="150" height="130">
                    <h4 class="lightSlider-h" style="margin-left: 20px"><?php echo e(substr($row["file_name"],0,8)); ?>.<?php echo e($row["ext"]); ?></h4>
                </a>
            </li>
            <?php }if(
                explode('/',$row["type"])[0] !== 'image' &&
                $row["type"] !== 'folder' &&
                $row["type"] !== 'application/pdf' &&
                explode('/',$row["type"])[0] !== 'audio' &&
                explode('/',$row["type"])[0] !== 'video' &&
                explode('/',$row["type"])[0] !== 'text'
            ){ ?>

            <li >
                <a href="<?php echo e($row["path"]); ?>" style="text-decoration: none">
                    <img src="/assets/blog/img/others/file.png" style="padding: 10px;border-radius: 20%" width="150" height="130">
                    <h4 class="lightSlider-h" style="margin-left: 20px"><?php echo e(substr($row["file_name"],0,8)); ?>.<?php echo e($row["ext"]); ?></h4>
                </a>
            </li>

            <?php } ?>




            <?php }} ?>





        </ul>

        <script type="text/javascript">
            $(document).ready(function() {
                $("#lightSlider").lightSlider({
                    item: 9,
                });
            });
        </script>

            <?php } ?>



<div style="height: 600px;overflow-y: scroll;overflow-x: hidden;">
    <table class="table " >


    <thead>
    <tr><th style="width:50%;">Item</th>
        <th>Size</th>
        <th>Type</th>
        <th>Modified</th>
        <th>Action</th>
    </tr></thead>
    <tbody >


    <?php

        $RawDB = new \App\Classes\RawDatabase();
        $RawConnect = $RawDB->getConnection();

        //$sql = "SELECT * FROM cloud WHERE parent_id = 0 AND trashed = 0 ORDER BY FIELD(type, 'folder','other') DESC";

        $sql = "SELECT * FROM cloud WHERE parent_id = 0 AND trashed = 0 AND user_id = ".$_SESSION['LoggedUserId']."
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
                    <br><input class="btn btn-primarys" type="submit" name="submit" value="Share..." >
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


    <?php if(isset($_SESSION['StorageLimitError'])){ ?>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#myModal").modal('show');
            });
        </script>


        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="location.href = '/home';">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Please upgrade your File size exceed your data limit.Please upgrade your storage or delete some from cloud to continue.</p>
                    </div>
                </div>
            </div>
        </div>


    <?php unset($_SESSION['StorageLimitError']);    } ?>


    <?php if(isset($_SESSION['StorageUpgradeSuccessful'])){ ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#myModal").modal('show');
        });
    </script>


    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="location.href = '/home';">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Storage Upgraded successfully.</p>
                </div>
            </div>
        </div>
    </div>


    <?php unset($_SESSION['StorageUpgradeSuccessful']);    } ?>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('blog.layouts.base-home', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
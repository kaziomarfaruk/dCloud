@extends('blog.layouts.base-home')

@section('content')


    <div class="table-wrapper-scroll-y my-custom-scrollbar">

        <?php
        if (isset($_POST["query"])){
            echo 'fdafsd';
        }
        ?>

        <div id="result"></div>

            <br><br>


              <div class="form-group">
                    <label for="exampleInputEmail1">Sharable Link</label>
                    <input style="width: 500px" id="copyTarget" readonly type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="http://dcloud.com/share/{{$_SESSION['LoggedUserId']}}/{{$_SESSION['LoggedUserSalt']}}" >
                </div>
                <button id="copyButton" type="submit" class="btn btn-primary">Copy to Clipboard</button><br><br>


            {{--<input type="text" id="copyTarget" value="Text to Copy"> <button id="copyButton">Copy</button><br><br>--}}

            <script>

                document.getElementById("copyButton").addEventListener("click", function() {
                    copyToClipboard(document.getElementById("copyTarget"));
                });

                function copyToClipboard(elem) {
                    // create hidden text element, if it doesn't already exist
                    var targetId = "_hiddenCopyText_";
                    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
                    var origSelectionStart, origSelectionEnd;
                    if (isInput) {
                        // can just use the original source element for the selection and copy
                        target = elem;
                        origSelectionStart = elem.selectionStart;
                        origSelectionEnd = elem.selectionEnd;
                    } else {
                        // must use a temporary form element for the selection and copy
                        target = document.getElementById(targetId);
                        if (!target) {
                            var target = document.createElement("textarea");
                            target.style.position = "absolute";
                            target.style.left = "-9999px";
                            target.style.top = "0";
                            target.id = targetId;
                            document.body.appendChild(target);
                        }
                        target.textContent = elem.textContent;
                    }
                    // select the content
                    var currentFocus = document.activeElement;
                    target.focus();
                    target.setSelectionRange(0, target.value.length);

                    // copy the selection
                    var succeed;
                    try {
                        succeed = document.execCommand("copy");
                    } catch(e) {
                        succeed = false;
                    }
                    // restore original focus
                    if (currentFocus && typeof currentFocus.focus === "function") {
                        currentFocus.focus();
                    }

                    if (isInput) {
                        // restore prior selection
                        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
                    } else {
                        // clear temporary content
                        target.textContent = "";
                    }
                    return succeed;
                }


            </script>


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

            $id = explode("/",$_SERVER["REQUEST_URI"])[2]; //die();
            $user_token = explode("/",$_SERVER["REQUEST_URI"])[3]; //die();

            $usrresult = mysqli_query($RawConnect,"SELECT * FROM user where salt = '{$user_token}'");
            $usrnumRows = mysqli_num_rows($usrresult);
            if($usrnumRows ==0 || $usrnumRows ==null){
                //ob_start();
                //echo "Sorry No User Found";
                //ob_end_clean();
                //die();
                //http://dcloud.com/share/13/e75ca67d80c6e93c816ff631419ce920
            }

            $sql = "SELECT * FROM cloud where trashed = 0 and public_share = 1 and user_id = '{$id}'";
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
            $removeFromShare = '';


            if($row['size']/1000000>1){
                $size = number_format($row['size']/1000000,2).' mb';
            }else{
                $size = number_format($row['size']/1000,2) . 'KB';
            }


            $removeFromShare = '<a href="/public-share-remove/'.$id.'" title="Delete">
                                <i class="fa fa-minus-circle fa-fw"></i>
                            </a> ';

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

            echo '
                        <tr>
                            '.$fileview.'
                            <td>'.$size.'</td>
                            <td>'.$row["type"].'</td>
                            <td>'.$row["modified_at"].'</td>
                            <td>'.$download.$preview.$removeFromShare.'</td>

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


<?php

namespace App\Controller;

class LiveSearch extends BaseController{

    public function action(){

        $connect = mysqli_connect("localhost", "root", "", "dcloud");
        $output = '';
        if(isset($_POST["query"]))
        {

            $search = mysqli_real_escape_string($connect, $_POST["query"]);
            $query = "SELECT * FROM cloud WHERE file_name LIKE '%{$search}%' AND trashed = 0";
            $result = mysqli_query($connect, $query);
            if(mysqli_num_rows($result) > 0) {
                $output .= '
                    <h4 style="padding: 10px;font-weight: bold;color: #828282">Search Result...</h4>
                    <div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Item</th>
							<th>Size</th>
							<th>Type</th>
							<th>Modified</th>
							<th>Action</th>
						</tr>';

                while($row = mysqli_fetch_array($result)) {

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

                    if(explode('/',$row["type"])[1] == 'pdf'){
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


                    $publicshare =  '<a href="/publicShareAction/'.$id.'" title="Preview">
                                               <i class="fa fa-share-square-o fa-fw"></i>
                                             </a>';

                    if($row['public_share'] == 1){
                        $publicshare = '';
                    }

                    $singleshare =  '<a href="#" title="Preview" data-toggle="modal" data-target="#ShareModal'.$id.'">
                                       <i class="fa fa-share-alt-square fa-fw"></i>
                                     </a>';

                    if($row['type']=='folder'){
                        $publicshare = '';
                        $singleshare =  '';
                    }


                    if($row["type"] == 'folder'){
                        $size = '/';
                    }

                    $output .= '
                        <tr>
                            '.$fileview.'
                            <td>'.$size.'</td>
                            <td>'.$row["type"].'</td>
                            <td>'.$row["modified_at"].'</td>
                            <td>'.$download.$preview.$rename.$delete.$publicshare.$singleshare.'</td>
                            
                        </tr>
                    ';
                }
                echo $output;
            }


        }



    }




}

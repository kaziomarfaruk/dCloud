@extends('blog.layouts.blog-home')

<?php



?>

@section('blog')

    <div class="row">
        <div style="width:400px;margin:0px auto">
            <div style=" background: #ffffff;border-top: 2px solid #d9d9d9 " class="account-wall">
                {{--<img src="/assets/blog/img/logo/dcloud.png" width="38" height="38">--}}

                <h1 style="text-align: center" class="trans display-8">Storage Policy</h1><br>

                <div style="padding: 20px">
                <table  class="table">
                    <thead>
                    <tr>
                        <th>Package Title</th>
                        <th>Storage</th>
                        <th>Price</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>

                <?php
                    $RawDB = new \App\Classes\RawDatabase();
                    $RawConnect = $RawDB->getConnection();

                    $query = mysqli_query($RawConnect,'SELECT * FROM storage_policy');
                    while($row = mysqli_fetch_assoc($query)){


                        ?>

                    <tr>
                        <td>{{$row["package"]}}</td>
                        <td>{{$row["storage"]}}</td>
                        <td>{{$row["price"]}}$</td>
                        <td><a href="#" data-toggle="modal" data-target="#myModal{{$row["id"]}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                        <td><a href="/packageDelete/{{$row["id"]}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>

                    </tr>

                <!-- Update Model-->
                <div class="modal fade" id="myModal{{$row["id"]}}" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h2>Upgrade Storage</h2>
                                <form  method="post" action="/adminStoragePolicyUpdateAction">
                                    <input class="p-3 form-control" type="text" name="package" value="{{$row["package"]}}" placeholder="Rename file">
                                    <input class="p-3 form-control" type="text" name="storage" value="{{$row["storage"]}}" placeholder="Rename file">
                                    <input class="p-3 form-control" type="text" name="price" value="{{$row["price"]}}" placeholder="Rename file">
                                    <input type="hidden" name="id" value="{{$row["id"]}}">
                                    <input type="submit" name="submit"  class="btn btn-primary" value="Upgrade" >
                                </form>

                            </div>
                            <div class="modal-footer">
                                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                            </div>
                        </div>
                    </div>
                </div>

                <?php    }  ?>



                    </tbody>
                </table>
                </div>

                <form action="/StoragePolicyAdd" method="post" class="form-signin">
                    <input name="package" type="text" class ="form-control" placeholder="Title" required="true" autofocus="true">
                    <input name="storage" type="text" class ="form-control" placeholder="Storage" required="true" autofocus="true">
                    <input name="price" type="text" class ="form-control" placeholder="Price" required="true" autofocus="true">
                    <button class="btn btn-lg btn-primary btn-block">Add</button>
                </form>

            </div>
        </div>
    </div>

@endsection





















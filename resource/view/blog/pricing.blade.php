@extends('blog.layouts.blog-home')


@section('blog')

    <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">

        <h1 class="display-4">Pricing</h1>

        <p class="lead">Select one of you package from many.You can upgrade further.</p>
    </div>

    <div class="container">

        <div class="mb-3 text-center">

        <?php

                $RawDB = new \App\Classes\RawDatabase();
                $RawConnect = $RawDB->getConnection();

                $query = mysqli_query($RawConnect,'SELECT * FROM storage_policy');
                while($row = mysqli_fetch_assoc($query)){

                        $size = '';
                        if($row['storage']/1000000>1){
                            $size = number_format($row['storage']/1000000,2).' MB';
                        }
                        if($row['storage']/1000000000>1){
                            $size = number_format($row['storage']/1000000000,2) . ' GB';
                        }

                    ?>

            <div class="col-md-4 card mb-4 box-shadow">

                <div class="card-header">

                    <h4 class="my-0 font-weight-normal">{{$row['package']}}</h4>

                </div>
                <div style="padding:20px">

                    <h1 class="card-title ">${{$row['price']}} <small class="">/ mo</small></h1>

                    <ul class="list-unstyled mt-3 mb-4">
                        <li>{{$size}} of storage</li>
                        <li>Priority email support</li>
                        <li>Help center access</li>
                    </ul>
                    <a style="text-decoration: none" href="/login?next=buy"><button type="button" class="btn btn-lg btn-block btn-primary">Get started</button></a>
                </div>
            </div>

            <?php } ?>

        </div>

@endsection























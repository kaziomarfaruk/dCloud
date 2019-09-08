<?php $__env->startSection('blog'); ?>



    <div class="mt-5 pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">


        <h1 class="trans display-4">Welcome To dCloud.com</h1>

        <p class="trans lead">dCloud Storage is unified object storage for developers and enterprises,
            from live applications data to cloud archival.From a lot of options select one of yours.
        </p>

        <div class="btn-group">
            <a href="/pricing"><button type="button" class="trans btn btn-lg btn-primary">Buy sotrage</button></a>

        </div>

    </div>





    <?php $__env->stopSection(); ?>


















<?php echo $__env->make('blog.layouts.blog-home', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
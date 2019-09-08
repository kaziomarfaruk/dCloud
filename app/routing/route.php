<?php

$router = new AltoRouter();

    $router->map('GET','/','App\Controller\BlogController#blog','blog');
    $router->map('GET','/pricing','App\Controller\BlogController#pricing','blog.pricing');
    $router->map('GET','/contact','App\Controller\BlogController#contact','blog.contact');

    //if(!empty($_SESSION["LoggedUserId"])){
    /* */
    $router->map('GET', '/home', 'App\Controller\HomeController#home', 'blog.home');
    $router->map('GET', '/upload/', 'App\Controller\HomeController#upload', 'blog.upload');
    $router->map('GET', '/folder/[i:id]', 'App\Controller\HomeController#folder', 'blog.folder');

    /* upload Download Routes */
    $router->map('POST', '/upload/action', 'App\Controller\UploadDownloadController#uploadAction', 'blog.uploadAction');
    $router->map('GET', '/download/[i:id]', 'App\Controller\UploadDownloadController#download', 'blog.download');
    $router->map('GET', '/download/folder/[i:id]', 'App\Controller\UploadDownloadController#folderDownload', 'blog.folder.download');
    /* ---------------------- */

    $router->map('POST', '/file/rename', 'App\Controller\HomeController#fileRename', 'blog.fileRename');

    $router->map('GET', '/file/delete/[i:id]', 'App\Controller\HomeController#fileDelete', 'blog.fileDelete');
    $router->map('GET', '/folder/delete/[i:id]', 'App\Controller\HomeController#folderDelete', 'blog.folderDelete');

    $router->map('GET', '/public-share-remove/[i:id]', 'App\Controller\ShareController#publicShareRemove', 'blog.publicShareRemove');
    $router->map('GET', '/private-share-remove/[i:id]', 'App\Controller\ShareController#privateShareRemove', 'blog.privateShareRemove');

    $router->map('POST', '/folder/create', 'App\Controller\HomeController#folderCreate', 'blog.folderCreate');
    $router->map('GET', '/shared', 'App\Controller\ShareController#shared', 'blog.share');


    //$router->map('GET', '/share/public/[i:id]', 'App\Controller\ShareController#publicShare', 'blog.publicShare');

    $router->map('GET', '/share/[i:id]/[a:action]', 'App\Controller\ShareController#publicShare', 'blog.publicShare');

    $router->map('GET', '/private/share/[i:id]', 'App\Controller\ShareController#privateShare', 'blog.privateShare');
    $router->map('GET', '/publicShareAction/[i:id]', 'App\Controller\ShareController#publicShareAction', 'blog.publicShareAction');
    $router->map('POST', '/personal/share', 'App\Controller\ShareController#personalShareAction', 'blog.personalShareAction');
    $router->map('GET', '/recent', 'App\Controller\RecentController#recent', 'blog.recent');
    $router->map('GET', '/trash', 'App\Controller\TrashController#trash', 'blog.trash');
    $router->map('GET', '/trash/restore/folder/[i:id]', 'App\Controller\TrashController#trashRestoreFolder', 'blog.trashRestoreFolder');
    $router->map('GET', '/trash/restore/file/[i:id]', 'App\Controller\TrashController#trashRestoreFile', 'blog.trashRestoreFile');
    $router->map('GET', '/trash/delete/folder/[i:id]', 'App\Controller\TrashController#trashDeleteFolder', 'blog.trashDeleteFolder');
    $router->map('GET', '/trash/delete/file/[i:id]', 'App\Controller\TrashController#trashDeleteFile', 'blog.trashDeleteFile');


//}else{
//    header('Location: /login');
//}
// login
$router->map('GET','/login','App\Controller\UserLogin#login','blog.login');
$router->map('POST','/login/action','App\Controller\UserLogin#action','blog.login.action');
$router->map('GET','/register','App\Controller\UserRegister#register','blog.register');
$router->map('POST','/register/action','App\Controller\UserRegister#action','blog.register.action');
$router->map('GET', '/logout/action', 'App\Controller\LogoutController#logout', 'logout');

$router->map('GET','/register/pack/[a:action]','App\Controller\UserRegister#register','blog.pack');


$router->map('GET','/register/confirmation/[a:action]','App\Controller\UserRegister#confirmation','blog.register.confirmation');

$router->map('GET','/user/recover','App\Controller\UserLogin#recover','blog.recover');
$router->map('POST','/user/recover/action','App\Controller\UserLogin#recoverAction','blog.recoverAction');
$router->map('GET','/user_recover/[a:action]','App\Controller\UserLogin#recoverActionProcess','blog.recoverActionProcess');
$router->map('POST','/user_recover_next','App\Controller\UserLogin#recoverActionChangePasswordSubmit','blog.recoverActionChangePasswordSubmit');

//live search
$router->map('POST','/live_search_action','App\Controller\LiveSearch#action','blog.livesearch.action');

//$router->map('GET','/user/[a:action]','App\Controller\RecentController#recent','blog.recent');
$router->map('GET','/upgrade','App\Controller\StorageController#upgrade','blog.upgrade');
$router->map('GET','/upgrade/action/p1','App\Controller\StorageController#upgradeP1','blog.upgradeP1');
$router->map('GET','/upgrade/action/p2','App\Controller\StorageController#upgradeP2','blog.upgradeP2');

//move
$router->map('GET', '/moveCreate/[i:id]', 'App\Controller\ParentChildController#moveCreate', 'blog.moveCreate');
$router->map('GET', '/move/[i:id]/[i:id2]', 'App\Controller\ParentChildController#move', 'blog.moveM');

$router->map('GET', '/copyCreate/[i:id]', 'App\Controller\ParentChildController#copyCreate', 'blog.copyCreate');
$router->map('GET', '/copy/[i:id]/[i:id2]', 'App\Controller\ParentChildController#copy', 'blog.copyM');

//admin controller
$router->map('GET','/admin/login','App\Controller\AdminController#adminLoginView','blog.adminLoginView');
$router->map('POST','/admin/login/action','App\Controller\AdminController#adminLoginAction','blog.adminLoginAction');
$router->map('GET','/admin','App\Controller\AdminController#admin','blog.admin');
$router->map('GET','/admin/logout','App\Controller\AdminController#adminLogout','blog.adminLogout');

$router->map('GET','/updateHomePage','App\Controller\AdminController#updateHomePage','blog.updateHomePage');
$router->map('GET','/updateContact','App\Controller\AdminController#updateContact','blog.updateContact');
$router->map('GET','/updateStoragePolicy','App\Controller\AdminController#updateStoragePolicy','blog.updateStoragePolicy');

$router->map('POST','/adminStoragePolicyUpdateAction','App\Controller\AdminController#adminStoragePolicyUpdateAction','blog.adminStoragePolicyUpdateAction');
$router->map('POST','/StoragePolicyAdd','App\Controller\AdminController#StoragePolicyAdd','blog.StoragePolicyAdd');

$router->map('GET','/packageDelete/[i:id]','App\Controller\AdminController#packageDelete','blog.packageDelete');


$router->map('GET','/upgrade/action/[a:action]','App\Controller\StorageController#upgradeStorage','blog.upgradeStorage');

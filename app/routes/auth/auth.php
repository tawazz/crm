<?php

$app->get('/authorize',function() use ($app){
    $access_token = $app->request->get('access_token');
    if($access_token){
        $app->response->redirect($app->urlFor('home'));
    }else{
        $app->response->redirect($app->Config->get("auth.server")."/authorize?redirect_url=http://crm/authorize&response=code");
    }
})->name('authorize');

$app->get('/logout',function() use ($app){
    $app->deleteCookie('access_token');
    $app->auth = false;
    $app->view()->appendData([
        "auth"=>false
    ]);
    $app->response->redirect($app->Config->get("auth.server")."/logout?redirect_url=http://crm/authorize");
    return 0;
})->name('logout');

$app->get('/login',function() use ($app){
    $access_token = $app->request->get('access_token');
    if($access_token){
        $app->setCookie('access_token',$access_token);
        $app->access_token = $access_token;
        $app->response->redirect($app->urlFor('home'));
    }else{
        $app->response->redirect($app->Config->get("auth.server")."/authorize?redirect_url=http://crm/authorize&response=code");
    }
})->name('login');

 ?>

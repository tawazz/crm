<?php

$app->get('/authorize',function() use ($app){
    $access_token = $app->request->get('access_token');
    if($access_token){
        $app->response->redirect($app->urlFor('home'));
    }else{
        $app->response->redirect('http://10.6.209.19/tazzy_auth/authorize?redirect_url=http://crm/authorize&response=code');
    }
})->name('authorize');

$app->get('/logout',function() use ($app){
    try {
        $access_token = $app->getCookie('access_token');
        $logoutRequest = $app->Http->request('GET',"http://10.6.209.19/tazzy_auth/logout");
        $response = json_decode($logoutRequest->getBody()->getContents());

        if(!$response->authenticated){
            dump($response);
            $app->deleteCookie('access_token');
            dump($app->getCookie('access_token'));
            $app->auth = false;
            $app->view()->appendData([
                "auth"=>false
            ]);
            $app->response->redirect("http://10.6.209.19/tazzy_auth/authorize?redirect_url=http://crm/authorize&response=code");
            return 0;
        }
    } catch (\Exception $e) {
        dump($e);
    }
})->name('logout');

$app->get('/login',function() use ($app){
    $access_token = $app->request->get('access_token');
    if($access_token){
        $app->setCookie('access_token',$access_token);
        $app->access_token = $access_token;
        $app->response->redirect($app->urlFor('home'));
    }else{
        $app->response->redirect('http://10.6.209.19/tazzy_auth/authorize?redirect_url=http://crm/authorize&response=code');
    }
})->name('login');

 ?>

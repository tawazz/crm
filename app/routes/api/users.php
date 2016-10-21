<?php

    $app->get('/users',function() use ($app) {

    })->name('api.get.users')

    $app->put('/users/:id',function($id) use ($app) {

    })->name('api.update.users')

    $app->delete('/users/:id',function($id) use ($app) {

    })->name('api.delete.users')

    $app->post('/user',function() use ($app) {
      $body = $app->request->getBody();
      $body = json_decode($body);

      $user_data = [
        "given_name" : $body->user->given_name,
        "email"      : $body->user->email,
        "phone"      : $body->user->phone
      ];

      $service_data = [
        "site_url" : $body->service->site_url,
        "customer_id": ,
        "site_name": $body->service->site_name
      ];

    })->name('api.add.users')
 ?>

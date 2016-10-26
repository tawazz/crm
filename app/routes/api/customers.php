<?php

    $app->get('/customers',function() use ($app) {

    })->name('api.get.customers')

    $app->put('/customers/:id',function($id) use ($app) {

    })->name('api.update.customers')

    $app->delete('/customers/:id',function($id) use ($app) {

    })->name('api.delete.customers')

    $app->post('/customer',function() use ($app) {
      $body = $app->request->getBody();
      $body = json_decode($body);

      $customer_data = [
        "given_name" : $body->customer->given_name,
        "email"      : $body->customer->email,
        "phone"      : $body->customer->phone
      ];

      $service_data = [
        "site_url" : $body->service->site_url,
        "customer_id": ,
        "site_name": $body->service->site_name
      ];

    })->name('api.add.customers')
 ?>

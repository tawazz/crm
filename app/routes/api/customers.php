<?php

    $app->get('/customers',function() use ($app) {
      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      try {
        $customers = $app->Customer->all();
        $res->isOk();
        echo json_encode($customers);
      } catch (Exception $e) {
        $res->setStatus(400);
        echo json_encode([
          "error" => $e->getMessage()
        ]);
      }

    })->name('api.get.customers');

    $app->get('/customers/:id',function($id) use ($app) {
      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      try {
        $customer = $app->Customer->findOrFail($id);
        $res->isOk();
        echo json_encode($customer);
      } catch (Exception $e) {
        $res->setStatus(400);
        echo json_encode([
          "error" => $e->getMessage()
        ]);
      }

    })->name('api.retrive.customer');

    $app->put('/customers/:id',function($id) use ($app) {

      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      try {
        $customer = $app->Customer->findOrFail($id);
        $res->isOk();

        echo json_encode($customer);
      } catch (Exception $e) {
        $res->setStatus(400);
        echo json_encode([
          "error" => $e->getMessage()
        ]);
      }

    })->name('api.update.customers');

    $app->delete('/customers/:id',function($id) use ($app) {
      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      try {
        $customer = $app->Customer->findOrFail($id);
        $res->isOk();
        $customer->delete();
        echo json_encode($customer);
      } catch (Exception $e) {
        $res->setStatus(400);
        echo json_encode([
          "error" => $e->getMessage()
        ]);
      }
    })->name('api.delete.customers');

    $app->post('/customer',function() use ($app) {
      $body = $app->request->getBody();
      $body = json_decode($body);

      $customer_data = [
        "given_name" => $body->customer->given_name,
        "email"      => $body->customer->email,
        "phone"      => $body->customer->phone
      ];

      $service_data = [
        "site_url" => $body->service->site_url,
        "customer_id"=> '',
        "site_name"=> $body->service->site_name
      ];

    })->name('api.add.customers');
 ?>

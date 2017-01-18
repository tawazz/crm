<?php

    $app->get('/bills',function() use ($app) {
      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      try {
          $bills = $app->Billing->bills();
          $res->isOk();
          $res->setBody(json_encode($bills));
      } catch (Exception $e) {
        $res->setStatus(400);
            echo json_encode([
              "error" => $e->getMessage()
            ]);
      }

    })->name('api.get.bill');

    $app->get('/bill/types',function() use ($app) {
      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      try {
        $bill = $app->bill->getTypesOptions();
        $res->isOk();
        echo json_encode($bill);
      } catch (Exception $e) {
        $res->setStatus(400);
        echo json_encode([
          "error" => $e->getMessage()
        ]);
      }

    })->name('api.get.bill.types');

    $app->get('/bill/:id',function($id) use ($app) {
      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      try {
        $bill = $app->bill->findOrFail($id);
        $bill->service = $bill->service->customer;
        $res->isOk();
        echo json_encode($bill);
      } catch (Exception $e) {
        $res->setStatus(400);
        echo json_encode([
          "error" => $e->getMessage()
        ]);
      }

    })->name('api.retrive.bill');

    $app->put('/bill/:id',function($id) use ($app) {

      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      $body = $app->request->getBody();
      try {
        $body = json_decode($body,true);
        $bill = $app->bill->findOrFail($id);
        $bill->fill($body);
        $bill->save();
        $res->isOk();
        echo json_encode($bill);
      } catch (Exception $e) {
        $res->setStatus(400);
        echo json_encode([
          "error" => $e->getMessage()
        ]);
      }

    })->name('api.update.bill');

    $app->delete('/bill/:id',function($id) use ($app) {
      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      try {
        $bill = $app->bill->findOrFail($id);
        $res->isOk();
        $bill->delete();
        echo json_encode(["deleted"=>true]);
      } catch (Exception $e) {
        $res->setStatus(400);
        echo json_encode([
          "error" => $e->getMessage()
        ]);
      }
    })->name('api.delete.bill');

    $app->post('/bill',function() use ($app) {
      $body = $app->request->getBody();
      $body = json_decode($body,true);
      $body->password = base64_encode($body->password);
      $bill = $app->bill->create($body);
      $bill->save();

      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      echo json_encode($bill);

    })->name('api.add.bill');
 ?>

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

    $app->get('/bills/status',function() use ($app) {
      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      try {
        $status = $app->Billing->getTypesOptions();
        $res->isOk();
        echo json_encode($status);
      } catch (Exception $e) {
        $res->setStatus(400);
        echo json_encode([
          "error" => $e->getMessage()
        ]);
      }

    })->name('api.get.bill.types');

    $app->get('/bills/:id',function($id) use ($app) {
      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      try {
        $bill = $app->Billing->findOrFail($id);
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

    $app->put('/bills/:id',function($id) use ($app) {

      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      $body = $app->request->getBody();
      try {
        $body = json_decode($body,true);
        $bill = $app->Billing->findOrFail($id);
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

    $app->delete('/bills/:id',function($id) use ($app) {
      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      try {
        $bill = $app->Billing->findOrFail($id);
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

    $app->post('/bills',function() use ($app) {
      $body = $app->request->getBody();
      $body = json_decode($body,true);
      $bill = $app->Billing->create($body);
      $bill->save();

      $res = $app->response;
      $res->isOk();
      $res->headers->set('Content-Type', 'application/json');
      echo json_encode($bill);

    })->name('api.add.bill');
 ?>

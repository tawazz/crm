<?php

    $app->get('/services',function() use ($app) {
      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      try {
        $services = $app->Service->getServices($app);
        $res->isOk();
        echo json_encode($services);
      } catch (Exception $e) {
        $res->setStatus(400);
        echo json_encode([
          "error" => $e->getMessage()
        ]);
      }

    })->name('api.get.services');

    $app->get('/services/:id',function($id) use ($app) {
      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      try {
        $service = $app->Service->findOrFail($id);
        $res->isOk();
        echo json_encode($service);
      } catch (Exception $e) {
        $res->setStatus(400);
        echo json_encode([
          "error" => $e->getMessage()
        ]);
      }

    })->name('api.retrive.service');

    $app->put('/services/:id',function($id) use ($app) {

      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      $body = $app->request->getBody();
      try {
        $body = json_decode($body,true);
        $service = $app->Service->findOrFail($id);
        $service->fill($body);
        $service->save();
        $res->isOk();
        echo json_encode($service);
      } catch (Exception $e) {
        $res->setStatus(400);
        echo json_encode([
          "error" => $e->getMessage()
        ]);
      }

    })->name('api.update.services');

    $app->delete('/services/:id',function($id) use ($app) {
      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      try {
        $service = $app->Service->findOrFail($id);
        $res->isOk();
        $service->delete();
        echo json_encode(["deleted"=>true]);
      } catch (Exception $e) {
        $res->setStatus(400);
        echo json_encode([
          "error" => $e->getMessage()
        ]);
      }
    })->name('api.delete.services');

    $app->post('/services',function() use ($app) {
      $body = $app->request->getBody();
      $body = json_decode($body,true);
      $service = $app->Service->create($body);
      $service->save();

      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      echo json_encode($service);

    })->name('api.add.services');
 ?>

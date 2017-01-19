<?php

    $app->get('/vault',function() use ($app) {
      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      try {
        $vault = $app->Vault->openVault();
        $res->isOk();
        $res->setBody(json_encode($vault));
      } catch (Exception $e) {
        $res->setStatus(400);
        echo json_encode([
          "error" => $e->getMessage()
        ]);
      }

    })->name('api.get.vault');

    $app->get('/vault/types',function() use ($app) {
      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      try {
        $vault = $app->Vault->getTypesOptions();
        $res->isOk();
        echo json_encode($vault);
      } catch (Exception $e) {
        $res->setStatus(400);
        echo json_encode([
          "error" => $e->getMessage()
        ]);
      }

    })->name('api.get.vault.types');

    $app->get('/vault/:id',function($id) use ($app) {
      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      try {
        $vault = $app->Vault->findOrFail($id);
        $vault->service = $vault->service->customer;
        $res->isOk();
        echo json_encode($vault);
      } catch (Exception $e) {
        $res->setStatus(400);
        echo json_encode([
          "error" => $e->getMessage()
        ]);
      }

    })->name('api.retrive.vault');

    $app->put('/vault/:id',function($id) use ($app) {

      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      $body = $app->request->getBody();
      try {
        $body = json_decode($body,true);
        $vault = $app->Vault->findOrFail($id);
        $body->password = base64_encode($body->password);
        $vault->fill($body);
        $vault->save();
        $res->isOk();
        echo json_encode($vault);
      } catch (Exception $e) {
        $res->setStatus(400);
        echo json_encode([
          "error" => $e->getMessage()
        ]);
      }

    })->name('api.update.vault');

    $app->delete('/vault/:id',function($id) use ($app) {
      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      try {
        $vault = $app->Vault->findOrFail($id);
        $res->isOk();
        $vault->delete();
        echo json_encode(["deleted"=>true]);
      } catch (Exception $e) {
        $res->setStatus(400);
        echo json_encode([
          "error" => $e->getMessage()
        ]);
      }
    })->name('api.delete.vault');

    $app->post('/vault',function() use ($app) {
      $body = $app->request->getBody();
      $body = json_decode($body,true);
      $body->password = base64_encode($body->password);
      $vault = $app->Vault->create($body);
      $vault->save();

      $res = $app->response;
      $res->headers->set('Content-Type', 'application/json');
      echo json_encode($vault);

    })->name('api.add.vault');
 ?>

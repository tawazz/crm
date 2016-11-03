<?php

  $app->get('/dashboard/customers',function() use ($app) {
    $app->render('dash/customers.twig');
  })->name('dash.customers');
 ?>

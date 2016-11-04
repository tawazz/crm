<?php

  $app->get('/dashboard/customers',function() use ($app) {
    //$app->render('dash/customers.twig');
    $app->render('home/home.php');
  })->name('dash.customers');
 ?>

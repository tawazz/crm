<?php

  $app->get('/dashboard/customers',function() use ($app) {
    //$app->render('dash/customers.twig');
    $app->render('home/home.php');
  })->name('dash.customers');

  $app->get('/dashboard/customers/add',function() use ($app) {
    $app->render('home/home.php');
  })->name('dash.customers.add');
  $app->get('/dashboard/customers/:id',function($id) use ($app) {
    $app->render('home/home.php');
  })->name('dash.customer.details');
 ?>

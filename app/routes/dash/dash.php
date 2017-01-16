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

  $app->get('/dashboard/services',function() use ($app) {
    $app->render('home/home.php');
  })->name('dash.services');

  $app->get('/dashboard/services/:id',function($id) use ($app) {
    $app->render('home/home.php');
  })->name('dash.services.add');

  $app->get('/dashboard/vault',function() use ($app) {
    $app->render('home/home.php');
  })->name('dash.vault');
  $app->get('/dashboard/+',function($args) use ($app) {
    $app->render('home/home.php');
});
 ?>

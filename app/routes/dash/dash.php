<?php

  $app->get('/dashboard/customers',$require_admin,function() use ($app) {
    //$app->render('dash/customers.twig');
    $app->render('home/home.php');
  })->name('dash.customers');

  $app->get('/dashboard/customers/add',$require_admin,function() use ($app) {
    $app->render('home/home.php');
  })->name('dash.customers.add');

  $app->get('/dashboard/customers/:id',$require_admin,function($id) use ($app) {
    $app->render('home/home.php');
  })->name('dash.customer.details');

  $app->get('/dashboard/services',$require_admin,function() use ($app) {
    $app->render('home/home.php');
  })->name('dash.services');

  $app->get('/dashboard/services/:id',$require_admin,function($id) use ($app) {
    $app->render('home/home.php');
  })->name('dash.services.add');

  $app->get('/dashboard/vault',$require_admin,function() use ($app) {
    $app->render('home/home.php');
  })->name('dash.vault');
  $app->get('/dashboard/:page+',$require_admin,function($args) use ($app) {
    $app->render('home/home.php');
});
 ?>

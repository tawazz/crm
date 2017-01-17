<?php
  $app->get('/',$require_login,function() use ($app){
    $app->render('home/home.php');
  })->name('home');

  $app->get('/about',function() use ($app){
    $app->render('home/about.php');
  })->name('about');

  $app->get('/contact',function() use ($app){
    $app->render('home/contact.php');
  })->name('contact');

  $app->get('/help',function() use ($app){
    $app->render('home/help.php');
  })->name('help');
  $app->get('/invoice',function() use ($app){
    $app->render('home/invoice.php');
  })->name('invoice');

  $app->post('/contact', function() use ($app){
    if( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) ){
     $name = $_POST['name'];
     $email = $_POST['email'];
     $phone = $_POST['phone'];
     $msg = $_POST['msg'];

     $M= "Name : {$name}". "Email: {$email} Phone : {$phone} "."Message : {$msg}";
     mail("tawanda.nyakudjga@gmail.com","tawazz.net/me",$M);
    }
      $app->flash("global","your message was sent");
      $app->response->redirect($app->urlFor('contact'));
  })->name('post.contact');


 ?>

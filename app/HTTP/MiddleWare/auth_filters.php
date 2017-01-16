<?php
  $authCheck = function($required) use($app){
    return function() use($required,$app){
      if((!$app->auth && $required) || ($app->auth && !$required)){
        $app->redirect($app->urlFor('home'));
      }
    };
  };
  $require_login = function() use($app){
    return function() use($app){
      if(!$app->auth && TRUE){
        $app->flash('global','Login required to access the resource');
        $app->redirect('http://10.6.209.19/tazzy_auth/authorize?redirect_url=http://crm/authorize&response=code');
      }
    };
  };


  $guest = function() use($authCheck){
    return $authCheck(false);
  };
 ?>

<?php

  $app->container->set('Customer',function(){
    return new HTTP\Models\Customer();
  });
  $app->container->set('Service',function(){
    return new HTTP\Models\Service();
  });
 ?>

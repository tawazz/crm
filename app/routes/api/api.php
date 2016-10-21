<?php
    $app->group('/api',$require_login , function () use ($app) {
        require 'services.php';
        require 'users.php';
    });

 ?>

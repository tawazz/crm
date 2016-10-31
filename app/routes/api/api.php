<?php
    $app->group('/api', function () use ($app) {
        require 'services.php';
        require 'customers.php';
    });

 ?>

<?php
require 'settings.php';
return [
  'paths' => [
    'migrations' => 'migrations'
  ],
  'migration_base_class' => '\MyProject\Migration\Migration',
  'environments' => [
    'default_migration_table' => 'phinxlog',
    'default_database' => 'dev',
    'dev' => [
      'name'      => Settings::get('mysql.database'),
      'adapter'   => Settings::get('mysql.driver'),
      'host'      => Settings::get('mysql.host'),
      'username'  => Settings::get('mysql.username'),
      'password'  => Settings::get('mysql.password'),
    ]
  ]
];

?>

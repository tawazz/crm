<?php
  namespace HTTP\Migration;
  require  __DIR__.'../../config/db.config.php';

  use Phinix\Migration\AbstractMigration;


  /**
   * base migration class
   */
  class Migration extends AbstractMigration
  {
    public $capsule;
    public $schema;

    public function init()
    {
       $this->capsule = Capsule;
       $this->schema = Capsule->schema();
    }
  }





 ?>

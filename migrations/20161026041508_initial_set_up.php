<?php

use \MyProject\Migration\Migration;

class InitialSetUp extends Migration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {

    }

    public function up()
    {
      $this->schema->create('customers',function($table){
        $table->increments('id');
        $table->string('first_name');
        $table->string('last_name');
        $table->string('email');
        $table->string('phone');
        $table->timestamps();
      });

      $this->schema->create('service',function($table){
        $table ->increments('id');
        $table->enum('service',['website','hosting','email','other']);
        $table->foreign('customer_id')->references('id')->on('customers');
      })
    }
}

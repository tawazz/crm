<?php

use HTTP\Migrations\Migration;

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

      $this->schema->create('services',function($table){
        $table ->increments('id');
        $table->enum('type',['website','hosting','email','other']);
        $table->foreign('customer_id')->references('id')->on('customers');
        $table->date('service_start');
        $table->date('service_end');
        $table->timestamps();

      });

      $this->schema->create('vault', function($table){
          $table->increments('id');
          $table->string('name');
          $table->string('url');
          $table->string('username');
          $table->timestamps();
          $table->string('password');

      });

      $this->schema->create('payments',function($table){
        $table->increments('id');
        $table->foreign('customer_id')->references('id')->on('customers');
        $table->foreign('service_id')->references('id')->on('services');
        $table->decimal('amount');
        $table->date('payed_on');
        $table->date('due');
        $table->timestamps();
      });
    }
}

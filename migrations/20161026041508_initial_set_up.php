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

    public function up()
    {
      $this->schema->create('customers',function($table){
        $table->increments('id')->unsigned();
        $table->string('first_name');
        $table->string('last_name');
        $table->string('company');
        $table->string('email');
        $table->string('phone');
        $table->string('address');
        $table->timestamps();
      });

      $this->schema->create('services',function($table){
        $table->increments('id')->unsigned();
        $table->enum('type',['website','hosting','email','other']);
        $table->integer('customer_id')->unsigned();
        $table->foreign('customer_id')->references('id')->on('customers');
        $table->string('name');
        $table->date('service_start');
        $table->date('service_end');
        $table->timestamps();

      });

      $this->schema->create('vault', function($table){
          $table->increments('id')->unsigned();
          $table->integer('service_id')->unsigned();
          $table->foreign('service_id')->references('id')->on('services');
          $table->string('url');
          $table->string('username');
          $table->string('password');
          $table->string('notes');
          $table->timestamps();

      });

      $this->schema->create('payments',function($table){
        $table->increments('id');
        $table->integer('customer_id')->unsigned();
        $table->foreign('customer_id')->references('id')->on('customers');
        $table->integer('service_id')->unsigned();
        $table->foreign('service_id')->references('id')->on('services');
        $table->decimal('amount');
        $table->date('payed_on');
        $table->date('due');
        $table->timestamps();
      });
    }
}

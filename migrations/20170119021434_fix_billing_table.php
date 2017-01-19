<?php

use \HTTP\Migrations\Migration;
use \Illuminate\Database\Schema\Blueprint;

class FixBillingTable extends Migration
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
        $this->schema->getConnection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        $this->schema->table('billing', function (Blueprint $table) {
            $table->dropColumn('due');
            $table->decimal('amount',8,2)->default(0.00)->change();
            $table->date('payed_on')->nullable()->default(null)->change();
        });
    }
}

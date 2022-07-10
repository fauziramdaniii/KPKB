<?php
use Migrations\AbstractMigration;

class CreateOrdersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('orders');

        $table->addColumn('invoice', 'string', [
            'limit' => 15,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('order_status_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('stockist_customer_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('customer_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('province_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('city_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('address', 'string', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('recipient_name', 'string', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('recipient_phone', 'string', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('gross_total', 'float', [
            'default' => 0,
            'null' => true,
        ]);

        $table->addColumn('total', 'float', [
            'default' => 0,
            'null' => true,
        ]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addIndex('invoice', [
            'unique' =>  true
        ]);

        $table->addIndex('stockist_customer_id');
        $table->addIndex('customer_id');
        $table->addIndex('province_id');
        $table->addIndex('city_id');


        $table->create();
    }
}

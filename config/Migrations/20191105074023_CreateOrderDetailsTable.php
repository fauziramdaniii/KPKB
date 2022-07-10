<?php
use Migrations\AbstractMigration;

class CreateOrderDetailsTable extends AbstractMigration
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
        $table = $this->table('order_details');

        $table->addColumn('order_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('product_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('qty', 'integer', [
            'default' => 1,
            'null' => true,
        ]);

        $table->addColumn('price', 'float', [
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

        $table->addIndex('order_id');
        $table->addIndex('product_id');


        $table->create();
    }
}

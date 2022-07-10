<?php
use Migrations\AbstractMigration;

class CreateOrderConfirmationsTable extends AbstractMigration
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
        $table = $this->table('order_confirmations');

        $table->addColumn('customer_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('order_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('bank_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('amount', 'float', [
            'default' => 0,
            'null' => true,
        ]);

        $table->addColumn('confirmation_date', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('image_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('note', 'string', [
            'default' => null,
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

        $table->addIndex('customer_id');
        $table->addIndex('order_id');
        $table->addIndex('bank_id');
        $table->addIndex('image_id');


        $table->create();
    }
}

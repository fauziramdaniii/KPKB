<?php
use Migrations\AbstractMigration;

class CreateCustomerProductStockMutations extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('customer_stock_mutations');

        $table->addColumn('customer_stock_mutation_transaction_id', 'integer', [
            'limit' => 11,
            'default' => null,
            'null' => true
        ]);

        $table->addColumn('customer_id', 'integer', [
            'limit' => 11,
            'default' => null,
            'null' => true
        ]);

        $table->addColumn('product_id', 'integer', [
            'limit' => 11,
            'default' => null,
            'null' => true
        ]);

        $table->addColumn('customer_stock_id', 'integer', [
            'limit' => 11,
            'default' => null,
            'null' => true
        ]);

        $table->addColumn('qty_in', 'float', [
            'default' => 0
        ]);

        $table->addColumn('qty_out', 'float', [
            'default' => 0
        ]);

        $table->addColumn('total_qty', 'float', [
            'default' => 0
        ]);


        $table->create();
    }
}

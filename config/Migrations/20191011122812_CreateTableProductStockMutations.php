<?php
use Migrations\AbstractMigration;

class CreateTableProductStockMutations extends AbstractMigration
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
        $table = $this->table('product_stock_mutations');

        $table->addColumn('product_stock_mutation_transaction_id', 'integer', [
            'limit' => 11,
            'null' => false
        ]);
        $table->addColumn('product_id', 'integer', [
            'limit' => 11,
            'null' => false
        ]);
        $table->addColumn('product_stock_id', 'integer', [
            'limit' => 11,
            'null' => false
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

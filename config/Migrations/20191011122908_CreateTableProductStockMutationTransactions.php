<?php
use Migrations\AbstractMigration;

class CreateTableProductStockMutationTransactions extends AbstractMigration
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
        $table = $this->table('product_stock_mutation_transactions');

        $table->addColumn('description', 'string', [
            'limit' => 200,
            'null' => false
        ]);
        $table->addColumn('amount', 'float', [
            'limit' => 200,
            'default' => 0,
        ]);
        $table->create();
    }
}

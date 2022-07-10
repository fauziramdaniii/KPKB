<?php
use Migrations\AbstractMigration;

class CreateCustomerProductStockMutationTransactions extends AbstractMigration
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
        $table = $this->table('customer_stock_mutation_transactions');

        $table->addColumn('customer_id', 'integer', [
            'limit' => 11,
            'default' => null,
            'null' => true
        ]);

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

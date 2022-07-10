<?php
use Migrations\AbstractMigration;

class CreateTableProductStockMutationTypes extends AbstractMigration
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
        $table = $this->table('product_stock_mutation_types');

        $table->addColumn('name', 'string', [
            'limit' => 50,
            'null' => false
        ]);
        $table->create();
    }
}

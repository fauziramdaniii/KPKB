<?php
use Migrations\AbstractMigration;

class CreateCustomerProductStocks extends AbstractMigration
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
        $table = $this->table('customer_stocks');

        $table->addColumn('customer_id', 'integer', [
            'default' => null,
            'null' => true,
        ])->addIndex('customer_id');

        $table->addColumn('product_id', 'integer', [
            'default' => null,
            'null' => true,
        ])->addIndex('product_id');


        $table->addColumn('quantity', 'integer', [
            'default' => 0,
            'null' => true,
        ]);

        $table->create();
    }
}

<?php
use Migrations\AbstractMigration;

class AlterTbaleProductStocks extends AbstractMigration
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
        $table = $this->table('product_stocks');
        $table->addColumn('supplier_id', 'integer', [
            'default' => null,
            'null' => true,
            'after' => 'product_id',
        ])->addIndex('supplier_id');
        $table->update();
    }
}

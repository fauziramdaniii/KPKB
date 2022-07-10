<?php
use Migrations\AbstractMigration;

class AlterTableProductStockMutations extends AbstractMigration
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
        $table = $this->table('product_stock_mutations');

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
            'after' => 'total_qty'
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
            'after' => 'created'
        ]);
        $table->update();
    }
}

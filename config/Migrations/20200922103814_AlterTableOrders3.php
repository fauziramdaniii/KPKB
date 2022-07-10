<?php
use Migrations\AbstractMigration;

class AlterTableOrders3 extends AbstractMigration
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
        $table = $this->table('orders');

        $table->addColumn('stock_type', 'integer', [
            'default' => null,
            'null' => true,
            'after' => 'total_weight',
            'comment' => '1 : in stock, 2 : non stock',
        ]);
        $table->addColumn('confirm_date', 'date', [
            'default' => null,
            'null' => true,
            'after' => 'stock_type',
        ]);
        $table->update();
    }
}

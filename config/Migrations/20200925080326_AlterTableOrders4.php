<?php
use Migrations\AbstractMigration;

class AlterTableOrders4 extends AbstractMigration
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

        $table->addColumn('flag', 'integer', [
            'limit' => 11,
            'default' => null,
            'null' => true,
            'after' => 'stock_type',
            'comment' => '1 to company, 2 to stockist',
        ]);
        $table->update();
    }
}

<?php
use Migrations\AbstractMigration;

class AlterTableOrders6 extends AbstractMigration
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
        $table->addColumn('notes', 'text', [
            'default' => null,
            'null' => true,
            'after' => 'total_weight'
        ]);
        $table->update();
    }
}

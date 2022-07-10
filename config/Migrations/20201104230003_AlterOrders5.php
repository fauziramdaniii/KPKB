<?php
use Migrations\AbstractMigration;

class AlterOrders5 extends AbstractMigration
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

        $table->addColumn('base_price', 'float', [
            'default' => 0,
            'null' => true,
            'after' => 'gross_total'
        ]);

        $table->update();
    }
}

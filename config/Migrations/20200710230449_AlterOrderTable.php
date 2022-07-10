<?php
use Migrations\AbstractMigration;

class AlterOrderTable extends AbstractMigration
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
        $table = $this->table('orders');

        $table->addColumn('is_freeshipping', 'boolean', [
            'default' => 0,
            'after' => 'shipping_cost',
        ]);

        $table->update();
    }
}

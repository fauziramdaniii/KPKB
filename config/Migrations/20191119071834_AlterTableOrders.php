<?php
use Migrations\AbstractMigration;

class AlterTableOrders extends AbstractMigration
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
        $table->addColumn('secret_key', 'string', [
            'limit' => 10,
            'default' => null,
            'null' => true,
            'after' => 'awb',
        ]);
        $table->update();
    }
}

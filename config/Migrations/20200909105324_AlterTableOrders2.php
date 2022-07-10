<?php
use Migrations\AbstractMigration;

class AlterTableOrders2 extends AbstractMigration
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

        $table->addColumn('zip', 'string', [
            'limit' => 5,
            'default' => NULL,
            'null' => true,
            'after' => 'subdistrict_id',
        ]);
        $table->update();
    }
}

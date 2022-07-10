<?php
use Migrations\AbstractMigration;

class AlterOrdersTable extends AbstractMigration
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

        $table->addColumn('awb', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => true,
            'after' => 'invoice',
        ]);

        $table->addIndex('awb');

        $table->update();
    }
}

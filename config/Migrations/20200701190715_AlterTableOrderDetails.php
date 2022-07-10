<?php
use Migrations\AbstractMigration;

class AlterTableOrderDetails extends AbstractMigration
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
        $table = $this->table('order_details');

        $table->addColumn('weight', 'float', [
            'default' => 0,
            'null' => true,
            'after' => 'total'
        ]);
        $table->addColumn('total_weight', 'float', [
            'default' => 0,
            'null' => true,
            'after' => 'weight'
        ]);
        $table->update();
    }
}

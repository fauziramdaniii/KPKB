<?php
use Migrations\AbstractMigration;

class AlterTableOrders1 extends AbstractMigration
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

        $table->addColumn('subdistrict_id', 'integer', [
            'default' => null,
            'null' => true,
            'after' => 'city_id'
        ]);
        $table->addColumn('shipping_cost', 'float', [
            'default' => 0,
            'null' => true,
            'after' => 'gross_total'
        ]);
        $table->addColumn('courrier', 'string', [
            'null' => true,
            'after' => 'recipient_phone'
        ]);
        $table->addColumn('courrier_type', 'string', [
            'null' => true,
            'after' => 'courrier'
        ]);
        $table->addColumn('total_weight', 'float', [
            'default' => 0,
            'null' => true,
            'after' => 'total'
        ]);
        $table->update();
    }
}

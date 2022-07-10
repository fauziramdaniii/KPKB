<?php
use Migrations\AbstractMigration;

class AlterTableCustomerAddress extends AbstractMigration
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
        $table = $this->table('customer_address');
        $table->addColumn('receiver_name', 'string', [
            'limit' => 70,
            'null' => false,
            'after' => 'customer_id'
        ]);
        $table->addColumn('receiver_phone', 'string', [
            'limit' => 15,
            'null' => false,
            'after' => 'receiver_name'
        ]);

        $table->update();
    }
}

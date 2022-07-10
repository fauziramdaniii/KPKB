<?php
use Migrations\AbstractMigration;

class AlterTableOrderConfirmations extends AbstractMigration
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
        $table = $this->table('order_confirmations');
        $table->addColumn('destination_bank', 'string', [
            'limit' => 150,
            'default' => null,
            'null' => true,
            'after' => 'customer_bank_id',
        ]);
        $table->update();
    }
}

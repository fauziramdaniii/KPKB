<?php
use Migrations\AbstractMigration;

class AlterOrderConfirmationsTable extends AbstractMigration
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

        $table->renameColumn('bank_id', 'customer_bank_id');



        $table->update();
    }
}

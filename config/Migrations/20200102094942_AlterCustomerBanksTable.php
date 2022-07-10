<?php
use Migrations\AbstractMigration;

class AlterCustomerBanksTable extends AbstractMigration
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
        $table = $this->table('customer_banks');

        $table->addColumn('deleted', 'datetime', [
            'default' => null,
            'null' => true,
            'after' => 'account_number',
        ]);

        $table->update();
    }
}

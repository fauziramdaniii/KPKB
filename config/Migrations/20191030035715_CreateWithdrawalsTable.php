<?php
use Migrations\AbstractMigration;

class CreateWithdrawalsTable extends AbstractMigration
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
        $table = $this->table('withdrawals');

        $table->addColumn('customer_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('customer_bank_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('withdrawal_status_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('transaction_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('amount', 'float', [
            'default' => 0,
            'null' => true,
        ]);

        $table->addColumn('note', 'string', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addIndex('customer_id');
        $table->addIndex('customer_bank_id');
        $table->addIndex('transaction_id');

        $table->create();
    }
}

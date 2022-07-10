<?php
use Migrations\AbstractMigration;

class AlterWithdrawalsTable extends AbstractMigration
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

        $table->addColumn('bank_name', 'string', [
            'default' => null,
            'null' => true,
            'after' => 'customer_id',
        ]);

        $table->addColumn('bank_city', 'string', [
            'default' => null,
            'null' => true,
            'after' => 'bank_name',
        ]);

        $table->addColumn('bank_branch', 'string', [
            'default' => null,
            'null' => true,
            'after' => 'bank_city',
        ]);

        $table->addColumn('bank_account_name', 'string', [
            'default' => null,
            'null' => true,
            'after' => 'bank_branch',
        ]);

        $table->addColumn('bank_account_number', 'string', [
            'default' => null,
            'null' => true,
            'after' => 'bank_account_name',
        ]);



        $table->update();
    }
}

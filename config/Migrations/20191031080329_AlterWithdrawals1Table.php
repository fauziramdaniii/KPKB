<?php
use Migrations\AbstractMigration;

class AlterWithdrawals1Table extends AbstractMigration
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

        $table->addColumn('fee', 'float', [
            'default' => 0,
            'null' => true,
            'after' => 'amount',
        ]);

        $table->update();
    }
}

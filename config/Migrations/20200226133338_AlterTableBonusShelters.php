<?php
use Migrations\AbstractMigration;

class AlterTableBonusShelters extends AbstractMigration
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
        $table = $this->table('bonus_shelters');

        $table->addColumn('payout', 'float', [
            'default' => 0,
            'null' => true,
            'after' => 'amount',
        ]);
        $table->update();
    }
}

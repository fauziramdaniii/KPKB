<?php
use Migrations\AbstractMigration;

class CreateTableBonusShelterLogs extends AbstractMigration
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
        $table = $this->table('bonus_shelter_logs');

        $table->addColumn('periode', 'string', [
            'default' => null,
            'null' => true,
            'limit' => 6,
        ]);
        $table->addColumn('rank_id', 'integer', [
            'null' => false,
        ]);
        $table->addColumn('amount', 'float', [
            'default' => 0,
            'null' => true,
        ]);
        $table->addColumn('payout', 'float', [
            'default' => 0,
            'null' => true,
        ]);
        $table->create();
    }
}

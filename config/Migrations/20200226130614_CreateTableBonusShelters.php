<?php
use Migrations\AbstractMigration;

class CreateTableBonusShelters extends AbstractMigration
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

        $table->addColumn('rank_id', 'integer', [
            'null' => false,
        ])->addIndex('rank_id');
        $table->addColumn('amount', 'float', [
            'default' => 0,
            'null' => true,
        ]);
        $table->create();
    }
}

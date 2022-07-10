<?php
use Migrations\AbstractMigration;

class AlterCustomersTable1 extends AbstractMigration
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
        $table = $this->table('customers');

        $table->addColumn('vip_rank_id', 'integer', [
            'default' => 1,
            'null' => true,
            'after' => 'rank_id',
        ])->addIndex('vip_rank_id');

        $table->addColumn('is_vip', 'boolean', [
            'default' => 0,
            'null' => true,
            'after' => 'vip_rank_id',
        ])->addIndex('is_vip');

        $table->update();
    }
}

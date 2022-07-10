<?php
use Migrations\AbstractMigration;

class AlterGenerations1Table extends AbstractMigration
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
        $table = $this->table('generations');

        $table->addIndex('customer_id');
        $table->addIndex('refferal_id');
        $table->addIndex('level');

        $table->addIndex(['refferal_id', 'level']);

        $table->update();
    }
}

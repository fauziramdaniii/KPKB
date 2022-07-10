<?php
use Migrations\AbstractMigration;

class AlterTableProvinces extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('provinces');
        $table->removeColumn('shipping_cost');
        $table->addColumn('zone', 'integer', [
            'limit' => 1,
            'default' => 1,
            'null' => true,
            'after' => 'name',
        ]);
        $table->update();
    }
}

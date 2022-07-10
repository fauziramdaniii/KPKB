<?php
use Migrations\AbstractMigration;

class AlterTableProvice extends AbstractMigration
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

        $table->addColumn('shipping_cost', 'float', [
            'default' => 0,
            'null' => true,
            'after' => 'name',
        ]);
        $table->update();
    }
}

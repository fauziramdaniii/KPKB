<?php
use Migrations\AbstractMigration;

class AlterTableProducts extends AbstractMigration
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
        $table = $this->table('products');
        $table->addColumn('on_sales', 'integer', [
            'limit' => 1,
            'default' => 0,
            'after' => 'point',
        ]);
        $table->update();
    }
}

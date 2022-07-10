<?php
use Migrations\AbstractMigration;

class AlterTableCards4 extends AbstractMigration
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
        $table = $this->table('cards');
        $table->addColumn('supplier_id', 'integer', [
            'default' => null,
            'null' => true,
            'after' => 'product_id',
        ])->addIndex('supplier_id');
        $table->update();
    }
}

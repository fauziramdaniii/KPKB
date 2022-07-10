<?php
use Migrations\AbstractMigration;

class CreateTableProducts extends AbstractMigration
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

        $table->addColumn('name', 'string', [
            'limit' => 50,
            'null' => false
        ]);
        $table->addColumn('sku', 'string', [
            'limit' => 50,
            'null' => false
        ]);
        $table->addColumn('supplier_id', 'integer', [
            'limit' => 11,
            'null' => false
        ]);
        $table->addColumn('product_unit_id', 'integer', [
            'limit' => 11,
            'null' => false
        ]);
        $table->addColumn('description', 'text');
        $table->addColumn('price', 'float', [
            'default' => 0,
        ]);
        $table->addColumn('point', 'integer', [
            'limit' => 11,
            'null' => false
        ]);
        $table->create();
    }
}

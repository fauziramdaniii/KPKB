<?php
use Migrations\AbstractMigration;

class AlterTableProducts2 extends AbstractMigration
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
        $table->addColumn('stokist_price', 'float', [
            'default' => 0,
            'null' => true,
            'after' => 'price',
        ]);
        $table->addColumn('weight', 'float', [
            'default' => 0,
            'null' => true,
        ]);
        $table->update();
    }
}

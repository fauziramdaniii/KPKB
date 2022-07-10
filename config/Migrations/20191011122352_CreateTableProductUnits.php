<?php
use Migrations\AbstractMigration;

class CreateTableProductUnits extends AbstractMigration
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
        $table = $this->table('product_units');
        $table->addColumn('name', 'string', [
            'limit' => 20,
            'null' => false
        ]);
        $table->create();
    }
}

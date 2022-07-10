<?php
use Migrations\AbstractMigration;

class CreateTableProductStocks extends AbstractMigration
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
        $table = $this->table('product_stocks');
        $table->addColumn('product_id', 'integer', [
            'limit' => 11,
            'null' => false
        ]);
        $table->addColumn('quantity', 'float', [
            'default' => 0
        ]);
        $table->create();
    }
}

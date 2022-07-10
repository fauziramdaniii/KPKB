<?php
use Migrations\AbstractMigration;

class AlterTableCards2 extends AbstractMigration
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

        $table->addColumn('stock_type', 'integer', [
            'default' => null,
            'null' => true,
            'after' => 'customer_id',
            'comment' => '1 : in stock, 2 : non stock',
        ]);
        $table->update();
    }
}
